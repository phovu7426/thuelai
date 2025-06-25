@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa video</h3>
            <div class="card-tools">
                <a href="{{ route('admin.stone.videos.index') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.stone.videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label for="title">Tiêu đề <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $video->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="description">Mô tả</label>
                            <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $video->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="video_url">URL Video <span class="text-danger">*</span></label>
                            <input type="text" name="video_url" id="video_url" class="form-control @error('video_url') is-invalid @enderror" value="{{ old('video_url', $video->video_url) }}" placeholder="Nhập URL YouTube hoặc mã nhúng" required>
                            <small class="form-text text-muted">Ví dụ: https://www.youtube.com/watch?v=XXXXXXXXXXX hoặc mã nhúng iframe</small>
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label>Xem trước video</label>
                            <div class="embed-responsive embed-responsive-16by9">
                                @php
                                    $videoUrl = $video->video_url;
                                    // Kiểm tra nếu là URL YouTube
                                    if (strpos($videoUrl, 'youtube.com/watch?v=') !== false) {
                                        $videoId = explode('v=', $videoUrl)[1];
                                        if (strpos($videoId, '&') !== false) {
                                            $videoId = explode('&', $videoId)[0];
                                        }
                                        echo '<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$videoId.'" allowfullscreen></iframe>';
                                    } 
                                    // Kiểm tra nếu là URL YouTube rút gọn
                                    elseif (strpos($videoUrl, 'youtu.be/') !== false) {
                                        $videoId = explode('youtu.be/', $videoUrl)[1];
                                        echo '<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$videoId.'" allowfullscreen></iframe>';
                                    }
                                    // Nếu là mã nhúng iframe
                                    elseif (strpos($videoUrl, '<iframe') !== false) {
                                        echo $videoUrl;
                                    }
                                    // Trường hợp khác
                                    else {
                                        echo '<div class="alert alert-info">Không thể hiển thị xem trước video. Vui lòng kiểm tra URL.</div>';
                                    }
                                @endphp
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="thumbnail">Ảnh thumbnail</label>
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                            <small class="form-text text-muted">Để trống nếu không muốn thay đổi ảnh</small>
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2" id="thumbnail-preview">
                                @if($video->thumbnail)
                                    <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" class="img-thumbnail" style="max-height: 200px">
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="is_featured">Video nổi bật</label>
                            <div class="form-check">
                                <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" value="1" {{ old('is_featured', $video->is_featured) ? 'checked' : '' }}>
                                <label for="is_featured" class="form-check-label">Đánh dấu là video nổi bật</label>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="status">Trạng thái <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="1" {{ old('status', $video->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status', $video->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="order">Thứ tự hiển thị</label>
                            <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $video->order) }}" min="0">
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
                    <a href="{{ route('admin.stone.videos.index') }}" class="btn btn-secondary">
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
    // Hiển thị ảnh thumbnail xem trước khi upload
    document.getElementById('thumbnail').addEventListener('change', function(e) {
        const preview = document.getElementById('thumbnail-preview');
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
</script>
@endsection 