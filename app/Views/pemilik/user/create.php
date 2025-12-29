<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Tambah User Baru</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('pemilik/users') ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" 
                                   value="<?= old('username') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullname">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fullname" name="fullname" 
                                   value="<?= old('fullname') ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <small class="text-muted">Minimal 6 karakter</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role">Role <span class="text-danger">*</span></label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="pemilik" <?= old('role') === 'pemilik' ? 'selected' : '' ?>>Pemilik</option>
                                <option value="gudang" <?= old('role') === 'gudang' ? 'selected' : '' ?>>Gudang</option>
                                <option value="kasir" <?= old('role') === 'kasir' ? 'selected' : '' ?>>Kasir</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="iconly-boldTicket-Star"></i> Simpan
                    </button>
                    <a href="<?= base_url('pemilik/users') ?>" class="btn btn-secondary">
                        <i class="iconly-boldClose-Square"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
