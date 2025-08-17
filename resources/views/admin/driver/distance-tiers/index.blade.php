@extends('admin.index')

@section('page_title', 'Quản lý khoảng cách')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.driver.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Khoảng cách</li>
@endsection

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Quản lý khoảng cách</h3>
                            <a href="{{ route('admin.driver.distance-tiers.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Thêm khoảng cách mới
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($distanceTiers->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="20%">Tên khoảng cách</th>
                                            <th width="15%">Khoảng cách</th>
                                            <th width="15%">Text hiển thị</th>
                                            <th width="25%">Mô tả</th>
                                            <th width="10%">Trạng thái</th>
                                            <th width="10%">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($distanceTiers as $index => $tier)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $tier->name }}</strong>
                                            </td>
                                            <td>
                                                <span class="text-info">
                                                    {{ $tier->distance_range }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-primary">
                                                    {{ $tier->display_text }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ $tier->description ?: 'Không có mô tả' }}
                                            </td>
                                            <td>
                                                @if($tier->is_active)
                                                    <span class="badge bg-success">Hoạt động</span>
                                                @else
                                                    <span class="badge bg-secondary">Tạm dừng</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('admin.driver.distance-tiers.edit', $tier->id) }}" 
                                                       class="btn-action btn-edit" title="Chỉnh sửa">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.driver.distance-tiers.destroy', $tier->id) }}" 
                                                          method="POST" 
                                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa khoảng cách này?')"
                                                          style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-action btn-delete" title="Xóa">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state text-center py-5">
                                <div class="empty-icon">
                                    <i class="fas fa-route"></i>
                                </div>
                                <h3>Chưa có khoảng cách nào</h3>
                                <p>Vui lòng thêm các khoảng cách để sử dụng trong quy tắc giá.</p>
                                <a href="{{ route('admin.driver.distance-tiers.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Thêm khoảng cách đầu tiên
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



