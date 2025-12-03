<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Pendaftaran - SaktiJob</title>
    <link rel="shortcut icon" href="<?= base_url('assets/admindash/assets/compiled/svg/favicon.svg') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/admindash/assets/compiled/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admindash/assets/compiled/css/app-dark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admindash/assets/compiled/css/auth.css') ?>">
</head>
<body>
    <script src="<?= base_url('assets/admindash/assets/compiled/js/app.js') ?>"></script>
    <div id="auth">
        <div class="row min-vh-100">
            <div class="col-lg-5 col-12 d-flex align-items-center justify-content-center">
                <div id="auth-left" style="max-width:520px;width:100%;background:#fff;border-radius:16px;padding:32px;box-shadow:0 12px 30px rgba(11,36,71,0.12)">
                    <h1 class="auth-title fs-4 text-primary" style="margin-bottom:8px">Daftar</h1>
                    <p class="auth-subtitle mb-4 fs-6">Daftar di SaktiJob sebagai:</p>

                    <div class="row g-3">
                        <div class="col-12">
                            <a href="<?= base_url('register') ?>?role=user" class="card text-decoration-none" style="border-radius:16px">
                                <div class="card-body d-flex align-items-center">
                                    <div class="me-3" style="font-size:28px">🧑‍🔧</div>
                                    <div>
                                        <h5 class="mb-1">Pencari Kerja</h5>
                                        <p class="text-muted mb-0">Buat akun untuk melamar dan simpan lowongan.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12">
                            <a href="<?= base_url('register') ?>?role=perusahaan" class="card text-decoration-none" style="border-radius:16px">
                                <div class="card-body d-flex align-items-center">
                                    <div class="me-3" style="font-size:28px">🏭</div>
                                    <div>
                                        <h5 class="mb-1">Perusahaan / Usaha</h5>
                                        <p class="text-muted mb-0">Pasang lowongan dan kelola kandidat.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <p class="mb-2 text-muted fs-6">Sudah mempunyai akun?</p>
                        <a href="<?= base_url('login') ?>" class="btn btn-outline-primary btn-lg shadow w-100" style="max-width:320px">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block d-flex align-items-center justify-content-center">
                <div id="auth-right" class="d-flex align-items-center justify-content-center" style="height:100vh;border-radius:25px 0 0 25px;overflow:hidden;position:relative;background: linear-gradient(145deg,rgba(11, 36, 71, 1) 0%, rgba(30, 136, 229, 1) 50%, rgba(242, 140, 40, 1) 100%);">
                    <img src="<?= base_url('assets/admindash/assets/compiled/bkt.jpg') ?>" alt="Background" style="max-width:100%;max-height:100%;object-fit:cover;border-radius:70px 0 70px 0;">
                    <div style="position:absolute;inset:0;background:rgba(0,0,0,0.35);"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
