@extends('admin.index')

@section('page_title', 'Quản lý quy tắc giá')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.driver.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Quy tắc giá</li>
@endsection

@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Quản lý quy tắc giá cố định</h3>
                            <a href="{{ route('admin.driver.pricing-rules.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Thêm quy tắc mới
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($pricingRules->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="15%">Thời gian</th>
                                            <th width="15%">5km đầu</th>
                                            <th width="15%">6-10km</th>
                                            <th width="15%">>10km</th>
                                            <th width="15%">>30km</th>
                                            <th width="10%">Trạng thái</th>
                                            <th width="10%">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pricingRules as $index => $rule)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="{{ $rule->time_icon }}" style="color: {{ $rule->time_color }}; margin-right: 8px;"></i>
                                                    <span>{{ $rule->time_slot }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-success fw-bold">
                                                    {{ number_format($rule->base_price / 1000, 0) }}k
                                                </span>
                                                <small class="text-muted">/chuyến</small>
                                            </td>
                                            <td>
                                                <span class="text-info fw-bold">
                                                    +{{ number_format($rule->price_6_10km / 1000, 0) }}k
                                                </span>
                                                <small class="text-muted">/km</small>
                                            </td>
                                            <td>
                                                <span class="text-warning fw-bold">
                                                    +{{ number_format($rule->price_over_10km / 1000, 0) }}k
                                                </span>
                                                <small class="text-muted">/km</small>
                                            </td>
                                            <td>
                                                <span class="text-primary fw-bold">
                                                    {{ $rule->price_over_30km }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($rule->is_active)
                                                    <span class="badge bg-success">Hoạt động</span>
                                                @else
                                                    <span class="badge bg-secondary">Tạm dừng</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.driver.pricing-rules.edit', $rule->id) }}" 
                                                       class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.driver.pricing-rules.destroy', $rule->id) }}" 
                                                          method="POST" 
                                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa quy tắc này?')"
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
                        @else
                            <div class="empty-state text-center py-5">
                                <div class="empty-icon">
                                    <i class="fas fa-calculator"></i>
                                </div>
                                <h3>Chưa có quy tắc giá nào</h3>
                                <p>Vui lòng thêm các quy tắc giá để tạo bảng giá cố định.</p>
                                <a href="{{ route('admin.driver.pricing-rules.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Thêm quy tắc đầu tiên
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
