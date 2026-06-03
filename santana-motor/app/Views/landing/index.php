<?= $this->extend('layouts/landing') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section">
  <div class="hero-overlay"></div>
  <div class="hero-container">
    <h1 class="hero-title">Motor Impian Anda<br>Ada di Sini</h1>
    <p class="hero-subtitle">Temukan berbagai pilihan motor berkualitas dengan harga terbaik dan pelayanan terpercaya</p>
    <div class="hero-buttons">
      <a href="<?= base_url('/catalog') ?>" class="btn-hero btn-primary-hero">Lihat Katalog</a>
      <a href="<?= base_url('/contact') ?>" class="btn-hero btn-secondary-hero">Hubungi Kami</a>
    </div>
  </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
  <div class="stats-container">
    <div class="stat-item">
      <div class="stat-number">20+</div>
      <div class="stat-label">Motor Tersedia</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">5+</div>
      <div class="stat-label">Merk Tersedia</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">100%</div>
      <div class="stat-label">Terpercaya</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">999+</div>
      <div class="stat-label">Pelanggan Puas</div>
    </div>
  </div>
</section>

<!-- Featured Motors Section -->
<section class="section" style="background: #f8f9fa;">
  <div class="container">
    <h2 class="section-title">Motor Pilihan Kami</h2>
    <p class="section-subtitle">Koleksi motor terbaru dan terlengkap dengan kualitas terjamin</p>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 2rem;">
      <?php if (!empty($featured_motors)): ?>
        <?php foreach (array_slice($featured_motors, 0, 8) as $motor): ?>
          <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.15)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.08)'">
            <?php if (!empty($motor['foto'])): ?>
              <div style="height: 200px; overflow: hidden; background: #f0f0f0;">
                <img src="<?= base_url('uploads/motorcycles/' . $motor['foto']) ?>"
                  alt="<?= esc($motor['merk'] . ' ' . $motor['tipe']) ?>"
                  style="width: 100%; height: 100%; object-fit: cover;">
              </div>
            <?php else: ?>
              <div style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                <i class="bi bi-bicycle"></i>
              </div>
            <?php endif; ?>

            <div style="padding: 1.5rem;">
              <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                <div>
                  <span style="background: #e7f3ff; color: #435ebe; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600;"><?= esc($motor['plat_nomor']) ?></span>
                </div>
                <span style="background: #d4edda; color: #155724; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">Tersedia</span>
              </div>

              <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 0.5rem; color: #1e1e2d;">
                <?= esc($motor['merk']) ?> <?= esc($motor['tipe']) ?>
              </h3>

              <div style="display: flex; gap: 0.5rem; margin-bottom: 1rem; flex-wrap: wrap;">
                <span style="background: #f8f9fa; padding: 0.3rem 0.8rem; border-radius: 5px; font-size: 0.85rem; color: #666;">
                  <i class="bi bi-palette"></i> <?= esc($motor['warna']) ?>
                </span>
                <span style="background: #f8f9fa; padding: 0.3rem 0.8rem; border-radius: 5px; font-size: 0.85rem; color: #666;">
                  <i class="bi bi-calendar"></i> <?= esc($motor['tahun']) ?>
                </span>
              </div>

              <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem;">
                <div style="font-size: 1.5rem; font-weight: 800; color: #28a745;">
                  Rp <?= number_format($motor['harga_jual'], 0, ',', '.') ?>
                </div>
                <a href="<?= base_url('/motor/' . $motor['id']) ?>"
                  style="background: #435ebe; color: white; padding: 0.6rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s;"
                  onmouseover="this.style.background='#364a99'"
                  onmouseout="this.style.background='#435ebe'">
                  Detail
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div style="grid-column: 1/-1; text-align: center; padding: 3rem; color: #666;">
          <i class="bi bi-inbox" style="font-size: 4rem; opacity: 0.3;"></i>
          <p style="margin-top: 1rem; font-size: 1.1rem;">Belum ada motor tersedia</p>
        </div>
      <?php endif; ?>
    </div>

    <?php if (!empty($featured_motors) && count($featured_motors) > 0): ?>
      <div style="text-align: center; margin-top: 3rem;">
        <a href="<?= base_url('/catalog') ?>"
          style="display: inline-block; background: #435ebe; color: white; padding: 1rem 3rem; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 1.1rem; transition: all 0.3s;"
          onmouseover="this.style.background='#364a99'; this.style.transform='translateY(-3px)'"
          onmouseout="this.style.background='#435ebe'; this.style.transform=''">
          Lihat Semua Motor <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- About Section -->
