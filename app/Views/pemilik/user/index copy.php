<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar User</h4>
            <div class="card-tools">
                <a href="<?= base_url('pemilik/users/new') ?>" class="btn btn-primary">
                    <i class="iconly-boldPlus"></i> Tambah User
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $index => $user): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= esc($user['username']) ?></td>
                                    <td><?= esc($user['fullname']) ?></td>
                                    <td>
                                        <?php 
                                        $badgeColor = [
                                            'pemilik' => 'danger',
                                            'gudang' => 'warning',
                                            'kasir' => 'info'
                                        ];
                                        ?>
                                        <span class="badge bg-<?= $badgeColor[$user['role']] ?? 'secondary' ?>">
                                            <?= ucfirst($user['role']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?= base_url('pemilik/users/' . $user['id']) ?>" class="mx-1 btn btn-sm btn-info" title="Detail">
                                                <i class="iconly-boldShow"></i>
                                            </a>
                                            <a href="<?= base_url('pemilik/users/' . $user['id'] . '/edit') ?>" class="mx-1 btn btn-sm btn-warning" title="Edit">
                                                <i class="iconly-boldEdit"></i>
                                            </a>
                                            <form action="<?= base_url('pemilik/users/' . $user['id']) ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="mx-1 btn btn-sm btn-danger" title="Hapus">
                                                    <i class="iconly-boldDelete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data user</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
<script>
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>
<?= $this->endSection() ?>
