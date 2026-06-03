<?= $this->extend('layouts/landing') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section" style="min-height: 300px;">
    <div class="hero-overlay"></div>
    <div class="hero-container">
        <h1 class="hero-title" style="font-size: 3rem;">Detail Motor</h1>
    </div>
</section>

<!-- Detail Section -->
<section class="section" style="background: #f8f9fa; padding-top: 3rem;">
    <div class="container">
        <div style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.1); margin-bottom: 3rem;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0;">
                <!-- Image Section -->
                <div style="position: relative;">
                    <?php if (!empty($motor['foto'])): ?>
                        <img src="<?= base_url('uploads/motorcycles/' . $motor['foto']) ?>" 
                             alt="<?= esc($motor['merk'] . ' ' . $motor['tipe']) ?>" 
                             style="width: 100%; height: 100%; object-fit: cover; min-height: 500px;">
                    <?php else: ?>
                        <div style="width: 100%; height: 100%; min-height: 500px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 6rem;">
                            <i class="bi bi-bicycle"></i>
                        </div>
                    <?php endif; ?>
                    <div style="position: absolute; top: 20px; left: 20px;">
                        <span style="background: #d4edda; color: #155724; padding: 0.5rem 1rem; border-radius: 25px; font-size: 0.9rem; font-weight: 600; box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
                            Tersedia
                        </span>
                    </div>
                </div>

                <!-- Info Section -->
                <div style="padding: 3rem;">
                    <div style="margin-bottom: 2rem;">
                        <span style="background: #e7f3ff; color: #435ebe; padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.9rem; font-weight: 600;">
                            <?= esc($motor['plat_nomor']) ?>
                        </span>
                    </div>

                    <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; color: #1e1e2d;">
                        <?= esc($motor['merk']) ?> <?= esc($motor['tipe']) ?>
                    </h1>

                    <div style="font-size: 2.5rem; font-weight: 800; color: #28a745; margin-bottom: 2rem;">
                        Rp <?= number_format($motor['harga_jual'], 0, ',', '.') ?>
                    </div>

                    <div style="border-top: 2px solid #f0f0f0; padding-top: 2rem; margin-bottom: 2rem;">
                        <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 1.5rem; color: #1e1e2d;">Spesifikasi</h3>
                        <div style="display: grid; gap: 1rem;">
                            <div style="display: flex; justify-content: space-between; padding: 1rem; background: #f8f9fa; border-radius: 10px;">
                                <span style="font-weight: 600; color: #666;"><i class="bi bi-card-text"></i> Plat Nomor</span>
                                <span style="font-weight: 700; color: #1e1e2d;"><?= esc($motor['plat_nomor']) ?></span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 1rem; background: #f8f9fa; border-radius: 10px;">
                                <span style="font-weight: 600; color: #666;"><i class="bi bi-tag"></i> Merk</span>
                                <span style="font-weight: 700; color: #1e1e2d;"><?= esc($motor['merk']) ?></span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 1rem; background: #f8f9fa; border-radius: 10px;">
                                <span style="font-weight: 600; color: #666;"><i class="bi bi-bicycle"></i> Tipe</span>
                                <span style="font-weight: 700; color: #1e1e2d;"><?= esc($motor['tipe']) ?></span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 1rem; background: #f8f9fa; border-radius: 10px;">
                                <span style="font-weight: 600; color: #666;"><i class="bi bi-palette"></i> Warna</span>
                                <span style="font-weight: 700; color: #1e1e2d;"><?= esc($motor['warna']) ?></span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 1rem; background: #f8f9fa; border-radius: 10px;">
                                <span style="font-weight: 600; color: #666;"><i class="bi bi-calendar"></i> Tahun</span>
                                <span style="font-weight: 700; color: #1e1e2d;"><?= esc($motor['tahun']) ?></span>
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <a href="<?= base_url('/contact') ?>" 
                           style="flex: 1; min-width: 200px; background: #435ebe; color: white; padding: 1rem 2rem; border-radius: 10px; text-decoration: none; font-weight: 600; text-align: center; transition: all 0.3s;"
                           onmouseover="this.style.background='#364a99'; this.style.transform='translateY(-2px)'"
                           onmouseout="this.style.background='#435ebe'; this.style.transform=''">
                            <i class="bi bi-chat-dots"></i> Hubungi Kami
                        </a>
                        <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20motor%20<?= urlencode($motor['merk'] . ' ' . $motor['tipe']) ?>" 
                           target="_blank"
                           style="flex: 1; min-width: 200px; background: #25D366; color: white; padding: 1rem 2rem; border-radius: 10px; text-decoration: none; font-weight: 600; text-align: center; transition: all 0.3s;"
                           onmouseover="this.style.background='#20ba5a'; this.style.transform='translateY(-2px)'"
                           onmouseout="this.style.background='#25D366'; this.style.transform=''">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                    </div>

                    <div style="margin-top: 2rem; padding: 1.5rem; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 10px;">
                        <p style="margin: 0; color: #856404; font-weight: 600;">
                            <i class="bi bi-info-circle"></i> Hubungi kami untuk informasi lebih lanjut atau jadwalkan test drive
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Motors -->
        <?php if (!empty($related_motors)): ?>
            <div style="margin-top: 4rem;">
                <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 2rem; color: #1e1e2d; text-align: center;">Motor Terkait</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 2rem;">
                    <?php foreach ($related_motors as $related): ?>
                        <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.15)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.08)'">
                            <?php if (!empty($related['foto'])): ?>
                                <div style="height: 200px; overflow: hidden; background: #f0f0f0;">
                                    <img src="<?= base_url('uploads/motorcycles/' . $related['foto']) ?>" 
                                         alt="<?= esc($related['merk'] . ' ' . $related['tipe']) ?>" 
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            <?php else: ?>
                                <div style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                                    <i class="bi bi-bicycle"></i>
                                </div>
                            <?php endif; ?>
                            
                            <div style="padding: 1.5rem;">
                                <h3 style="font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem; color: #1e1e2d;">
                                    <?= esc($related['merk']) ?> <?= esc($related['tipe']) ?>
                                </h3>
                                
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem;">
                                    <div style="font-size: 1.3rem; font-weight: 800; color: #28a745;">
                                        Rp <?= number_format($related['harga_jual'], 0, ',', '.') ?>
                                    </div>
                                    <a href="<?= base_url('/motor/' . $related['id']) ?>" 
                                       style="background: #435ebe; color: white; padding: 0.5rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s;"
                                       onmouseover="this.style.background='#364a99'"
                                       onmouseout="this.style.background='#435ebe'">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <div style="text-align: center; margin-top: 3rem;">
            <a href="<?= base_url('/catalog') ?>" 
               style="display: inline-block; background: #6c757d; color: white; padding: 1rem 2.5rem; border-radius: 10px; text-decoration: none; font-weight: 600; transition: all 0.3s;"
               onmouseover="this.style.background='#5a6268'"
               onmouseout="this.style.background='#6c757d'">
                <i class="bi bi-arrow-left"></i> Kembali ke Katalog
            </a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('extra_css') ?>
<style>
    @media (max-width: 768px) {
        .container > div:first-child > div {
            grid-template-columns: 1fr !important;
        }
    }
</style>
<?= $this->endSection() ?>
