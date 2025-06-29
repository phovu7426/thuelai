@extends('admin.layouts.main')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa sản phẩm đá</h3>
            <div class="card-tools">
                <a href="{{ route('admin.stone.products.index') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.stone.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label for="name">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="code">Mã sản phẩm</label>
                            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $product->code) }}">
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="stone_category_id">Danh mục <span class="text-danger">*</span></label>
                            <select name="stone_category_id" id="stone_category_id" class="form-control @error('stone_category_id') is-invalid @enderror" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('stone_category_id', $product->stone_category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('stone_category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="stone_material_id">Chất liệu <span class="text-danger">*</span></label>
                            <select name="stone_material_id" id="stone_material_id" class="form-control @error('stone_material_id') is-invalid @enderror" required>
                                <option value="">-- Chọn chất liệu --</option>
                                @foreach($materials as $material)
                                    <option value="{{ $material->id }}" {{ old('stone_material_id', $product->stone_material_id) == $material->id ? 'selected' : '' }}>
                                        {{ $material->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('stone_material_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="stone_surface_id">Bề mặt <span class="text-danger">*</span></label>
                            <select name="stone_surface_id" id="stone_surface_id" class="form-control @error('stone_surface_id') is-invalid @enderror" required>
                                <option value="">-- Chọn bề mặt --</option>
                                @foreach($surfaces as $surface)
                                    <option value="{{ $surface->id }}" {{ old('stone_surface_id', $product->stone_surface_id) == $surface->id ? 'selected' : '' }}>
                                        {{ $surface->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('stone_surface_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="stone_color_id">Màu sắc</label>
                            <select name="stone_color_id" id="stone_color_id" class="form-control @error('stone_color_id') is-invalid @enderror">
                                <option value="">-- Chọn màu sắc --</option>
                                @foreach($colors as $color)
                                    <option value="{{ $color->id }}" {{ old('stone_color_id', $product->stone_color_id) == $color->id ? 'selected' : '' }}>
                                        {{ $color->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('stone_color_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="price">Giá</label>
                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" min="0" step="0.01">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="sale_price">Giá khuyến mãi</label>
                            <input type="number" name="sale_price" id="sale_price" class="form-control @error('sale_price') is-invalid @enderror" value="{{ old('sale_price', $product->sale_price) }}" min="0" step="0.01">
                            @error('sale_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="short_description">Mô tả ngắn</label>
                            <textarea name="short_description" id="short_description" rows="3" class="form-control @error('short_description') is-invalid @enderror">{{ old('short_description', $product->short_description) }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="description">Mô tả chi tiết</label>
                            <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror" data-editor="true">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label>Đặc tính kỹ thuật</label>
                            <div id="specifications-container">
                                @if(isset($product->specifications) && is_array($product->specifications))
                                    @foreach($product->specifications as $key => $value)
                                        <div class="row mb-2 specification-row">
                                            <div class="col-md-5">
                                                <input type="text" name="specifications[key][]" class="form-control" placeholder="Tên thuộc tính" value="{{ $key }}">
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="specifications[value][]" class="form-control" placeholder="Giá trị" value="{{ is_string($value) ? $value : '' }}">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger btn-sm remove-specification">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="row mb-2 specification-row">
                                        <div class="col-md-5">
                                            <input type="text" name="specifications[key][]" class="form-control" placeholder="Tên thuộc tính">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" name="specifications[value][]" class="form-control" placeholder="Giá trị">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger btn-sm remove-specification">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-info btn-sm" id="add-specification">
                                <i class="bi bi-plus"></i> Thêm đặc tính
                            </button>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="applications">Ứng dụng</label>
                            <select name="applications[]" id="applications" class="form-control @error('applications') is-invalid @enderror" multiple>
                                @foreach($applications as $application)
                                    <option value="{{ $application->id }}" {{ in_array($application->id, $productApplicationIds ?? []) ? 'selected' : '' }}>
                                        {{ $application->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Giữ phím Ctrl (Windows) hoặc Command (Mac) để chọn nhiều ứng dụng</small>
                            @error('applications')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="main_image">Ảnh chính</label>
                            <input type="file" name="main_image" id="main_image" class="form-control @error('main_image') is-invalid @enderror" accept="image/*">
                            <small class="form-text text-muted">Để trống nếu không muốn thay đổi ảnh</small>
                            @error('main_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2" id="main-image-preview">
                                @if(isset($product->main_image))
                                    <img src="{{ get_image_url($product->main_image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-height: 200px">
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="gallery">Bộ sưu tập ảnh</label>
                            <input type="file" name="gallery[]" id="gallery" class="form-control @error('gallery') is-invalid @enderror" accept="image/*" multiple>
                            <small class="form-text text-muted">Có thể chọn nhiều ảnh</small>
                            @error('gallery')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            @if(isset($product->gallery) && is_array($product->gallery))
                                <div class="mt-3">
                                    <label>Ảnh hiện tại:</label>
                                    <div class="row">
                                        @foreach($product->gallery as $image)
                                            <div class="col-md-6 mb-2">
                                                <div class="position-relative">
                                                    <img src="{{ get_image_url($image) }}" alt="Gallery" class="img-thumbnail" style="max-height: 100px">
                                                    <div class="form-check position-absolute" style="top: 5px; right: 5px;">
                                                        <input type="checkbox" name="remove_gallery[]" value="{{ $image }}" id="remove-{{ $loop->index }}" class="form-check-input">
                                                        <label class="form-check-label" for="remove-{{ $loop->index }}">Xóa</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="is_featured">Đặc sắc</label>
                            <div class="form-check">
                                <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                <label for="is_featured" class="form-check-label">Đánh dấu là sản phẩm đặc sắc</label>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="order">Thứ tự hiển thị</label>
                            <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $product->order ?? 0) }}" min="0">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Lưu thay đổi
                    </button>
                    <a href="{{ route('admin.stone.products.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // Khởi tạo Select2 cho ứng dụng
    $(document).ready(function() {
        $('#applications').select2({
            placeholder: "Chọn ứng dụng",
            allowClear: true,
            width: '100%'
        });
    });

    // Hiển thị ảnh chính xem trước khi upload
    document.getElementById('main_image').addEventListener('change', function(e) {
        const preview = document.getElementById('main-image-preview');
        preview.innerHTML = '';
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxHeight = '200px';
                img.className = 'img-thumbnail';
                preview.appendChild(img);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // Xử lý thêm đặc tính kỹ thuật
    document.getElementById('add-specification').addEventListener('click', function() {
        const container = document.getElementById('specifications-container');
        const row = document.createElement('div');
        row.className = 'row mb-2 specification-row';
        row.innerHTML = `
            <div class="col-md-5">
                <input type="text" name="specifications[key][]" class="form-control" placeholder="Tên thuộc tính">
            </div>
            <div class="col-md-5">
                <input type="text" name="specifications[value][]" class="form-control" placeholder="Giá trị">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-specification">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(row);
        
        // Thêm sự kiện xóa cho nút xóa mới
        row.querySelector('.remove-specification').addEventListener('click', function() {
            container.removeChild(row);
        });
    });
    
    // Xử lý nút xóa đặc tính
    document.querySelectorAll('.remove-specification').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.specification-row').remove();
        });
    });
</script>
@endsection
