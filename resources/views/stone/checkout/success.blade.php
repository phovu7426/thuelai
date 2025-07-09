@extends('stone.layouts.main')

@section('page_title', 'Đặt hàng thành công')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="text-center mb-5">
                    <div class="mb-4">
                        <i class="fa fa-check-circle text-success" style="font-size: 80px;"></i>
                    </div>
                    <h1 class="mb-3">Đặt hàng thành công!</h1>
                    <p class="lead">Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được tiếp nhận và đang được xử lý.</p>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Thông tin đơn hàng #{{ $order->id }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted">Thông tin khách hàng</h6>
                                <p><strong>Họ tên:</strong> {{ $order->customer_name }}</p>
                                <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                                <p><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
                                <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Thông tin đơn hàng</h6>
                                <p><strong>Mã đơn hàng:</strong> #{{ $order->id }}</p>
                                <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                                <p><strong>Trạng thái:</strong> {!! $order->status_label !!}</p>
                                <p><strong>Ghi chú:</strong> {{ $order->note ?? 'Không có' }}</p>
                            </div>
                        </div>

                        <h6 class="text-muted mb-3">Chi tiết đơn hàng</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th class="text-right">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ number_format((float) $item->price) }} đ</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td class="text-right">{{ number_format((float) $item->subtotal) }} đ</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-right">Tổng cộng:</th>
                                        <th class="text-right">{{ number_format((float) $order->total_amount) }} đ</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('stone.orders.index') }}" class="btn btn-primary">
                        <i class="fa fa-list"></i> Xem danh sách đơn hàng
                    </a>
                    <a href="{{ route('stone.products.index') }}" class="btn btn-outline-primary ml-2">
                        <i class="fa fa-shopping-bag"></i> Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
