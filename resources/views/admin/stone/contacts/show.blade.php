@extends('admin.layouts.main')

@section('title', 'Chi tiết liên hệ')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.stone.contacts.index') }}">Quản lý liên hệ</a></li>
                        <li class="breadcrumb-item active">Chi tiết liên hệ</li>
                    </ol>
                </div>
                <h4 class="page-title">Chi tiết liên hệ</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="header-title">Thông tin liên hệ #{{ $contact->id }}</h4>
                        <div>
                            <a href="{{ route('admin.stone.contacts.index') }}" class="btn btn-secondary me-2">
                                <i class="mdi mdi-arrow-left"></i> Quay lại
                            </a>
                            <button type="button" class="btn btn-danger delete-contact">
                                <i class="mdi mdi-delete"></i> Xóa
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Họ tên:</label>
                                <p class="form-control-static">{{ $contact->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <p class="form-control-static">{{ $contact->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại:</label>
                                <p class="form-control-static">{{ $contact->phone ?? 'Không có' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Ngày gửi:</label>
                                <p class="form-control-static">{{ $contact->created_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tiêu đề:</label>
                                <p class="form-control-static">{{ $contact->subject ?? 'Không có tiêu đề' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Trạng thái:</label>
                                <p class="form-control-static">
                                    @if($contact->is_read)
                                        <span class="badge bg-success">Đã đọc</span>
                                    @else
                                        <span class="badge bg-warning">Chưa đọc</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Nội dung:</label>
                                <div class="border rounded p-3 bg-light">
                                    {!! nl2br(e($contact->message)) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-3">
                        <div class="col-12">
                            <h5>Phản hồi qua email</h5>
                            <div class="d-grid gap-2 d-md-flex mt-3">
                                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject ?? 'Phản hồi liên hệ' }}" class="btn btn-primary">
                                    <i class="mdi mdi-email"></i> Gửi email phản hồi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-warning h1 text-danger"></i>
                    <h4 class="mt-2">Xác nhận xóa</h4>
                    <p class="mt-3">Bạn có chắc chắn muốn xóa liên hệ này không? Hành động này không thể hoàn tác.</p>
                    <form action="{{ route('admin.stone.contacts.destroy', $contact->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Xử lý nút xóa
        $('.delete-contact').click(function() {
            $('#delete-modal').modal('show');
        });
    });
</script>
@endsection 