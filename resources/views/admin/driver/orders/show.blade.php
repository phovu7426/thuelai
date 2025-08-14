@extends('admin.layouts.main')

@section('title', 'Chi tiết đơn hàng lái xe')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Chi tiết đơn hàng lái xe</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.driver.orders.index') }}">Đơn hàng lái xe</a></li>
                    <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.driver.orders.edit', $driverOrder->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Chỉnh sửa
                </a>
                <a href="{{ route('admin.driver.orders.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Order Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle"></i>
                        Thông tin đơn hàng
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="info-label">Mã đơn hàng:</span>
                                <span class="info-value">{{ $driverOrder->order_number }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Dịch vụ:</span>
                                <span class="info-value">{{ $driverOrder->service->name }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Loại dịch vụ:</span>
                                <span class="info-value">
                                    @switch($driverOrder->service_type)
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
                                    @if($driverOrder->hours)
                                        - {{ $driverOrder->hours }} giờ
                                    @endif
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Thời gian đón:</span>
                                <span class="info-value">{{ $driverOrder->pickup_datetime->format('H:i - d/m/Y') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="info-label">Địa điểm đón:</span>
                                <span class="info-value">{{ $driverOrder->pickup_location }}</span>
                            </div>
                            @if($driverOrder->destination)
                            <div class="info-item">
                                <span class="info-label">Điểm đến:</span>
                                <span class="info-value">{{ $driverOrder->destination }}</span>
                            </div>
                            @endif
                            <div class="info-item">
                                <span class="info-label">Tổng tiền:</span>
                                <span class="info-value total-amount">{{ number_format($driverOrder->total_amount) }}đ</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Ngày đặt:</span>
                                <span class="info-value">{{ $driverOrder->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user"></i>
                        Thông tin khách hàng
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="info-label">Họ và tên:</span>
                                <span class="info-value">{{ $driverOrder->customer_name }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Số điện thoại:</span>
                                <span class="info-value">{{ $driverOrder->customer_phone }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if($driverOrder->customer_email)
                            <div class="info-item">
                                <span class="info-label">Email:</span>
                                <span class="info-value">{{ $driverOrder->customer_email }}</span>
                            </div>
                            @endif
                            @if($driverOrder->user)
                            <div class="info-item">
                                <span class="info-label">Tài khoản:</span>
                                <span class="info-value">{{ $driverOrder->user->name }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Special Requirements -->
            @if($driverOrder->special_requirements)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clipboard-list"></i>
                        Yêu cầu đặc biệt
                    </h5>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $driverOrder->special_requirements }}</p>
                </div>
            </div>
            @endif

            <!-- Admin Notes -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-comment"></i>
                        Ghi chú admin
                    </h5>
                </div>
                <div class="card-body">
                    @if($driverOrder->admin_notes)
                        <p class="mb-0">{{ $driverOrder->admin_notes }}</p>
                    @else
                        <p class="text-muted mb-0">Chưa có ghi chú nào.</p>
                    @endif
                    <button type="button" class="btn btn-info btn-sm mt-2" onclick="addNote({{ $driverOrder->id }})">
                        <i class="fas fa-plus"></i> Thêm ghi chú
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Order Status -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-tasks"></i>
                        Trạng thái đơn hàng
                    </h5>
                </div>
                <div class="card-body">
                    <div class="current-status mb-3">
                        <span class="status-label">Trạng thái hiện tại:</span>
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
                        <span class="badge bg-{{ $statusColors[$driverOrder->status] }} fs-6">
                            {{ $statusLabels[$driverOrder->status] }}
                        </span>
                    </div>

                    <div class="status-actions">
                        @if($driverOrder->status === 'pending')
                        <button type="button" class="btn btn-success btn-sm w-100 mb-2" onclick="updateStatus({{ $driverOrder->id }}, 'confirmed')">
                            <i class="fas fa-check"></i> Xác nhận đơn hàng
                        </button>
                        @endif
                        
                        @if($driverOrder->status === 'confirmed')
                        <button type="button" class="btn btn-primary btn-sm w-100 mb-2" onclick="updateStatus({{ $driverOrder->id }}, 'in_progress')">
                            <i class="fas fa-play"></i> Bắt đầu thực hiện
                        </button>
                        @endif
                        
                        @if($driverOrder->status === 'in_progress')
                        <button type="button" class="btn btn-success btn-sm w-100 mb-2" onclick="updateStatus({{ $driverOrder->id }}, 'completed')">
                            <i class="fas fa-flag-checkered"></i> Hoàn thành
                        </button>
                        @endif
                        
                        @if(in_array($driverOrder->status, ['pending', 'confirmed']))
                        <button type="button" class="btn btn-danger btn-sm w-100" onclick="updateStatus({{ $driverOrder->id }}, 'cancelled')">
                            <i class="fas fa-times"></i> Hủy đơn hàng
                        </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock"></i>
                        Lịch sử đơn hàng
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Đơn hàng được tạo</h6>
                                <p class="timeline-text">{{ $driverOrder->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        
                        @if($driverOrder->status !== 'pending')
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info">
                                <i class="fas fa-check-double"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Đơn hàng được xác nhận</h6>
                                <p class="timeline-text">{{ $driverOrder->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($driverOrder->status === 'in_progress')
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary">
                                <i class="fas fa-car"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Đang thực hiện</h6>
                                <p class="timeline-text">Lái xe đang trên đường đến địa điểm đón</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($driverOrder->status === 'completed')
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success">
                                <i class="fas fa-flag-checkered"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Hoàn thành</h6>
                                <p class="timeline-text">Dịch vụ đã hoàn thành thành công</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($driverOrder->status === 'cancelled')
                        <div class="timeline-item">
                            <div class="timeline-marker bg-danger">
                                <i class="fas fa-ban"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Đã hủy</h6>
                                <p class="timeline-text">Đơn hàng đã bị hủy</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                        <textarea class="form-control" id="adminNotes" name="admin_notes" rows="4" placeholder="Nhập ghi chú cho đơn hàng này...">{{ $driverOrder->admin_notes }}</textarea>
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

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f1f3f4;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 600;
    color: #495057;
    min-width: 120px;
}

.info-value {
    color: #333;
    text-align: right;
    flex: 1;
}

.total-amount {
    font-weight: 700;
    color: #28a745;
    font-size: 1.1rem;
}

.status-actions .btn {
    margin-bottom: 0.5rem;
}

.timeline {
    position: relative;
    padding-left: 2rem;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 1rem;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 2rem;
}

.timeline-marker {
    position: absolute;
    left: -1.5rem;
    top: 0.25rem;
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.8rem;
}

.timeline-content {
    margin-left: 1rem;
}

.timeline-title {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.25rem;
}

.timeline-text {
    color: #6c757d;
    margin-bottom: 0;
    font-size: 0.9rem;
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
</script>
@endpush
