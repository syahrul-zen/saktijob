<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Lowongan Perusahaan</h3>
    <p class="text-muted">Kelola dan pasang lowongan pekerjaan Anda.</p>
    </div>
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Daftar Lowongan</h5>
                <a href="<?= base_url('perusahaan/lowongan/create') ?>" class="btn btn-primary">Buat Lowongan</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Lokasi</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($jobs)): foreach($jobs as $job): ?>
                        <tr>
                            <td>
                                <?php if(!empty($job['image'])): ?>
                                    <img src="<?= base_url($job['image']) ?>" alt="" style="height:40px;width:40px;object-fit:cover;border-radius:6px">
                                <?php endif; ?>
                            </td>
                            <td><?= esc($job['title']) ?></td>
                            <td><?= esc($job['location']) ?></td>
                            <td><?= esc($job['employment_type']) ?></td>
                            <td>
                                <?php if(($job['status'] ?? 'draft') === 'published'): ?>
                                    <span class="badge bg-success">Published</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Draft</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('perusahaan/lowongan/edit/'.$job['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="<?= base_url('perusahaan/lowongan/delete/'.$job['id']) ?>" method="post" class="d-inline action-delete">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                                <?php if(($job['status'] ?? 'draft') === 'published'): ?>
                                    <form action="<?= base_url('perusahaan/lowongan/unpublish/'.$job['id']) ?>" method="post" class="d-inline action-unpublish">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-warning">Unpublish</button>
                                    </form>
                                <?php else: ?>
                                    <form action="<?= base_url('perusahaan/lowongan/publish/'.$job['id']) ?>" method="post" class="d-inline action-publish">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-success">Publish</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada lowongan.</td>
                        </tr>
                        <?php endif; ?>
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
document.querySelectorAll('form.action-delete').forEach(f => {
    f.addEventListener('submit', function(e){
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Hapus Lowongan?',
            text: 'Tindakan ini tidak dapat dibatalkan.',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((res)=>{ if(res.isConfirmed) this.submit(); });
    });
});
document.querySelectorAll('form.action-publish').forEach(f => {
    f.addEventListener('submit', function(e){
        e.preventDefault();
        Swal.fire({
            icon: 'question',
            title: 'Publish Lowongan?',
            showCancelButton: true,
            confirmButtonText: 'Publish',
            cancelButtonText: 'Batal'
        }).then((res)=>{ if(res.isConfirmed) this.submit(); });
    });
});
document.querySelectorAll('form.action-unpublish').forEach(f => {
    f.addEventListener('submit', function(e){
        e.preventDefault();
        Swal.fire({
            icon: 'question',
            title: 'Unpublish Lowongan?',
            showCancelButton: true,
            confirmButtonText: 'Unpublish',
            cancelButtonText: 'Batal'
        }).then((res)=>{ if(res.isConfirmed) this.submit(); });
    });
});
</script>
