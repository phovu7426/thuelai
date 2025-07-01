@extends('admin.layouts.main')

@section('title', 'Tạo đơn hàng mới')

@section('css')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .select2-container {
            width: 100% !important;
        }

        .product-row {
            background: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            position: relative;
        }

        .product-row.highlight {
            border: 2px solid #dc3545;
        }

        .btn-remove-product {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.stone.orders.index') }}">Đơn hàng</a></li>
                            <li class="breadcrumb-item active">Tạo mới</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Tạo đơn hàng mới</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="orderForm" action="{{ route('admin.stone.orders.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Cột thông tin khách hàng -->
                                <div class="col-md-5">
                                    <h5 class="mb-3">Thông tin khách hàng</h5>
                                    <div class="form-group">
                                        <label>Tài khoản</label>
                                        <select class="form-control select2" name="user_id" id="user_id">
                                            <option value="">Chọn tài khoản</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Họ tên <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="customer_name" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="customer_email">
                                    </div>

                                    <div class="form-group">
                                        <label>Số điện thoại <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="customer_phone" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Địa chỉ <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="customer_address" rows="3" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Ghi chú</label>
                                        <textarea class="form-control" name="note" rows="3"></textarea>
                                    </div>
                                </div>

                                <!-- Cột danh sách sản phẩm -->
                                <div class="col-md-7">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="mb-0">Danh sách sản phẩm</h5>
                                        <button type="button" class="btn btn-primary" id="btnAddProduct">
                                            <i class="mdi mdi-plus"></i> Thêm sản phẩm
                                        </button>
                                    </div>

                                    <div id="productList">
                                        <!-- Products will be added here -->
                                    </div>

                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">Tổng tiền:</h5>
                                                <h5 class="mb-0" id="totalAmount">0đ</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-3">
                                <a href="{{ route('admin.stone.orders.index') }}" class="btn btn-secondary mr-2">Hủy</a>
                                <button type="submit" class="btn btn-primary">Tạo đơn hàng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chọn nhiều sản phẩm -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Chọn sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Chọn</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="product-checkbox" data-id="{{ $product->id }}">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ number_format($product->price) }}đ</td>
                                    <td>
                                        <input type="number" class="form-control product-qty"
                                            data-id="{{ $product->id }}" value="1" min="1" disabled>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="saveProductBtn">Lưu</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            console.log('Document ready');

            let productCount = 0;

            // Khởi tạo Select2
            $('.select2').select2();

            // Khi nhấn "Thêm sản phẩm" mở modal
            $('#btnAddProduct').on('click', function() {
                $('.product-checkbox').prop('checked', false);
                $('.product-qty').val(1).prop('disabled', true);
                $('#productModal').modal('show');
            });

            // Khi check vào sản phẩm thì enable input số lượng
            $(document).on('change', '.product-checkbox', function() {
                var id = $(this).data('id');
                $('.product-qty[data-id="' + id + '"]').prop('disabled', !this.checked);
            });

            // Khi ấn "Lưu" trong modal
            $('#saveProductBtn').on('click', function() {
                $('.product-checkbox:checked').each(function() {
                    var id = $(this).data('id');
                    var name = $(this).closest('tr').find('td:nth-child(2)').text();
                    var price = $(this).closest('tr').find('td:nth-child(3)').text().replace('đ',
                        '').replace(/,/g, '');
                    var qty = $('.product-qty[data-id="' + id + '"]').val();

                    // Kiểm tra đã có trong danh sách ngoài chưa, nếu chưa thì mới thêm
                    if ($('#productList').find('.product-row[data-product-id="' + id + '"]')
                        .length === 0) {
                        var html = `
                    <div class="product-row" data-product-id="${id}">
                        <input type="hidden" name="products[][product_id]" value="${id}">
                        <input type="hidden" name="products[][quantity]" value="${qty}">
                        <div><b>${name}</b> - SL: ${qty} - Đơn giá: ${Number(price).toLocaleString()}đ</div>
                        <button type="button" class="btn btn-danger btn-sm btn-remove-product">Xóa</button>
                    </div>
                `;
                        $('#productList').append(html);
                    }
                });
                $('#productModal').modal('hide');
                updateTotal();
            });

            // Xóa sản phẩm khỏi danh sách
            $(document).on('click', '.btn-remove-product', function() {
                $(this).closest('.product-row').remove();
                updateTotal();
            });

            // Hàm tính tổng tiền
            function updateTotal() {
                let total = 0;
                $('#productList .product-row').each(function() {
                    var priceText = $(this).find('div').text().match(/Đơn giá: ([\d,]+)/);
                    var qtyText = $(this).find('div').text().match(/SL: (\d+)/);
                    var price = priceText ? parseInt(priceText[1].replace(/,/g, '')) : 0;
                    var qty = qtyText ? parseInt(qtyText[1]) : 0;
                    total += price * qty;
                });
                $('#totalAmount').text(formatMoney(total));
            }

            // Định dạng tiền tệ
            function formatMoney(amount) {
                return new Intl.NumberFormat('vi-VN').format(amount) + 'đ';
            }

            // Xử lý khi chọn user
            $('#user_id').change(function() {
                const userId = $(this).val();
                if (userId) {
                    $.get(`/admin/users/${userId}/info`, function(data) {
                        $('[name="customer_name"]').val(data.name || '');
                        $('[name="customer_email"]').val(data.email || '');
                        $('[name="customer_phone"]').val(data.profile?.phone || '');
                        $('[name="customer_address"]').val(data.profile?.address || '');
                    });
                }
            });

            // Thêm sản phẩm đầu tiên
            console.log('Adding first product');
            $('#btnAddProduct').click();
        });
    </script>
@endsection
