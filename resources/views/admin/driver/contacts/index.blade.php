@extends('admin.index')

@section('page_title', 'Quản lý liên hệ lái xe')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.driver.dashboard') }}">Dịch vụ lái xe</a></li>
    <li class="breadcrumb-item active" aria-current="page">Liên hệ lái xe</li>
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
                                <form action="{{ route('admin.driver.contacts.index') }}" method="GET" class="mb-0">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <input type="text" name="name" class="form-control" placeholder="🔍 Nhập tên khách hàng"
                                                   value="{{ request('name') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-search"></i> Lọc
                                            </button>
                                            <a href="{{ route('admin.driver.contacts.index') }}" class="btn btn-secondary">
                                                <i class="bi bi-arrow-clockwise"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-3 d-flex justify-content-end">
                                @can('access_users')
                                    <a href="{{ route('admin.driver.contacts.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle"></i> Thêm liên hệ mới
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if($contacts->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
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
                                        @foreach($contacts as $index => $contact)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $contact['name'] }}</strong>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $contact['email'] }}" class="text-decoration-none">
                                                    <i class="bi bi-envelope"></i> {{ $contact['email'] }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="tel:{{ $contact['phone'] }}" class="text-decoration-none">
                                                    <i class="bi bi-telephone"></i> {{ $contact['phone'] }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $contact['subject'] ?? 'Không có tiêu đề' }}
                                            </td>
                                            <td>
                                                <select class="form-select form-select-sm status-select" 
                                                        data-contact-id="{{ $contact['id'] }}" 
                                                        data-current-status="{{ $contact['status'] }}"
                                                        data-status-type="contacts">
                                                    <option value="unread" {{ $contact['status'] == 'unread' ? 'selected' : '' }}>
                                                        Chưa đọc
                                                    </option>
                                                    <option value="read" {{ $contact['status'] == 'read' ? 'selected' : '' }}>
                                                        Đã đọc
                                                    </option>
                                                    <option value="replied" {{ $contact['status'] == 'replied' ? 'selected' : '' }}>
                                                        Đã trả lời
                                                    </option>
                                                </select>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($contact['created_at'])->format('d/m/Y') }}</td>
                                            <td>
                                                @can('access_users')
                                                    <a href="{{ route('admin.driver.contacts.show', $contact['id']) }}" 
                                                       class="btn btn-sm btn-info" title="Xem chi tiết">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.driver.contacts.edit', $contact['id']) }}" 
                                                       class="btn btn-sm btn-warning" title="Chỉnh sửa">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.driver.contacts.destroy', $contact['id']) }}" 
                                                          method="POST" 
                                                          style="display:inline;"
                                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa liên hệ này?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
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
                            @if($contacts->hasPages())
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $contacts->links() }}
                                </div>
                            @endif
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-envelope-open display-1 text-muted"></i>
                                <h4 class="mt-3 text-muted">Chưa có liên hệ nào</h4>
                                <p class="text-muted">Hãy thêm liên hệ đầu tiên để bắt đầu!</p>
                                <a href="{{ route('admin.driver.contacts.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Thêm liên hệ mới
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
