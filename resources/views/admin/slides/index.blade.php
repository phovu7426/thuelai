@extends('admin.index')

@section('page_title', 'Danh sách Slide')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Danh sách Slide</li>
@endsection

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-9">
                                <form action="{{ route('admin.slides.index') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="title" class="form-control"
                                                placeholder="Nhập tiêu đề slide" value="{{ request('title') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary">Lọc</button>
                                            <a href="{{ route('admin.slides.index') }}" class="btn btn-secondary">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-3 d-flex">
                                <a href="{{ route('admin.slides.create') }}" class="btn btn-primary ms-auto">Thêm Slide</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>STT</th>
                                        <th>Tiêu đề</th>
                                        <th>Hình ảnh</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($slides as $index => $slide)
                                        <tr>
                                            <td>{{ method_exists($slides, 'firstItem') ? $slides->firstItem() + $index : $loop->iteration }}
                                            </td>
                                            <td>{{ $slide->title }}</td>
                                            <td>
                                                @if ($slide->image)
                                                    <img src="{{ asset('storage/' . $slide->image) }}"
                                                        style="max-width: 120px; max-height: 60px;" class="img-thumbnail">
                                                @endif
                                            </td>
                                            <td>
                                                @if ($slide->status)
                                                    <span class="badge bg-success">Hiển thị</span>
                                                @else
                                                    <span class="badge bg-secondary">Ẩn</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.slides.edit', $slide->id) }}"
                                                    class="btn btn-sm btn-warning" title="Sửa"><i
                                                        class="fas fa-edit"></i></a>
                                                <form action="{{ route('admin.slides.destroy', $slide->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Xóa"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if (method_exists($slides, 'links'))
                            @include('vendor.pagination.pagination', ['paginator' => $slides])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
