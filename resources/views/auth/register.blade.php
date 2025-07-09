<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng ký thành viên - StoneShop</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0ecec 0%, #b8d8d8 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }

        .register-container {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            padding: 32px 28px 24px 28px;
            width: 100%;
            max-width: 420px;
            position: relative;
        }

        .register-container h2 {
            margin-bottom: 8px;
            font-size: 26px;
            color: #1a535c;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-container h2 i {
            color: #4ecdc4;
            margin-right: 10px;
        }

        .register-container .slogan {
            font-size: 15px;
            color: #888;
            text-align: center;
            margin-bottom: 18px;
        }

        .register-container .form-group label {
            font-weight: 500;
            color: #1a535c;
        }

        .register-container .form-control {
            border-radius: 8px;
            border: 1px solid #b8d8d8;
        }

        .register-container .btn {
            background: linear-gradient(90deg, #4ecdc4 0%, #1a535c 100%);
            border: none;
            color: #fff;
            font-size: 17px;
            font-weight: bold;
            border-radius: 8px;
            padding: 12px;
            transition: background 0.3s;
        }

        .register-container .btn:hover {
            background: linear-gradient(90deg, #1a535c 0%, #4ecdc4 100%);
        }

        .register-container .send-otp {
            margin-bottom: 15px;
            display: block;
            color: #4ecdc4;
            cursor: pointer;
            font-weight: 500;
        }

        .register-container .send-otp:hover {
            text-decoration: underline;
            color: #1a535c;
        }

        .error-message {
            color: #e63946;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h2 class="text-center"><i class="fas fa-gem"></i> Đăng ký thành viên</h2>
        <div class="slogan">Khám phá thế giới đá quý - Đăng ký để nhận ưu đãi hấp dẫn từ StoneShop!</div>
        <form id="register_form">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required
                    placeholder="Nhập email của bạn">
                <small class="error-message" id="email-error"></small>
            </div>
            <a id="send_otp" class="send-otp">Gửi mã OTP xác thực</a>
            <div class="form-group">
                <label for="otp">Mã OTP:</label>
                <input type="text" name="otp" id="otp" class="form-control" required
                    placeholder="Nhập mã OTP vừa nhận">
            </div>
            <div class="form-group">
                <label for="name">Họ và tên:</label>
                <input type="text" name="name" id="name" class="form-control" required
                    placeholder="Nhập họ tên của bạn">
                <small class="error-message" id="name-error"></small>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" name="password" id="password" class="form-control" required
                    placeholder="Tạo mật khẩu (6-16 ký tự)">
                <small class="error-message" id="password-error"></small>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Xác nhận mật khẩu:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    required placeholder="Nhập lại mật khẩu">
                <small class="error-message" id="password_confirmation-error"></small>
            </div>
            <button type="submit" class="btn btn-block">Đăng ký ngay</button>
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
                } else if (!/\S+@\S+\.\S+/.test(email)) {
                    $('#email-error').text('Email không hợp lệ');
                    isValid = false;
                }

                if (password === '') {
                    $('#password-error').text('Mật khẩu không được để trống');
                    isValid = false;
                } else if (password.length < 6 || password.length > 16) {
                    $('#password-error').text('Mật khẩu phải có từ 6 đến 16 ký tự');
                    isValid = false;
                }

                if (password !== passwordConfirmation) {
                    $('#password_confirmation-error').text('Mật khẩu xác nhận không khớp');
                    isValid = false;
                }

                if (!isValid) {
                    return;
                }

                $.ajax({
                    url: '{{ route('register') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success === true) {
                            toastr.success(response.message || 'Đăng ký tài khoản thành công');
                            setTimeout(function() {
                                window.location.href = "{{ url('/') }}";
                            }, 3000);
                        } else {
                            toastr.error(response.message || 'Đăng ký tài khoản thất bại');
                        }
                    },
                    error: function(xhr) {
                        let message = xhr.responseJSON.message || 'Đăng ký thất bại';
                        toastr.error(message);
                    }
                });
            });

            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif

            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif
        });
    </script>
</body>

</html>
