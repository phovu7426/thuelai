@extends('admin.index')

@section('page_title', 'Thêm mức giá mới')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.driver.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.driver.pricing-tiers.index') }}">Giá theo khoảng cách</a>
    </li>
    <li class="breadcrumb-item active">Thêm mới</li>
@endsection

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Thêm mức giá mới</h3>
                            <a href="{{ route('admin.driver.pricing-tiers.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.driver.pricing-tiers.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="time_slot">Thời gian <span class="text-danger">*</span></label>
                                        <select class="form-control @error('time_slot') is-invalid @enderror" 
                                                id="time_slot" 
                                                name="time_slot" 
                                                required>
                                            <option value="">Chọn thời gian</option>
                                            <option value="Trước 22h" {{ old('time_slot') == 'Trước 22h' ? 'selected' : '' }}>Trước 22h</option>
                                            <option value="22h - 24h" {{ old('time_slot') == '22h - 24h' ? 'selected' : '' }}>22h - 24h</option>
                                            <option value="Sau 24h" {{ old('time_slot') == 'Sau 24h' ? 'selected' : '' }}>Sau 24h</option>
                                        </select>
                                        @error('time_slot')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="time_icon">Icon <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('time_icon') is-invalid @enderror" 
                                               id="time_icon" 
                                               name="time_icon" 
                                               value="{{ old('time_icon') }}" 
                                               placeholder="Ví dụ: fas fa-sun, fas fa-moon, fas fa-star"
                                               required>
                                        @error('time_icon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Sử dụng FontAwesome icons</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="time_color">Màu sắc <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('time_color') is-invalid @enderror" 
                                               id="time_color" 
                                               name="time_color" 
                                               value="{{ old('time_color') }}" 
                                               placeholder="Ví dụ: #ffc107, #17a2b8, #dc3545"
                                               required>
                                        @error('time_color')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Hex code hoặc tên màu CSS</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="from_distance">Từ km <span class="text-danger">*</span></label>
                                        <input type="number" 
                                               class="form-control @error('from_distance') is-invalid @enderror" 
                                               id="from_distance" 
                                               name="from_distance" 
                                               value="{{ old('from_distance') }}" 
                                               min="0" 
                                               step="0.1"
                                               placeholder="0"
                                               required>
                                        @error('from_distance')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="to_distance">Đến km</label>
                                        <input type="number" 
                                               class="form-control @error('to_distance') is-invalid @enderror" 
                                               id="to_distance" 
                                               name="to_distance" 
                                               value="{{ old('to_distance') }}" 
                                               min="0" 
                                               step="0.1"
                                               placeholder="Để trống = không giới hạn">
                                        @error('to_distance')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Để trống = từ km đó trở lên</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="price">Giá <span class="text-danger">*</span></label>
                                        <input type="number" 
                                               class="form-control @error('price') is-invalid @enderror" 
                                               id="price" 
                                               name="price" 
                                               value="{{ old('price') }}" 
                                               min="0" 
                                               step="1000"
                                               placeholder="245000"
                                               required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="price_type">Loại giá <span class="text-danger">*</span></label>
                                        <select class="form-control @error('price_type') is-invalid @enderror" 
                                                id="price_type" 
                                                name="price_type" 
                                                required>
                                            <option value="">Chọn loại giá</option>
                                            <option value="fixed" {{ old('price_type') == 'fixed' ? 'selected' : '' }}>Giá cố định</option>
                                            <option value="per_km" {{ old('price_type') == 'per_km' ? 'selected' : '' }}>Giá theo km</option>
                                        </select>
                                        @error('price_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Giá cố định hoặc giá/km</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Mô tả</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" 
                                                  name="description" 
                                                  rows="3"
                                                  placeholder="Mô tả chi tiết về mức giá này">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Mô tả để dễ hiểu hơn</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sort_order">Thứ tự sắp xếp</label>
                                        <input type="number" 
                                               class="form-control @error('sort_order') is-invalid @enderror" 
                                               id="sort_order" 
                                               name="sort_order" 
                                               value="{{ old('sort_order', 0) }}" 
                                               min="0"
                                               step="1">
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Số càng nhỏ càng hiển thị trước</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="is_active">Trạng thái</label>
                                        <div class="form-check">
                                            <input type="checkbox" 
                                                   class="form-check-input" 
                                                   id="is_active" 
                                                   name="is_active" 
                                                   value="1" 
                                                   {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Kích hoạt mức giá này
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Tạo mức giá
                                </button>
                                <a href="{{ route('admin.driver.pricing-tiers.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Hủy
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-fill icon và color khi chọn time slot
    const timeSlotSelect = document.getElementById('time_slot');
    const timeIconInput = document.getElementById('time_icon');
    const timeColorInput = document.getElementById('time_color');
    
    const timeSlotData = {
        'Trước 22h': { icon: 'fas fa-sun', color: '#ffc107' },
        '22h - 24h': { icon: 'fas fa-moon', color: '#17a2b8' },
        'Sau 24h': { icon: 'fas fa-star', color: '#dc3545' }
    };
    
    timeSlotSelect.addEventListener('change', function() {
        const selectedValue = this.value;
        if (timeSlotData[selectedValue]) {
            timeIconInput.value = timeSlotData[selectedValue].icon;
            timeColorInput.value = timeSlotData[selectedValue].color;
        }
    });
});
</script>
@endsection

