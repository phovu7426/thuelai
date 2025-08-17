@extends('admin.index')

@section('page_title', 'Chỉnh sửa danh mục')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.post-categories.index') }}">Danh sách danh mục</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa danh mục</li>
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
                            <i class="bi bi-folder-gear"></i> Chỉnh sửa danh mục: {{ $category->name }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.post-categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">
                                            <i class="bi bi-folder"></i> Tên danh mục <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" placeholder="📁 Nhập tên danh mục..." 
                                               value="{{ old('name', $category->name) }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            <i class="bi bi-text-paragraph"></i> Mô tả
                                        </label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="4" 
                                                  placeholder="📄 Nhập mô tả danh mục...">{{ old('description', $category->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                                <label for="color" class="form-label">
                                                    <i class="bi bi-palette"></i> Màu sắc
                                                </label>
                                                <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" 
                                                       id="color" name="color" value="{{ old('color', $category->color) }}" title="Chọn màu sắc">
                                                @error('color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="sort_order" class="form-label">
                                                    <i class="bi bi-sort-numeric-down"></i> Thứ tự
                                                </label>
                                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                                       id="sort_order" name="sort_order" placeholder="0" 
                                                       value="{{ old('sort_order', $category->sort_order) }}" min="0">
                                                @error('sort_order')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Số càng nhỏ càng hiển thị trước</small>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                                                           value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_active">
                                                        <i class="bi bi-toggle-on"></i> Kích hoạt danh mục
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="image" class="form-label">
                                                    <i class="bi bi-image"></i> Hình ảnh
                                                </label>
                                                @if($category->image)
                                                    <div class="mb-2">
                                                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" 
                                                             class="img-thumbnail" style="max-width: 200px;">
                                                    </div>
                                                @endif
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                                       id="image" name="image" accept="image/*">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Định dạng: JPG, PNG, GIF. Kích thước tối đa: 2MB</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.post-categories.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Quay lại
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i> Cập nhật danh mục
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


