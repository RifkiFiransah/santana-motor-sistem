<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Detail User</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th width="200">Username</th>
                    <td><?= esc($user['username']) ?></td>
                </tr>
                <tr>
                    <th>Nama Lengkap</th>
                    <td><?= esc($user['fullname']) ?></td>
                </tr>
                <tr>
                    <th>Role</th>
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
                </tr>
                <tr>
                    <th>Dibuat Pada</th>
                    <td><?= date('d/m/Y H:i:s', strtotime($user['created_at'])) ?></td>
                </tr>
                <tr>
                    <th>Terakhir Diupdate</th>
                    <td><?= date('d/m/Y H:i:s', strtotime($user['updated_at'])) ?></td>
                </tr>
            </table>

            <div class="mt-3">
                <a href="<?= base_url('pemilik/users/' . $user['id'] . '/edit') ?>" class="btn btn-warning">
                    <i class="iconly-boldEdit"></i> Edit
                </a>
                <a href="<?= base_url('pemilik/users') ?>" class="btn btn-secondary">
                    <i class="iconly-boldArrow---Left-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
