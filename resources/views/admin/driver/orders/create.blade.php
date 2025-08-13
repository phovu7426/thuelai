@extends('admin.layouts.main')

@section('title', 'Tạo đơn hàng lái xe')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tạo đơn hàng lái xe mới</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.driver.orders.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.driver.orders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_name">Tên khách hàng <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                                           id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                                    @error('customer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_phone">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('customer_phone') is-invalid @enderror" 
                                           id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required>
                                    @error('customer_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_email">Email</label>
                                    <input type="email" class="form-control @error('customer_email') is-invalid @enderror" 
                                           id="customer_email" name="customer_email" value="{{ old('customer_email') }}">
                                    @error('customer_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_type">Loại dịch vụ <span class="text-danger">*</span></label>
                                    <select class="form-control @error('service_type') is-invalid @enderror" 
                                            id="service_type" name="service_type" required>
                                        <option value="">Chọn loại dịch vụ</option>
                                        <option value="hourly" {{ old('service_type') == 'hourly' ? 'selected' : '' }}>Lái xe theo giờ</option>
                                        <option value="trip" {{ old('service_type') == 'trip' ? 'selected' : '' }}>Lái xe theo chuyến</option>
                                        <option value="custom" {{ old('service_type') == 'custom' ? 'selected' : '' }}>Lái xe theo yêu cầu</option>
                                        <option value="business" {{ old('service_type') == 'business' ? 'selected' : '' }}>Lái xe cho doanh nghiệp</option>
                                        <option value="event" {{ old('service_type') == 'event' ? 'selected' : '' }}>Lái xe cho sự kiện</option>
                                    </select>
                                    @error('service_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pickup_date">Ngày đón <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('pickup_date') is-invalid @enderror" 
                                           id="pickup_date" name="pickup_date" value="{{ old('pickup_date') }}" required>
                                    @error('pickup_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pickup_time">Giờ đón <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('pickup_time') is-invalid @enderror" 
                                           id="pickup_time" name="pickup_time" value="{{ old('pickup_time') }}" required>
                                    @error('pickup_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pickup_location">Địa điểm đón <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('pickup_location') is-invalid @enderror" 
                                              id="pickup_location" name="pickup_location" rows="3" required>{{ old('pickup_location') }}</textarea>
                                    @error('pickup_location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="destination">Điểm đến</label>
                                    <textarea class="form-control @error('destination') is-invalid @enderror" 
                                              id="destination" name="destination" rows="3">{{ old('destination') }}</textarea>
                                    @error('destination')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="duration">Thời gian (giờ)</label>
                                    <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                                           id="duration" name="duration" value="{{ old('duration') }}" min="1">
                                    @error('duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estimated_price">Giá ước tính (VNĐ)</label>
                                    <input type="number" class="form-control @error('estimated_price') is-invalid @enderror" 
                                           id="estimated_price" name="estimated_price" value="{{ old('estimated_price') }}" min="0">
                                    @error('estimated_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select class="form-control @error('status') is-invalid @enderror" 
                                            id="status" name="status">
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                        <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                        <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>Đang thực hiện</option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="notes">Ghi chú</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="4">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Tạo đơn hàng
                            </button>
                            <a href="{{ route('admin.driver.orders.index') }}" class="btn btn-secondary">
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
    // Auto-calculate estimated price based on service type and duration
    $('#service_type, #duration').on('change', function() {
        calculatePrice();
    });

    function calculatePrice() {
        const serviceType = $('#service_type').val();
        const duration = parseInt($('#duration').val()) || 0;
        
        let basePrice = 0;
        switch(serviceType) {
            case 'hourly':
                basePrice = 150000; // 150k/giờ
                break;
            case 'trip':
                basePrice = 300000; // 300k/chuyến
                break;
            case 'custom':
                basePrice = 200000; // 200k/giờ
                break;
            case 'business':
                basePrice = 250000; // 250k/giờ
                break;
            case 'event':
                basePrice = 400000; // 400k/ngày
                break;
        }
        
        let estimatedPrice = 0;
        if (serviceType === 'hourly' || serviceType === 'custom' || serviceType === 'business') {
            estimatedPrice = basePrice * duration;
        } else if (serviceType === 'trip') {
            estimatedPrice = basePrice;
        } else if (serviceType === 'event') {
            estimatedPrice = basePrice * Math.ceil(duration / 8); // Tính theo ngày
        }
        
        if (estimatedPrice > 0) {
            $('#estimated_price').val(estimatedPrice);
        }
    }
});
</script>
@endsection
