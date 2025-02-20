<!DOCTYPE html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login</title>

    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="https://ujian-sekolah.skripsian.site/assets-auth/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://ujian-sekolah.skripsian.site/assets-auth/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="https://ujian-sekolah.skripsian.site/assets-auth/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="https://ujian-sekolah.skripsian.site/assets-auth/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="https://ujian-sekolah.skripsian.site/assets-auth/css/demo.css" />
    <link rel="stylesheet" href="https://ujian-sekolah.skripsian.site/assets-auth/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="https://ujian-sekolah.skripsian.site/assets-auth/vendor/css/pages/page-auth.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://ujian-sekolah.skripsian.site/assets-auth/vendor/js/helpers.js"></script>
    <script src="https://ujian-sekolah.skripsian.site/assets-auth/js/config.js"></script>
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <!-- <div class="app-brand justify-content-center">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="<?= base_url('https://ujian-sekolah.skripsian.site/assets-auth/img/logo-map.png') ?>" alt="Logo Map" width="100">
                                </span>
                            </a>
                        </div> -->

                        <h4 class="mb-2">Selamat Datang!</h4>
                        <p class="mb-4">Silahkan login untuk masuk ke akunmu</p>

                        <?php if (session()->has('error')): ?>
                            <div class="alert alert-danger">
                                <?= session('error') ?>
                            </div>
                        <?php endif; ?>

                        <form action="/login" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" value="<?= old('email') ?>" required autofocus>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    <!-- <a href="/forgot-password">
                                        <small>Forgot Password?</small>
                                    </a> -->
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter your password" required>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                            </div>
                            <span class="d-flex align-items-center justify-content-center">Belum punya akun? <a href="/register">Daftar</a></span>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ujian-sekolah.skripsian.site/assets-auth/vendor/libs/jquery/jquery.js"></script>
    <script src="https://ujian-sekolah.skripsian.site/assets-auth/vendor/libs/popper/popper.js"></script>
    <script src="https://ujian-sekolah.skripsian.site/assets-auth/vendor/js/bootstrap.js"></script>
    <script src="https://ujian-sekolah.skripsian.site/assets-auth/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="https://ujian-sekolah.skripsian.site/assets-auth/vendor/js/menu.js"></script>
    <script src="https://ujian-sekolah.skripsian.site/assets-auth/js/main.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>