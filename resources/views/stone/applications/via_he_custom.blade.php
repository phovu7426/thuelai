@extends('stone.layouts.main')

@section('title', 'Ứng dụng Via hè')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Ứng dụng Via hè</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <img src="{{ asset('images/default/default_image.png') }}" class="img-fluid mb-4" alt="Via hè">
                    
                    <div class="content">
                        <p>Đá via hè là loại đá được sử dụng để lát vỉa hè, lối đi trong công viên, khu đô thị, khu nghỉ dưỡng...</p>
                        <p>Đá via hè thường được làm từ đá granite, đá bazan hoặc đá xanh. Đá via hè có nhiều kích thước và màu sắc khác nhau.</p>
                        <p>Đá via hè có những ưu điểm sau:</p>
                        <ul>
                            <li>Độ bền cao, chịu được tác động của thời tiết và môi trường</li>
                            <li>Khả năng chịu lực tốt, không bị biến dạng khi có tải trọng lớn</li>
                            <li>Không bị trơn trượt, an toàn cho người đi bộ</li>
                            <li>Dễ dàng lắp đặt và bảo trì</li>
                            <li>Tính thẩm mỹ cao, tạo nên không gian sang trọng, hiện đại</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Thông tin</h5>
                </div>
                <div class="card-body">
                    <p><strong>Loại:</strong> Ứng dụng ngoại thất</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 