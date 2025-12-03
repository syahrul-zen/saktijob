<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Ubah Lowongan</h3>
    <p class="text-muted">Perbarui detail lowongan pekerjaan.</p>
</div>

<div class="page-content">
    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('perusahaan/lowongan/update/'.$job['id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control" value="<?= esc(old('title',$job['title'])) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="location" class="form-control" value="<?= esc(old('location',$job['location'])) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Pekerjaan</label>
                    <select name="employment_type" class="form-select">
                        <?php $type = old('employment_type',$job['employment_type']); ?>
                        <option value="full-time" <?= $type==='full-time'?'selected':'' ?>>Full-time</option>
                        <option value="part-time" <?= $type==='part-time'?'selected':'' ?>>Part-time</option>
                        <option value="contract" <?= $type==='contract'?'selected':'' ?>>Kontrak</option>
                        <option value="internship" <?= $type==='internship'?'selected':'' ?>>Magang</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gaji Minimum (opsional)</label>
                        <input type="number" name="salary_min" class="form-control" value="<?= esc(old('salary_min',$job['salary_min'])) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gaji Maksimum (opsional)</label>
                        <input type="number" name="salary_max" class="form-control" value="<?= esc(old('salary_max',$job['salary_max'])) ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="6"><?= esc(old('description',$job['description'])) ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar (JPG/PNG/WEBP)</label>
                    <?php if(!empty($job['image'])): ?>
                        <div class="mb-2"><img src="<?= base_url($job['image']) ?>" alt="" style="max-height:80px;border-radius:6px"></div>
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="<?= base_url('perusahaan/lowongan') ?>" class="btn btn-outline-secondary">Batal</a>
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

<?= $this->endSection() ?>
