<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>Landing Page Data Katalog</title>

    <link rel="stylesheet" href="<?= base_url('assets-landingpage/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-landingpage/css/line-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-landingpage/css/owl.carousel.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-landingpage/css/owl.theme.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-landingpage/css/nivo-lightbox.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-landingpage/css/magnific-popup.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-landingpage/css/animate.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-landingpage/css/color-switcher.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-landingpage/css/menu_sideslide.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-landingpage/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-landingpage/css/responsive.css') ?>">

</head>

<body>

    <header id="slider-area">
        <nav class="navbar navbar-expand-md fixed-top scrolling-navbar bg-white">
            <div class="container">
                <a class="navbar-brand" href="index.html"><img src="https://upload.wikimedia.org/wikipedia/id/9/95/Logo_Institut_Teknologi_Bandung.png" width="50" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="lni-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto w-100 justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#slider-area">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#about-us">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#blog">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="<?= base_url('login') ?>">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="carousel-area">
            <div id="carousel-slider" class="carousel slide carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-slider" data-slide-to="1"></li>
                    <li data-target="#carousel-slider" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="<?= base_url('assets-landingpage/img/slider/bg-1.png') ?>" style="height: 100vh; width: inherit; object-fit:cover;" alt="">
                        
                    </div>
                    <div class="carousel-item">
                        <img src="<?= base_url('assets-landingpage/img/slider/bg-3.png') ?>" style="height: 100vh; width: inherit; object-fit:cover;" alt="">
                        
                    </div>
                    <div class="carousel-item">
                        <img src="<?= base_url('assets-landingpage/img/slider/bg-2.png') ?>" style="height: 100vh; width: inherit; object-fit:cover;" alt="">
                        
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carousel-slider" role="button" data-slide="prev">
                    <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-left"></i></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-slider" role="button" data-slide="next">
                    <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-right"></i></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </header>

    <section id="about-us" class="call-action section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="cta-trial text-center">
                        <h4>Apa itu Hibah Buku?</h4>
                        <p>
                            Hibah Buku adalah sebuah inisiatif untuk memberikan buku-buku kepada individu atau lembaga yang membutuhkan, seperti sekolah, perpustakaan, dan organisasi sosial lainnya. Tujuannya adalah untuk meningkatkan akses terhadap pendidikan dan pengetahuan dengan cara mendistribusikan buku-buku yang masih layak pakai. Program hibah buku ini biasanya melibatkan donasi dari individu, komunitas, atau penerbit yang ingin berbagi sumber daya mereka demi kemajuan pendidikan di berbagai daerah.
                        </p>
                        <p>
                            Hibah Buku dapat mencakup berbagai jenis buku, mulai dari buku pelajaran, buku referensi, hingga buku nonfiksi dan fiksi yang dapat memperkaya wawasan pembaca. Melalui program ini, diharapkan dapat meningkatkan minat baca dan memperluas cakrawala pengetahuan masyarakat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="blog" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Galeri Katalog</h2>
                <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos debitis.</p>
            </div>
            <div class="row">
                <?php foreach ($catalogs as $catalog): ?>
                    <div class="col-lg-4 col-md-6 col-xs-12 blog-item">
                        <div class="blog-item-wrapper">
                            <div class="blog-item-img">
                                <a href="#">
                                    <img src="<?= base_url('/uploads/books/' . esc($catalog['book_photo'])) ?>" alt="<?= esc($catalog['name']) ?>">
                                </a>
                            </div>
                            <div class="blog-item-text">
                                <h3><a href="#"><?= esc($catalog['name']) ?></a></h3>
                                <p>Quantity: <?= esc($catalog['qty']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-info float-left">
                        <p>Crafted by <a href="http://uideck.com" rel="nofollow">UIdeck</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <a href="#" class="back-to-top">
        <i class="lni-arrow-up"></i>
    </a>

    <div id="loader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div> -->

    <script src="<?= base_url('assets-landingpage/js/jquery-min.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/classie.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/color-switcher.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/jquery.mixitup.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/nivo-lightbox.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/owl.carousel.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/jquery.stellar.min.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/jquery.nav.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/scrolling-nav.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/jquery.easing.min.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/wow.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/jquery.vide.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/jquery.counterup.min.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/jquery.magnific-popup.min.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/waypoints.min.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/form-validator.min.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/contact-form-script.js') ?>"></script>
    <script src="<?= base_url('assets-landingpage/js/main.js') ?>"></script>

</body>

</html>