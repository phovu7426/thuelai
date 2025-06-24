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
                        <div class="row">
                            <div class="col-sm-9">
                                <!-- Form lọc -->
                                <form action="{{ route('admin.permissions.index') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="title" class="form-control" placeholder="Ý nghĩa quyền"
                                                   value="{{ request('title') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="name" class="form-control" placeholder="Tên quyền"
                                                   value="{{ request('name') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="parent" class="form-control" placeholder="Quyền cha"
                                                   value="{{ request('parent') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary">Lọc</button>
                                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-3 d-flex">
                                @canany(['manage_permissions', 'create_permissions'])
                                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary ms-auto">Thêm quyền</a>
                                @endcanany
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
                                        @canany(['manage_permissions', 'edit_permissions'])
                                            <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                               class="btn btn-sm btn-warning" title="Chỉnh sửa">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcanany
                                        @canany(['manage_permissions', 'delete_permissions'])
                                            <form action="{{ route('admin.permissions.delete', $permission->id) }}" method="POST"
                                                  style="display:inline-block;"
                                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endcanany
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
