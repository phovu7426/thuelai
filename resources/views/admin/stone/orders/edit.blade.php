@extends('admin.layouts.main')

@section('title', 'Chỉnh sửa đơn hàng')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.stone.orders.index') }}">Quản lý đơn hàng</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa đơn hàng</li>
                    </ol>
                </div>
                <h4 class="page-title">Chỉnh sửa đơn hàng #{{ $order->order_number }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.stone.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Thông tin khách hàng</h5>
                                
                                <div class="form-group">
                                    <label for="customer_name">Họ tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name', $order->customer_name) }}" required>
                                    @error('customer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="customer_email">Email</label>
                                    <input type="email" class="form-control @error('customer_email') is-invalid @enderror" id="customer_email" name="customer_email" value="{{ old('customer_email', $order->customer_email) }}">
                                    @error('customer_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="customer_phone">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('customer_phone') is-invalid @enderror" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', $order->customer_phone) }}" required>
                                    @error('customer_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="customer_address">Địa chỉ <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('customer_address') is-invalid @enderror" id="customer_address" name="customer_address" rows="3" required>{{ old('customer_address', $order->customer_address) }}</textarea>
                                    @error('customer_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="note">Ghi chú</label>
                                    <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3">{{ old('note', $order->note) }}</textarea>
                                    @error('note')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="status">Trạng thái <span class="text-danger">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                                        <option value="approved" {{ old('status', $order->status) == 'approved' ? 'selected' : '' }}>Đã duyệt</option>
                                        <option value="completed" {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                        <option value="cancelled" {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="mb-3">Sản phẩm</h5>
                                
                                <div class="table-responsive">
                                    <table class="table table-centered table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                                <th class="text-right">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->items as $item)
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <strong>{{ $item->product_name }}</strong>
                                                            @if($item->product)
                                                                <p class="text-muted mb-0">Mã: {{ $item->product->code }}</p>
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
                                                <th colspan="3" class="text-right">Tổng cộng</th>
                                                <th class="text-right">{{ number_format($order->total_amount) }} đ</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                
                                <div class="alert alert-info mt-3">
                                    <i class="mdi mdi-information-outline mr-1"></i>
                                    Để thay đổi sản phẩm trong đơn hàng, vui lòng tạo đơn hàng mới.
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-right mt-4">
                            <a href="{{ route('admin.stone.orders.show', $order->id) }}" class="btn btn-secondary mr-2">Hủy</a>
                            <button type="submit" class="btn btn-primary">Cập nhật đơn hàng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 