@extends('admin.index')

@section('page_title', 'Chỉnh sửa khoảng cách')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.driver.distance-tiers.index') }}">Danh sách khoảng cách</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa khoảng cách</li>
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
                            <i class="bi bi-route-gear"></i> Chỉnh sửa khoảng cách: {{ $distanceTier->name }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.driver.distance-tiers.update', $distanceTier->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    <i class="bi bi-tag"></i> Tên khoảng cách <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                       id="name" name="name" placeholder="📏 Nhập tên khoảng cách..." 
                                                       value="{{ old('name', $distanceTier->name) }}" required>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="display_text" class="form-label">
                                                    <i class="bi bi-text-paragraph"></i> Text hiển thị <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control @error('display_text') is-invalid @enderror" 
                                                       id="display_text" name="display_text" placeholder="📝 Nhập text hiển thị..." 
                                                       value="{{ old('display_text', $distanceTier->display_text) }}" required>
                                                @error('display_text')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="from_distance" class="form-label">
                                                    <i class="bi bi-arrow-right"></i> Từ khoảng cách (km) <span class="text-danger">*</span>
                                                </label>
                                                <input type="number" class="form-control @error('from_distance') is-invalid @enderror" 
                                                       id="from_distance" name="from_distance" placeholder="0" 
                                                       value="{{ old('from_distance', $distanceTier->from_distance) }}" min="0" step="0.1" required>
                                                @error('from_distance')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="to_distance" class="form-label">
                                                    <i class="bi bi-arrow-left"></i> Đến khoảng cách (km)
                                                </label>
                                                <input type="number" class="form-control @error('to_distance') is-invalid @enderror" 
                                                       id="to_distance" name="to_distance" placeholder="0" 
                                                       value="{{ old('to_distance', $distanceTier->to_distance) }}" min="0" step="0.1">
                                                @error('to_distance')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Để trống nếu không giới hạn</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            <i class="bi bi-text-paragraph"></i> Mô tả
                                        </label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="3" 
                                                  placeholder="📄 Nhập mô tả...">{{ old('description', $distanceTier->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">
                                                <i class="bi bi-gear"></i> Cài đặt
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                                                           value="1" {{ old('is_active', $distanceTier->is_active) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_active">
                                                        <i class="bi bi-toggle-on"></i> Kích hoạt khoảng cách
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="sort_order" class="form-label">
                                                    <i class="bi bi-sort-numeric-down"></i> Thứ tự hiển thị
                                                </label>
                                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                                       id="sort_order" name="sort_order" placeholder="0" 
                                                       value="{{ old('sort_order', $distanceTier->sort_order) }}" min="0">
                                                @error('sort_order')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Số càng nhỏ càng hiển thị trước</small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="color" class="form-label">
                                                    <i class="bi bi-palette"></i> Màu sắc
                                                </label>
                                                <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" 
                                                       id="color" name="color" value="{{ old('color', $distanceTier->color) }}" title="Chọn màu sắc">
                                                @error('color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="icon" class="form-label">
                                                    <i class="bi bi-emoji-smile"></i> Icon
                                                </label>
                                                <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                                       id="icon" name="icon" placeholder="🎨 Ví dụ: fas fa-route" 
                                                       value="{{ old('icon', $distanceTier->icon) }}">
                                                @error('icon')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <small class="form-text text-muted">Sử dụng FontAwesome icons</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.driver.distance-tiers.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Quay lại
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i> Cập nhật khoảng cách
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection
