@extends('admin.index')

@section('page_title', 'Thêm mới đánh giá khách hàng')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.driver.dashboard') }}">Dịch vụ lái xe</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.driver.testimonials.index') }}">Đánh giá khách hàng</a></li>
    <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
@endsection

@section('content')
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-chat-quote"></i> Thêm mới đánh giá khách hàng
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.driver.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="customer_name" class="form-label">
                                            <i class="bi bi-person"></i> Tên khách hàng
                                        </label>
                                        <input type="text" name="customer_name" id="customer_name" class="form-control"
                                               placeholder="👤 Nhập tên khách hàng..." value="{{ old('customer_name') }}" required>
                                        @error('customer_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="customer_position" class="form-label">
                                            <i class="bi bi-briefcase"></i> Chức vụ
                                        </label>
                                        <input type="text" name="customer_position" id="customer_position" class="form-control"
                                               placeholder="💼 Nhập chức vụ..." value="{{ old('customer_position') }}">
                                        @error('customer_position')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="rating" class="form-label">
                                            <i class="bi bi-star"></i> Đánh giá
                                        </label>
                                        <select name="rating" id="rating" class="form-control" required>
                                            <option value="">⭐ Chọn số sao</option>
                                            <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>1 sao</option>
                                            <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2 sao</option>
                                            <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3 sao</option>
                                            <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4 sao</option>
                                            <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5 sao</option>
                                        </select>
                                        @error('rating')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">
                                            <i class="bi bi-image"></i> Hình ảnh
                                        </label>
                                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                        <small class="text-muted">Hỗ trợ: JPG, PNG, GIF (tối đa 2MB)</small>
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="content" class="form-label">
                                            <i class="bi bi-chat-text"></i> Nội dung đánh giá
                                        </label>
                                        <textarea name="content" id="content" class="form-control" rows="5"
                                                  placeholder="💬 Nhập nội dung đánh giá..." required>{{ old('content') }}</textarea>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="status" id="status" class="form-check-input" value="1" {{ old('status') ? 'checked' : '' }}>
                                            <label for="status" class="form-check-label">
                                                <i class="bi bi-check-circle"></i> Kích hoạt
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="featured" id="featured" class="form-check-input" value="1" {{ old('featured') ? 'checked' : '' }}>
                                            <label for="featured" class="form-check-label">
                                                <i class="bi bi-star"></i> Nổi bật
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="{{ route('admin.driver.testimonials.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Hủy
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i> Thêm mới
                                        </button>
                                    </div>
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection
