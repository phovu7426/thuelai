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
                        <h3 class="card-title">
                            <i class="bi bi-shield-plus"></i> Thêm mới vai trò
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.roles.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">
                                            <i class="bi bi-tag"></i> Tên vai trò
                                        </label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="🏷️ Nhập tên vai trò..." value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">
                                            <i class="bi bi-info-circle"></i> Mô tả
                                        </label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="ℹ️ Nhập mô tả..." value="{{ old('title') }}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Hủy
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i> Thêm mới
                                        </button>
                                    </div>
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
