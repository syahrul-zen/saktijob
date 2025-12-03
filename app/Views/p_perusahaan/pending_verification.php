<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Menunggu Verifikasi Admin</h3>
    <p class="text-muted">Profil perusahaan Anda telah dikirim. Admin akan meninjau dan memverifikasi sebelum Anda dapat mengakses dashboard perusahaan.</p>
</div>

<div class="page-content">
    <div class="card">
        <div class="card-body">
            <p class="mb-0">Status saat ini: <span class="badge bg-warning">Pending</span></p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?php $swal = session()->getFlashdata('swal'); if ($swal): ?>
<script>
Swal.fire({
    icon: '<?= esc($swal['icon'] ?? 'info') ?>',
    title: '<?= esc($swal['title'] ?? '') ?>',
    text: '<?= esc($swal['text'] ?? '') ?>'
});
</script>
<?php endif; ?>
