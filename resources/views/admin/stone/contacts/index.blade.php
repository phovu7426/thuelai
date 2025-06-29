@extends('admin.layouts.main')

@section('title', 'Quản lý liên hệ')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Quản lý liên hệ</li>
                    </ol>
                </div>
                <h4 class="page-title">Quản lý liên hệ</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h4 class="header-title">
                                Danh sách liên hệ
                                @if($unreadCount > 0)
                                    <span class="badge bg-danger">{{ $unreadCount }} chưa đọc</span>
                                @endif
                            </h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="button" id="mark-read-btn" class="btn btn-success me-2" disabled>
                                <i class="mdi mdi-check-all"></i> Đánh dấu đã đọc
                            </button>
                            <button type="button" id="delete-selected-btn" class="btn btn-danger" disabled>
                                <i class="mdi mdi-delete"></i> Xóa đã chọn
                            </button>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-centered table-striped dt-responsive nowrap w-100" id="contacts-datatable">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="select-all">
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th>Họ tên</th>
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
                                    <tr class="{{ $contact->is_read ? '' : 'table-warning' }}">
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input contact-checkbox" value="{{ $contact->id }}">
                                            </div>
                                        </td>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone ?? 'N/A' }}</td>
                                        <td>{{ $contact->subject ?? 'Không có tiêu đề' }}</td>
                                        <td>
                                            @if($contact->is_read)
                                                <span class="badge bg-success">Đã đọc</span>
                                            @else
                                                <span class="badge bg-warning">Chưa đọc</span>
                                            @endif
                                        </td>
                                        <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('admin.stone.contacts.show', $contact->id) }}" class="action-icon">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="action-icon delete-contact" data-id="{{ $contact->id }}">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $contacts->links() }}
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
                    <form id="delete-form" action="" method="POST">
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
        // Xử lý checkbox select all
        $('#select-all').change(function() {
            $('.contact-checkbox').prop('checked', $(this).prop('checked'));
            updateButtonState();
        });

        // Cập nhật trạng thái nút khi checkbox thay đổi
        $(document).on('change', '.contact-checkbox', function() {
            updateButtonState();
        });

        // Cập nhật trạng thái nút
        function updateButtonState() {
            const checkedCount = $('.contact-checkbox:checked').length;
            $('#mark-read-btn, #delete-selected-btn').prop('disabled', checkedCount === 0);
        }

        // Xử lý nút đánh dấu đã đọc
        $('#mark-read-btn').click(function() {
            const selectedIds = $('.contact-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length > 0) {
                $.ajax({
                    url: "{{ route('admin.stone.contacts.mark-as-read') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        ids: selectedIds
                    },
                    success: function(response) {
                        if (response.success) {
                            // Cập nhật UI
                            $('.contact-checkbox:checked').each(function() {
                                $(this).closest('tr').removeClass('table-warning');
                                $(this).closest('tr').find('.badge').removeClass('bg-warning').addClass('bg-success').text('Đã đọc');
                            });
                            
                            // Cập nhật số lượng chưa đọc
                            const unreadCount = parseInt("{{ $unreadCount }}") - selectedIds.length;
                            if (unreadCount > 0) {
                                $('.badge.bg-danger').text(unreadCount + ' chưa đọc');
                            } else {
                                $('.badge.bg-danger').remove();
                            }
                            
                            // Hiển thị thông báo
                            toastr.success('Đã đánh dấu ' + selectedIds.length + ' liên hệ là đã đọc');
                        }
                    }
                });
            }
        });

        // Xử lý nút xóa đã chọn
        $('#delete-selected-btn').click(function() {
            const selectedIds = $('.contact-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length > 0) {
                if (confirm('Bạn có chắc chắn muốn xóa ' + selectedIds.length + ' liên hệ đã chọn?')) {
                    $.ajax({
                        url: "{{ route('admin.stone.contacts.bulk-delete') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            ids: selectedIds
                        },
                        success: function(response) {
                            if (response.success) {
                                // Xóa các hàng đã chọn
                                $('.contact-checkbox:checked').each(function() {
                                    $(this).closest('tr').remove();
                                });
                                
                                // Hiển thị thông báo
                                toastr.success('Đã xóa ' + selectedIds.length + ' liên hệ');
                                
                                // Cập nhật trạng thái nút
                                updateButtonState();
                            }
                        }
                    });
                }
            }
        });

        // Xử lý nút xóa đơn lẻ
        $('.delete-contact').click(function() {
            const contactId = $(this).data('id');
            $('#delete-form').attr('action', '/admin/stone/contacts/' + contactId);
            $('#delete-modal').modal('show');
        });
    });
</script>
@endsection 