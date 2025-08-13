@extends('admin.layouts.main')

@section('title', 'Quản lý liên hệ lái xe')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Quản lý liên hệ lái xe</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.driver.dashboard') }}">Dịch vụ lái xe</a></li>
                    <li class="breadcrumb-item active">Liên hệ lái xe</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.driver.contacts.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Thêm liên hệ mới
                </a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Contacts List -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Danh sách liên hệ</h5>
                </div>
                <div class="card-body">
                    @if($contacts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Tiêu đề</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày gửi</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact['id'] ?? $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $contact['name'] }}</strong>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a>
                                        </td>
                                        <td>
                                            <a href="tel:{{ $contact['phone'] }}">{{ $contact['phone'] }}</a>
                                        </td>
                                        <td>
                                            {{ $contact['subject'] ?? 'Không có tiêu đề' }}
                                        </td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'unread' => 'danger',
                                                    'read' => 'success',
                                                    'replied' => 'info'
                                                ];
                                                $statusLabels = [
                                                    'unread' => 'Chưa đọc',
                                                    'read' => 'Đã đọc',
                                                    'replied' => 'Đã trả lời'
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $statusColors[$contact['status']] ?? 'secondary' }}">
                                                {{ $statusLabels[$contact['status']] ?? ucfirst($contact['status']) }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($contact['created_at'])->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.driver.contacts.show', $contact['id']) }}" 
                                                   class="btn btn-sm btn-info" title="Xem">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.driver.contacts.edit', $contact['id']) }}" 
                                                   class="btn btn-sm btn-warning" title="Sửa">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.driver.contacts.destroy', $contact['id']) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa liên hệ này?')">
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
                            {{ $contacts->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-envelope text-muted" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-muted">Chưa có liên hệ nào</h5>
                            <p class="text-muted">Hãy thêm liên hệ đầu tiên để bắt đầu</p>
                            <a href="{{ route('admin.driver.contacts.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus"></i> Thêm liên hệ mới
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /Contacts List -->
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Contacts index page loaded');
});
</script>
@endsection
