@extends('admin.index')

@section('page_title', 'Chỉnh sửa dịch vụ lái xe')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.driver.services.index') }}">Danh sách dịch vụ</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa dịch vụ</li>
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
                            <i class="bi bi-gear-gear"></i> Chỉnh sửa dịch vụ lái xe: {{ $driverService->name }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.driver.services.update', $driverService->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">
                                            <i class="bi bi-gear"></i> Tên dịch vụ <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" placeholder="🚗 Nhập tên dịch vụ..." 
                                               value="{{ old('name', $driverService->name) }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="short_description" class="form-label">
                                            <i class="bi bi-text-paragraph"></i> Mô tả ngắn
                                        </label>
                                        <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                                  id="short_description" name="short_description" rows="3" 
                                                  placeholder="📝 Nhập mô tả ngắn...">{{ old('short_description', $driverService->short_description) }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <small class="form-text text-muted">Tối đa 500 ký tự</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            <i class="bi bi-file-text"></i> Mô tả chi tiết
                                        </label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="5" 
                                                  placeholder="📄 Nhập mô tả chi tiết...">{{ old('description', $driverService->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="sort_order" class="form-label">
                                                    <i class="bi bi-sort-numeric-down"></i> Thứ tự hiển thị
                                                </label>
                                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                                       id="sort_order" name="sort_order" placeholder="0" 
                                                       value="{{ old('sort_order', $driverService->sort_order) }}" min="0">
                                                @error('sort_order')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="price" class="form-label">
                                                    <i class="bi bi-currency-dollar"></i> Giá dịch vụ
                                                </label>
                                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                                       id="price" name="price" placeholder="0" 
                                                       value="{{ old('price', $driverService->price) }}" min="0" step="0.01">
                                                @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
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
                                                    <i class="bi bi-toggle-on"></i> Trạng thái
                                                </label>
                                                <select class="form-select @error('status') is-invalid @enderror" 
                                                        id="status" name="status">
                                                    <option value="active" {{ old('status', $driverService->status) == 'active' ? 'selected' : '' }}>✅ Hoạt động</option>
                                                    <option value="inactive" {{ old('status', $driverService->status) == 'inactive' ? 'selected' : '' }}>❌ Không hoạt động</option>
                                                    <option value="draft" {{ old('status', $driverService->status) == 'draft' ? 'selected' : '' }}>📝 Bản nháp</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" 
                                                           value="1" {{ old('is_featured', $driverService->is_featured) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_featured">
                                                        <i class="bi bi-star"></i> Đánh dấu nổi bật
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="image" class="form-label">
                                                    <i class="bi bi-image"></i> Hình ảnh dịch vụ
                                                </label>
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                                       id="image" name="image" accept="image/*">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Để trống nếu không muốn thay đổi hình ảnh</small>
                                                
                                                @if($driverService->image)
                                                    <div class="mt-2">
                                                        <img src="{{ asset('storage/' . $driverService->image) }}" 
                                                             alt="{{ $driverService->name }}" 
                                                             class="img-thumbnail" style="max-height: 150px">
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label for="icon" class="form-label">
                                                    <i class="bi bi-emoji-smile"></i> Icon dịch vụ
                                                </label>
                                                <input type="file" class="form-control @error('icon') is-invalid @enderror" 
                                                       id="icon" name="icon" accept="image/*">
                                                @error('icon')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Để trống nếu không muốn thay đổi icon</small>
                                                
                                                @if($driverService->icon)
                                                    <div class="mt-2">
                                                        <img src="{{ asset('storage/' . $driverService->icon) }}" 
                                                             alt="{{ $driverService->name }} icon" 
                                                             class="img-thumbnail" style="max-height: 80px">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.driver.services.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Quay lại
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i> Cập nhật dịch vụ
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
