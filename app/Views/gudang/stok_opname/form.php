<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Stok Opname</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="iconly-boldInfo-Circle"></i> 
                <strong>Jumlah Sistem:</strong> <?= $jumlahSistem ?> unit motor tersedia di sistem
            </div>

            <form action="<?= base_url('gudang/stok-opname') ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_sistem">Jumlah Sistem <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="jumlah_sistem" name="jumlah_sistem" 
                                   value="<?= old('jumlah_sistem', $jumlahSistem) ?>" readonly required>
                            <small class="text-muted">Otomatis terisi dari sistem</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_fisik">Jumlah Fisik <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="jumlah_fisik" name="jumlah_fisik" 
                                   value="<?= old('jumlah_fisik') ?>" placeholder="Masukkan hasil pengecekan fisik" required>
                            <small class="text-muted">Hasil pengecekan fisik di gudang</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="4" 
                                      placeholder="Catatan tambahan (opsional)"><?= old('catatan') ?></textarea>
                            <small class="text-muted">Jelaskan jika ada selisih atau kondisi khusus</small>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="iconly-boldSend"></i> Kirim Laporan
                    </button>
                    <a href="<?= base_url('gudang/dashboard') ?>" class="btn btn-secondary">
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
    // Auto calculate selisih
    document.getElementById('jumlah_fisik').addEventListener('input', function() {
        const sistem = parseInt(document.getElementById('jumlah_sistem').value) || 0;
        const fisik = parseInt(this.value) || 0;
        const selisih = fisik - sistem;
        
        const catatan = document.getElementById('catatan');
        if (selisih !== 0 && !catatan.value) {
            catatan.placeholder = `Selisih: ${selisih > 0 ? '+' : ''}${selisih}. Jelaskan penyebabnya...`;
        }
    });
</script>
<?= $this->endSection() ?>
