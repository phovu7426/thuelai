@extends('stone.layouts.main')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">Chi tiết đơn hàng #{{ $order->id }}</h1>
                <a href="{{ route('stone.orders.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left"></i> Quay lại danh sách
                </a>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Thông tin đơn hàng</h5>
                        <div>{!! $order->status_label !!}</div>
                    </div>
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
                            <p><strong>Ngày đặt:</strong> {{ $order->formatted_date }}</p>
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
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->product->image)
                                                    <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="img-thumbnail mr-3" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('images/default/default_image.png') }}" alt="{{ $item->product->name }}" class="img-thumbnail mr-3" style="width: 60px; height: 60px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $item->product->name }}</h6>
                                                    <a href="{{ route('stone.products.show', $item->product->id) }}" class="text-primary">Xem sản phẩm</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ number_format((float)$item->price) }} đ</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td class="text-right">{{ number_format((float)$item->subtotal) }} đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Tổng cộng:</th>
                                    <th class="text-right">{{ number_format((float)$order->total_amount) }} đ</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('stone.products.index') }}" class="btn btn-outline-primary">
                            <i class="fa fa-shopping-bag"></i> Tiếp tục mua sắm
                        </a>
                        
                        @if($order->status == 'pending')
                            <form action="{{ route('stone.orders.cancel', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                    <i class="fa fa-times"></i> Hủy đơn hàng
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 