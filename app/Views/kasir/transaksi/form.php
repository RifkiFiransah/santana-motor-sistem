<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Transaksi Penjualan</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('kasir/transaksi') ?>" method="POST" id="formTransaksi">
                <?= csrf_field() ?>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="motorcycle_id">Pilih Motor <span class="text-danger">*</span></label>
                            <select class="form-select" id="motorcycle_id" name="motorcycle_id" required>
                                <option value="">-- Pilih Motor --</option>
                                <?php if (!empty($motors)): ?>
                                    <?php foreach ($motors as $motor): ?>
                                        <option value="<?= $motor['id'] ?>" 
                                                data-plat="<?= esc($motor['plat_nomor']) ?>"
                                                data-merk="<?= esc($motor['merk']) ?>"
                                                data-tipe="<?= esc($motor['tipe']) ?>"
                                                data-harga="<?= $motor['harga_jual'] ?>"
                                                data-foto="<?= !empty($motor['foto']) ? base_url('uploads/motorcycles/' . $motor['foto']) : '' ?>"
                                                <?= (isset($_GET['motor_id']) && $_GET['motor_id'] == $motor['id']) ? 'selected' : '' ?>>
                                            <?= esc($motor['plat_nomor']) ?> - <?= esc($motor['merk']) ?> <?= esc($motor['tipe']) ?> (Rp <?= number_format($motor['harga_jual'], 0, ',', '.') ?>)
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Detail Motor</label>
                            <div class="alert alert-info" id="detailMotor">
                                <small>Pilih motor untuk melihat detail</small>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_pembeli">Nama Pembeli <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" 
                                   value="<?= old('nama_pembeli') ?>" placeholder="Nama lengkap pembeli" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_hp_pembeli">No HP Pembeli <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="no_hp_pembeli" name="no_hp_pembeli" 
                                   value="<?= old('no_hp_pembeli') ?>" placeholder="0812xxxxxxxx" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="harga_akhir">Harga Akhir <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="harga_akhir" name="harga_akhir" 
                                   value="<?= old('harga_akhir') ?>" placeholder="Harga final setelah negosiasi" required>
                            <small class="text-muted">Masukkan harga final setelah negosiasi (jika ada)</small>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Yakin ingin memproses transaksi ini?')">
                        <i class="iconly-boldBag-2"></i> Proses Transaksi
                    </button>
                    <a href="<?= base_url('kasir/motor') ?>" class="btn btn-secondary">
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
    document.getElementById('motorcycle_id').addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const detailDiv = document.getElementById('detailMotor');
        const hargaInput = document.getElementById('harga_akhir');

        if (this.value) {
            const plat = selected.getAttribute('data-plat');
            const merk = selected.getAttribute('data-merk');
            const tipe = selected.getAttribute('data-tipe');
            const harga = selected.getAttribute('data-harga');            const foto = selected.getAttribute('data-foto');
            const hasFoto = foto && foto.trim().length > 0;
            const imageHtml = hasFoto
                ? `<div class="mb-2 text-center"><img src="${foto}" alt="Foto Motor" class="img-fluid rounded" style="max-height: 200px; object-fit: cover;"></div>`
                : '';

            detailDiv.innerHTML = `
                ${imageHtml}
                <strong>${plat}</strong><br>
                ${merk} ${tipe}<br>
                <span class="text-success">Harga: Rp ${parseInt(harga).toLocaleString('id-ID')}</span>
                ${hasFoto ? '' : '<div class="mt-2 small text-muted"><i class="iconly-boldImage"></i> Foto motor tidak tersedia</div>'}
            `;
            
            // Auto fill harga akhir dengan harga jual
            if (!hargaInput.value) {
                hargaInput.value = harga;
            }
        } else {
            detailDiv.innerHTML = '<small>Pilih motor untuk melihat detail</small>';
            hargaInput.value = '';
        }
    });

    // Trigger change jika ada motor yang sudah dipilih (dari URL parameter)
    if (document.getElementById('motorcycle_id').value) {
        document.getElementById('motorcycle_id').dispatchEvent(new Event('change'));
    }

    // Format number input
    document.getElementById('harga_akhir').addEventListener('blur', function() {
        if (this.value) {
            const numValue = this.value.replace(/[^0-9]/g, '');
            this.value = numValue;
        }
    });
</script>
<?= $this->endSection() ?>
