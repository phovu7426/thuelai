@extends('admin.layouts.main')

@section('title', 'Sửa dịch vụ lái xe')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Sửa dịch vụ lái xe</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.driver.dashboard') }}">Dịch vụ lái xe</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.driver.services.index') }}">Quản lý dịch vụ</a></li>
                    <li class="breadcrumb-item active">Sửa dịch vụ</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Edit Form -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Thông tin dịch vụ</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.driver.services.update', $driverService->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Basic Information -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên dịch vụ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $driverService->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Mô tả ngắn</label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                              id="short_description" name="short_description" rows="3">{{ old('short_description', $driverService->short_description) }}</textarea>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Tối đa 500 ký tự</small>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả chi tiết</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="5">{{ old('description', $driverService->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="mb-3">
                                    <label for="sort_order" class="form-label">Thứ tự hiển thị</label>
                                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                           id="sort_order" name="sort_order" value="{{ old('sort_order', $driverService->sort_order) }}" min="0">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Current Images -->
                                <div class="mb-3">
                                    <h6>Hình ảnh hiện tại:</h6>
                                    @if($driverService->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $driverService->image) }}" 
                                                 alt="{{ $driverService->name }}" 
                                                 class="img-fluid rounded" 
                                                 style="max-width: 100%; height: auto;">
                                        </div>
                                    @else
                                        <div class="mb-2 bg-secondary rounded d-flex align-items-center justify-content-center" 
                                             style="width: 100%; height: 150px;">
                                            <i class="bi bi-image text-white" style="font-size: 2rem;"></i>
                                        </div>
                                    @endif
                                    
                                    @if($driverService->icon)
                                        <div class="mb-2">
                                            <small>Icon hiện tại:</small><br>
                                            <img src="{{ asset('storage/' . $driverService->icon) }}" 
                                                 alt="{{ $driverService->name }} icon" 
                                                 class="img-fluid rounded" 
                                                 style="max-width: 80px; height: auto;">
                                        </div>
                                    @else
                                        <div class="mb-2 bg-secondary rounded d-flex align-items-center justify-content-center" 
                                             style="width: 80px; height: 80px;">
                                            <i class="bi bi-gear text-white"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Image Upload -->
                                <div class="mb-3">
                                    <label for="image" class="form-label">Thay đổi hình ảnh dịch vụ</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Định dạng: JPEG, PNG, JPG, GIF. Tối đa 2MB</small>
                                </div>

                                <div class="mb-3">
                                    <label for="icon" class="form-label">Thay đổi icon dịch vụ</label>
                                    <input type="file" class="form-control @error('icon') is-invalid @enderror" 
                                           id="icon" name="icon" accept="image/*">
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Định dạng: JPEG, PNG, JPG, GIF. Tối đa 2MB</small>
                                </div>

                                <!-- Status Options -->
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" 
                                               {{ old('status', $driverService->status) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status">
                                            Kích hoạt dịch vụ
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" 
                                               {{ old('is_featured', $driverService->is_featured) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Đánh dấu nổi bật
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.driver.services.show', $driverService->id) }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left"></i> Quay lại
                                    </a>
                                    <div>
                                        <a href="{{ route('admin.driver.services.index') }}" class="btn btn-outline-secondary me-2">
                                            Hủy
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check"></i> Cập nhật dịch vụ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Form -->
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview image khi chọn file
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Có thể thêm preview image ở đây
                console.log('New image selected:', file.name);
            };
            reader.readAsDataURL(file);
        }
    });

    // Preview icon khi chọn file
    document.getElementById('icon').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Có thể thêm preview icon ở đây
                console.log('New icon selected:', file.name);
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection
