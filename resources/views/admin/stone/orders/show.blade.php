@extends('admin.layouts.main')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.stone.orders.index') }}">Quản lý đơn hàng</a></li>
                        <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
                    </ol>
                </div>
                <h4 class="page-title">Chi tiết đơn hàng #{{ $order->order_number }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5>Thông tin khách hàng</h5>
                                <address class="mb-0 font-14 address-lg">
                                    <strong>{{ $order->customer_name }}</strong><br>
                                    {{ $order->customer_address }}<br>
                                    <abbr title="Điện thoại">SĐT:</abbr> {{ $order->customer_phone }}<br>
                                    @if($order->customer_email)
                                        <abbr title="Email">Email:</abbr> {{ $order->customer_email }}
                                    @endif
                                </address>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5>Thông tin đơn hàng</h5>
                                <div class="font-14">
                                    <strong>Mã đơn hàng:</strong> {{ $order->order_number }}<br>
                                    <strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}<br>
                                    <strong>Trạng thái:</strong> 
                                    @if($order->status == 'pending')
                                        <span class="badge badge-warning">Chờ duyệt</span>
                                    @elseif($order->status == 'approved')
                                        <span class="badge badge-info">Đã duyệt</span>
                                    @elseif($order->status == 'completed')
                                        <span class="badge badge-success">Hoàn thành</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge badge-danger">Đã hủy</span>
                                    @endif
                                    <br>
                                    <strong>Nguồn:</strong> 
                                    @if($order->is_admin_created)
                                        <span class="badge badge-primary">Admin</span>
                                    @else
                                        <span class="badge badge-light">Khách hàng</span>
                                    @endif
                                    <br>
                                    <strong>Ghi chú:</strong> {{ $order->note ?? 'Không có' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-centered table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th class="text-right">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
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
                                            <th colspan="4" class="text-right">Tổng cộng</th>
                                            <th class="text-right">{{ number_format($order->total_amount) }} đ</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Cập nhật trạng thái</h5>
                            <form action="{{ route('admin.stone.orders.update-status', $order->id) }}" method="POST" class="form-inline">
                                @csrf
                                <div class="form-group mr-2">
                                    <select name="status" class="form-control">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                                        <option value="approved" {{ $order->status == 'approved' ? 'selected' : '' }}>Đã duyệt</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="btn-group">
                                <a href="{{ route('admin.stone.orders.edit', $order->id) }}" class="btn btn-secondary">
                                    <i class="mdi mdi-square-edit-outline"></i> Sửa
                                </a>
                                <form action="{{ route('admin.stone.orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ml-1">
                                        <i class="mdi mdi-delete"></i> Xóa
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 