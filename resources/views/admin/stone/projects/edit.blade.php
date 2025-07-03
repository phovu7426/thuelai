@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa dự án đá</h3>
            <div class="card-tools">
                <a href="{{ route('admin.stone.projects.index') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.stone.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label for="name">Tên dự án <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $project->name) }}" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="description">Mô tả ngắn</label>
                            <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $project->description) }}</textarea>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="content">Nội dung chi tiết</label>
                            <textarea name="content" id="content" rows="5" class="form-control" data-editor="true">{{ old('content', $project->content) }}</textarea>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="client">Khách hàng</label>
                            <input type="text" name="client" id="client" class="form-control" value="{{ old('client', $project->client) }}">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="location">Địa điểm</label>
                            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $project->location) }}">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="province">Tỉnh/Thành phố</label>
                            <input type="text" name="province" id="province" class="form-control" value="{{ old('province', $project->province) }}">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="region">Khu vực <span class="text-danger">*</span></label>
                            <select name="region" id="region" class="form-control" required>
                                <option value="">-- Chọn khu vực --</option>
                                <option value="north" {{ old('region', $project->region) == 'north' ? 'selected' : '' }}>Miền Bắc</option>
                                <option value="central" {{ old('region', $project->region) == 'central' ? 'selected' : '' }}>Miền Trung</option>
                                <option value="south" {{ old('region', $project->region) == 'south' ? 'selected' : '' }}>Miền Nam</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="budget">Ngân sách (VNĐ)</label>
                            <input type="number" name="budget" id="budget" class="form-control" value="{{ old('budget', $project->budget) }}" min="0">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="completed_date">Ngày hoàn thành</label>
                            <input type="date" name="completed_date" id="completed_date" class="form-control" value="{{ old('completed_date', $project->completed_date ? $project->completed_date->format('Y-m-d') : '') }}">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="main_image">Ảnh chính</label>
                            <input type="file" name="main_image" id="main_image" class="form-control">
                            @if($project->main_image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $project->main_image) }}" alt="{{ $project->name }}" class="img-thumbnail" style="max-height: 200px">
                                </div>
                            @endif
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="gallery">Thêm ảnh vào bộ sưu tập</label>
                            <input type="file" name="gallery[]" id="gallery" class="form-control" accept="image/*" multiple>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="is_featured">Dự án nổi bật</label>
                            <div class="form-check">
                                <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label">Đánh dấu là dự án nổi bật</label>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="status">Trạng thái <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1" {{ old('status', $project->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status', $project->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="order">Thứ tự hiển thị</label>
                            <input type="number" name="order" id="order" class="form-control" value="{{ old('order', $project->order) }}" min="0">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Lưu thay đổi
                    </button>
                    <a href="{{ route('admin.stone.projects.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 