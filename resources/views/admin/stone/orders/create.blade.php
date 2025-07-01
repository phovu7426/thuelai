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
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form id="orderForm" action="{{ route('admin.stone.orders.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <!-- Thông tin khách hàng -->
                            <div class="col-md-5">
                                <h5 class="mb-3">Thông tin khách hàng</h5>
                                
                                <div class="form-group">
                                    <label>Tài khoản</label>
                                    <select class="form-control select2" name="user_id" id="user_id">
                                        <option value="">Chọn tài khoản</option>
                                        @foreach($users as $user)
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

                            <!-- Danh sách sản phẩm -->
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

<!-- Product Template -->
<template id="productTemplate">
    <div class="product-row mb-3 p-3 border rounded">
        <select class="form-control product-select" name="product[]">
            <option value="">Chọn sản phẩm</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>
</template>
@endsection

@section('scripts')
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
    console.log('Document ready');
    
    let productCount = 0;
    
    // Khởi tạo Select2
    $('.select2').select2();
    
    // Hàm thêm sản phẩm
    function addProduct() {
        console.log('Adding product');
        
        const productHtml = `
            <div class="product-row highlight" id="product-${productCount}">
                <div class="form-group">
                    <label>Sản phẩm <span class="text-danger">*</span></label>
                    <select class="form-control select2-product" name="products[${productCount}][product_id]" required>
                        <option value="">Chọn sản phẩm</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                {{ $product->name }} ({{ number_format($product->price) }}đ)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Số lượng <span class="text-danger">*</span></label>
                            <input type="number" class="form-control quantity-input" 
                                   name="products[${productCount}][quantity]" 
                                   value="1" min="1" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Thành tiền</label>
                            <input type="text" class="form-control subtotal" readonly>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-danger btn-sm btn-remove-product">
                    <i class="mdi mdi-trash-can"></i> Xóa
                </button>
            </div>
        `;
        
        // Thêm HTML vào container
        $('#productList').append(productHtml);
        
        // Khởi tạo Select2 cho select box mới
        $(`#product-${productCount} .select2-product`).select2();
        
        // Tăng biến đếm
        productCount++;
        
        // Cập nhật trạng thái nút xóa
        updateRemoveButtons();
        
        console.log('Product added, count:', productCount);
    }
    
    // Sự kiện click nút thêm sản phẩm
    $('#btnAddProduct').on('click', function() {
        console.log('Add product button clicked');
        addProduct();
    });
    
    // Sự kiện xóa sản phẩm
    $(document).on('click', '.btn-remove-product', function() {
        console.log('Remove button clicked');
        $(this).closest('.product-row').remove();
        updateTotal();
        updateRemoveButtons();
    });
    
    // Sự kiện thay đổi sản phẩm hoặc số lượng
    $(document).on('change', '.select2-product, .quantity-input', function() {
        console.log('Product or quantity changed');
        const $row = $(this).closest('.product-row');
        updateRowTotal($row);
    });
    
    // Cập nhật thành tiền cho một dòng
    function updateRowTotal($row) {
        const $select = $row.find('.select2-product');
        const $quantity = $row.find('.quantity-input');
        const $subtotal = $row.find('.subtotal');
        
        const price = $select.find(':selected').data('price') || 0;
        const amount = price * ($quantity.val() || 0);
        
        $subtotal.val(formatMoney(amount));
        updateTotal();
    }
    
    // Cập nhật tổng tiền
    function updateTotal() {
        let total = 0;
        $('.product-row').each(function() {
            const $select = $(this).find('.select2-product');
            const $quantity = $(this).find('.quantity-input');
            const price = $select.find(':selected').data('price') || 0;
            total += price * ($quantity.val() || 0);
        });
        
        $('#totalAmount').text(formatMoney(total));
    }
    
    // Cập nhật trạng thái nút xóa
    function updateRemoveButtons() {
        const $buttons = $('.btn-remove-product');
        $buttons.toggle($('.product-row').length > 1);
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
    addProduct();
});
</script>
@endsection 