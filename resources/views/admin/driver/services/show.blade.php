@extends('admin.layouts.main')

@section('title', 'Chi tiết dịch vụ lái xe')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Chi tiết dịch vụ lái xe</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.driver.dashboard') }}">Dịch vụ lái xe</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.driver.services.index') }}">Quản lý dịch vụ</a></li>
                    <li class="breadcrumb-item active">Chi tiết</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.driver.services.edit', $service->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Sửa dịch vụ
                </a>
                <a href="{{ route('admin.driver.services.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Service Details -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Thông tin dịch vụ</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>ID:</strong></td>
                                    <td>{{ $service->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tên dịch vụ:</strong></td>
                                    <td>{{ $service->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Slug:</strong></td>
                                    <td>{{ $service->slug }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Trạng thái:</strong></td>
                                    <td>
                                        <span class="badge bg-{{ $service->status ? 'success' : 'danger' }}">
                                            {{ $service->status ? 'Kích hoạt' : 'Vô hiệu' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Nổi bật:</strong></td>
                                    <td>
                                        <span class="badge bg-{{ $service->is_featured ? 'warning' : 'secondary' }}">
                                            {{ $service->is_featured ? 'Nổi bật' : 'Bình thường' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Thứ tự:</strong></td>
                                    <td>{{ $service->sort_order }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Giá theo giờ:</strong></td>
                                    <td>
                                        @if($service->price_per_hour)
                                            <span class="badge bg-info">{{ number_format($service->price_per_hour) }}đ/giờ</span>
                                        @else
                                            <span class="text-muted">Chưa cập nhật</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Giá theo chuyến:</strong></td>
                                    <td>
                                        @if($service->price_per_trip)
                                            <span class="badge bg-success">{{ number_format($service->price_per_trip) }}đ/chuyến</span>
                                        @else
                                            <span class="text-muted">Chưa cập nhật</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Ngày tạo:</strong></td>
                                    <td>{{ $service->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Cập nhật lần cuối:</strong></td>
                                    <td>{{ $service->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($service->short_description)
                    <div class="mt-4">
                        <h6><strong>Mô tả ngắn:</strong></h6>
                        <p class="text-muted">{{ $service->short_description }}</p>
                    </div>
                    @endif

                    @if($service->description)
                    <div class="mt-4">
                        <h6><strong>Mô tả chi tiết:</strong></h6>
                        <div class="text-muted">
                            {!! nl2br(e($service->description)) !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Service Images -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Hình ảnh dịch vụ</h5>
                </div>
                <div class="card-body">
                    @if($service->image)
                        <div class="mb-3">
                            <h6>Hình ảnh chính:</h6>
                            <img src="{{ asset('storage/' . $service->image) }}" 
                                 alt="{{ $service->name }}" 
                                 class="img-fluid rounded" 
                                 style="max-width: 100%; height: auto;">
                        </div>
                    @else
                        <div class="mb-3">
                            <h6>Hình ảnh chính:</h6>
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-center" 
                                 style="width: 100%; height: 200px;">
                                <i class="bi bi-image text-white" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                    @endif

                    @if($service->icon)
                        <div class="mb-3">
                            <h6>Icon dịch vụ:</h6>
                            <img src="{{ asset('storage/' . $service->icon) }}" 
                                 alt="{{ $service->name }} icon" 
                                 class="img-fluid rounded" 
                                 style="max-width: 100px; height: auto;">
                        </div>
                    @else
                        <div class="mb-3">
                            <h6>Icon dịch vụ:</h6>
                            <div class="bg-secondary rounded d-flex align-items-center justify-content-center" 
                                 style="width: 100px; height: 100px;">
                                <i class="bi bi-gear text-white" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Thao tác nhanh</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.driver.services.edit', $service->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Sửa dịch vụ
                        </a>
                        <form action="{{ route('admin.driver.services.destroy', $service->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa dịch vụ này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-trash"></i> Xóa dịch vụ
                            </button>
                        </form>
                        <a href="{{ route('admin.driver.services.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Service Details -->
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Service detail page loaded');
});
</script>
@endsection
