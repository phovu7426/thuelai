@extends('admin.index')

@section('page_title', 'Chỉnh sửa Danh Mục')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Danh sách Danh Mục</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa Danh Mục</li>
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
                            <i class="bi bi-folder-gear"></i> Chỉnh sửa Danh Mục: {{ $category->name }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    <i class="bi bi-folder"></i> Tên Danh Mục <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                                       placeholder="📁 Nhập tên danh mục..." 
                                                       value="{{ old('name', $category->name) }}" required>
                                                @error('name') 
                                                    <span class="text-danger">{{ $message }}</span> 
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="code" class="form-label">
                                                    <i class="bi bi-code"></i> Mã Danh Mục <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                                                       placeholder="🔢 Nhập mã danh mục..." 
                                                       value="{{ old('code', $category->code) }}" required>
                                                @error('code') 
                                                    <span class="text-danger">{{ $message }}</span> 
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="slug" class="form-label">
                                                    <i class="bi bi-link"></i> Slug <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                                                       placeholder="🔗 Nhập slug..." 
                                                       value="{{ old('slug', $category->slug) }}" required>
                                                @error('slug') 
                                                    <span class="text-danger">{{ $message }}</span> 
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="parent_id" class="form-label">
                                                    <i class="bi bi-diagram-3"></i> Danh Mục Cha
                                                </label>
                                                <select name="parent_id" class="form-select">
                                                    <option value="">📂 Không có</option>
                                                    @foreach($categories as $cat)
                                                        <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                                                            {{ $cat->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            <i class="bi bi-text-paragraph"></i> Mô Tả
                                        </label>
                                        <textarea name="description" class="form-control" rows="3" 
                                                  placeholder="📄 Nhập mô tả...">{{ old('description', $category->description) }}</textarea>
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
                                                <label for="status" class="form-label">
                                                    <i class="bi bi-toggle-on"></i> Trạng Thái
                                                </label>
                                                <select name="status" class="form-select">
                                                    <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>✅ Hiển Thị</option>
                                                    <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>❌ Ẩn</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="sort_order" class="form-label">
                                                    <i class="bi bi-sort-numeric-down"></i> Thứ tự hiển thị
                                                </label>
                                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                                       id="sort_order" name="sort_order" placeholder="0" 
                                                       value="{{ old('sort_order', $category->sort_order ?? 0) }}" min="0">
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
                                                       id="color" name="color" value="{{ old('color', $category->color ?? '#007bff') }}" title="Chọn màu sắc">
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
                                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Quay lại
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i> Cập Nhật Danh Mục
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
