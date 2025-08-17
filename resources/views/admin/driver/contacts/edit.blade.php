@extends('admin.index')

@section('page_title', 'Chỉnh sửa liên hệ')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.driver.contacts.index') }}">Danh sách liên hệ</a></li>
    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa liên hệ</li>
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
                        <h3 class="card-title">
                            <i class="bi bi-envelope-gear"></i> Chỉnh sửa liên hệ: {{ $contact['name'] ?? 'Không có tên' }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.driver.contacts.update', $contact['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    <i class="bi bi-person"></i> Tên <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                       id="name" name="name" 
                                                       placeholder="👤 Nhập tên..." 
                                                       value="{{ old('name', $contact['name'] ?? '') }}" required>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">
                                                    <i class="bi bi-envelope"></i> Email <span class="text-danger">*</span>
                                                </label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                       id="email" name="email" 
                                                       placeholder="📧 Nhập email..." 
                                                       value="{{ old('email', $contact['email'] ?? '') }}" required>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">
                                                    <i class="bi bi-telephone"></i> Số điện thoại
                                                </label>
                                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                                       id="phone" name="phone" 
                                                       placeholder="📞 Nhập số điện thoại..." 
                                                       value="{{ old('phone', $contact['phone'] ?? '') }}">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="subject" class="form-label">
                                                    <i class="bi bi-chat-text"></i> Tiêu đề
                                                </label>
                                                <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                                       id="subject" name="subject" 
                                                       placeholder="📝 Nhập tiêu đề..." 
                                                       value="{{ old('subject', $contact['subject'] ?? '') }}">
                                                @error('subject')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="message" class="form-label">
                                            <i class="bi bi-chat-dots"></i> Nội dung tin nhắn <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control @error('message') is-invalid @enderror" 
                                                  id="message" name="message" rows="6" 
                                                  placeholder="💬 Nhập nội dung tin nhắn..." required>{{ old('message', $contact['message'] ?? '') }}</textarea>
                                        @error('message')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="admin_notes" class="form-label">
                                            <i class="bi bi-sticky"></i> Ghi chú admin
                                        </label>
                                        <textarea class="form-control @error('admin_notes') is-invalid @enderror" 
                                                  id="admin_notes" name="admin_notes" rows="3" 
                                                  placeholder="📝 Nhập ghi chú...">{{ old('admin_notes', $contact['admin_notes'] ?? '') }}</textarea>
                                        @error('admin_notes')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">
                                                <i class="bi bi-gear"></i> Cài đặt
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">
                                                    <i class="bi bi-toggle-on"></i> Trạng thái
                                                </label>
                                                <select class="form-select @error('status') is-invalid @enderror" 
                                                        id="status" name="status">
                                                    <option value="unread" {{ old('status', $contact['status'] ?? '') == 'unread' ? 'selected' : '' }}>📧 Chưa đọc</option>
                                                    <option value="read" {{ old('status', $contact['status'] ?? '') == 'read' ? 'selected' : '' }}>✅ Đã đọc</option>
                                                    <option value="replied" {{ old('status', $contact['status'] ?? '') == 'replied' ? 'selected' : '' }}>💬 Đã trả lời</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="priority" class="form-label">
                                                    <i class="bi bi-flag"></i> Độ ưu tiên
                                                </label>
                                                <select class="form-select @error('priority') is-invalid @enderror" 
                                                        id="priority" name="priority">
                                                    <option value="low" {{ old('priority', $contact['priority'] ?? '') == 'low' ? 'selected' : '' }}>🟢 Thấp</option>
                                                    <option value="medium" {{ old('priority', $contact['priority'] ?? '') == 'medium' ? 'selected' : '' }}>🟡 Trung bình</option>
                                                    <option value="high" {{ old('priority', $contact['priority'] ?? '') == 'high' ? 'selected' : '' }}>🔴 Cao</option>
                                                </select>
                                                @error('priority')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="assigned_to" class="form-label">
                                                    <i class="bi bi-person-check"></i> Giao cho
                                                </label>
                                                <select class="form-select @error('assigned_to') is-invalid @enderror" 
                                                        id="assigned_to" name="assigned_to">
                                                    <option value="">👤 Chọn người xử lý</option>
                                                    @foreach($users ?? [] as $user)
                                                        <option value="{{ $user->id }}" 
                                                                {{ old('assigned_to', $contact['assigned_to'] ?? '') == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('assigned_to')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="contact_date" class="form-label">
                                                    <i class="bi bi-calendar"></i> Ngày liên hệ
                                                </label>
                                                <input type="datetime-local" class="form-control @error('contact_date') is-invalid @enderror" 
                                                       id="contact_date" name="contact_date" 
                                                       value="{{ old('contact_date', $contact['contact_date'] ?? '') }}">
                                                @error('contact_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.driver.contacts.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Quay lại
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i> Cập nhật liên hệ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection
