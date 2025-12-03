<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3><?= (($profile['status'] ?? 'pending') === 'verified') ? 'Profil Perusahaan' : 'Lengkapi Profil Perusahaan' ?></h3>
    <p class="text-muted">
        <?php if (($profile['status'] ?? 'pending') === 'verified'): ?>
            Status: <span class="badge bg-success">Verified</span>
        <?php else: ?>
            Sebelum memasang lowongan, lengkapi data perusahaan untuk verifikasi admin.
        <?php endif; ?>
    </p>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('perusahaan/profile') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Nama Perusahaan</label>
                            <input type="text" name="company_name" class="form-control" value="<?= esc(old('company_name', $profile['company_name'] ?? '')) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="address" class="form-control" value="<?= esc(old('address', $profile['address'] ?? '')) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="phone" class="form-control" value="<?= esc(old('phone', $profile['phone'] ?? '')) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Website (opsional)</label>
                            <input type="url" name="website" class="form-control" value="<?= esc(old('website', $profile['website'] ?? '')) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="4"><?= esc(old('description', $profile['description'] ?? '')) ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <?= (($profile['status'] ?? 'pending') === 'verified') ? 'Simpan Perubahan' : 'Kirim untuk Verifikasi' ?>
                        </button>
                    </form>

                    <?php if(session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            <?php foreach(session()->getFlashdata('errors') as $err): ?>
                                <div><?= esc($err) ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-2">Kenapa perlu verifikasi?</h5>
                    <p class="text-muted mb-0">Verifikasi meningkatkan kepercayaan pencari kerja terhadap lowongan Anda dan membantu sistem memprioritaskan postingan terverifikasi.</p>
                </div>
            </div>
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
