@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sản phẩm đá</h3>
            <div class="card-tools">
                <a href="{{ route('admin.stone.products.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus"></i> Thêm mới
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="50">ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Chất liệu</th>
                            <th>Bề mặt</th>
                            <th>Hình ảnh</th>
                            <th>Giá</th>
                            <th>Trạng thái</th>
                            <th width="150">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products ?? [] as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>{{ $product->material->name ?? 'N/A' }}</td>
                            <td>{{ $product->surface->name ?? 'N/A' }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50">
                                @else
                                    <span class="text-muted">Không có hình</span>
                                @endif
                            </td>
                            <td>{{ number_format($product->price) }} VNĐ</td>
                            <td>
                                @if($product->status == 1)
                                    <span class="badge bg-success">Hiển thị</span>
                                @else
                                    <span class="badge bg-danger">Ẩn</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.stone.products.edit', $product->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.stone.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Không có dữ liệu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if(isset($products) && method_exists($products, 'links'))
            <div class="mt-4">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 