@extends('stone.layouts.main')

@section('page_title', 'Đơn hàng của tôi')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0">Đơn hàng của tôi</h1>
                    <a href="{{ route('stone.products.index') }}" class="btn btn-primary">
                        <i class="fa fa-shopping-bag"></i> Tiếp tục mua sắm
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

                @if ($orders->count() > 0)
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
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('stone.orders.show', $order->id) }}"
                                                        class="text-primary font-weight-bold">
                                                        #{{ $order->order_number }}
                                                    </a>
                                                </td>
                                                <td>{{ $order->formatted_date }}</td>
                                                <td><strong>{{ number_format($order->total_amount) }} đ</strong></td>
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
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('stone.orders.show', $order->id) }}"
                                                            class="btn btn-info btn-sm" data-toggle="tooltip"
                                                            title="Xem chi tiết">
                                                            <i class="fa fa-eye"></i>
                                                        </a>

                                                        @if ($order->status == 'pending')
                                                            <form action="{{ route('stone.orders.cancel', $order->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    data-toggle="tooltip" title="Hủy đơn hàng"
                                                                    onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
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
                        <h4>Bạn chưa có đơn hàng nào</h4>
                        <p class="text-muted">Hãy khám phá các sản phẩm của chúng tôi và đặt hàng ngay!</p>
                        <a href="{{ route('stone.products.index') }}" class="btn btn-primary">
                            <i class="fa fa-shopping-bag"></i> Xem sản phẩm
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Enable tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
