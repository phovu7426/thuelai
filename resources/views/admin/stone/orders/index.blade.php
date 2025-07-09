@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quản lý đơn hàng</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.stone.orders.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus"></i> Tạo đơn hàng mới
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.stone.orders.index') }}" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" name="order_number" class="form-control" placeholder="Mã đơn hàng"
                                value="{{ request('order_number') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="customer_name" class="form-control"
                                placeholder="Tên khách hàng" value="{{ request('customer_name') }}">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="customer_phone" class="form-control"
                                placeholder="Số điện thoại" value="{{ request('customer_phone') }}">
                        </div>
                        <div class="col-md-2">
                            <select name="status" class="form-control">
                                <option value="">-- Trạng thái --</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã huỷ</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Lọc</button>
                            <a href="{{ route('admin.stone.orders.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="50">ID</th>
                                <th>Mã đơn hàng</th>
                                <th>Khách hàng</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th width="150">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->order_number }}</td>
                                    <td>
                                        <div>
                                            <div class="fw-bold">{{ $order->customer_name }}</div>
                                            <div class="text-muted small">{{ $order->customer_phone }}</div>
                                            @if ($order->customer_email)
                                                <div class="text-muted small">{{ $order->customer_email }}</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <div>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</div>
                                            <div class="text-muted small">{{ \Carbon\Carbon::parse($order->created_at)->format('H:i:s') }}</div>
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
                                                    'text' => 'Chờ xử lý',
                                                ],
                                                'processing' => [
                                                    'class' => 'bg-info text-white',
                                                    'text' => 'Đang xử lý',
                                                ],
                                                'completed' => [
                                                    'class' => 'bg-success text-white',
                                                    'text' => 'Hoàn thành',
                                                ],
                                                'cancelled' => [
                                                    'class' => 'bg-danger text-white',
                                                    'text' => 'Đã hủy',
                                                ],
                                            ][$order->status] ?? [
                                                'class' => 'bg-secondary text-white',
                                                'text' => 'Không xác định',
                                            ];
                                        @endphp
                                        <span class="badge {{ $statusConfig['class'] }}">
                                            {{ $statusConfig['text'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.stone.orders.show', $order->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if ($order->status == 'pending')
                                            <button type="button" class="btn btn-warning btn-sm"
                                                onclick="updateStatus({{ $order->id }}, 'processing')">
                                                <i class="bi bi-play"></i>
                                            </button>
                                        @endif
                                        <form action="{{ route('admin.stone.orders.destroy', $order->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if (isset($orders) && method_exists($orders, 'links'))
                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
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
    </script>
@endsection
