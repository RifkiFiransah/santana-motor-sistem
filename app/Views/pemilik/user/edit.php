<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit User</h4>
        </div>
        <div class="card-body">
            <form id="userForm" action="<?= base_url('pemilik/users/' . $user['id']) ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" id="methodField" value="PUT">
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
                    <button type="button" class="btn btn-primary" onclick="submitUpdate()">
                        <i class="iconly-boldTicket-Star"></i> Update
                    </button>

                    <button type="button" class="btn btn-danger" onclick="submitDelete()">
                        <i class="iconly-boldClose-Square"></i> Delete
                    </button>

                    <a href="<?= base_url('pemilik/users') ?>" class="btn btn-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    function submitUpdate() {
        const username = document.getElementById('username').value.trim();
        const fullname = document.getElementById('fullname').value.trim();
        const role = document.getElementById('role').value;

        if (!username || !fullname || !role) {
            Swal.fire({
                icon: 'warning',
                title: 'Data belum lengkap',
                text: 'Username, Nama Lengkap, dan Role wajib diisi'
            });
            return;
        }

        document.getElementById('methodField').value = 'PUT';
        document.getElementById('userForm').submit();
    }

    function submitDelete() {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data user akan dihapus permanen',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('methodField').value = 'DELETE';
                document.getElementById('userForm').submit();
            }
        });
    }
</script>


<?= $this->endSection() ?>