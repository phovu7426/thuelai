@extends('admin.index')

@section('page_title', 'Danh sách tài khoản')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Danh sách tài khoản</li>
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
                                <form action="{{ route('admin.users.index') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="email" name="email" class="form-control" placeholder="Nhập email"
                                                   value="{{ request('email') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">Lọc</button>
                                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-3 d-flex">
                                @can('access_users')
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary ms-auto">Thêm Tài khoản</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Email</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                                <th>Vai Trò</th>
                                <th>Hành Động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $index => $user)
                                <tr>
                                    <td>{{ $users->firstItem() + $index }}</td>
                                    <td>{{ $user->email ?? '' }}</td>
                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td>{{ !empty($user->is_blocked) ? 'Khóa' : 'Không khóa' }}</td>
                                    <td>
                                        @php
                                            $roleCount = $user->roles->count();
                                        @endphp

                                        @if ($roleCount > 0)
                                            <button type="button"
                                                    class="btn btn-sm btn-success"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#rolesModal_{{ $user->id }}">
                                                {{ $roleCount }} vai trò
                                            </button>
                                        @else
                                            <span class="badge bg-secondary">0 vai trò</span>
                                        @endif
                                    </td>
                                    <td>
                                        @can('access_users')
                                            <a href="{{ route('admin.users.showAssignRolesForm', $user->id ?? '') }}" title="Gán vai trò"
                                               class="btn btn-sm btn-warning"><i class="fas fa-user-tag"></i></a>
                                        @endcan
                                        @can('access_users')
                                            <a href="{{ route('admin.profiles.edit', $user->id ?? '') }}"
                                               class="btn btn-sm btn-warning" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('admin.users.toggleBlock', $user->id ?? '') }}" method="POST"
                                                  style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="status" value="{{ !empty($user->is_blocked) ? 0 : 1 }}">
                                                <button type="submit" title="Đổi trạng thái" class="btn btn-sm btn-warning">
                                                    <i class="bi {{ !empty($user->is_blocked) ? 'bi-unlock-fill' : 'bi-lock-fill' }}"></i>
                                                </button>
                                            </form>
                                        @endcan
                                        @can('access_users')
                                            <form action="{{ route('admin.users.delete', $user->id ?? '') }}" method="POST"
                                                  style="display:inline;">
                                                @csrf
                                                <button type="submit" title="Xóa" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                    <!-- Hiển thị phân trang -->
                    @include('vendor.pagination.pagination', ['paginator' => $users])
                </div>
                <!-- /.card -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->

    <!-- Modals hiển thị danh sách vai trò của từng tài khoản -->
    @foreach($users as $user)
        <div class="modal fade" id="rolesModal_{{ $user->id }}" tabindex="-1"
             aria-labelledby="rolesModalLabel_{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rolesModalLabel_{{ $user->id }}">
                            Vai trò của: <strong>{{ $user->email }}</strong>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        @if ($user->roles->count())
                            <ul class="list-group">
                                @foreach ($user->roles as $role)
                                    <li class="list-group-item">{{ $role->title ?? $role->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>Người dùng này chưa có vai trò nào.</p>
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
