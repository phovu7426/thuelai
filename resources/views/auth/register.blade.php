<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cơ sở sản xuất đá ốp lát DN - Đá tự nhiên cao cấp</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1500&q=80') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(40, 40, 40, 0.55);
            z-index: 1;
        }

        .register-container {
            position: relative;
            z-index: 2;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            padding: 36px 32px 28px 32px;
            width: 100%;
            max-width: 410px;
            margin: 0 auto;
        }

        .register-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 18px;
        }

        .register-logo img {
            width: 50%;
            height: 45px;
            object-fit: contain;
            /* Không bo tròn, không nền, không viền, không bóng đổ */
        }

        .register-container h2 {
            margin-bottom: 18px;
            font-size: 22px;
            color: #2d2d2d;
            text-align: center;
            font-weight: 600;
        }

        .register-container .form-group label {
            font-weight: 600;
            color: #444;
        }

        .register-container .form-control {
            border-radius: 8px;
            border: 1px solid #d1d5db;
        }

        .register-container .btn-primary {
            background: linear-gradient(90deg, #5a5a5a 0%, #bca177 100%);
            border: none;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            padding: 10px;
            margin-top: 10px;
            box-shadow: 0 2px 8px rgba(188, 161, 119, 0.12);
            transition: background 0.3s;
        }

        .register-container .btn-primary:hover {
            background: linear-gradient(90deg, #bca177 0%, #5a5a5a 100%);
        }

        .register-container .send-otp {
            margin-bottom: 15px;
            display: block;
            color: #bca177;
            cursor: pointer;
            font-weight: 500;
        }

        .register-container .send-otp:hover {
            text-decoration: underline;
            color: #5a5a5a;
        }

        .error-message {
            color: #e63946;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="overlay"></div>
    <div class="register-container">
        <div class="register-logo">
            <img src="{{ asset('images/default/logov2.png') }}" alt="StoneShop Logo">
        </div>
        <h2>Đăng ký tài khoản</h2>
        <form id="register_form">
            @csrf
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"
                        style="color:#bca177;margin-right:7px;"></i>Email:</label>
                <input type="email" name="email" id="email" class="form-control" required
                    placeholder="Nhập email của bạn">
                <small class="error-message" id="email-error"></small>
            </div>
            <a id="send_otp" class="send-otp">Gửi mã OTP xác thực</a>
            <div class="form-group">
                <label for="otp"><i class="fas fa-key" style="color:#bca177;margin-right:7px;"></i>Mã OTP:</label>
                <input type="text" name="otp" id="otp" class="form-control" required
                    placeholder="Nhập mã OTP vừa nhận">
            </div>
            <div class="form-group">
                <label for="name"><i class="fas fa-user" style="color:#bca177;margin-right:7px;"></i>Họ và
                    tên:</label>
                <input type="text" name="name" id="name" class="form-control" required
                    placeholder="Nhập họ tên của bạn">
                <small class="error-message" id="name-error"></small>
            </div>
            <div class="form-group">
                <label for="password"><i class="fas fa-lock" style="color:#bca177;margin-right:7px;"></i>Mật
                    khẩu:</label>
                <input type="password" name="password" id="password" class="form-control" required
                    placeholder="Tạo mật khẩu (6-16 ký tự)">
                <small class="error-message" id="password-error"></small>
            </div>
            <div class="form-group">
                <label for="password_confirmation"><i class="fas fa-lock"
                        style="color:#bca177;margin-right:7px;"></i>Xác nhận mật khẩu:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    required placeholder="Nhập lại mật khẩu">
                <small class="error-message" id="password_confirmation-error"></small>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Đăng ký ngay</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#send_otp').on('click', function(event) {
                event.preventDefault();
                const email = $('#email').val();
                if (!email) {
                    toastr.error('Vui lòng nhập email trước khi gửi OTP.');
                    return;
                }
                var $btn = $(this);
                $btn.html('<i class="fas fa-spinner fa-spin"></i> Đang gửi...');
                $btn.addClass('disabled').css('pointer-events', 'none');
                $.ajax({
                    url: '{{ route('send.register') }}',
                    method: 'POST',
                    data: {
                        email: email,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success === true) {
                            toastr.success(response.message ||
                                'OTP đã được gửi đến email của bạn.');
                        } else {
                            toastr.error(response.message || 'Gửi OTP thất bại.');
                        }
                    },
                    error: function(xhr) {
                        let message = xhr.responseJSON.message || 'Gửi OTP thất bại';
                        toastr.error(message);
                    },
                    complete: function() {
                        $btn.html('Gửi mã OTP xác thực');
                        $btn.removeClass('disabled').css('pointer-events', '');
                    }
                });
            });
            $('#register_form').on('submit', function(event) {
                event.preventDefault();
                $('.error-message').text('');
                let isValid = true;
                let name = $('#name').val().trim();
                let email = $('#email').val().trim();
                let password = $('#password').val();
                let passwordConfirmation = $('#password_confirmation').val();
                if (name === '') {
                    $('#name-error').text('Tên không được để trống');
                    isValid = false;
                }
                if (email === '') {
                    $('#email-error').text('Email không được để trống');
                    isValid = false;
                }
                if (password.length < 6 || password.length > 16) {
                    $('#password-error').text('Mật khẩu phải từ 6-16 ký tự');
                    isValid = false;
                }
                if (password !== passwordConfirmation) {
                    $('#password_confirmation-error').text('Mật khẩu xác nhận không khớp');
                    isValid = false;
                }
                if (!isValid) return;
                $.ajax({
                    url: '{{ route('register') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success === true) {
                            toastr.success(response.message || 'Đăng ký thành công!');
                            setTimeout(function() {
                                window.location.href = "{{ url('/') }}";
                            }, 3000);
                        } else {
                            toastr.error(response.message || 'Đăng ký thất bại!');
                        }
                    },
                    error: function(xhr) {
                        let message = xhr.responseJSON.message || 'Đăng ký thất bại!';
                        toastr.error(message);
                    }
                });
            });
        });
    </script>
</body>

</html>
