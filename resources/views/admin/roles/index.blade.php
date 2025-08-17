@extends('admin.index')

@section('page_title', 'Danh sách vai trò')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Danh sách vai trò</li>
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
                                <form action="{{ route('admin.roles.index') }}" method="GET" class="mb-0">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <input type="text" name="name" class="form-control" placeholder="🔍 Nhập tên vai trò"
                                                   value="{{ request('name') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-search"></i> Lọc
                                            </button>
                                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                                <i class="bi bi-arrow-clockwise"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end">
                                @can('access_users')
                                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle"></i> Thêm Vai trò
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ý nghĩa vai trò</th>
                                <th>Tên vai trò</th>
                                <th>Quyền</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $index => $role)
                                <tr>
                                    <td>{{ $roles->firstItem() + $index }}</td>
                                    <td>{{ $role->title ?? '' }}</td>
                                    <td>{{ $role->name ?? '' }}</td>
                                    <td>
                                        @php
                                            $permissionCount = count($role->permissions ?? []);
                                        @endphp

                                        @if ($permissionCount > 0)
                                            <button type="button"
                                                    class="btn btn-sm btn-success"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#permissionsModal_{{ $role->id }}">
                                                {{ $permissionCount }} quyền
                                            </button>
                                        @else
                                            <span class="badge bg-secondary">0 quyền</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            @can('access_roles')
                                                <a href="{{ route('admin.roles.edit', $role->id ?? '') }}" class="btn-action btn-edit" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('admin.roles.delete', $role->id ?? '') }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete" title="Xóa"><i class="fas fa-trash-alt"></i></button>
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
                    @include('vendor.pagination.pagination', ['paginator' => $roles])
                </div>
            </div>
        </div>
    </div>

    <!-- Modal hiển thị danh sách quyền -->
    @foreach($roles as $role)
        <div class="modal fade" id="permissionsModal_{{ $role->id }}" tabindex="-1" aria-labelledby="permissionsModalLabel_{{ $role->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="permissionsModalLabel_{{ $role->id }}">
                            Danh sách quyền của vai trò: <strong>{{ $role->title }}</strong>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        @if (count($role->permissions ?? []))
                            <ul class="list-group">
                                @foreach ($role->permissions as $permission)
                                    <li class="list-group-item">{{ $permission->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>Không có quyền nào được gán.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
