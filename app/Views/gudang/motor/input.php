<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Input Motor Masuk</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('gudang/motor/masuk') ?>" method="POST" enctype="multipart/form-data" id="inputForm">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="plat_nomor">Plat Nomor <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="plat_nomor" name="plat_nomor"
                                value="<?= old('plat_nomor') ?>" placeholder="Contoh: B 1234 XYZ" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="merk">Merk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="merk" name="merk"
                                value="<?= old('merk') ?>" placeholder="Contoh: Honda, Yamaha, Suzuki" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="tipe">Tipe <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tipe" name="tipe"
                                value="<?= old('tipe') ?>" placeholder="Contoh: Beat, Vario, Mio" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="warna">Warna <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="warna" name="warna"
                                value="<?= old('warna') ?>" placeholder="Contoh: Merah, Hitam" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="tahun">Tahun <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="tahun" name="tahun"
                                value="<?= old('tahun') ?>" placeholder="Contoh: 2020" min="1900" max="<?= date('Y') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="harga_beli">Harga Beli <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                                value="<?= old('harga_beli') ?>" placeholder="Contoh: 10000000" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual"
                                value="<?= old('harga_jual') ?>" placeholder="Contoh: 12000000" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="sumber_pembelian">Sumber Pembelian</label>
                            <input type="text" class="form-control" id="sumber_pembelian" name="sumber_pembelian"
                                value="<?= old('sumber_pembelian') ?>" placeholder="Contoh: Lelang, Dealer, Perorangan">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="foto">Foto Motor <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="foto" name="foto"
                                accept="image/jpeg,image/jpg,image/png,image/gif" required>
                            <small class="text-muted">Format: JPG, JPEG, PNG, GIF (Max 5MB)</small>
                            <div id="preview-foto" class="mt-2"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <button type="button" class="btn btn-primary" onclick="submitInput()">
                        <i class="iconly-boldTicket-Star"></i> Simpan
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

    function submitInput() {
        Swal.fire({
            title: 'Input Data Motor',
            text: 'Apakah data motor sudah benar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Proses',
            cancelButtonText: 'Batal',
            confirmButtonColor: 'rgba(51, 105, 221, 1)'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('inputForm').submit();
            }
        });
    }
</script>
<?= $this->endSection() ?>