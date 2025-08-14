@extends('admin.layouts.main')

@section('title', 'Quản lý đơn hàng lái xe')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fas fa-receipt text-primary"></i>
                        Quản lý đơn hàng lái xe
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Đơn hàng lái xe</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="text-dark">
                            <i class="fas fa-list text-info"></i>
                            Danh sách đơn hàng
                        </h3>
                        <a href="{{ route('admin.driver.orders.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tạo đơn hàng mới
                        </a>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-filter text-primary"></i> Bộ lọc tìm kiếm
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.driver.orders.index') }}" id="filter-form">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-control form-control-sm" id="status" name="status">
                                        <option value="">Tất cả trạng thái</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Đang thực hiện</option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="service" class="form-label">Dịch vụ</label>
                                    <select class="form-control form-control-sm" id="service" name="service_id">
                                        <option value="">Tất cả dịch vụ</option>
                                        @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date_from" class="form-label">Từ ngày</label>
                                    <input type="date" class="form-control form-control-sm" id="date_from" name="date_from" value="{{ request('date_from') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date_to" class="form-label">Đến ngày</label>
                                    <input type="date" class="form-control form-control-sm" id="date_to" name="date_to" value="{{ request('date_to') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="search" class="form-label">Tìm kiếm</label>
                                    <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Tìm theo tên, SĐT, mã đơn hàng..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-sm me-2">
                                    <i class="fas fa-search"></i> Tìm kiếm
                                </button>
                                <a href="{{ route('admin.driver.orders.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-undo"></i> Làm mới
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-list text-info"></i>
                        Danh sách đơn hàng ({{ $orders->total() }})
                    </h3>
                    <div class="card-tools">
                        <span class="badge badge-info">{{ $orders->count() }}/{{ $orders->total() }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="120">Mã đơn hàng</th>
                                        <th width="180">Khách hàng</th>
                                        <th width="150">Dịch vụ</th>
                                        <th width="120">Thời gian đón</th>
                                        <th width="200">Địa điểm</th>
                                        <th width="120">Tổng tiền</th>
                                        <th width="120">Trạng thái</th>
                                        <th width="120">Ngày tạo</th>
                                        <th width="200">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <span class="badge badge-secondary font-weight-bold">{{ $order->order_number }}</span>
                                        </td>
                                        <td>
                                            <div class="customer-info">
                                                <div class="customer-name font-weight-bold text-primary">{{ $order->customer_name }}</div>
                                                <div class="customer-phone text-muted small">
                                                    <i class="fas fa-phone"></i> {{ $order->customer_phone }}
                                                </div>
                                                @if($order->customer_email)
                                                    <div class="customer-email text-muted small">
                                                        <i class="fas fa-envelope"></i> {{ $order->customer_email }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="service-info">
                                                <div class="service-name font-weight-bold">{{ $order->service->name }}</div>
                                                <div class="service-type text-muted small">
                                                    <i class="fas fa-tag"></i>
                                                    @switch($order->service_type)
                                                        @case('hourly')
                                                            Theo giờ
                                                            @break
                                                        @case('trip')
                                                            Theo chuyến
                                                            @break
                                                        @case('custom')
                                                            Tùy chỉnh
                                                            @break
                                                    @endswitch
                                                    @if($order->hours)
                                                        - {{ $order->hours }} giờ
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="datetime-info">
                                                <div class="date font-weight-bold">{{ $order->pickup_datetime->format('d/m/Y') }}</div>
                                                <div class="time text-muted small">
                                                    <i class="fas fa-clock"></i> {{ $order->pickup_datetime->format('H:i') }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="location-info">
                                                <div class="pickup font-weight-bold">
                                                    <i class="fas fa-map-marker-alt text-success"></i> {{ Str::limit($order->pickup_location, 30) }}
                                                </div>
                                                @if($order->destination)
                                                    <div class="destination text-muted small">
                                                        <i class="fas fa-flag-checkered text-info"></i> {{ Str::limit($order->destination, 30) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-success font-weight-bold">{{ number_format($order->total_amount) }}đ</span>
                                        </td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'pending' => 'warning',
                                                    'confirmed' => 'info',
                                                    'in_progress' => 'primary',
                                                    'completed' => 'success',
                                                    'cancelled' => 'danger'
                                                ];
                                                $statusLabels = [
                                                    'pending' => 'Chờ xác nhận',
                                                    'confirmed' => 'Đã xác nhận',
                                                    'in_progress' => 'Đang thực hiện',
                                                    'completed' => 'Hoàn thành',
                                                    'cancelled' => 'Đã hủy'
                                                ];
                                            @endphp
                                            <span class="badge badge-{{ $statusColors[$order->status] }} badge-lg">
                                                {{ $statusLabels[$order->status] }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="date-info">
                                                <div class="date font-weight-bold">{{ $order->created_at->format('d/m/Y') }}</div>
                                                <div class="time text-muted small">
                                                    <i class="fas fa-clock"></i> {{ $order->created_at->format('H:i') }}
                                                </div>
                                            </div>
                                        </td>
                                            <div class="btn-group-vertical btn-group-sm" role="group">
                                                <a href="{{ route('admin.driver.orders.show', $order->id) }}" class="btn btn-info btn-sm mb-1" title="Xem chi tiết">
                                                    <i class="fas fa-eye"></i> Xem
                                                </a>
                                                <a href="{{ route('admin.driver.orders.edit', $order->id) }}" class="btn btn-warning btn-sm mb-1" title="Chỉnh sửa">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>
                                                <button type="button" class="btn btn-success btn-sm mb-1" title="Cập nhật trạng thái" onclick="updateStatus({{ $order->id }}, '{{ $order->status }}')">
                                                    <i class="fas fa-sync-alt"></i> Trạng thái
                                                </button>
                                                <button type="button" class="btn btn-primary btn-sm mb-1" title="Thêm ghi chú" onclick="addNote({{ $order->id }})">
                                                    <i class="fas fa-comment"></i> Ghi chú
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($orders->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $orders->appends(request()->query())->links() }}
                        </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <div class="empty-state">
                                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">Chưa có đơn hàng nào</h4>
                                <p class="text-muted">Hãy tạo đơn hàng đầu tiên hoặc kiểm tra lại bộ lọc.</p>
                                <a href="{{ route('admin.driver.orders.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tạo đơn hàng mới
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add Note Modal -->
<div class="modal fade" id="addNoteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm ghi chú</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addNoteForm">
                <div class="modal-body">
                    <input type="hidden" id="noteOrderId" name="order_id">
                    <div class="form-group">
                        <label for="adminNotes">Ghi chú</label>
                        <textarea class="form-control" id="adminNotes" name="admin_notes" rows="4" placeholder="Nhập ghi chú cho đơn hàng này..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu ghi chú</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.page-header {
    background: #f8f9fa;
    padding: 2rem 0;
    margin-bottom: 2rem;
    border-radius: 10px;
}

.page-title {
    margin: 0;
    color: #333;
    font-weight: 600;
}

.breadcrumb {
    margin: 0;
    padding: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: ">";
}

.empty-state {
    text-align: center;
    padding: 2rem;
}

.empty-state i {
    color: #dee2e6;
}

.status-badge {
    font-size: 0.8rem;
    padding: 0.5rem 0.75rem;
}

.table th {
    background: #f8f9fa;
    border-top: none;
    font-weight: 600;
    color: #495057;
}

.table td {
    vertical-align: middle;
}

.dropdown-menu {
    min-width: 200px;
}

.dropdown-item {
    padding: 0.5rem 1rem;
}

.dropdown-item i {
    width: 20px;
    margin-right: 0.5rem;
}

.modal-header {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.modal-header .btn-close {
    filter: invert(1);
}
</style>
@endpush

@push('scripts')
<script>
function updateStatus(orderId, status) {
    const statusLabels = {
        'confirmed': 'xác nhận',
        'in_progress': 'bắt đầu thực hiện',
        'completed': 'hoàn thành',
        'cancelled': 'hủy'
    };
    
    if (confirm(`Bạn có chắc chắn muốn ${statusLabels[status]} đơn hàng này?`)) {
        fetch(`/admin/driver-orders/${orderId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Có lỗi xảy ra: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi cập nhật trạng thái');
        });
    }
}

function addNote(orderId) {
    document.getElementById('noteOrderId').value = orderId;
    document.getElementById('addNoteForm').reset();
    new bootstrap.Modal(document.getElementById('addNoteModal')).show();
}

document.getElementById('addNoteForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const orderId = document.getElementById('noteOrderId').value;
    
    fetch(`/admin/driver-orders/${orderId}/note`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('addNoteModal')).hide();
            location.reload();
        } else {
            alert('Có lỗi xảy ra: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra khi thêm ghi chú');
    });
});

// Auto-submit form when filters change
document.getElementById('status').addEventListener('change', function() {
    document.getElementById('filter-form').submit();
});

document.getElementById('service').addEventListener('change', function() {
    document.getElementById('filter-form').submit();
});
</script>
@endpush
