<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Semua Lowongan - SaktiJob</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?= base_url('assets/jobentry/img/favicon.ico') ?>" rel="icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets/jobentry/lib/animate/animate.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/jobentry/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/jobentry/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/jobentry/css/style.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="container-fliud bg-white p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="<?= base_url('/') ?>" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">Sakti<span style="color:#F28C28">Job</span></h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <?php $homeUrl = ((bool)session('logged_in') && session('role')==='user') ? base_url('user/beranda') : base_url('/'); ?>
                    <a href="<?= $homeUrl ?>" class="nav-item nav-link">Beranda</a>
                    <a href="<?= base_url('lowongan') ?>" class="nav-item nav-link active">Lowongan</a>
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

        <div class="container-fliud py-5">
            <div class="container">
                <h1 class="text-center mb-5">Semua Lowongan</h1>
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
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
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
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/jobentry/lib/wow/wow.min.js') ?>"></script>
    <script src="<?= base_url('assets/jobentry/lib/easing/easing.min.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="<?= base_url('assets/jobentry/js/main.js') ?>"></script>
</body>

</html>
