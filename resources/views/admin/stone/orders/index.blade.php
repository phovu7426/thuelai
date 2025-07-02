@extends('admin.layouts.main')

@section('page_title', 'Quản lý đơn hàng')

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
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-9">
                        <form action="{{ route('admin.stone.orders.index') }}" method="GET" class="mb-0">
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <input type="text" name="order_number" class="form-control" placeholder="Mã đơn hàng"
                                        value="{{ request('order_number') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="customer_name" class="form-control"
                                        placeholder="Tên khách hàng" value="{{ request('customer_name') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="customer_phone" class="form-control"
                                        placeholder="Số điện thoại" value="{{ request('customer_phone') }}">
                                </div>
                                <div class="col-md-2">
                                    <select name="status" class="form-control">
                                        <option value="">-- Trạng thái --</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ
                                            xử lý
                                        </option>
                                        <option value="processing"
                                            {{ request('status') == 'processing' ? 'selected' : '' }}>Đang
                                            xử lý</option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                            Hoàn
                                            thành</option>
                                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                            Đã huỷ
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-1 d-flex gap-1">
                                    <button type="submit" class="btn btn-primary">Lọc</button>
                                    <a href="{{ route('admin.stone.orders.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3 text-end">
                        <a href="{{ route('admin.stone.orders.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Tạo đơn hàng mới
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
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
                                    <td>{{ $order->order_number }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold">{{ $order->customer_name }}</span>
                                            <span class="text-muted small">{{ $order->customer_phone }}</span>
                                            @if ($order->customer_email)
                                                <span class="text-muted small">{{ $order->customer_email }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</span>
                                            <span
                                                class="text-muted small">{{ \Carbon\Carbon::parse($order->created_at)->format('H:i:s') }}</span>
                                        </div>
                                    </td>
                                    <td class="fw-bold">
                                        @php
                                            $totalAmount = $order->total_amount;
                                            if ($totalAmount == 0 && $order->items->count() > 0) {
                                                $totalAmount = $order->items->sum(function ($item) {
                                                    return $item->price * $item->quantity;
                                                });
                                            }
                                        @endphp
                                        {{ number_format($totalAmount) }}đ
                                    </td>
                                    <td>
                                        @php
                                            $statusConfig = [
                                                'pending' => [
                                                    'class' => 'bg-warning text-dark',
                                                    'icon' => 'fas fa-hourglass-half',
                                                    'text' => 'Chờ xử lý',
                                                ],
                                                'processing' => [
                                                    'class' => 'bg-info text-white',
                                                    'icon' => 'fas fa-cog fa-spin',
                                                    'text' => 'Đang xử lý',
                                                ],
                                                'completed' => [
                                                    'class' => 'bg-success text-white',
                                                    'icon' => 'fas fa-check-circle',
                                                    'text' => 'Hoàn thành',
                                                ],
                                                'cancelled' => [
                                                    'class' => 'bg-danger text-white',
                                                    'icon' => 'fas fa-times-circle',
                                                    'text' => 'Đã hủy',
                                                ],
                                            ][$order->status] ?? [
                                                'class' => 'bg-secondary text-white',
                                                'icon' => 'fas fa-question-circle',
                                                'text' => 'Không xác định',
                                            ];
                                        @endphp
                                        <span class="badge {{ $statusConfig['class'] }}">
                                            <i class="{{ $statusConfig['icon'] }}"></i> {{ $statusConfig['text'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-end">
                                            <button type="button"
                                                onclick="window.location.href='{{ route('admin.stone.orders.show', $order->id) }}'"
                                                class="btn btn-sm btn-link px-2" title="Xem chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @if ($order->status == 'pending')
                                                <button type="button" class="btn btn-sm btn-link px-2"
                                                    title="Chuyển sang đang xử lý"
                                                    onclick="updateStatus({{ $order->id }}, 'processing')">
                                                    <i class="fas fa-play"></i>
                                                </button>
                                            @endif
                                            <form action="{{ route('admin.stone.orders.destroy', $order->id) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-link px-2 text-danger"
                                                    title="Xóa"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
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

@section('scripts')
    <script>
        // Initialize orderData object to store order information
        const orderData = {};

        function updateStatus(orderId, newStatus) {
            // Create form data
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('status', newStatus);

            // Send AJAX request
            fetch(`{{ url('admin/stone/orders') }}/${orderId}/status`, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Reload the page to show updated status
                        window.location.reload();
                    } else {
                        // Show error message
                        alert(data.message || 'Có lỗi xảy ra khi cập nhật trạng thái đơn hàng');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi cập nhật trạng thái đơn hàng');
                });
        }

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection
