<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Data Perusahaan</h3>
    <p class="text-muted">Verifikasi perusahaan yang mendaftar untuk meningkatkan kepercayaan lowongan.</p>
</div>

<div class="page-content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Perusahaan</th>
                            <th>Telepon</th>
                            <th>Website</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($profiles as $p): ?>
                        <tr>
                            <td><?= esc($p['company_name']) ?></td>
                            <td><?= esc($p['phone']) ?></td>
                            <td><?= esc($p['website']) ?></td>
                            <td>
                                <?php if(($p['status'] ?? 'pending') === 'verified'): ?>
                                    <span class="badge bg-success">Verified</span>
                                <?php elseif(($p['status'] ?? 'pending') === 'rejected'): ?>
                                    <span class="badge bg-danger">Rejected</span>
                                <?php else: ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action="<?= base_url('admin/dataperusahaan/verify/'.$p['id']) ?>" method="post" class="d-inline action-verify">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-success" <?= ($p['status'] ?? 'pending') === 'verified' ? 'disabled' : '' ?>>Verifikasi</button>
                                </form>
                                <form action="<?= base_url('admin/dataperusahaan/reject/'.$p['id']) ?>" method="post" class="d-inline action-reject">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger" <?= ($p['status'] ?? 'pending') === 'rejected' ? 'disabled' : '' ?>>Tolak</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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

<script>
document.querySelectorAll('form.action-verify').forEach(f => {
    f.addEventListener('submit', function(e){
        e.preventDefault();
        Swal.fire({
            icon: 'question',
            title: 'Verifikasi Perusahaan?',
            text: 'Perusahaan akan mendapat status terverifikasi.',
            showCancelButton: true,
            confirmButtonText: 'Ya, verifikasi',
            cancelButtonText: 'Batal'
        }).then((res)=>{ if(res.isConfirmed) this.submit(); });
    });
});
document.querySelectorAll('form.action-reject').forEach(f => {
    f.addEventListener('submit', function(e){
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Tolak Perusahaan?',
            text: 'Status akan ditandai sebagai ditolak.',
            showCancelButton: true,
            confirmButtonText: 'Ya, tolak',
            cancelButtonText: 'Batal'
        }).then((res)=>{ if(res.isConfirmed) this.submit(); });
    });
});
</script>