<section class="section" id="about">
  <div class="container">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;">
      <div style="position: relative;">
        <div style="width: 100%; height: 500px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.2);">
          <img src="<?= base_url('assets/static/images/logo/santana-logo.png') ?>"
            alt="Santana Motor"
            style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8;">
        </div>
        <div style="position: absolute; bottom: -30px; right: -30px; background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.15);">
          <div style="font-size: 3rem; font-weight: 800; color: #435ebe;">10+</div>
          <div style="font-weight: 600; color: #666;">Tahun Berpengalaman</div>
        </div>
      </div>

      <div>
        <h2 class="section-title" style="text-align: left;">Tentang Kami</h2>
        <p style="font-size: 1.1rem; line-height: 1.8; color: #666; margin-bottom: 2rem;">
          Santana Motor adalah dealer motor terpercaya yang telah melayani ribuan pelanggan dengan koleksi motor berkualitas dan harga terbaik. Kami berkomitmen untuk memberikan pelayanan terbaik dan motor yang sesuai dengan kebutuhan Anda.
        </p>
        <div style="display: grid; gap: 1.5rem; margin-bottom: 2rem;">
          <div style="display: flex; gap: 1rem; align-items: start;">
            <div style="background: #e7f3ff; width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; padding: 0;">
              <i class="bi bi-check-circle" style="font-size: 1.5rem; color: #435ebe; line-height: 0; display: block;"></i>
            </div>
            <div>
              <h4 style="font-weight: 700; margin-bottom: 0.5rem;">Motor Berkualitas</h4>
              <p style="color: #666;">Semua motor telah melewati pengecekan kualitas yang ketat</p>
            </div>
          </div>
          <div style="display: flex; gap: 1rem; align-items: start;">
            <div style="background: #e7f3ff; width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; padding: 0;">
              <i class="bi bi-shield-check" style="font-size: 1.5rem; color: #435ebe; line-height: 0; display: block;"></i>
            </div>
            <div>
              <h4 style="font-weight: 700; margin-bottom: 0.5rem;">Terpercaya</h4>
              <p style="color: #666;">Pelayanan profesional dan transparan untuk kepuasan Anda</p>
            </div>
          </div>
          <div style="display: flex; gap: 1rem; align-items: start;">
            <div style="background: #e7f3ff; width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; padding: 0;">
              <i class="bi bi-cash-stack" style="font-size: 1.5rem; color: #435ebe; line-height: 0; display: block;"></i>
            </div>
            <div>
              <h4 style="font-weight: 700; margin-bottom: 0.5rem;">Harga Terbaik</h4>
              <p style="color: #666;">Kami menawarkan harga kompetitif dengan kualitas terjamin</p>
            </div>
          </div>
        </div>
        <a href="<?= base_url('/about') ?>"
          style="display: inline-block; background: #435ebe; color: white; padding: 1rem 2rem; border-radius: 10px; text-decoration: none; font-weight: 600; transition: all 0.3s;"
          onmouseover="this.style.background='#364a99'"
          onmouseout="this.style.background='#435ebe'">
          Selengkapnya <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-align: center;">
  <div class="container">
    <h2 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem;">Siap Menemukan Motor Impian Anda?</h2>
    <p style="font-size: 1.2rem; margin-bottom: 2rem; opacity: 0.95;">Hubungi kami sekarang untuk informasi lebih lanjut dan dapatkan penawaran terbaik</p>
    <a href="<?= base_url('/contact') ?>"
      style="display: inline-block; background: white; color: #435ebe; padding: 1rem 3rem; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 1.1rem; transition: all 0.3s;"
      onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.3)'"
      onmouseout="this.style.transform=''; this.style.boxShadow=''">
      Hubungi Kami Sekarang <i class="bi bi-whatsapp"></i>
    </a>
  </div>
</section>

<?= $this->endSection() ?>