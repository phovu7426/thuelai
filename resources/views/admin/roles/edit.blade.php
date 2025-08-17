@extends('admin.index')

@section('page_title', 'Chỉnh sửa vai trò')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Danh sách vai trò</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa vai trò</li>
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
                            <i class="bi bi-shield-gear"></i> Chỉnh sửa vai trò: {{ $role->title }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">
                                                    <i class="bi bi-person-badge"></i> Tên hiển thị <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" id="title" name="title"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    placeholder="👤 Nhập tên hiển thị..." 
                                                    value="{{ old('title', $role->title) }}" required>
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    <i class="bi bi-code"></i> Tên hệ thống <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" id="name" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="🔧 Nhập tên hệ thống..." 
                                                    value="{{ old('name', $role->name) }}" required>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            <i class="bi bi-text-paragraph"></i> Mô tả
                                        </label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="3" 
                                                  placeholder="📄 Nhập mô tả...">{{ old('description', $role->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-shield-check"></i> Quyền được gán
                                        </label>
                                        <select class="form-control select2 @error('permissions') is-invalid @enderror"
                                            name="permissions[]" multiple data-field="name"
                                            data-selected='@json($role->permissions->pluck('name')->toArray())'
                                            data-url="{{ route('admin.permissions.autocomplete') }}">
                                            <option value="">🔐 Chọn quyền</option>
                                        </select>
                                        @error('permissions')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <small class="form-text text-muted">Có thể chọn nhiều quyền</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">
                                                <i class="bi bi-gear"></i> Cài đặt
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                                                           value="1" {{ old('is_active', $role->is_active ?? true) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_active">
                                                        <i class="bi bi-toggle-on"></i> Kích hoạt vai trò
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="sort_order" class="form-label">
                                                    <i class="bi bi-sort-numeric-down"></i> Thứ tự hiển thị
                                                </label>
                                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                                       id="sort_order" name="sort_order" placeholder="0" 
                                                       value="{{ old('sort_order', $role->sort_order ?? 0) }}" min="0">
                                                @error('sort_order')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Số càng nhỏ càng hiển thị trước</small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="color" class="form-label">
                                                    <i class="bi bi-palette"></i> Màu sắc
                                                </label>
                                                <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" 
                                                       id="color" name="color" value="{{ old('color', $role->color ?? '#007bff') }}" title="Chọn màu sắc">
                                                @error('color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Quay lại
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i> Cập nhật vai trò
                                        </button>
                                    </div>
                                </div>
                            </div>
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
