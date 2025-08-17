{{-- Form cho Testimonials Modal --}}
@csrf

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="customer_name" class="form-label">
                <i class="bi bi-person"></i> Tên khách hàng <span class="text-danger">*</span>
            </label>
            <input type="text" name="customer_name" id="customer_name" class="form-control"
                   placeholder="Nhập tên khách hàng..."
                   value="{{ isset($data['customer_name']) ? $data['customer_name'] : old('customer_name') }}"
                   required>
            <div class="invalid-feedback" id="customer_nameError"></div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="customer_email" class="form-label">
                <i class="bi bi-envelope"></i> Email khách hàng
            </label>
            <input type="email" name="customer_email" id="customer_email" class="form-control"
                   placeholder="Nhập email khách hàng..."
                   value="{{ isset($data['customer_email']) ? $data['customer_email'] : old('customer_email') }}">
            <div class="invalid-feedback" id="customer_emailError"></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="rating" class="form-label">
                <i class="bi bi-star"></i> Đánh giá <span class="text-danger">*</span>
            </label>
            <select name="rating" id="rating" class="form-control" required>
                <option value="">Chọn đánh giá</option>
                <option value="1" {{ (isset($data['rating']) ? $data['rating'] : old('rating')) == 1 ? 'selected' : '' }}>⭐ 1 sao</option>
                <option value="2" {{ (isset($data['rating']) ? $data['rating'] : old('rating')) == 2 ? 'selected' : '' }}>⭐⭐ 2 sao</option>
                <option value="3" {{ (isset($data['rating']) ? $data['rating'] : old('rating')) == 3 ? 'selected' : '' }}>⭐⭐⭐ 3 sao</option>
                <option value="4" {{ (isset($data['rating']) ? $data['rating'] : old('rating')) == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ 4 sao</option>
                <option value="5" {{ (isset($data['rating']) ? $data['rating'] : old('rating')) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ 5 sao</option>
            </select>
            <div class="invalid-feedback" id="ratingError"></div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="service_type" class="form-label">
                <i class="bi bi-gear"></i> Loại dịch vụ
            </label>
            <select name="service_type" id="service_type" class="form-control">
                <option value="">Chọn loại dịch vụ</option>
                <option value="driver" {{ (isset($data['service_type']) ? $data['service_type'] : old('service_type')) == 'driver' ? 'selected' : '' }}>Dịch vụ lái xe</option>
                <option value="delivery" {{ (isset($data['service_type']) ? $data['service_type'] : old('service_type')) == 'delivery' ? 'selected' : '' }}>Giao hàng</option>
                <option value="other" {{ (isset($data['service_type']) ? $data['service_type'] : old('service_type')) == 'other' ? 'selected' : '' }}>Khác</option>
            </select>
            <div class="invalid-feedback" id="service_typeError"></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="title" class="form-label">
                <i class="bi bi-chat-quote"></i> Tiêu đề đánh giá
            </label>
            <input type="text" name="title" id="title" class="form-control"
                   placeholder="Nhập tiêu đề đánh giá..."
                   value="{{ isset($data['title']) ? $data['title'] : old('title') }}">
            <div class="invalid-feedback" id="titleError"></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="content" class="form-label">
                <i class="bi bi-text-paragraph"></i> Nội dung đánh giá <span class="text-danger">*</span>
            </label>
            <textarea name="content" id="content" class="form-control" rows="4"
                      placeholder="Nhập nội dung đánh giá..." required>{{ isset($data['content']) ? $data['content'] : old('content') }}</textarea>
            <div class="invalid-feedback" id="contentError"></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="customer_avatar" class="form-label">
                <i class="bi bi-image"></i> Ảnh đại diện khách hàng
            </label>
            <input type="file" name="customer_avatar" id="customer_avatar" class="form-control" accept="image/*">
            <div class="invalid-feedback" id="customer_avatarError"></div>
            @if(isset($data['customer_avatar']) && $data['customer_avatar'])
                <div class="mt-2">
                    <img src="/storage/{{ $data['customer_avatar'] }}" class="img-thumbnail" width="80">
                </div>
            @endif
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="verified_purchase" class="form-label">
                <i class="bi bi-check-circle"></i> Xác minh mua hàng
            </label>
            <select name="verified_purchase" id="verified_purchase" class="form-control">
                <option value="0" {{ (isset($data['verified_purchase']) ? $data['verified_purchase'] : old('verified_purchase', 0)) == 0 ? 'selected' : '' }}>Chưa xác minh</option>
                <option value="1" {{ (isset($data['verified_purchase']) ? $data['verified_purchase'] : old('verified_purchase', 0)) == 1 ? 'selected' : '' }}>Đã xác minh</option>
            </select>
            <div class="invalid-feedback" id="verified_purchaseError"></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1"
                       {{ (isset($data['is_active']) ? $data['is_active'] : old('is_active', true)) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    <i class="bi bi-toggle-on"></i> Kích hoạt
                </label>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" value="1"
                       {{ (isset($data['is_featured']) ? $data['is_featured'] : old('is_featured')) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_featured">
                    <i class="bi bi-star"></i> Nổi bật
                </label>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="sort_order" class="form-label">
                <i class="bi bi-sort-numeric-down"></i> Thứ tự sắp xếp
            </label>
            <input type="number" name="sort_order" id="sort_order" class="form-control"
                   placeholder="Nhập thứ tự sắp xếp..."
                   value="{{ isset($data['sort_order']) ? $data['sort_order'] : old('sort_order', 0) }}" min="0">
            <div class="invalid-feedback" id="sort_orderError"></div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="review_date" class="form-label">
                <i class="bi bi-calendar"></i> Ngày đánh giá
            </label>
            <input type="date" name="review_date" id="review_date" class="form-control"
                   value="{{ isset($data['review_date']) ? $data['review_date'] : old('review_date', date('Y-m-d')) }}">
            <div class="invalid-feedback" id="review_dateError"></div>
        </div>
    </div>
</div>

{{-- Script để xử lý form --}}
<script>
$(document).ready(function() {
    // Preview avatar khi chọn file
    $('#customer_avatar').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = $('<div class="mt-2"><img src="' + e.target.result + '" class="img-thumbnail" width="80"></div>');
                $('#customer_avatar').next('.mt-2').remove();
                $('#customer_avatar').after(preview);
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Auto-generate title from content if empty
    $('#content').on('input', function() {
        const content = $(this).val();
        if (content && !$('#title').val()) {
            const title = content.length > 50 ? content.substring(0, 50) + '...' : content;
            $('#title').val(title);
        }
    });
});
</script>
