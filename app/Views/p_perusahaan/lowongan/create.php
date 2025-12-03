<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Buat Lowongan</h3>
    <p class="text-muted">Lengkapi detail lowongan pekerjaan.</p>
</div>

<div class="page-content">
    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('perusahaan/lowongan') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control" value="<?= esc(old('title')) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="location" class="form-control" value="<?= esc(old('location')) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Pekerjaan</label>
                    <select name="employment_type" class="form-select">
                        <option value="">Pilih jenis</option>
                        <option value="full-time" <?= old('employment_type')==='full-time'?'selected':'' ?>>Full-time</option>
                        <option value="part-time" <?= old('employment_type')==='part-time'?'selected':'' ?>>Part-time</option>
                        <option value="contract" <?= old('employment_type')==='contract'?'selected':'' ?>>Kontrak</option>
                        <option value="internship" <?= old('employment_type')==='internship'?'selected':'' ?>>Magang</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gaji Minimum (opsional)</label>
                        <input type="number" name="salary_min" class="form-control" value="<?= esc(old('salary_min')) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gaji Maksimum (opsional)</label>
                        <input type="number" name="salary_max" class="form-control" value="<?= esc(old('salary_max')) ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="6"><?= esc(old('description')) ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar (JPG/PNG/WEBP)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
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
