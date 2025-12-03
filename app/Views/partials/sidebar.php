<?php
$role = session('role') ?? 'user';
$dashboard = $role === 'admin' ? 'admin/dashboard' : ($role === 'perusahaan' ? 'perusahaan/dashboard' : 'user/beranda');
$current = trim(service('uri')->getPath(), '/');
$active = function(string $path) use ($current) {
    return strpos($current, trim($path, '/')) === 0 ? ' active' : '';
};
if ($role === 'perusahaan') {
    $companyProfile = model('App\\Models\\CompanyProfileModel')
        ->where('user_id', session('id'))
        ->first();
}
if ($role === 'user') {
    return;
}
?>
<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="<?= base_url($dashboard) ?>">
                        <span class="fw-bold fs-4">
                            <span class="text-warning">Sakti</span><span class="text-secondary">Job</span>
                        </span>
                    </a>
                </div>
                <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="20" height="20"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                            </g>
                        </g>
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label" for="toggle-dark"></label>
                    </div>
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">

                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item<?= $active($dashboard) ?>">
                    <a href="<?= base_url($dashboard) ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <?php if ($role === 'admin'): ?>
                    <li class="sidebar-item<?= $active('admin/dataperusahaan') ?>">
                        <a href="<?= base_url('admin/dataperusahaan') ?>" class="sidebar-link">
                            <i class="bi bi-building-fill"></i>
                            <span>Data Perusahaan</span>
                        </a>
                    </li>
                    <li class="sidebar-item<?= $active('admin/lowongan') ?>">
                        <a href="<?= base_url('admin/lowongan') ?>" class="sidebar-link">
                            <i class="bi bi-briefcase-fill"></i>
                            <span>Data Lowongan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-people-fill"></i>
                            <span>Data User</span>
                        </a>
                    </li>
                <?php elseif ($role === 'perusahaan'): ?>
                    <?php if (empty($companyProfile) || (($companyProfile['status'] ?? 'pending') !== 'verified')): ?>
                        <li class="sidebar-item<?= $active('perusahaan/profile') ?>">
                            <a href="<?= base_url('perusahaan/profile') ?>" class="sidebar-link">
                                <i class="bi bi-building"></i>
                                <span>Lengkapi Profil</span>
                            </a>
                        </li>
                    <?php else: ?>
                    <li class="sidebar-item<?= $active('perusahaan/lowongan') ?>">
                        <a href="<?= base_url('perusahaan/lowongan') ?>" class="sidebar-link">
                            <i class="bi bi-briefcase-fill"></i>
                            <span>Lowongan</span>
                        </a>
                    </li>
                    <?php endif; ?>
                        <li class="sidebar-item<?= $active('perusahaan/profile') ?>">
                            <a href="<?= base_url('perusahaan/profile') ?>" class="sidebar-link">
                                <i class="bi bi-building"></i>
                                <span>Profil Perusahaan</span>
                            </a>
                        </li>
                <?php else: ?>
                    <li class="sidebar-item<?= $active('user/profile') ?>">
                        <a href="<?= base_url('user/profile') ?>" class="sidebar-link">
                            <i class="bi bi-person"></i>
                            <span>Lengkapi Profil</span>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="sidebar-item">
                    <a href="<?= base_url('/logout') ?>" class="sidebar-link">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
