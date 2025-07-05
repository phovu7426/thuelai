@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tạo đơn hàng mới</h3>
            <div class="card-tools">
                <a href="{{ route('admin.stone.orders.index') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
        <div class="card-body">
            <form id="orderForm" action="{{ route('admin.stone.orders.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="user_id">Tài khoản</label>
                            <select class="form-control select2 @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                                <option value="">Chọn tài khoản</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="customer_name">Họ tên <span class="text-danger">*</span></label>
                            <input type="text" name="customer_name" id="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') }}" required>
                            @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="customer_email">Email</label>
                            <input type="email" name="customer_email" id="customer_email" class="form-control @error('customer_email') is-invalid @enderror" value="{{ old('customer_email') }}">
                            @error('customer_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="customer_phone">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" name="customer_phone" id="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" value="{{ old('customer_phone') }}" required>
                            @error('customer_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="customer_address">Địa chỉ <span class="text-danger">*</span></label>
                            <textarea name="customer_address" id="customer_address" rows="3" class="form-control @error('customer_address') is-invalid @enderror" required>{{ old('customer_address') }}</textarea>
                            @error('customer_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="status">Trạng thái <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                @foreach(\App\Models\Order::getStatuses() as $key => $label)
                                    <option value="{{ $key }}" @if(old('status', \App\Models\Order::STATUS_PENDING) == $key) selected @endif>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="note">Ghi chú</label>
                            <textarea name="note" id="note" rows="3" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                            @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="mb-3">Danh sách sản phẩm</h5>
                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-primary" id="btnAddProduct">
                                <i class="bi bi-plus-circle"></i> Thêm sản phẩm
                            </button>
                        </div>
                        
                        <div id="productList" class="mb-3">
                            <!-- Products will be added here -->
                        </div>
                        
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Tổng tiền:</h5>
                                    <h5 class="mb-0" id="totalAmount">0đ</h5>
                                    <input type="hidden" name="total_amount" id="hiddenTotalAmount" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Tạo đơn hàng
                    </button>
                    <a href="{{ route('admin.stone.orders.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x"></i> Hủy
                    </a>
                </div>
            </form>
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

@section('scripts')
<script>
    $(document).ready(function() {
        let productCount = 0;

        // Khởi tạo Select2
        $('.select2').select2();

        // Khi nhấn "Thêm sản phẩm" mở modal
        $('#btnAddProduct').on('click', function() {
            // Reset checkbox và quantity
            $('.product-checkbox').prop('checked', false);
            $('.product-qty').val(1).prop('disabled', true);
            
            // Đánh dấu và cập nhật số lượng cho các sản phẩm đã chọn
            $('#productList .product-row').each(function() {
                var id = $(this).data('product-id');
                var qtyMatch = $(this).find('div').text().match(/SL: (\d+)/);
                var qty = qtyMatch ? parseInt(qtyMatch[1]) : 1;
                
                // Check checkbox và enable input số lượng
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
            // Xóa tất cả sản phẩm hiện tại
            $('#productList').empty();
            resetProductCount();
            
            // Thêm lại các sản phẩm đã chọn
            $('.product-checkbox:checked').each(function() {
                var id = $(this).data('id');
                var name = $(this).closest('tr').find('td:nth-child(2)').text();
                var priceText = $(this).closest('tr').find('td:nth-child(3)').text();
                // Ensure we correctly parse the price by removing đ and commas
                var price = Number(priceText.replace(/[^\d]/g, ''));
                var qty = $('.product-qty[data-id="' + id + '"]').val();

                var html = `
                    <div class="product-row" data-product-id="${id}">
                        <input type="hidden" name="products[${productCount}][id]" value="${id}">
                        <input type="hidden" name="products[${productCount}][quantity]" value="${qty}">
                        <input type="hidden" name="products[${productCount}][price]" value="${price}">
                        <div>
                            <strong>${name}</strong> - ${priceText} - SL: ${qty} - Thành tiền: ${number_format(price * qty)}đ
                        </div>
                        <button type="button" class="btn btn-sm btn-danger btn-remove-product">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                `;
                
                $('#productList').append(html);
                productCount++;
            });
            
            // Cập nhật tổng tiền
            updateTotalAmount();
            
            // Đóng modal
            $('#productModal').modal('hide');
        });
        
        // Xóa sản phẩm
        $(document).on('click', '.btn-remove-product', function() {
            $(this).closest('.product-row').remove();
            updateTotalAmount();
        });
        
        // Cập nhật tổng tiền
        function updateTotalAmount() {
            var total = 0;
            $('.product-row').each(function() {
                var priceText = $(this).find('div').text().match(/Thành tiền: ([\d,]+)đ/);
                if (priceText && priceText[1]) {
                    var price = Number(priceText[1].replace(/[^\d]/g, ''));
                    total += price;
                }
            });
            
            $('#totalAmount').text(number_format(total) + 'đ');
            $('#hiddenTotalAmount').val(total);
        }
        
        // Format số
        function number_format(number) {
            return new Intl.NumberFormat('vi-VN').format(number);
        }
    });
</script>
@endsection 
