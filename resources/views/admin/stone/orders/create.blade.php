@extends('admin.layouts.main')

@section('title', 'Tạo đơn hàng mới')

@section('css')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .select2-container {
            width: 100% !important;
        }

        .product-row {
            background: #f8f9fa;
            padding: 10px 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            border: 1px solid #e3e6f0;
            position: relative;
            transition: box-shadow 0.2s;
        }

        .product-row:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
            border-color: #007bff;
        }

        .btn-remove-product {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .table-products th,
        .table-products td {
            vertical-align: middle !important;
        }

        .table-products img {
            width: 32px !important;
            height: 32px !important;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #eee;
            display: block;
            margin: 0 auto;
        }

        .total-amount-box {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 8px;
            padding: 16px 24px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #856404;
            margin-top: 16px;
        }

        @media (max-width: 767px) {
            .total-amount-box {
                font-size: 1rem;
                padding: 10px 12px;
            }
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
            <div class="col-lg-5 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white"><b>Thông tin khách hàng</b></div>
                    <div class="card-body">
                        <form id="orderForm" action="{{ route('admin.stone.orders.store') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label">Họ tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="customer_name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="customer_email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="customer_phone" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Địa chỉ <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="customer_address" rows="2" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                                <select class="form-control" name="status">
                                    @foreach (\App\Models\Order::getStatuses() as $key => $label)
                                        <option value="{{ $key }}"
                                            @if ($key == \App\Models\Order::STATUS_PENDING) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ghi chú</label>
                                <textarea class="form-control" name="note" rows="2"></textarea>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <b>Danh sách sản phẩm</b>
                        <button type="button" class="btn btn-light btn-sm" id="btnAddProduct"><i class="mdi mdi-plus"></i>
                            Thêm sản phẩm</button>
                    </div>
                    <div class="card-body">
                        <div id="productList">
                            <!-- Products will be added here -->
                        </div>
                        <div class="total-amount-box d-flex justify-content-between align-items-center">
                            <span>Tổng tiền:</span>
                            <span id="totalAmount">0đ</span>
                            <input type="hidden" name="total_amount" id="hiddenTotalAmount" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-end">
                <a href="{{ route('admin.stone.orders.index') }}" class="btn btn-secondary me-2">Hủy</a>
                <button type="submit" class="btn btn-success btn-md px-5">Tạo đơn hàng</button>
            </div>
        </div>
        </form>
        <!-- Modal chọn nhiều sản phẩm -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="productModalLabel">Chọn sản phẩm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control mb-3" id="searchProductInput"
                            placeholder="Tìm kiếm sản phẩm...">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-products align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Chọn</th>
                                        <th>Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody id="productTableBody">
                                    @foreach ($products as $product)
                                        <tr>
                                            <td><input type="checkbox" class="product-checkbox"
                                                    data-id="{{ $product->id }}"></td>
                                            <td>
                                                @if ($product->main_image)
                                                    <img width="30" height="30"
                                                        src="{{ asset($product->main_image) }}"
                                                        alt="{{ $product->name }}">
                                                @else
                                                    <img width="30" height="30"
                                                        src="/images/default/default_image.png" alt="No image">
                                                @endif
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ number_format($product->price) }}đ</td>
                                            <td><input type="number" class="form-control product-qty"
                                                    data-id="{{ $product->id }}" value="1" min="1"
                                                    disabled></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary" id="saveProductBtn">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let productCount = 0;
            // Khởi tạo Select2
            $('.select2').select2();
            // Modal: filter sản phẩm
            $('#searchProductInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#productTableBody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            // Khi nhấn "Thêm sản phẩm" mở modal
            $('#btnAddProduct').on('click', function() {
                $('.product-checkbox').prop('checked', false);
                $('.product-qty').val(1).prop('disabled', true);
                $('#productList .product-row').each(function() {
                    var id = $(this).data('product-id');
                    var qty = $(this).find('input[name$="[quantity]"]').val();
                    var $checkbox = $('.product-checkbox[data-id="' + id + '"]');
                    var $qtyInput = $('.product-qty[data-id="' + id + '"]');
                    $checkbox.prop('checked', true);
                    $qtyInput.prop('disabled', false).val(qty);
                });
                $('#productModal').modal('show');
            });
            // Khi check vào sản phẩm thì enable input số lượng
            $(document).on('change', '.product-checkbox', function() {
                var id = $(this).data('id');
                $('.product-qty[data-id="' + id + '"]').prop('disabled', !this.checked);
            });
            // Reset productCount khi xóa tất cả
            function resetProductCount() {
                productCount = 0;
            }
            // Khi ấn "Lưu" trong modal
            $('#saveProductBtn').on('click', function() {
                $('#productList').empty();
                resetProductCount();
                $('.product-checkbox:checked').each(function() {
                    var id = $(this).data('id');
                    var row = $(this).closest('tr');
                    var name = row.find('td:nth-child(3)').text();
                    var priceText = row.find('td:nth-child(4)').text();
                    var price = Number(priceText.replace(/[^\d]/g, ''));
                    var qty = $('.product-qty[data-id="' + id + '"]').val();
                    var img = row.find('img').attr('src');
                    var html = `<div class="product-row d-flex align-items-center mb-2" data-product-id="${id}">
                    <img src="${img}" class="me-3" style="width:32px;height:32px;object-fit:cover;border-radius:4px;border:1px solid #eee;">
                    <div class="flex-grow-1">
                        <b>${name}</b> <span class="text-muted">(SL: ${qty})</span><br>
                        <span class="text-info">${Number(price).toLocaleString('vi-VN')}đ</span>
                        <input type="hidden" name="products[${productCount}][id]" value="${id}">
                        <input type="hidden" name="products[${productCount}][quantity]" value="${qty}">
                        <input type="hidden" name="products[${productCount}][price]" value="${price}">
                    </div>
                    <button type="button" class="btn btn-danger btn-sm btn-remove-product ms-2"><i class="mdi mdi-trash-can"></i> Xóa</button>
                </div>`;
                    productCount++;
                    $('#productList').append(html);
                });
                $('#productModal').modal('hide');
                updateTotal();
            });
            // Xóa sản phẩm khỏi danh sách và cập nhật lại index
            $(document).on('click', '.btn-remove-product', function() {
                $(this).closest('.product-row').remove();
                resetProductCount();
                $('.product-row').each(function() {
                    $(this).find('input[name^="products"]').each(function() {
                        var name = $(this).attr('name');
                        name = name.replace(/products\[\d+\]/, 'products[' + productCount +
                            ']');
                        $(this).attr('name', name);
                    });
                    productCount++;
                });
                updateTotal();
            });
            // Cập nhật tổng tiền
            function updateTotal() {
                var total = 0;
                $('#productList .product-row').each(function() {
                    var price = Number($(this).find('input[name$="[price]"]').val());
                    var qty = Number($(this).find('input[name$="[quantity]"]').val());
                    total += price * qty;
                });
                $('#totalAmount').text(total.toLocaleString('vi-VN') + 'đ');
                $('#hiddenTotalAmount').val(total);
            }
        });
    </script>
@endsection
