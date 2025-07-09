@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa slide</h3>
            <div class="card-tools">
                <a href="{{ route('admin.slides.index') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.slides.update', $slide->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label for="title">Tiêu đề <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $slide->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="description">Mô tả</label>
                            <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description', $slide->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="link">Liên kết</label>
                            <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link', $slide->link) }}">
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="image">Hình ảnh</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            <small class="form-text text-muted">Để trống nếu không muốn thay đổi hình ảnh</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2" id="image-preview">
                                @if($slide->image)
                                    <img src="{{ asset('storage/' . $slide->image) }}" alt="{{ $slide->title }}" class="img-thumbnail" style="max-height: 200px">
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status', $slide->status) == '1' ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status', $slide->status) == '0' ? 'selected' : '' }}>Ẩn</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Lưu thay đổi
                    </button>
                    <a href="{{ route('admin.slides.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Hiển thị hình ảnh xem trước khi upload
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = '';
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100%';
                img.style.maxHeight = '200px';
                img.className = 'img-thumbnail';
                preview.appendChild(img);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endsection
