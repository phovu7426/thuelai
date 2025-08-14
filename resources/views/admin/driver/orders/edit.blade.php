@extends('admin.layouts.main')

@section('title', 'Chỉnh sửa đơn hàng lái xe')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Chỉnh sửa đơn hàng lái xe</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.driver.orders.index') }}">Đơn hàng lái xe</a></li>
                    <li class="breadcrumb-item active">Chỉnh sửa đơn hàng</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.driver.orders.show', $driverOrder->id) }}" class="btn btn-secondary">
                    <i class="fas fa-eye"></i> Xem chi tiết
                </a>
                <a href="{{ route('admin.driver.orders.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit"></i>
                        Chỉnh sửa đơn hàng #{{ $driverOrder->order_number }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.driver.orders.update', $driverOrder->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="customer_name" class="form-label">Họ và tên *</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $driverOrder->customer_name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="customer_phone" class="form-label">Số điện thoại *</label>
                                    <input type="tel" class="form-control" id="customer_phone" name="customer_phone" value="{{ $driverOrder->customer_phone }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="customer_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ $driverOrder->customer_email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="driver_service_id" class="form-label">Dịch vụ *</label>
                                    <select class="form-control" id="driver_service_id" name="driver_service_id" required>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ $driverOrder->driver_service_id == $service->id ? 'selected' : '' }}>
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="service_type" class="form-label">Loại dịch vụ *</label>
                                    <select class="form-control" id="service_type" name="service_type" required>
                                        <option value="hourly" {{ $driverOrder->service_type == 'hourly' ? 'selected' : '' }}>Theo giờ</option>
                                        <option value="trip" {{ $driverOrder->service_type == 'trip' ? 'selected' : '' }}>Theo chuyến</option>
                                        <option value="custom" {{ $driverOrder->service_type == 'custom' ? 'selected' : '' }}>Tùy chỉnh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="hours" class="form-label">Số giờ</label>
                                    <input type="number" class="form-control" id="hours" name="hours" value="{{ $driverOrder->hours }}" min="1" max="24">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="pickup_datetime" class="form-label">Thời gian đón *</label>
                                    <input type="datetime-local" class="form-control" id="pickup_datetime" name="pickup_datetime" value="{{ $driverOrder->pickup_datetime->format('Y-m-d\TH:i') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="status" class="form-label">Trạng thái *</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="pending" {{ $driverOrder->status == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                                        <option value="confirmed" {{ $driverOrder->status == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                        <option value="in_progress" {{ $driverOrder->status == 'in_progress' ? 'selected' : '' }}>Đang thực hiện</option>
                                        <option value="completed" {{ $driverOrder->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                        <option value="cancelled" {{ $driverOrder->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="pickup_location" class="form-label">Địa điểm đón *</label>
                            <input type="text" class="form-control" id="pickup_location" name="pickup_location" value="{{ $driverOrder->pickup_location }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-group mb-3">
                                <label for="destination" class="form-label">Điểm đến</label>
                                <input type="text" class="form-control" id="destination" name="destination" value="{{ $driverOrder->destination }}">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="special_requirements" class="form-label">Yêu cầu đặc biệt</label>
                            <textarea class="form-control" id="special_requirements" name="special_requirements" rows="3">{{ $driverOrder->special_requirements }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="admin_notes" class="form-label">Ghi chú admin</label>
                            <textarea class="form-control" id="admin_notes" name="admin_notes" rows="3">{{ $driverOrder->admin_notes }}</textarea>
                        </div>

                        <div class="form-actions text-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Cập nhật đơn hàng
                            </button>
                            <a href="{{ route('admin.driver.orders.show', $driverOrder->id) }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                                Hủy
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.page-header {
    background: #f8f9fa;
    padding: 2rem 0;
    margin-bottom: 2rem;
    border-radius: 10px;
}

.page-title {
    margin: 0;
    color: #333;
    font-weight: 600;
}

.breadcrumb {
    margin: 0;
    padding: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: ">";
}

.form-label {
    font-weight: 600;
    color: #495057;
}

.form-control {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    padding: 0.75rem;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.form-actions {
    margin-top: 2rem;
}

.form-actions .btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    margin: 0 0.25rem;
}
</style>
@endpush
