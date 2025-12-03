<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Beranda - Lowongan Direkomendasikan</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?= base_url('assets/jobentry/img/favicon.ico') ?>" rel="icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets/jobentry/lib/animate/animate.min.css') ?>" rel="stylesheet">
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
                    <a href="<?= base_url('lowongan') ?>" class="nav-item nav-link">Cari lowongan</a>
                    <?php $up = session('user_profile') ?? null; $initials = ''; if ($up && !empty($up['full_name'])) { $parts = preg_split('/\s+/', trim($up['full_name'])); $initials = strtoupper(substr($parts[0] ?? '',0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : '')); } ?>
                    <div class="nav-item dropdown">
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
                </div>
                <a href="<?= base_url('logout') ?>" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Logout<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>

        <div class="container-fluid bg-dark text-white py-4">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Masukkan kata kunci" />
                    </div>
                    <div class="col-md-4">
                        <select class="form-select">
                            <option selected>Semua klasifikasi</option>
                            <option value="it">Teknologi Informasi</option>
                            <option value="marketing">Marketing</option>
                            <option value="design">Desain</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Masukkan kota atau wilayah" />
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-pink w-100" style="background:#ff0a80;color:#fff">Cari</button>
                    </div>
                </div>
                <div class="text-end mt-2">
                    <a href="#" class="text-white-50 small">Opsi lainnya</a>
                </div>
            </div>
        </div>

        

        <div class="container-fliud py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h4 class="mb-4">Direkomendasikan</h4>
                        <?php if(!empty($jobs)): foreach($jobs as $job): $company = $profiles[$job['user_id']] ?? null; ?>
                        <div class="p-4 mb-3 border rounded">
                            <div class="d-flex justify-content-between">
                                <div class="flex-grow-1 pe-3">
                                    <h5 class="mb-1"><?= esc($job['title']) ?></h5>
                                    <div class="text-muted mb-2"><?= esc($company['company_name'] ?? 'Perusahaan') ?></div>
                                    <div class="mb-2">
                                        <span class="badge bg-success me-2">Baru untuk kamu</span>
                                    </div>
                                    <div class="text-muted">
                                        <span class="me-3"><i class="far fa-clock text-primary me-1"></i><?= esc($job['employment_type'] ?: 'Full time') ?></span>
                                        <span class="me-3"><i class="fa fa-map-marker-alt text-primary me-1"></i><?= esc($job['location'] ?: '-') ?></span>
                                        <?php if(!empty($job['salary_min']) || !empty($job['salary_max'])): ?>
                                            <span class="me-3"><i class="far fa-money-bill-alt text-primary me-1"></i>
                                                <?= !empty($job['salary_min']) ? 'Rp '.number_format($job['salary_min'],0,',','.') : '' ?>
                                                <?= (!empty($job['salary_min']) && !empty($job['salary_max'])) ? ' - ' : '' ?>
                                                <?= !empty($job['salary_max']) ? 'Rp '.number_format($job['salary_max'],0,',','.') : '' ?>
                                                per month
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="text-muted small mt-2">
                                        <?= $job['created_at'] ? date('d M Y \p\u\k\u\l', strtotime($job['created_at'])) : '' ?>
                                    </div>
                                </div>
                                <div class="text-end" style="min-width:120px">
                                    <img class="img-fluid" src="<?= base_url(!empty($job['image']) ? $job['image'] : 'assets/jobentry/img/com-logo-1.jpg') ?>" alt="" style="width:80px;height:80px;object-fit:cover">
                                    <div class="mt-3">
                                        <a class="btn btn-outline-secondary btn-sm me-2 btn-save-job" href="#" data-job-id="<?= esc($job['id']) ?>"><i class="far fa-bookmark"></i></a>
                                        <?php $isLogged = (bool)session('logged_in') && (session('role')==='user'); $applyUrl = $isLogged ? base_url('lowongan/detail/'.$job['id']) : base_url('login?redirect=' . urlencode('/lowongan/detail/'.$job['id'])); ?>
                                        <a class="btn btn-primary btn-sm" href="<?= $applyUrl ?>">Lamar Sekarang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; else: ?>
                        <div class="alert alert-light border">Belum ada rekomendasi lowongan.</div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h6 class="mb-2">Pencarian tersimpan</h6>
                                <p class="text-muted mb-0">Gunakan tombol Simpan pencarian di bawah hasil pencarian untuk menyimpan pencarian dan menerima setiap lowongan kerja baru.</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-2">Lowongan kerja tersimpan</h6>
                                <ul id="savedJobsList" class="list-unstyled mb-0">
                                    <?php if (!empty($savedJobs)): foreach ($savedJobs as $sj): ?>
                                        <li class="mb-2"><a href="<?= base_url('lowongan/detail/'.$sj['id']) ?>" class="text-decoration-none"><?= esc($sj['title']) ?></a><div class="text-muted small"><?= esc($sj['company'] ?? '') ?></div></li>
                                    <?php endforeach; endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="<?= base_url('assets/jobentry/js/main.js') ?>"></script>
    <script>
    (function(){
        var csrfName = '<?= csrf_token() ?>';
        var csrfHash = '<?= csrf_hash() ?>';
        function updateSaved(list){
            var el = document.getElementById('savedJobsList');
            if(!el) return;
            var html = '';
            for(var i=0;i<list.length;i++){
                var it = list[i];
                html += '<li class="mb-2"><a href="<?= base_url('lowongan/detail/') ?>'+it.id+'" class="text-decoration-none">'+it.title+'</a><div class="text-muted small">'+(it.company||'')+'</div></li>';
            }
            el.innerHTML = html;
        }
        document.querySelectorAll('.btn-save-job').forEach(function(btn){
            btn.addEventListener('click', function(e){
                e.preventDefault();
                var id = this.getAttribute('data-job-id');
                var fd = new FormData();
                fd.append(csrfName, csrfHash);
                fetch('<?= base_url('user/save') ?>/'+id, {method:'POST', body:fd}).then(function(r){return r.json()}).then(function(res){ if(res && res.ok){ updateSaved(res.saved||[]); }});
            });
        });
    })();
    </script>
</body>

</html>
