{{-- Form cho Posts Modal --}}
@csrf

<div class="row g-3">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="title" class="form-label">
                <i class="bi bi-type"></i> Tiêu đề <span class="text-danger">*</span>
            </label>
            <input type="text" name="title" id="title" class="form-control"
                   placeholder="Nhập tiêu đề bài viết..."
                   value="{{ $data['title'] ?? old('title') }}"
                   required>
            <div class="invalid-feedback" id="titleError"></div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="mb-3">
            <label for="category_id" class="form-label">
                <i class="bi bi-tag"></i> Danh mục
            </label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">Chọn danh mục</option>
                @foreach($categories ?? [] as $category)
                    <option value="{{ $category->id }}" 
                            {{ ($data['category_id'] ?? old('category_id')) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="category_idError"></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="excerpt" class="form-label">
                <i class="bi bi-text-paragraph"></i> Tóm tắt
            </label>
            <textarea name="excerpt" id="excerpt" class="form-control" rows="3"
                      placeholder="Nhập tóm tắt bài viết...">{{ $data['excerpt'] ?? old('excerpt') }}</textarea>
            <div class="invalid-feedback" id="excerptError"></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="content" class="form-label">
                <i class="bi bi-file-text"></i> Nội dung <span class="text-danger">*</span>
            </label>
            <textarea name="content" id="content" class="form-control" rows="8"
                      placeholder="Nhập nội dung bài viết...">{{ $data['content'] ?? old('content') }}</textarea>
            <div class="invalid-feedback" id="contentError"></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="image" class="form-label">
                <i class="bi bi-image"></i> Ảnh đại diện
            </label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @if(isset($data['image']) && $data['image'])
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $data['image']) }}" alt="Ảnh hiện tại" class="img-thumbnail" style="max-width: 200px;">
                </div>
            @endif
            <div class="invalid-feedback" id="imageError"></div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="status" class="form-label">
                <i class="bi bi-toggle-on"></i> Trạng thái
            </label>
            <select name="status" id="status" class="form-control">
                <option value="draft" {{ ($data['status'] ?? old('status')) == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                <option value="published" {{ ($data['status'] ?? old('status')) == 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                <option value="archived" {{ ($data['status'] ?? old('status')) == 'archived' ? 'selected' : '' }}>Đã lưu trữ</option>
            </select>
            <div class="invalid-feedback" id="statusError"></div>
        </div>
        
        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" name="featured" id="featured" class="form-check-input" value="1"
                       {{ ($data['featured'] ?? old('featured')) ? 'checked' : '' }}>
                <label class="form-check-label" for="featured">
                    <i class="bi bi-star"></i> Nổi bật
                </label>
            </div>
        </div>
    </div>
</div>

{{-- Script để xử lý form --}}
<script>
$(document).ready(function() {
    // Auto-resize textarea
    $('#excerpt, #content').on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
    
    // Image preview
    $('#image').on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = $('<div class="mt-2"><img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 200px;"></div>');
                $('#image').next('.mt-2').remove();
                $('#image').after(preview);
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
