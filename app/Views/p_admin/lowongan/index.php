<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Data Lowongan Perusahaan</h3>
    <p class="text-muted">Seluruh lowongan yang diupload oleh perusahaan terdaftar, dikelompokkan per perusahaan.</p>
</div>

<div class="page-content">
    <?php if (!empty($groups)): ?>
        <?php foreach ($groups as $uid => $group): $profile = $group['profile'] ?? null; ?>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0"><?= esc($profile['company_name'] ?? 'Tanpa Profil') ?></h5>
                    <small class="text-muted">User ID: <?= esc($uid) ?></small>
                </div>
                <span class="badge bg-primary">Total: <?= count($group['jobs']) ?> lowongan</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Lokasi</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Dipublikasikan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($group['jobs'] as $job): ?>
                            <tr>
                                <td><?= esc($job['title']) ?></td>
                                <td><?= esc($job['location']) ?></td>
                                <td><?= esc($job['employment_type']) ?></td>
                                <td><span class="badge <?= ($job['status'] ?? '')==='published' ? 'bg-success' : 'bg-secondary' ?>"><?= esc($job['status']) ?></span></td>
                                <td><?= $job['created_at'] ? date('d M Y', strtotime($job['created_at'])) : '-' ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <p class="mb-0">Belum ada lowongan.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>

