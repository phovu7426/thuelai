@extends('admin.index')

@section('page_title', 'Quản lý giá theo khoảng cách')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.driver.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Giá theo khoảng cách</li>
@endsection

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Quản lý giá theo khoảng cách linh hoạt</h3>
                            <a href="{{ route('admin.driver.pricing-tiers.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Thêm mức giá mới
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($pricingTiers->count() > 0)
                            @foreach($pricingTiers as $timeSlot => $tiers)
                            <div class="pricing-time-slot mb-4">
                                <h4 class="mb-3">
                                    <i class="{{ $tiers->first()->time_icon }}" style="color: {{ $tiers->first()->time_color }};"></i>
                                    {{ $timeSlot }}
                                </h4>
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th width="20%">Khoảng cách</th>
                                                <th width="15%">Loại giá</th>
                                                <th width="20%">Giá</th>
                                                <th width="25%">Mô tả</th>
                                                <th width="10%">Trạng thái</th>
                                                <th width="10%">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tiers as $index => $tier)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <strong>{{ $tier->distance_description }}</strong>
                                                </td>
                                                <td>
                                                    @if($tier->price_type === 'fixed')
                                                        <span class="badge bg-primary">Giá cố định</span>
                                                    @else
                                                        <span class="badge bg-info">Giá theo km</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="text-success fw-bold">
                                                        {{ $tier->display_price }}
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
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.driver.pricing-tiers.edit', $tier->id) }}" 
                                                           class="btn btn-sm btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.driver.pricing-tiers.destroy', $tier->id) }}" 
                                                              method="POST" 
                                                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa mức giá này?')"
                                                              style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
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
                            </div>
                            @endforeach
                        @else
                            <div class="empty-state text-center py-5">
                                <div class="empty-icon">
                                    <i class="fas fa-graph-up"></i>
                                </div>
                                <h3>Chưa có mức giá nào</h3>
                                <p>Vui lòng thêm các mức giá theo khoảng cách để tạo bảng giá linh hoạt.</p>
                                <a href="{{ route('admin.driver.pricing-tiers.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Thêm mức giá đầu tiên
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

