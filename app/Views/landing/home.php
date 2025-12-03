<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SaktiJob - Portal Pencari Kerja</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?= base_url('assets/jobentry/img/favicon.ico') ?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets/jobentry/lib/animate/animate.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/jobentry/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('assets/jobentry/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets/jobentry/css/style.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="container-fliud bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Memuat...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="index.html" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">Sakti<span style="color:#F28C28">Job</span></h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <?php $homeUrl = ((bool)session('logged_in') && session('role')==='user') ? base_url('user/beranda') : base_url('/'); ?>
                    <a href="<?= $homeUrl ?>" class="nav-item nav-link active">Beranda</a>
                    <a href="<?= base_url('lowongan') ?>" class="nav-item nav-link">Lowongan</a>
                    <a href="#" class="nav-item nav-link">Hubungi Kami</a>
                </div>
                <?php if ((bool)session('logged_in') && session('role')==='user'): ?>
                <?php $up = session('user_profile') ?? null; $initials = ''; if ($up && !empty($up['full_name'])) { $parts = preg_split('/\s+/', trim($up['full_name'])); $initials = strtoupper(substr($parts[0] ?? '',0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : '')); } ?>
                <div class="nav-item dropdown me-2">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="d-inline-flex justify-content-center align-items-center rounded-circle bg-primary text-white" style="width:36px;height:36px;font-weight:600">
                            <?= !empty($initials) ? esc($initials) : '<i class="bi bi-person"></i>' ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                        <li><a class="dropdown-item" href="<?= base_url('user/profile') ?>">Lengkapi Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
                    </ul>
                </div>
                <a href="<?= base_url('logout') ?>" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Logout<i class="fa fa-arrow-right ms-3"></i></a>
                <?php else: ?>
                <a href="<?= base_url('daftar') ?>" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Masuk/Daftar<i class="fa fa-arrow-right ms-3"></i></a>
                <?php endif; ?>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Carousel Start -->
        <div class="container-fluid p-0">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="<?= base_url('assets/jobentry/img/carousel-1.jpg') ?>" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(11, 36, 71, .5);">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-10 col-lg-8 text-center">
                                    <h1 class="display-5 text-white animated slideInDown mb-3">Temukan Pekerjaan Terbaik untuk Masa Depan Anda</h1>
                                    <p class="fs-6 fw-medium text-white mb-4 pb-2">Bangun karier impian bersama SaktiJob. Ribuan lowongan terpercaya dan pencarian cerdas membantu Anda melangkah lebih cepat.</p>
                                    <div class="mt-2">
                                        <a href="<?= base_url('daftar') ?>" class="btn btn-primary btn-lg px-4 py-3 me-2 mb-2">Daftar</a>
                                        <a href="<?= base_url('login') ?>" class="btn btn-outline-light btn-lg px-4 py-3 mb-2">Masuk</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="<?= base_url('assets/jobentry/img/carousel-2.jpg') ?>" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(11, 36, 71, .5);">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-10 col-lg-8 text-center">
                                    <h1 class="display-5 text-white animated slideInDown mb-3">Lowongan Startup Terbaik, Peluang Besar untuk Berkembang</h1>
                                    <p class="fs-6 fw-medium text-white mb-4 pb-2">Gabung dengan perusahaan bertumbuh dan peran berdampak. Temukan peluang yang sesuai keterampilan dan tujuan karier Anda.</p>
                                    <div class="mt-2">
                                        <a href="<?= base_url('daftar') ?>" class="btn btn-primary btn-lg px-4 py-3 me-2 mb-2">Daftar</a>
                                        <a href="<?= base_url('login') ?>" class="btn btn-outline-light btn-lg px-4 py-3 mb-2">Masuk</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->


        <!-- Search Start -->
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control border-0" placeholder="Kata Kunci" />
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0">
                                    <option selected>Kategori</option>
                                    <option value="1">Category 1</option>
                                    <option value="2">Category 2</option>
                                    <option value="3">Category 3</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0">
                                    <option selected>Lokasi</option>
                                    <option value="1">Location 1</option>
                                    <option value="2">Location 2</option>
                                    <option value="3">Location 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark border-0 w-100">Cari</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search End -->

        <!-- Jobs Start -->
        <div class="container-fliud py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Daftar Lowongan</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                                <h6 class="mt-n1 mb-0">Unggulan</h6>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <?php if(!empty($jobs)): foreach($jobs as $job): $company = $profiles[$job['user_id']] ?? null; ?>
                            <div class="job-item p-4 mb-4">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded" src="<?= base_url(!empty($job['image']) ? $job['image'] : 'assets/jobentry/img/com-logo-1.jpg') ?>" alt="" style="width: 80px; height: 80px;">
                                        <div class="text-start ps-4">
                                            <h5 class="mb-1"><?= esc($job['title']) ?></h5>
                                            <?php if($company): ?><div class="text-muted small mb-2"><?= esc($company['company_name']) ?></div><?php endif; ?>
                                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i><?= esc($job['location']) ?></span>
                                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i><?= esc($job['employment_type']) ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                            <a class="btn btn-light btn-square me-3" href="#"><i class="far fa-heart text-primary"></i></a>
                                            <?php $isLogged = (bool)session('logged_in') && (session('role')==='user'); $applyUrl = $isLogged ? base_url('lowongan/detail/'.$job['id']) : base_url('login?redirect=' . urlencode('/lowongan/detail/'.$job['id'])); ?>
                                            <a class="btn btn-primary" href="<?= $applyUrl ?>">Lamar Sekarang</a>
                                        </div>
                                        <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Dipublikasikan: <?= date('d M Y', strtotime($job['created_at'])) ?></small>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; else: ?>
                            <div class="alert alert-light border">Belum ada lowongan dipublikasikan.</div>
                            <?php endif; ?>
                            <?php if (!empty($hasMore) && $hasMore): ?>
                            <a class="btn btn-primary py-3 px-5" href="<?= base_url('lowongan') ?>">Lihat Lebih Banyak Lowongan</a>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Jobs End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Perusahaan</h5>
                        <a class="btn btn-link text-white-50" href="">Tentang Kami</a>
                        <a class="btn btn-link text-white-50" href="">Hubungi Kami</a>
                        <a class="btn btn-link text-white-50" href="">Layanan Kami</a>
                        <a class="btn btn-link text-white-50" href="">Kebijakan Privasi</a>
                        <a class="btn btn-link text-white-50" href="">Syarat & Ketentuan</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Tautan Cepat</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Kontak</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Dapatkan info lowongan terbaru dan tips karier langsung di email Anda.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Email Anda">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Langganan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">SaktiJob</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="<?= base_url('/') ?>">Beranda</a>
                                <a href="#">FAQ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/jobentry/lib/wow/wow.min.js') ?>"></script>
    <script src="<?= base_url('assets/jobentry/lib/easing/easing.min.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('assets/jobentry/js/main.js') ?>"></script>
</body>

</html>
