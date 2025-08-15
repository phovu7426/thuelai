@extends('admin.layouts.main')

@section('title', 'Sửa bảng giá - ' . $service->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sửa bảng giá: {{ $service->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.driver.pricing.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.driver.pricing.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Tên dịch vụ</label>
                                    <input type="text" class="form-control" id="name" value="{{ $service->name }}" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <input type="text" class="form-control" value="{{ $service->status ? 'Hoạt động' : 'Tạm dừng' }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price_per_hour">Giá theo giờ (VNĐ) <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control @error('price_per_hour') is-invalid @enderror" 
                                           id="price_per_hour" 
                                           name="price_per_hour" 
                                           value="{{ old('price_per_hour', $service->price_per_hour) }}" 
                                           min="0" 
                                           step="1000" 
                                           required>
                                    @error('price_per_hour')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Nhập giá theo giờ cho dịch vụ này</small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price_per_trip">Giá theo chuyến (VNĐ) <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control @error('price_per_trip') is-invalid @enderror" 
                                           id="price_per_trip" 
                                           name="price_per_trip" 
                                           value="{{ old('price_per_trip', $service->price_per_trip) }}" 
                                           min="0" 
                                           step="1000" 
                                           required>
                                    @error('price_per_trip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Nhập giá theo chuyến cho dịch vụ này</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Cập nhật bảng giá
                            </button>
                            <a href="{{ route('admin.driver.pricing.index') }}" class="btn btn-secondary">
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
    // Format số tiền khi nhập
    $('#price_per_hour, #price_per_trip').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length > 0) {
            value = parseInt(value).toLocaleString('vi-VN');
            $(this).val(value.replace(/\./g, ''));
        }
    });
});
</script>
@endsection
