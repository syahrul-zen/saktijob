<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard - SaktiJob' ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/admindash/assets/compiled/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admindash/assets/compiled/css/app-dark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admindash/assets/compiled/css/iconly.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admindash/assets/extensions/sweetalert2/sweetalert2.css') ?>">

    <script src="<?= base_url('assets/admindash/assets/static/js/initTheme.js') ?>"></script>
</head>

<body>
    <div id="app">

        <?= $this->include('partials/sidebar') ?>

        <div id="main" class="layout-navbar">
            
            <?= $this->include('partials/navbar') ?>

            <div id="main-content">
                <?= $this->renderSection('content') ?>
            </div>

        </div>
    </div>

    <script src="<?= base_url('assets/admindash/assets/static/js/components/dark.js') ?>"></script>
    <script src="<?= base_url('assets/admindash/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('assets/admindash/assets/compiled/js/app.js') ?>"></script>
    <script src="<?= base_url('assets/admindash/assets/extensions/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/admindash/assets/static/js/pages/dashboard.js') ?>"></script>
    <script src="<?= base_url('assets/admindash/assets/extensions/sweetalert2/sweetalert2.min.js') ?>"></script>
</body>

</html>
