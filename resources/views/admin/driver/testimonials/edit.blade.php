@extends('admin.layouts.main')

@section('title', 'Chỉnh sửa đánh giá khách hàng')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chỉnh sửa đánh giá khách hàng</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.driver.testimonials.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.driver.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_name">Tên khách hàng <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                                           id="customer_name" name="customer_name" 
                                           value="{{ old('customer_name', $testimonial->customer_name) }}" required>
                                    @error('customer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_type">Loại dịch vụ</label>
                                    <select class="form-control @error('service_type') is-invalid @enderror" 
                                            id="service_type" name="service_type">
                                        <option value="">Chọn loại dịch vụ</option>
                                        <option value="hourly" {{ old('service_type', $testimonial->service_type) == 'hourly' ? 'selected' : '' }}>Lái xe theo giờ</option>
                                        <option value="trip" {{ old('service_type', $testimonial->service_type) == 'trip' ? 'selected' : '' }}>Lái xe theo chuyến</option>
                                        <option value="custom" {{ old('service_type', $testimonial->service_type) == 'custom' ? 'selected' : '' }}>Lái xe theo yêu cầu</option>
                                        <option value="business" {{ old('service_type', $testimonial->service_type) == 'business' ? 'selected' : '' }}>Lái xe cho doanh nghiệp</option>
                                        <option value="event" {{ old('service_type', $testimonial->service_type) == 'event' ? 'selected' : '' }}>Lái xe cho sự kiện</option>
                                    </select>
                                    @error('service_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rating">Đánh giá <span class="text-danger">*</span></label>
                                    <div class="rating-input">
                                        @for($i = 1; $i <= 5; $i++)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                                                   {{ old('rating', $testimonial->rating) == $i ? 'checked' : '' }} required>
                                            <label for="star{{ $i }}" class="star-label">
                                                <i class="fas fa-star"></i>
                                            </label>
                                        @endfor
                                        <span class="rating-text ml-2">({{ old('rating', $testimonial->rating) }}/5)</span>
                                    </div>
                                    @error('rating')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="display_order">Thứ tự hiển thị</label>
                                    <input type="number" class="form-control @error('display_order') is-invalid @enderror" 
                                           id="display_order" name="display_order" 
                                           value="{{ old('display_order', $testimonial->display_order) }}" min="1">
                                    @error('display_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content">Nội dung đánh giá <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" name="content" rows="5" required>{{ old('content', $testimonial->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="notes">Ghi chú</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3">{{ old('notes', $testimonial->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Ảnh khách hàng</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" 
                                               id="image" name="image" accept="image/*">
                                        <label class="custom-file-label" for="image">Chọn file...</label>
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    
                                    @if($testimonial->image)
                                    <div class="mt-2">
                                        <label>Ảnh hiện tại:</label>
                                        <div class="current-image">
                                            <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                                 alt="Ảnh hiện tại" class="img-thumbnail" style="max-width: 200px;">
                                            <div class="mt-2">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="remove_image" value="1"> Xóa ảnh hiện tại
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="status" name="status" value="active" 
                                               {{ old('status', $testimonial->status) == 'active' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status">Hiển thị</label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Nổi bật</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="is_featured" name="is_featured" value="1" 
                                               {{ old('is_featured', $testimonial->is_featured) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_featured">Đánh dấu nổi bật</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Cập nhật
                            </button>
                            <a href="{{ route('admin.driver.testimonials.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Hủy
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Rating stars interaction
    $('.rating-input input[type="radio"]').on('change', function() {
        const rating = $(this).val();
        $('.rating-text').text(`(${rating}/5)`);
        
        // Update star colors
        $('.star-label').each(function(index) {
            if (index < rating) {
                $(this).find('i').removeClass('text-muted').addClass('text-warning');
            } else {
                $(this).find('i').removeClass('text-warning').addClass('text-muted');
            }
        });
    });

    // Custom file input
    $('.custom-file-input').on('change', function() {
        const fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(fileName);
    });

    // Initialize star colors on page load
    const currentRating = $('input[name="rating"]:checked').val();
    if (currentRating) {
        $('.star-label').each(function(index) {
            if (index < currentRating) {
                $(this).find('i').removeClass('text-muted').addClass('text-warning');
            } else {
                $(this).find('i').removeClass('text-warning').addClass('text-muted');
            }
        });
    }
});
</script>

<style>
.rating-input {
    display: flex;
    align-items: center;
}

.rating-input input[type="radio"] {
    display: none;
}

.star-label {
    cursor: pointer;
    font-size: 24px;
    color: #ddd;
    transition: color 0.2s;
}

.star-label:hover,
.star-label:hover ~ .star-label {
    color: #ffc107;
}

.rating-input input[type="radio"]:checked ~ .star-label {
    color: #ffc107;
}

.rating-text {
    font-weight: bold;
    color: #666;
}

.current-image img {
    border: 2px solid #ddd;
    border-radius: 4px;
}

.checkbox-inline {
    font-size: 14px;
    color: #666;
}
</style>
@endsection
