<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit User</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('pemilik/users/' . $user['id']) ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" 
                                   value="<?= old('username', $user['username']) ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullname">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fullname" name="fullname" 
                                   value="<?= old('fullname', $user['fullname']) ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role">Role <span class="text-danger">*</span></label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="pemilik" <?= old('role', $user['role']) === 'pemilik' ? 'selected' : '' ?>>Pemilik</option>
                                <option value="gudang" <?= old('role', $user['role']) === 'gudang' ? 'selected' : '' ?>>Gudang</option>
                                <option value="kasir" <?= old('role', $user['role']) === 'kasir' ? 'selected' : '' ?>>Kasir</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="iconly-boldTicket-Star"></i> Update
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
