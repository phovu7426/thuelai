@extends('admin.index')

@section('page_title', 'Quản lý đánh giá khách hàng')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.driver.dashboard') }}">Dịch vụ lái xe</a></li>
    <li class="breadcrumb-item active" aria-current="page">Đánh giá khách hàng</li>
@endsection

@section('content')
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-sm-9">
                                <!-- Form lọc -->
                                <form action="{{ route('admin.driver.testimonials.index') }}" method="GET" class="mb-0">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <input type="text" name="customer_name" class="form-control" placeholder="🔍 Nhập tên khách hàng"
                                                   value="{{ request('customer_name') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-search"></i> Lọc
                                            </button>
                                            <a href="{{ route('admin.driver.testimonials.index') }}" class="btn btn-secondary">
                                                <i class="bi bi-arrow-clockwise"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end">
                                @can('access_users')
                                    <a href="{{ route('admin.driver.testimonials.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle"></i> Thêm đánh giá mới
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if($testimonials->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Hình ảnh</th>
                                            <th>Khách hàng</th>
                                            <th>Đánh giá</th>
                                            <th>Nội dung</th>
                                            <th>Trạng thái</th>
                                            <th>Nổi bật</th>
                                            <th>Ngày tạo</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($testimonials as $index => $testimonial)
                                        <tr>
                                            <td>{{ $testimonials->firstItem() + $index }}</td>
                                            <td>
                                                @if($testimonial->image)
                                                    <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                                         alt="{{ $testimonial->customer_name }}" 
                                                         class="rounded-circle" 
                                                         width="40" height="40">
                                                @else
                                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" 
                                                         style="width: 40px; height: 40px;">
                                                        <i class="bi bi-person text-white"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $testimonial->customer_name }}</strong><br>
                                                <small class="text-muted">{{ $testimonial->customer_position ?? 'Khách hàng' }}</small>
                                            </td>
                                            <td>
                                                <div class="mb-1">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $testimonial->rating)
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        @else
                                                            <i class="bi bi-star text-muted"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <small class="text-muted">{{ $testimonial->rating }}/5 sao</small>
                                            </td>
                                            <td>{{ Str::limit($testimonial->content, 100) }}</td>
                                            <td>
                                                <select class="form-select form-select-sm status-select" 
                                                        data-testimonial-id="{{ $testimonial->id }}" 
                                                        data-current-status="{{ $testimonial->status ? '1' : '0' }}"
                                                        data-status-type="default">
                                                    <option value="0" {{ !$testimonial->status ? 'selected' : '' }}>
                                                        Vô hiệu
                                                    </option>
                                                    <option value="1" {{ $testimonial->status ? 'selected' : '' }}>
                                                        Kích hoạt
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select form-select-sm featured-select" 
                                                        data-testimonial-id="{{ $testimonial->id }}" 
                                                        data-current-featured="{{ $testimonial->featured ? '1' : '0' }}"
                                                        data-featured-type="testimonials">
                                                    <option value="0" {{ !$testimonial->featured ? 'selected' : '' }}>
                                                        Bình thường
                                                    </option>
                                                    <option value="1" {{ $testimonial->featured ? 'selected' : '' }}>
                                                        Nổi bật
                                                    </option>
                                                </select>
                                            </td>
                                            <td>{{ $testimonial->created_at ? $testimonial->created_at->format('d/m/Y') : 'N/A' }}</td>
                                            <td>
                                                @can('access_users')
                                                    <a href="{{ route('admin.driver.testimonials.show', $testimonial->id) }}"
                                                       class="btn btn-sm btn-info" title="Xem chi tiết">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.driver.testimonials.edit', $testimonial->id) }}"
                                                       class="btn btn-sm btn-warning" title="Chỉnh sửa">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.driver.testimonials.destroy', $testimonial->id) }}" method="POST"
                                                          style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Xóa" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Phân trang -->
                            @if($testimonials->hasPages())
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $testimonials->links() }}
                                </div>
                            @endif
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-chat-quote display-1 text-muted"></i>
                                <h4 class="mt-3 text-muted">Chưa có đánh giá nào</h4>
                                <p class="text-muted">Hãy thêm đánh giá đầu tiên để bắt đầu!</p>
                                <a href="{{ route('admin.driver.testimonials.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Thêm đánh giá mới
                                </a>
                            </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection

@section('scripts')
<!-- Sử dụng component chung admin-dropdowns.js -->
@endsection
