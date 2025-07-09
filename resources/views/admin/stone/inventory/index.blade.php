@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Quản lý kho hàng</h3>
        </div>
        <div class="card-body">
            <!-- Filter Form -->
            <form action="{{ route('admin.stone.inventory.index') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="code">Mã sản phẩm</label>
                            <input type="text" name="code" id="code" class="form-control" value="{{ request('code') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="quantity_from">Số lượng từ</label>
                            <input type="number" name="quantity_from" id="quantity_from" class="form-control" value="{{ request('quantity_from') }}" min="0">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="quantity_to">Số lượng đến</label>
                            <input type="number" name="quantity_to" id="quantity_to" class="form-control" value="{{ request('quantity_to') }}" min="0">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Tất cả</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Ẩn</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.stone.inventory.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-counterclockwise"></i> Đặt lại
                        </a>
                    </div>
                </div>
            </form>

            <!-- Products Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Mã SP</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Chất liệu</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->material->name }}</td>
                            <td>
                                <span class="badge {{ $product->quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $product->quantity }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $product->status ? 'bg-success' : 'bg-danger' }}">
                                    {{ $product->status ? 'Hiển thị' : 'Ẩn' }}
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#updateQuantityModal{{ $product->id }}">
                                    <i class="bi bi-pencil"></i> Cập nhật số lượng
                                </button>
                            </td>
                        </tr>

                        <!-- Update Quantity Modal -->
                        <div class="modal fade" id="updateQuantityModal{{ $product->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.stone.inventory.update-quantity', $product->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Cập nhật số lượng - {{ $product->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label for="quantity{{ $product->id }}">Số lượng mới</label>
                                                <input type="number" 
                                                    name="quantity" 
                                                    id="quantity{{ $product->id }}" 
                                                    class="form-control" 
                                                    value="{{ $product->quantity }}" 
                                                    min="0" 
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="note{{ $product->id }}">Ghi chú</label>
                                                <textarea name="note" 
                                                    id="note{{ $product->id }}" 
                                                    class="form-control" 
                                                    rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="bi bi-x"></i> Đóng
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-check"></i> Cập nhật
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 