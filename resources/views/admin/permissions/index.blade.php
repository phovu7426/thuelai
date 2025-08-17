@extends('admin.index')

@section('page_title', 'Danh sách quyền')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Danh sách quyền</li>
@endsection

@section('content')
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-sm-9">
                                <!-- Form lọc -->
                                <form action="{{ route('admin.permissions.index') }}" method="GET" class="mb-0">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <input type="text" name="name" class="form-control" placeholder="🔍 Nhập tên quyền"
                                                   value="{{ request('name') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-search"></i> Lọc
                                            </button>
                                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
                                                <i class="bi bi-arrow-clockwise"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end">
                                @can('access_users')
                                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle"></i> Thêm Quyền
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ý nghĩa quyền</th>
                                <th>Tên quyền</th>
                                <th>Quyền cha</th>
                                <th>Mặc định</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions ?? [] as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->title }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->parent->title ?? 'Không có' }}</td>
                                    <td>{{ $permission->is_default ? 'Có' : 'Không' }}</td>
                                    <td class="text-center">
                                        <div class="action-buttons">
                                            @can('access_permissions')
                                                <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                                   class="btn-action btn-edit" title="Chỉnh sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.permissions.delete', $permission->id) }}" method="POST"
                                                      style="display:inline;"
                                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete" title="Xóa">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Hiển thị phân trang -->
                    @include('vendor.pagination.pagination', ['paginator' => $permissions])
                </div>
                <!-- /.card -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection
