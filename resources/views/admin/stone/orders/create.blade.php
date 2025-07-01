@extends('admin.layouts.main')

@section('page_title', 'Tạo đơn hàng mới')

@section('css')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .select2-container {
        width: 100% !important;
    }
    
    /* Fix for Select2 inside Bootstrap modal */
    .select2-dropdown {
        z-index: 1056 !important;
    }
    
    /* Ensure buttons are visible */
    .btn-primary, .btn-danger {
        cursor: pointer;
    }
    
    /* Make sure the add product button is clearly visible */
    #add-product-row {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
    }
    
    #add-product-row:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }
    
    /* Ẩn hàng mẫu */
    #product-template {
        display: none;
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
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                    <form action="{{ route('admin.stone.orders.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="total_amount" id="total_amount_input" value="0">

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Thông tin khách hàng</h5>

                                <div class="form-group">
                                    <label for="user_id">Liên kết với tài khoản</label>
                                    <select class="form-control select2" name="user_id" id="user_id">
                                        <option value="">Không liên kết tài khoản</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="customer_name">Họ tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                                    @error('customer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="customer_email">Email</label>
                                    <input type="email" class="form-control @error('customer_email') is-invalid @enderror" id="customer_email" name="customer_email" value="{{ old('customer_email') }}">
                                    @error('customer_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="customer_phone">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('customer_phone') is-invalid @enderror" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required>
                                    @error('customer_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="customer_address">Địa chỉ <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('customer_address') is-invalid @enderror" id="customer_address" name="customer_address" rows="3" required>{{ old('customer_address') }}</textarea>
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

                                <div class="form-group">
                                    <label for="status">Trạng thái <span class="text-danger">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                        <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                    <small class="form-text text-muted">
                                        <ul class="pl-3 mb-0">
                                            <li><strong>Chờ xử lý</strong>: Đơn hàng mới</li>
                                            <li><strong>Đang xử lý</strong>: Đã xác nhận và đang thực hiện</li>
                                            <li><strong>Hoàn thành</strong>: Đã giao hàng hoặc hoàn tất</li>
                                            <li><strong>Đã hủy</strong>: Đơn hàng đã bị hủy</li>
                                        </ul>
                                    </small>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5 class="mb-3">Sản phẩm</h5>

                                <div class="card">
                                    <div class="card-body">
                                        <div id="products-container">
                                            <!-- Sản phẩm 1 -->
                                            <div class="product-row mb-3">
                                                <div class="form-group">
                                                    <label>Sản phẩm <span class="text-danger">*</span></label>
                                                    <select class="form-control product-select" name="products[0][id]" required>
                                                        <option value="">Chọn sản phẩm</option>
                                                        @forelse($products as $product)
                                                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                                                {{ $product->name }} ({{ $product->code }}) - {{ number_format($product->price) }}đ
                                                            </option>
                                                        @empty
                                                            <option value="" disabled>Không có sản phẩm nào</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Số lượng <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control product-quantity" name="products[0][quantity]" min="1" value="1" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Thành tiền</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control product-subtotal" value="0" readonly>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">đ</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right mb-2">
                                                    <button type="button" class="btn btn-sm btn-danger remove-product-row" disabled>
                                                        <i class="mdi mdi-trash-can"></i> Xóa
                                                    </button>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="text-left">
                                            <button type="button" class="btn btn-primary" id="add-product-row">
                                                <i class="mdi mdi-plus"></i> Thêm sản phẩm
                                            </button>
                                        </div>

                                        <div class="d-flex justify-content-between mt-3">
                                            <h5>Tổng cộng:</h5>
                                            <h5 id="total-amount">0 đ</h5>
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
@endsection

@section('js')
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Biến đếm số lượng sản phẩm
        let productCount = 1;
        
        // Khởi tạo Select2 cho tất cả select box
        initializeSelect2();
        
        function initializeSelect2() {
            $('.product-select').select2({
                width: '100%'
            });
            
            $('#user_id, #status').select2({
                width: '100%'
            });
        }
        
        // Thêm sản phẩm mới
        $('#add-product-row').on('click', function() {
            console.log('Thêm sản phẩm mới');
            
            // Lấy HTML của hàng đầu tiên
            const firstRow = $('#products-container .product-row:first').clone();
            
            // Cập nhật index cho các input và select
            firstRow.find('select, input').each(function() {
                const name = $(this).attr('name');
                if (name) {
                    $(this).attr('name', name.replace(/\[\d+\]/, '[' + productCount + ']'));
                }
            });
            
            // Reset giá trị và xóa Select2
            const select = firstRow.find('.product-select');
            select.val('').removeAttr('data-select2-id');
            select.find('option').removeAttr('data-select2-id');
            firstRow.find('.select2-container').remove();
            
            // Copy lại tất cả options từ select box đầu tiên
            const originalSelect = $('#products-container .product-row:first .product-select');
            select.html(originalSelect.html());
            
            // Reset các giá trị khác
            firstRow.find('.product-quantity').val(1);
            firstRow.find('.product-subtotal').val(0);
            firstRow.find('.remove-product-row').prop('disabled', false);
            
            // Tăng biến đếm
            productCount++;
            
            // Thêm hàng mới vào container
            $('#products-container').append(firstRow);
            
            // Khởi tạo Select2 cho dropdown mới
            select.select2({
                width: '100%'
            });
            
            // Cập nhật trạng thái các nút xóa
            updateRemoveButtons();
        });
        
        // Xóa sản phẩm (sử dụng event delegation)
        $(document).on('click', '.remove-product-row', function() {
            const productRows = $('#products-container .product-row');
            if (productRows.length > 1) {
                $(this).closest('.product-row').remove();
                updateTotalAmount();
                updateRemoveButtons();
            }
        });
        
        // Cập nhật trạng thái các nút xóa
        function updateRemoveButtons() {
            const productRows = $('#products-container .product-row');
            if (productRows.length <= 1) {
                $('.remove-product-row').prop('disabled', true);
            } else {
                $('.remove-product-row').prop('disabled', false);
            }
        }
        
        // Cập nhật thành tiền cho một dòng sản phẩm
        function updateRowSubtotal(row) {
            const select = row.find('.product-select');
            const quantity = row.find('.product-quantity');
            const subtotal = row.find('.product-subtotal');
            
            const selectedOption = select.find('option:selected');
            const price = selectedOption.data('price') || 0;
            const qty = parseInt(quantity.val()) || 0;
            
            const total = price * qty;
            subtotal.val(formatCurrency(total).replace(' đ', ''));
            
            // Cập nhật tổng tiền đơn hàng
            updateTotalAmount();
        }
        
        // Cập nhật tổng tiền đơn hàng
        function updateTotalAmount() {
            let total = 0;
            
            $('#products-container .product-row').each(function() {
                const select = $(this).find('.product-select');
                const quantity = $(this).find('.product-quantity');
                
                if (select.val()) {
                    const selectedOption = select.find('option:selected');
                    const price = selectedOption.data('price') || 0;
                    const qty = parseInt(quantity.val()) || 0;
                    
                    total += price * qty;
                }
            });
            
            $('#total-amount').text(formatCurrency(total));
            $('#total_amount_input').val(total);
        }
        
        // Định dạng tiền tệ
        function formatCurrency(amount) {
            return new Intl.NumberFormat('vi-VN', { style: 'decimal' }).format(amount) + ' đ';
        }
        
        // Cập nhật thành tiền khi thay đổi sản phẩm hoặc số lượng
        $(document).on('change', '.product-select, .product-quantity', function() {
            const row = $(this).closest('.product-row');
            updateRowSubtotal(row);
        });
        
        // Auto-fill thông tin khách hàng khi chọn tài khoản
        $('#user_id').change(function() {
            const userId = $(this).val();
            if (userId) {
                $.ajax({
                    url: `/admin/users/${userId}/info`,
                    type: 'GET',
                    success: function(data) {
                        $('#customer_name').val(data.name || '');
                        $('#customer_email').val(data.email || '');
                        $('#customer_phone').val(data.profile?.phone || '');
                        $('#customer_address').val(data.profile?.address || '');
                    }
                });
            }
        });
        
        // Khởi tạo tính toán ban đầu
        $('#products-container .product-row').each(function() {
            updateRowSubtotal($(this));
        });
    });
</script>
@endsection 