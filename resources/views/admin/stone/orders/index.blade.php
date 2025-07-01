@extends('admin.layouts.main')

@section('title', 'Quản lý đơn hàng')

@section('css')
<!-- Material Design Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css">
<style>
    .badge {
        padding: 8px 12px;
        font-size: 0.9rem;
        font-weight: 500;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .badge-warning {
        background-color: #ffc107;
        color: #000;
    }
    .badge-info {
        background-color: #17a2b8;
        color: #fff;
    }
    .badge-success {
        background-color: #28a745;
        color: #fff;
    }
    .badge-danger {
        background-color: #dc3545;
        color: #fff;
    }
    .badge-secondary {
        background-color: #6c757d;
        color: #fff;
    }
    .btn-group .btn {
        margin: 0 2px;
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-group .btn i {
        font-size: 1.1rem;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý đơn hàng</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Quản lý đơn hàng</li>
            </ol>
        </nav>
    </div>

    <!-- Card -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('admin.stone.orders.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Tạo đơn hàng mới
                </a>
            </div>
            <div class="d-flex gap-2">
                <form action="{{ route('admin.stone.orders.index') }}" method="GET" class="d-flex gap-2">
                    <div class="input-group">
                        <input type="text" 
                               class="form-control" 
                               placeholder="Tìm theo mã đơn, tên khách hàng..." 
                               name="search" 
                               value="{{ request('search') }}">
                        <select class="form-select" name="status" style="min-width: 150px;">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Khách hàng</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th class="text-end">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.stone.orders.show', $order->id) }}" class="text-primary fw-bold">
                                        #{{ $order->order_number }}
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">{{ $order->customer_name }}</span>
                                        <span class="text-muted small">{{ $order->customer_phone }}</span>
                                        @if($order->customer_email)
                                            <span class="text-muted small">{{ $order->customer_email }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</span>
                                        <span class="text-muted small">{{ \Carbon\Carbon::parse($order->created_at)->format('H:i:s') }}</span>
                                    </div>
                                </td>
                                <td class="fw-bold">{{ number_format($order->total_amount) }}đ</td>
                                <td>
                                    @php
                                        $statusConfig = [
                                            'pending' => [
                                                'class' => 'bg-warning text-dark',
                                                'icon' => 'fas fa-hourglass-half',
                                                'text' => 'Chờ xử lý'
                                            ],
                                            'processing' => [
                                                'class' => 'bg-info text-white',
                                                'icon' => 'fas fa-cog fa-spin',
                                                'text' => 'Đang xử lý'
                                            ],
                                            'completed' => [
                                                'class' => 'bg-success text-white',
                                                'icon' => 'fas fa-check-circle',
                                                'text' => 'Hoàn thành'
                                            ],
                                            'cancelled' => [
                                                'class' => 'bg-danger text-white',
                                                'icon' => 'fas fa-times-circle',
                                                'text' => 'Đã hủy'
                                            ]
                                        ][$order->status] ?? [
                                            'class' => 'bg-secondary text-white',
                                            'icon' => 'fas fa-question-circle',
                                            'text' => 'Không xác định'
                                        ];
                                    @endphp
                                    <span class="badge {{ $statusConfig['class'] }}">
                                        <i class="{{ $statusConfig['icon'] }}"></i> {{ $statusConfig['text'] }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group float-end">
                                        <a href="{{ route('admin.stone.orders.show', $order->id) }}" 
                                           class="btn btn-info btn-sm" 
                                           data-bs-toggle="tooltip" 
                                           title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if($order->status == 'pending')
                                            <form action="{{ route('admin.stone.orders.update', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="processing">
                                                <button type="submit" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Chuyển sang đang xử lý">
                                                    <i class="fas fa-play"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if($order->status == 'processing')
                                            <form action="{{ route('admin.stone.orders.update', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="btn btn-success btn-sm" data-bs-toggle="tooltip" title="Đánh dấu hoàn thành">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if(in_array($order->status, ['pending', 'processing']))
                                            <form action="{{ route('admin.stone.orders.update', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Hủy đơn hàng" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if($order->status == 'completed' || $order->status == 'cancelled')
                                            <form action="{{ route('admin.stone.orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Xóa đơn hàng" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                        <p>Không có đơn hàng nào</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Enable tooltips
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    }
});

// Function to update order status
window.updateStatus = function(orderId, status) {
    // Create form element
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ url("admin/stone/orders") }}/' + orderId;
    
    // Add CSRF token
    var csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = '{{ csrf_token() }}';
    form.appendChild(csrf);
    
    // Add method override
    var method = document.createElement('input');
    method.type = 'hidden';
    method.name = '_method';
    method.value = 'PUT';
    form.appendChild(method);
    
    // Add status
    var statusInput = document.createElement('input');
    statusInput.type = 'hidden';
    statusInput.name = 'status';
    statusInput.value = status;
    form.appendChild(statusInput);
    
    // Add form to body and submit
    document.body.appendChild(form);
    form.submit();
}

// Function to delete order
window.deleteOrder = function(orderId) {
    // Create form element
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ url("admin/stone/orders") }}/' + orderId;
    
    // Add CSRF token
    var csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = '{{ csrf_token() }}';
    form.appendChild(csrf);
    
    // Add method override
    var method = document.createElement('input');
    method.type = 'hidden';
    method.name = '_method';
    method.value = 'DELETE';
    form.appendChild(method);
    
    // Add form to body and submit
    document.body.appendChild(form);
    form.submit();
}
</script>
@endsection 