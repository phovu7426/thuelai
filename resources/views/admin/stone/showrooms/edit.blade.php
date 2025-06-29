@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa showroom đá</h3>
            <div class="card-tools">
                <a href="{{ route('admin.stone.showrooms.index') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.stone.showrooms.update', $showroom->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label for="name">Tên showroom <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $showroom->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="description">Mô tả</label>
                            <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $showroom->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="address">Địa chỉ <span class="text-danger">*</span></label>
                            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $showroom->address) }}" required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $showroom->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $showroom->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="working_hours">Giờ làm việc</label>
                            <input type="text" name="working_hours" id="working_hours" class="form-control @error('working_hours') is-invalid @enderror" value="{{ old('working_hours', $showroom->working_hours) }}" placeholder="Ví dụ: 8:00 - 17:30, Thứ 2 - Thứ 6">
                            @error('working_hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="location">Vị trí Google Maps</label>
                            <textarea name="location" id="location" rows="3" class="form-control @error('location') is-invalid @enderror" placeholder="Nhập mã nhúng Google Maps">{{ old('location', $showroom->location) }}</textarea>
                            <small class="form-text text-muted">Nhập mã nhúng iframe từ Google Maps</small>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="image">Ảnh đại diện</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            <small class="form-text text-muted">Để trống nếu không muốn thay đổi ảnh</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2" id="image-preview">
                                @if($showroom->image)
                                    <img src="{{ get_image_url($showroom->image) }}" alt="{{ $showroom->name }}" class="img-thumbnail" style="max-height: 200px">
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
                            
                            @if(isset($showroom->gallery) && is_array($showroom->gallery))
                                <div class="mt-3">
                                    <label>Ảnh hiện tại:</label>
                                    <div class="row">
                                        @foreach($showroom->gallery as $image)
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
                            <label for="status">Trạng thái <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="1" {{ old('status', $showroom->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status', $showroom->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="order">Thứ tự hiển thị</label>
                            <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $showroom->order) }}" min="0">
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
                    <a href="{{ route('admin.stone.showrooms.index') }}" class="btn btn-secondary">
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
    // Hiển thị ảnh xem trước khi upload
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('image-preview');
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