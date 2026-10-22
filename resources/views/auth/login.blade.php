<!doctype html>
<html lang="id" data-bs-theme="dark">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Admin - SportSpace</title>

    <!-- PLUGINS -->
    <link href="{{ asset('template/admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">

    <link href="{{ asset('template/admin/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet">

    <link href="{{ asset('template/admin/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="{{ asset('template/admin/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link href="{{ asset('template/admin/css/icons.css') }}" rel="stylesheet">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- MAIN STYLE -->
    <link href="{{ asset('template/admin/css/main.css') }}" rel="stylesheet">

    <link href="{{ asset('template/admin/css/dark-theme.css') }}" rel="stylesheet">


    <style>
        body {
            min-height: 100vh;
            font-family: 'Noto Sans', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            padding: 30px 15px;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            margin: auto;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            overflow: hidden;
        }

        .login-card .card-body {
            padding: 40px !important;
        }

        .login-logo {
            width: 55px;
            height: 55px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .brand-name {
            font-size: 25px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .brand-subtitle {
            color: #8f9ba8;
            font-size: 14px;
        }

        .login-title {
            font-size: 20px;
            font-weight: 600;
            margin-top: 30px;
            margin-bottom: 5px;
        }

        .login-description {
            color: #8f9ba8;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 500;
        }

        .input-group-text {
            background: transparent;
            border-color: rgba(255, 255, 255, 0.12);
        }

        .form-control {
            min-height: 46px;
            border-color: rgba(255, 255, 255, 0.12);
        }

        .form-control:focus {
            border-color: #0dcaf0;
            box-shadow: none;
        }

        .login-btn {
            min-height: 46px;
            font-weight: 600;
            border-radius: 6px;
        }

        .back-website {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .back-website a {
            color: #0dcaf0;
            text-decoration: none;
            font-size: 14px;
        }

        .back-website a:hover {
            color: #fff;
        }

        .alert {
            font-size: 14px;
        }

        .admin-icon {
            color: #0dcaf0;
        }
    </style>

</head>


<body>


    <div class="login-container">

        <div class="card login-card">

            <div class="card-body">


                <!-- LOGO & BRAND -->

                <div class="text-center">

                    <img src="{{ asset('template/admin/images/logo-icon.png') }}" class="login-logo" alt="SportSpace">

                    <div class="brand-name">
                        SportSpace
                    </div>

                    <div class="brand-subtitle">
                        Sistem Reservasi Lapangan Olahraga
                    </div>

                </div>


                <!-- TITLE -->

                <div class="text-center">

                    <div class="login-title">
                        Login Administrator
                    </div>

                    <p class="login-description">
                        Masuk untuk mengelola sistem SportSpace
                    </p>

                </div>


                <!-- ERROR -->

                @if(session('error'))

                    <div class="alert alert-danger d-flex align-items-center">

                        <i class="bi bi-exclamation-circle me-2"></i>

                        <div>
                            {{ session('error') }}
                        </div>

                    </div>

                @endif


                <!-- SUCCESS -->

                @if(session('success'))

                    <div class="alert alert-success d-flex align-items-center">

                        <i class="bi bi-check-circle me-2"></i>

                        <div>
                            {{ session('success') }}
                        </div>

                    </div>

                @endif


                <!-- VALIDATION -->

                @if($errors->any())

                    <div class="alert alert-danger">

                        <div class="d-flex align-items-center">

                            <i class="bi bi-exclamation-triangle me-2"></i>

                            <strong>
                                Login gagal
                            </strong>

                        </div>

                        <div class="mt-1">
                            {{ $errors->first() }}
                        </div>

                    </div>

                @endif


                <!-- FORM LOGIN -->

                <form action="{{ route('admin.login.submit') }}" method="POST">

                    @csrf


                    <!-- EMAIL -->

                    <div class="mb-3">

                        <label for="email" class="form-label">

                            Email Administrator

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-envelope admin-icon"></i>

                            </span>

                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                                placeholder="admin@sportspace.com" autocomplete="email" required>

                        </div>

                    </div>


                    <!-- PASSWORD -->

                    <div class="mb-4">

                        <label for="password" class="form-label">

                            Password

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-lock admin-icon"></i>

                            </span>

                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukkan password" autocomplete="current-password" required>

                            <button type="button" class="input-group-text" id="togglePassword" style="cursor: pointer;">

                                <i class="bi bi-eye-slash" id="passwordIcon">
                                </i>

                            </button>

                        </div>

                    </div>


                    <!-- LOGIN BUTTON -->

                    <div class="d-grid">

                        <button type="submit" class="btn btn-info login-btn">

                            <i class="bi bi-box-arrow-in-right me-1"></i>

                            Login Administrator

                        </button>

                    </div>


                </form>


                <!-- BACK TO WEBSITE -->

                <div class="text-center back-website">

                    <a href="{{ route('home') }}">

                        <i class="bi bi-arrow-left me-1"></i>

                        Kembali ke Website

                    </a>

                </div>


            </div>

        </div>

    </div>


    <!-- JAVASCRIPT -->

    <script src="{{ asset('template/admin/js/jquery.min.js') }}"></script>


    <script>

        const togglePassword =
            document.getElementById('togglePassword');

        const password =
            document.getElementById('password');

        const passwordIcon =
            document.getElementById('passwordIcon');


        togglePassword.addEventListener('click', function () {

            const isPassword =
                password.getAttribute('type') === 'password';


            password.setAttribute(
                'type',
                isPassword ? 'text' : 'password'
            );


            if (isPassword) {

                passwordIcon.classList.remove('bi-eye-slash');

                passwordIcon.classList.add('bi-eye');

            } else {

                passwordIcon.classList.remove('bi-eye');

                passwordIcon.classList.add('bi-eye-slash');

            }

        });

    </script>


</body>

</html>