@extends('stone.layouts.main')

@section('page_title', 'Thanh toán')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Thanh toán</h1>

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

                @if (!Cart::isEmpty())
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Thông tin thanh toán</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('stone.checkout.process') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label for="customer_name">Họ tên <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('customer_name') is-invalid @enderror"
                                                id="customer_name" name="customer_name"
                                                value="{{ old('customer_name', auth()->user()->name ?? '') }}" required>
                                            @error('customer_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="customer_email">Email</label>
                                            <input type="email"
                                                class="form-control @error('customer_email') is-invalid @enderror"
                                                id="customer_email" name="customer_email"
                                                value="{{ old('customer_email', auth()->user()->email ?? '') }}">
                                            @error('customer_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="customer_phone">Số điện thoại <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('customer_phone') is-invalid @enderror"
                                                id="customer_phone" name="customer_phone"
                                                value="{{ old('customer_phone') }}" required>
                                            @error('customer_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="customer_address">Địa chỉ <span class="text-danger">*</span></label>
                                            <textarea class="form-control @error('customer_address') is-invalid @enderror" id="customer_address"
                                                name="customer_address" rows="3" required>{{ old('customer_address') }}</textarea>
                                            @error('customer_address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="note">Ghi chú</label>
                                            <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3">{{ old('note') }}</textarea>
                                            @error('note')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="alert alert-info">
                                            <i class="fa fa-info-circle"></i> Phương thức thanh toán: Thanh toán khi nhận
                                            hàng.
                                        </div>

                                        <div class="d-flex justify-content-between mt-4">
                                            <a href="{{ route('stone.cart.index') }}" class="btn btn-outline-secondary">
                                                <i class="fa fa-arrow-left"></i> Quay lại giỏ hàng
                                            </a>

                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-check"></i> Đặt hàng
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Đơn hàng của bạn</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th class="text-right">Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (Cart::getContent() as $item)
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <strong>{{ $item->name }}</strong>
                                                                <br>
                                                                <small class="text-muted">{{ number_format($item->price) }}
                                                                    đ x {{ $item->quantity }}</small>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            {{ number_format($item->price * $item->quantity) }} đ</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Tổng cộng</th>
                                                    <th class="text-right">{{ number_format($cartTotal) }} đ</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <h3>Giỏ hàng của bạn đang trống</h3>
                        <p class="mt-3">Hãy thêm sản phẩm vào giỏ hàng để tiếp tục.</p>
                        <a href="{{ route('stone.products.index') }}" class="btn btn-primary mt-3">
                            <i class="fa fa-shopping-bag"></i> Mua sắm ngay
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
