@extends('admin.layouts.main')

@section('page_title', 'Chi tiết đơn hàng')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.stone.orders.index') }}">Quản lý đơn hàng</a>
                            </li>
                            <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Chi tiết đơn hàng #{{ $order->order_number }}</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">Thông tin đơn hàng</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 200px;">Mã đơn hàng:</th>
                                        <td><strong>{{ $order->order_number }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Ngày đặt:</th>
                                        <td>{{ $order->formatted_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái:</th>
                                        <td>
                                            {!! $order->status_label !!}
                                            @if ($order->status == 'pending')
                                                <br>
                                                <small class="text-muted">Có thể chuyển sang: Đang xử lý, Đã hủy</small>
                                            @elseif($order->status == 'processing')
                                                <br>
                                                <small class="text-muted">Có thể chuyển sang: Hoàn thành, Đã hủy</small>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tổng tiền:</th>
                                        <td>
                                            @php
                                                // If total_amount is zero, calculate from items
                                                $totalAmount = $order->total_amount;
                                                if ($totalAmount == 0 && count($order->items) > 0) {
                                                    $totalAmount = $order->items->sum(function($item) {
                                                        return $item->price * $item->quantity;
                                                    });
                                                }
                                            @endphp
                                            <strong class="text-danger">{{ number_format($totalAmount) }} đ</strong>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5 class="card-title">Thông tin khách hàng</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 200px;">Họ tên:</th>
                                        <td>{{ $order->customer_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại:</th>
                                        <td>{{ $order->customer_phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $order->customer_email ?: 'Không có' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ:</th>
                                        <td>{{ $order->customer_address }}</td>
                                    </tr>
                                    @if ($order->note)
                                        <tr>
                                            <th>Ghi chú:</th>
                                            <td>{{ $order->note }}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="card-title">Chi tiết đơn hàng</h5>
                                <div class="table-responsive">
                                    <table class="table table-centered table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;">#</th>
                                                <th>Sản phẩm</th>
                                                <th style="width: 150px;">Giá</th>
                                                <th style="width: 100px;">Số lượng</th>
                                                <th style="width: 150px;" class="text-right">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->items as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <div>
                                                            <strong>{{ $item->product->name }}</strong>
                                                            @if ($item->product)
                                                                <p class="text-muted mb-0">Mã: {{ $item->product->code }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>{{ number_format($item->price) }} đ</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td class="text-right">{{ number_format($item->subtotal) }} đ</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" class="text-right">Tổng cộng</th>
                                                <th class="text-right">
                                                    @php
                                                        // If total_amount is zero, calculate from items
                                                        $totalAmount = $order->total_amount;
                                                        if ($totalAmount == 0 && count($order->items) > 0) {
                                                            $totalAmount = $order->items->sum(function($item) {
                                                                return $item->price * $item->quantity;
                                                            });
                                                        }
                                                    @endphp
                                                    {{ number_format($totalAmount) }} đ
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h5>Cập nhật trạng thái</h5>
                                @if ($order->status != 'completed' && $order->status != 'cancelled')
                                    <div class="btn-group">
                                        @if ($order->status == 'pending')
                                            <form action="{{ route('admin.stone.orders.update', $order->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value='processing'>
                                                <input type="hidden" name="customer_name" value="{{ $order->customer_name }}">
                                                <input type="hidden" name="customer_email" value="{{ $order->customer_email }}">
                                                <input type="hidden" name="customer_phone" value="{{ $order->customer_phone }}">
                                                <input type="hidden" name="customer_address" value="{{ $order->customer_address }}">
                                                <input type="hidden" name="note" value="{{ $order->note }}">
                                                <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    <i class="mdi mdi-progress-check"></i> Chuyển sang đang xử lý
                                                </button>
                                            </form>
                                        @endif

                                        @if ($order->status == 'processing')
                                            <form action="{{ route('admin.stone.orders.update', $order->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value='completed'>
                                                <input type="hidden" name="customer_name" value="{{ $order->customer_name }}">
                                                <input type="hidden" name="customer_email" value="{{ $order->customer_email }}">
                                                <input type="hidden" name="customer_phone" value="{{ $order->customer_phone }}">
                                                <input type="hidden" name="customer_address" value="{{ $order->customer_address }}">
                                                <input type="hidden" name="note" value="{{ $order->note }}">
                                                <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                                <button type="submit" class="btn btn-success mr-2">
                                                    <i class="mdi mdi-check-circle"></i> Đánh dấu hoàn thành
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.stone.orders.update', $order->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value='cancelled'>
                                            <input type="hidden" name="customer_name" value="{{ $order->customer_name }}">
                                            <input type="hidden" name="customer_email" value="{{ $order->customer_email }}">
                                            <input type="hidden" name="customer_phone" value="{{ $order->customer_phone }}">
                                            <input type="hidden" name="customer_address" value="{{ $order->customer_address }}">
                                            <input type="hidden" name="note" value="{{ $order->note }}">
                                            <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                                <i class="mdi mdi-close-circle"></i> Hủy đơn hàng
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        Đơn hàng đã {{ $order->status == 'completed' ? 'hoàn thành' : 'bị hủy' }}, không
                                        thể thay đổi trạng thái.
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('admin.stone.orders.index') }}" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left"></i> Quay lại danh sách
                                </a>
                                @if ($order->status == 'completed' || $order->status == 'cancelled')
                                    <form action="{{ route('admin.stone.orders.destroy', $order->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ml-1"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                            <i class="mdi mdi-delete"></i> Xóa đơn hàng
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function updateStatus(orderId, status) {
            // Create form element
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ url('admin/stone/orders') }}/' + orderId;

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

            // Add status with proper value from constants
            var statusInput = document.createElement('input');
            statusInput.type = 'hidden';
            statusInput.name = 'status';
            
            // Sử dụng các chuỗi trực tiếp thay vì các hằng số
            if (status === 'processing') {
                statusInput.value = 'processing';
            } else if (status === 'completed') {
                statusInput.value = 'completed';
            } else if (status === 'cancelled') {
                statusInput.value = 'cancelled';
            } else if (status === 'pending') {
                statusInput.value = 'pending';
            }
            
            form.appendChild(statusInput);
            
            // Thêm các trường bắt buộc
            var customerName = document.createElement('input');
            customerName.type = 'hidden';
            customerName.name = 'customer_name';
            customerName.value = '{{ $order->customer_name }}';
            form.appendChild(customerName);
            
            var customerEmail = document.createElement('input');
            customerEmail.type = 'hidden';
            customerEmail.name = 'customer_email';
            customerEmail.value = '{{ $order->customer_email }}';
            form.appendChild(customerEmail);
            
            var customerPhone = document.createElement('input');
            customerPhone.type = 'hidden';
            customerPhone.name = 'customer_phone';
            customerPhone.value = '{{ $order->customer_phone }}';
            form.appendChild(customerPhone);
            
            var customerAddress = document.createElement('input');
            customerAddress.type = 'hidden';
            customerAddress.name = 'customer_address';
            customerAddress.value = '{{ $order->customer_address }}';
            form.appendChild(customerAddress);
            
            var note = document.createElement('input');
            note.type = 'hidden';
            note.name = 'note';
            note.value = '{{ $order->note }}';
            form.appendChild(note);
            
            var userId = document.createElement('input');
            userId.type = 'hidden';
            userId.name = 'user_id';
            userId.value = '{{ $order->user_id }}';
            form.appendChild(userId);

            // Add form to body and submit
            document.body.appendChild(form);
            form.submit();
        }
    </script>
@endsection
