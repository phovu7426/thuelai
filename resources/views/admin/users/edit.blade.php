@extends('admin.index')

@section('page_title', 'Chỉnh sửa tài khoản')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Danh sách tài khoản</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa tài khoản</li>
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
                        <h3 class="card-title">
                            <i class="bi bi-person-gear"></i> Chỉnh sửa tài khoản
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">
                                            <i class="bi bi-person"></i> Tên
                                        </label>
                                        <input type="text" name="name" class="form-control" 
                                               placeholder="👤 Nhập tên..." value="{{ $user->name }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">
                                            <i class="bi bi-envelope"></i> Email
                                        </label>
                                        <input type="email" name="email" class="form-control" 
                                               placeholder="📧 Nhập email..." value="{{ $user->email }}" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">
                                            <i class="bi bi-lock"></i> Mật khẩu mới (để trống nếu không đổi)
                                        </label>
                                        <input type="password" name="password" class="form-control" 
                                               placeholder="🔒 Nhập mật khẩu mới...">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">
                                            <i class="bi bi-lock-fill"></i> Xác nhận mật khẩu mới
                                        </label>
                                        <input type="password" name="password_confirmation" class="form-control" 
                                               placeholder="🔒 Nhập lại mật khẩu mới...">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Hủy
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i> Cập nhật
                                        </button>
                                    </div>
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection
