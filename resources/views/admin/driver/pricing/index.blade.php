@extends('admin.layouts.main')

@section('title', 'Quản lý bảng giá')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quản lý bảng giá dịch vụ</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%">Tên dịch vụ</th>
                                    <th width="15%">Giá theo giờ</th>
                                    <th width="15%">Giá theo chuyến</th>
                                    <th width="15%">Trạng thái</th>
                                    <th width="15%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($services as $index => $service)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($service->icon)
                                                <img src="{{ asset('storage/' . $service->icon) }}" 
                                                     alt="{{ $service->name }}" 
                                                     class="rounded me-2" 
                                                     width="40" height="40">
                                            @else
                                                <div class="bg-primary rounded d-flex align-items-center justify-content-center me-2" 
                                                     style="width: 40px; height: 40px;">
                                                    <i class="bi bi-gear text-white"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <strong>{{ $service->name }}</strong>
                                                @if($service->is_featured)
                                                    <span class="badge bg-warning ms-1">Nổi bật</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-success fw-bold">
                                            {{ number_format($service->price_per_hour) }}đ/giờ
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-success fw-bold">
                                            {{ number_format($service->price_per_trip) }}đ/chuyến
                                        </span>
                                    </td>
                                    <td>
                                        @if($service->status)
                                            <span class="badge bg-success">Hoạt động</span>
                                        @else
                                            <span class="badge bg-secondary">Tạm dừng</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.driver.pricing.edit', $service->id) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Sửa giá
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Không có dịch vụ nào</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
