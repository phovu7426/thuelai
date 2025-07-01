@extends('stone.layouts.main')

@section('page_title', 'Giới thiệu - Thanh Tùng Stone')

@section('content')
    <!-- Hero Section -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="mb-4">Giới thiệu về Thanh Tùng Stone</h1>
                    <p class="lead">Chuyên cung cấp và thi công đá tự nhiên cao cấp với chất lượng tốt nhất, mẫu mã đa dạng
                        và giá cả cạnh tranh.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('images/default/default_image.png') }}" alt="Về chúng tôi"
                        class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6">
                    <h2 class="mb-4">Về chúng tôi</h2>
                    <p>Thanh Tùng Stone là đơn vị hàng đầu trong lĩnh vực cung cấp và thi công đá tự nhiên cao cấp tại Việt
                        Nam. Với hơn 10 năm kinh nghiệm, chúng tôi tự hào mang đến cho khách hàng những sản phẩm đá tự nhiên
                        chất lượng cao, mẫu mã đa dạng với giá cả cạnh tranh nhất thị trường.</p>
                    <p>Đá tự nhiên từ Thanh Tùng Stone được nhập khẩu từ các mỏ đá nổi tiếng trên thế giới như Ý, Tây Ban
                        Nha, Brazil, Ấn Độ... với các loại đá marble, granite, travertine, onyx... đáp ứng mọi nhu cầu thiết
                        kế và trang trí.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="fas fa-medal text-primary fa-3x"></i>
                            </div>
                            <h4 class="mb-3">Chất lượng hàng đầu</h4>
                            <p>Chúng tôi cam kết cung cấp các sản phẩm đá tự nhiên với chất lượng tốt nhất, được tuyển chọn
                                kỹ lưỡng từ các mỏ đá nổi tiếng trên thế giới.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="fas fa-tools text-primary fa-3x"></i>
                            </div>
                            <h4 class="mb-3">Thi công chuyên nghiệp</h4>
                            <p>Đội ngũ thợ lành nghề với nhiều năm kinh nghiệm, đảm bảo thi công đúng kỹ thuật, chính xác và
                                thẩm mỹ cao, đáp ứng mọi yêu cầu khắt khe nhất.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="fas fa-headset text-primary fa-3x"></i>
                            </div>
                            <h4 class="mb-3">Dịch vụ tận tâm</h4>
                            <p>Chúng tôi luôn đặt sự hài lòng của khách hàng lên hàng đầu, cam kết tư vấn tận tình, báo giá
                                minh bạch và hỗ trợ khách hàng trong suốt quá trình sử dụng.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Strengths -->
    <section class="section bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Điểm mạnh của chúng tôi</h2>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="me-4">
                            <i class="fas fa-cubes text-primary fa-2x"></i>
                        </div>
                        <div>
                            <h4>Đa dạng sản phẩm</h4>
                            <p>Thanh Tùng Stone cung cấp đầy đủ các loại đá tự nhiên cao cấp với hàng nghìn mẫu mã, màu sắc
                                và hoa văn khác nhau, đáp ứng mọi nhu cầu thiết kế và trang trí.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="me-4">
                            <i class="fas fa-shipping-fast text-primary fa-2x"></i>
                        </div>
                        <div>
                            <h4>Giao hàng nhanh chóng</h4>
                            <p>Chúng tôi có kho hàng rộng lớn với nhiều mẫu mã sẵn có, đảm bảo giao hàng đúng tiến độ, đáp
                                ứng nhu cầu cấp bách của khách hàng.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="me-4">
                            <i class="fas fa-dollar-sign text-primary fa-2x"></i>
                        </div>
                        <div>
                            <h4>Giá cả cạnh tranh</h4>
                            <p>Là đơn vị nhập khẩu trực tiếp, chúng tôi cam kết mang đến cho khách hàng sản phẩm chất lượng
                                với mức giá tốt nhất thị trường.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="me-4">
                            <i class="fas fa-award text-primary fa-2x"></i>
                        </div>
                        <div>
                            <h4>Bảo hành dài hạn</h4>
                            <p>Tất cả sản phẩm của Thanh Tùng Stone đều được bảo hành dài hạn, mang đến sự an tâm tuyệt đối
                                cho khách hàng.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Process -->
    <section class="section">
        <div class="container">
            <h2 class="text-center mb-5">Quy trình làm việc</h2>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="text-center">
                        <div class="position-relative mb-4">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                style="width: 80px; height: 80px;">
                                <i class="fas fa-comments text-white fa-2x"></i>
                            </div>
                            <div class="position-absolute top-50 end-0 translate-middle-y d-none d-md-block"
                                style="right: -40px;">
                                <i class="fas fa-arrow-right text-primary fa-2x"></i>
                            </div>
                        </div>
                        <h4>Tư vấn</h4>
                        <p>Chuyên viên tư vấn sản phẩm phù hợp với nhu cầu và không gian của khách hàng</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="text-center">
                        <div class="position-relative mb-4">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                style="width: 80px; height: 80px;">
                                <i class="fas fa-ruler-combined text-white fa-2x"></i>
                            </div>
                            <div class="position-absolute top-50 end-0 translate-middle-y d-none d-md-block"
                                style="right: -40px;">
                                <i class="fas fa-arrow-right text-primary fa-2x"></i>
                            </div>
                        </div>
                        <h4>Khảo sát</h4>
                        <p>Tiến hành khảo sát, đo đạc chính xác và lên phương án thi công chi tiết</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="text-center">
                        <div class="position-relative mb-4">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                style="width: 80px; height: 80px;">
                                <i class="fas fa-hammer text-white fa-2x"></i>
                            </div>
                            <div class="position-absolute top-50 end-0 translate-middle-y d-none d-md-block"
                                style="right: -40px;">
                                <i class="fas fa-arrow-right text-primary fa-2x"></i>
                            </div>
                        </div>
                        <h4>Thi công</h4>
                        <p>Đội ngũ thợ lành nghề tiến hành thi công theo đúng tiêu chuẩn kỹ thuật</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="text-center">
                        <div class="position-relative mb-4">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                style="width: 80px; height: 80px;">
                                <i class="fas fa-check-circle text-white fa-2x"></i>
                            </div>
                        </div>
                        <h4>Nghiệm thu</h4>
                        <p>Nghiệm thu công trình và bàn giao cho khách hàng với sự hài lòng tuyệt đối</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Bạn muốn tìm hiểu thêm?</h2>
                    <p class="lead mb-4">Hãy liên hệ ngay với chúng tôi để được tư vấn chi tiết và báo giá tốt nhất.</p>
                    <a href="{{ route('stone.contact') }}" class="btn btn-primary btn-lg">Liên hệ ngay</a>
                </div>
            </div>
        </div>
    </section>
@endsection
