@extends('admin.layouts.main')

@section('title', 'Quản lý đơn hàng lái xe')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Quản lý đơn hàng lái xe</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.driver.dashboard') }}">Dịch vụ lái xe</a></li>
                    <li class="breadcrumb-item active">Đơn hàng lái xe</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.driver.orders.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Tạo đơn hàng mới
                </a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Orders List -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Danh sách đơn hàng</h5>
                </div>
                <div class="card-body">
                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Mã đơn</th>
                                        <th>Khách hàng</th>
                                        <th>Dịch vụ</th>
                                        <th>Thời gian</th>
                                        <th>Địa điểm</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <strong>{{ $order->order_number }}</strong>
                                        </td>
                                        <td>
                                            <div>
                                                <strong>{{ $order->customer_name }}</strong><br>
                                                <small class="text-muted">{{ $order->customer_phone }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @if($order->service)
                                                <span class="badge bg-info">{{ $order->service->name }}</span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                <small><strong>Ngày:</strong> {{ $order->service_date ? \Carbon\Carbon::parse($order->service_date)->format('d/m/Y') : 'N/A' }}</small><br>
                                                <small><strong>Giờ:</strong> {{ $order->service_time ?? 'N/A' }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <small>{{ Str::limit($order->pickup_location, 50) }}</small>
                                        </td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'pending' => 'warning',
                                                    'confirmed' => 'info',
                                                    'in_progress' => 'primary',
                                                    'completed' => 'success',
                                                    'cancelled' => 'danger'
                                                ];
                                                $statusLabels = [
                                                    'pending' => 'Chờ xác nhận',
                                                    'confirmed' => 'Đã xác nhận',
                                                    'in_progress' => 'Đang thực hiện',
                                                    'completed' => 'Hoàn thành',
                                                    'cancelled' => 'Đã hủy'
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                                {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.driver.orders.show', $order->id) }}" 
                                                   class="btn btn-sm btn-info" title="Xem">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.driver.orders.edit', $order->id) }}" 
                                                   class="btn btn-sm btn-warning" title="Sửa">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.driver.orders.destroy', $order->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-cart-check text-muted" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-muted">Chưa có đơn hàng nào</h5>
                            <p class="text-muted">Hãy tạo đơn hàng đầu tiên để bắt đầu</p>
                            <a href="{{ route('admin.driver.orders.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus"></i> Tạo đơn hàng mới
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /Orders List -->
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Orders index page loaded');
});
</script>
@endsection
