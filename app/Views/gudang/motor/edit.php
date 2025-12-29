<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Data Motor</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('gudang/motor/update/' . $motor['id']) ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="plat_nomor">Plat Nomor <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" 
                                   value="<?= old('plat_nomor', $motor['plat_nomor']) ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="merk">Merk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="merk" name="merk" 
                                   value="<?= old('merk', $motor['merk']) ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipe">Tipe <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tipe" name="tipe" 
                                   value="<?= old('tipe', $motor['tipe']) ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="warna">Warna <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="warna" name="warna" 
                                   value="<?= old('warna', $motor['warna']) ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tahun">Tahun <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="tahun" name="tahun" 
                                   value="<?= old('tahun', $motor['tahun']) ?>" min="1900" max="<?= date('Y') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="harga_beli">Harga Beli <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli" 
                                   value="<?= old('harga_beli', $motor['harga_beli']) ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual" 
                                   value="<?= old('harga_jual', $motor['harga_jual']) ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sumber_pembelian">Sumber Pembelian</label>
                            <input type="text" class="form-control" id="sumber_pembelian" name="sumber_pembelian" 
                                   value="<?= old('sumber_pembelian', $motor['sumber_pembelian'] ?? '') ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="foto">Ganti Foto Motor</label>
                            <input type="file" class="form-control" id="foto" name="foto" 
                                   accept="image/jpeg,image/jpg,image/png,image/gif">
                            <small class="text-muted">Format: JPG, JPEG, PNG, GIF (Max 5MB) - Kosongkan jika tidak ingin mengubah</small>
                            <div id="preview-foto" class="mt-2"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Foto Saat Ini</label>
                            <div id="current-foto" class="mt-2">
                                <?php if ($motor['foto']): ?>
                                    <img src="<?= base_url('uploads/motorcycles/' . $motor['foto']) ?>" 
                                         alt="Foto Motor" class="img-fluid rounded" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                    <p class="small text-muted mt-2">File: <?= $motor['foto'] ?></p>
                                <?php else: ?>
                                    <div class="alert alert-warning">
                                        <small>Belum ada foto</small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="iconly-boldTicket-Star"></i> Update
                    </button>
                    <a href="<?= base_url('gudang/motor') ?>" class="btn btn-secondary">
                        <i class="iconly-boldClose-Square"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Preview foto sebelum upload
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewDiv = document.getElementById('preview-foto');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                previewDiv.innerHTML = `
                    <div class="card" style="width: 200px;">
                        <img src="${event.target.result}" class="card-img-top" alt="Preview" style="max-height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text small">${file.name}</p>
                            <p class="card-text small text-muted">${(file.size / 1024).toFixed(2)} KB</p>
                        </div>
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        } else {
            previewDiv.innerHTML = '';
        }
    });
</script>
<?= $this->endSection() ?>
