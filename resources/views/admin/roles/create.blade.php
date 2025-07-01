@extends('admin.index')

@section('page_title', 'Thêm vai trò')
@section('page_title', 'Thêm vai trò')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Thêm vai trò</li>
@endsection

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Thông tin vai trò</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.roles.store') }}" method="POST">
                            @csrf

                            {{-- Tên hiển thị --}}
                            <div class="mb-3">
                                <label for="title" class="form-label">Tên hiển thị</label>
                                <input type="text" id="title" name="title"
                                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                    required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tên hệ thống --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên hệ thống</label>
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Quyền --}}
                            <div class="mb-3">
                                <label class="form-label">Danh sách quyền</label>
                                <select class="form-control select2 @error('permissions') is-invalid @enderror"
                                    name="permissions[]" multiple data-field="name"
                                    data-url="{{ route('admin.permissions.autocomplete') }}">
                                    <option value="">Chọn quyền</option>
                                </select>
                                @error('permissions')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Nút hành động --}}
                            <button type="submit" class="btn btn-primary">Thêm vai trò</button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
