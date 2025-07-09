@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quản lý Slide</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.slides.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus"></i> Thêm mới
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.slides.index') }}" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="title" class="form-control" placeholder="Tiêu đề slide"
                                value="{{ request('title') }}">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="description" class="form-control" placeholder="Mô tả"
                                value="{{ request('description') }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Lọc</button>
                            <a href="{{ route('admin.slides.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="50">ID</th>
                                <th>Tiêu đề</th>
                                <th>Mô tả</th>
                                <th>Hình ảnh</th>
                                <th>Trạng thái</th>
                                <th width="150">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($slides ?? [] as $slide)
                                <tr>
                                    <td>{{ $slide->id }}</td>
                                    <td>{{ $slide->title }}</td>
                                    <td>{{ Str::limit($slide->description, 100) }}</td>
                                    <td>
                                        @if ($slide->image)
                                            <img src="{{ asset('storage/' . $slide->image) }}"
                                                style="max-width: 120px; max-height: 60px;" class="img-thumbnail">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($slide->status == 1)
                                            <span class="badge bg-success">Hiển thị</span>
                                        @else
                                            <span class="badge bg-danger">Ẩn</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.slides.edit', $slide->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.slides.destroy', $slide->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if (isset($slides) && method_exists($slides, 'links'))
                    <div class="mt-4">
                        {{ $slides->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
