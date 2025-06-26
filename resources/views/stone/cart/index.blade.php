@extends('stone.layouts.main')

@section('title', 'Giỏ hàng')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Giỏ hàng</h1>
            
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
            
            @if(Cart::isEmpty())
                <div class="text-center py-5">
                    <h3>Giỏ hàng của bạn đang trống</h3>
                    <p class="mt-3">Hãy thêm sản phẩm vào giỏ hàng để tiếp tục.</p>
                    <a href="{{ route('stone.products.index') }}" class="btn btn-primary mt-3">
                        <i class="fa fa-shopping-bag"></i> Mua sắm ngay
                    </a>
                </div>
            @else
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th style="width: 150px;">Số lượng</th>
                                        <th class="text-right">Thành tiền</th>
                                        <th class="text-center" style="width: 100px;">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if(isset($item->attributes['image']))
                                                        <img src="{{ asset($item->attributes['image']) }}" alt="{{ $item->name }}" class="img-thumbnail mr-3" style="width: 80px; height: 80px; object-fit: cover;">
                                                    @else
                                                        <img src="{{ asset('images/default/default_image.png') }}" alt="{{ $item->name }}" class="img-thumbnail mr-3" style="width: 80px; height: 80px; object-fit: cover;">
                                                    @endif
                                                    <div>
                                                        <h5 class="mb-1">{{ $item->name }}</h5>
                                                        <a href="{{ route('stone.products.show', $item->id) }}" class="text-primary">Xem chi tiết</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format($item->price) }} đ</td>
                                            <td>
                                                <form action="{{ route('stone.cart.update') }}" method="POST" class="d-flex">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <div class="input-group">
                                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control">
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-outline-secondary">
                                                                <i class="fa fa-refresh"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="text-right">{{ number_format($item->price * $item->quantity) }} đ</td>
                                            <td class="text-center">
                                                <form action="{{ route('stone.cart.remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Tổng cộng:</strong></td>
                                        <td class="text-right"><strong>{{ number_format($cartTotal) }} đ</strong></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            <form action="{{ route('stone.cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Bạn có chắc muốn xóa tất cả sản phẩm khỏi giỏ hàng?')">
                                    <i class="fa fa-trash"></i> Xóa giỏ hàng
                                </button>
                            </form>
                        </div>
                        <div>
                            <a href="{{ route('stone.products.index') }}" class="btn btn-outline-secondary mr-2">
                                <i class="fa fa-arrow-left"></i> Tiếp tục mua sắm
                            </a>
                            <a href="{{ route('stone.checkout.index') }}" class="btn btn-primary">
                                <i class="fa fa-check"></i> Thanh toán
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 