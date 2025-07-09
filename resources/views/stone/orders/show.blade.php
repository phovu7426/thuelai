@extends('stone.layouts.main')

@section('page_title', 'Chi tiết đơn hàng')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0">Chi tiết đơn hàng #{{ $order->order_number }}</h1>
                    <a href="{{ route('stone.orders.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left"></i> Quay lại danh sách
                    </a>
                </div>

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

                <div class="card">
                    <div class="card-body">
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
                                                <small class="text-muted">Bạn có thể hủy đơn hàng này</small>
                                            @elseif($order->status == 'processing')
                                                <br>
                                                <small class="text-muted">Đơn hàng đang được xử lý</small>
                                            @elseif($order->status == 'completed')
                                                <br>
                                                <small class="text-muted">Đơn hàng đã hoàn thành</small>
                                            @else
                                                <br>
                                                <small class="text-muted">Đơn hàng đã bị hủy</small>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tổng tiền:</th>
                                        <td><strong class="text-danger">{{ number_format($order->total_amount) }} đ</strong>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5 class="card-title">Thông tin giao hàng</h5>
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
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th style="width: 150px;">Đơn giá</th>
                                                <th style="width: 100px;">Số lượng</th>
                                                <th style="width: 150px;" class="text-right">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->items as $item)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset('images/default/default_image.png') }}"
                                                                alt="{{ $item->product_name }}"
                                                                class="img-thumbnail mr-3"
                                                                style="width: 60px; height: 60px; object-fit: cover;">
                                                            <div>
                                                                <h6 class="mb-0">
                                                                    {{ $item->product_name }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ number_format($item->price) }} đ</td>
                                                    <td class="text-center">{{ $item->quantity }}</td>
                                                    <td class="text-right">{{ number_format($item->subtotal) }} đ</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3" class="text-right">Tổng cộng:</th>
                                                <th class="text-right">{{ number_format($order->total_amount) }} đ</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="{{ route('stone.products.index') }}" class="btn btn-primary">
                                    <i class="fa fa-shopping-bag"></i> Tiếp tục mua sắm
                                </a>
                            </div>

                            @if ($order->status == 'pending')
                                <div>
                                    <form action="{{ route('stone.orders.cancel', $order->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                            <i class="fa fa-times"></i> Hủy đơn hàng
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
