@extends('stone.layouts.main')

@section('title', 'Đơn hàng của tôi')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Đơn hàng của tôi</h1>
            
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
            
            @if($orders->count() > 0)
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th class="text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->formatted_date }}</td>
                                            <td>{{ number_format((float)$order->total_amount) }} đ</td>
                                            <td>{!! $order->status_label !!}</td>
                                            <td class="text-center">
                                                <a href="{{ route('stone.orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i> Chi tiết
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-center mt-4">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <h3>Bạn chưa có đơn hàng nào</h3>
                    <p class="mt-3">Hãy mua sắm và đặt hàng để xem lịch sử đơn hàng của bạn tại đây.</p>
                    <a href="{{ route('stone.products.index') }}" class="btn btn-primary mt-3">
                        <i class="fa fa-shopping-bag"></i> Mua sắm ngay
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 