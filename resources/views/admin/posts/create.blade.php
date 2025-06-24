@extends('admin.index')

@section('page_title', 'Thêm Bài Đăng')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Bài Đăng</a></li>
    <li class="breadcrumb-item active">Thêm</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Thêm Bài Đăng</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tiêu Đề <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Mô Tả Ngắn</label>
                        <div class="col-sm-10">
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div class="form-text">Mô tả ngắn về bài đăng, sẽ hiển thị ở trang danh sách</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Hình Ảnh</label>
                        <div class="col-sm-10">
                            <x-uploads.file-upload name="image" />
                            @error('image') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nội Dung <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="10" data-editor="true">{{ old('content') }}</textarea>
                            @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Yêu Cầu Đăng Nhập</label>
                        <div class="col-sm-10">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="require_login" id="require_login" {{ old('require_login') ? 'checked' : '' }}>
                                <label class="form-check-label" for="require_login">Người dùng phải đăng nhập để xem</label>
                            </div>
                            <div class="form-text">Nếu bật, chỉ người dùng đã đăng nhập mới có thể xem bài đăng này</div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label">Trạng Thái <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-select @error('status') is-invalid @enderror" name="status">
                                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Hoạt Động</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Không Hoạt Động</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Lưu</button>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
