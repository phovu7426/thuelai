@extends('admin.layouts.main')

@section('title', 'Quản lý đánh giá khách hàng')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Quản lý đánh giá khách hàng</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.driver.dashboard') }}">Dịch vụ lái xe</a></li>
                    <li class="breadcrumb-item active">Đánh giá khách hàng</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.driver.testimonials.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Thêm đánh giá mới
                </a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Testimonials List -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Danh sách đánh giá</h5>
                </div>
                <div class="card-body">
                    @if($testimonials->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
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
                                    @foreach($testimonials as $testimonial)
                                    <tr>
                                        <td>{{ $testimonial->id }}</td>
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
                                            <div class="form-check form-switch">
                                                <input class="form-check-input toggle-status" 
                                                       type="checkbox" 
                                                       data-id="{{ $testimonial->id }}"
                                                       {{ $testimonial->status ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    {{ $testimonial->status ? 'Kích hoạt' : 'Vô hiệu' }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input toggle-featured" 
                                                       type="checkbox" 
                                                       data-id="{{ $testimonial->id }}"
                                                       {{ $testimonial->is_featured ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    {{ $testimonial->is_featured ? 'Nổi bật' : 'Bình thường' }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{ $testimonial->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.driver.testimonials.show', $testimonial->id) }}" 
                                                   class="btn btn-sm btn-info" title="Xem">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.driver.testimonials.edit', $testimonial->id) }}" 
                                                   class="btn btn-sm btn-warning" title="Sửa">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.driver.testimonials.destroy', $testimonial->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $testimonials->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-chat-quote text-muted" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-muted">Chưa có đánh giá nào</h5>
                            <p class="text-muted">Hãy thêm đánh giá đầu tiên để bắt đầu</p>
                            <a href="{{ route('admin.driver.testimonials.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus"></i> Thêm đánh giá mới
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /Testimonials List -->
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle trạng thái testimonial
    document.querySelectorAll('.toggle-status').forEach(function(toggle) {
        toggle.addEventListener('change', function() {
            const testimonialId = this.getAttribute('data-id');
            const isChecked = this.checked;
            
            fetch(`/admin/driver/testimonials/${testimonialId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật label
                    const label = this.nextElementSibling;
                    label.textContent = isChecked ? 'Kích hoạt' : 'Vô hiệu';
                    
                    // Hiển thị thông báo
                    alert(data.message);
                } else {
                    // Khôi phục trạng thái cũ
                    this.checked = !isChecked;
                    alert('Có lỗi xảy ra: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = !isChecked;
                alert('Có lỗi xảy ra khi cập nhật trạng thái');
            });
        });
    });

    // Toggle trạng thái featured
    document.querySelectorAll('.toggle-featured').forEach(function(toggle) {
        toggle.addEventListener('change', function() {
            const testimonialId = this.getAttribute('data-id');
            const isChecked = this.checked;
            
            fetch(`/admin/driver/testimonials/${testimonialId}/toggle-featured`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật label
                    const label = this.nextElementSibling;
                    label.textContent = isChecked ? 'Nổi bật' : 'Bình thường';
                    
                    // Hiển thị thông báo
                    alert(data.message);
                } else {
                    // Khôi phục trạng thái cũ
                    this.checked = !isChecked;
                    alert('Có lỗi xảy ra: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = !isChecked;
                alert('Có lỗi xảy ra khi cập nhật trạng thái nổi bật');
            });
        });
    });
});
</script>
@endsection
