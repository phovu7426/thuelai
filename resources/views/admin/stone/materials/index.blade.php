@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chất liệu đá</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.stone.materials.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus"></i> Thêm mới
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.stone.materials.index') }}" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" name="name" class="form-control" placeholder="Tên chất liệu"
                                value="{{ request('name') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="slug" class="form-control" placeholder="Slug"
                                value="{{ request('slug') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="description" class="form-control" placeholder="Mô tả"
                                value="{{ request('description') }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Lọc</button>
                            <a href="{{ route('admin.stone.materials.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="50">ID</th>
                                <th>Tên chất liệu</th>
                                <th>Slug</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th width="150">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($materials ?? [] as $material)
                                <tr>
                                    <td>{{ $material->id }}</td>
                                    <td>{{ $material->name }}</td>
                                    <td>{{ $material->slug }}</td>
                                    <td>{{ Str::limit($material->description, 100) }}</td>
                                    <td>
                                        @if ($material->status == 1)
                                            <span class="badge bg-success">Hiển thị</span>
                                        @else
                                            <span class="badge bg-danger">Ẩn</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.stone.materials.edit', $material->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.stone.materials.destroy', $material->id) }}"
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

                @if (isset($materials) && method_exists($materials, 'links'))
                    <div class="mt-4">
                        {{ $materials->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
