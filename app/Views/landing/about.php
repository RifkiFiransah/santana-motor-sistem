<?= $this->extend('layouts/landing') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section" style="min-height: 400px;">
    <div class="hero-overlay"></div>
    <div class="hero-container">
        <h1 class="hero-title" style="font-size: 3rem;">Tentang Kami</h1>
        <p class="hero-subtitle">Lebih dari sekadar dealer motor</p>
    </div>
</section>

<!-- About Content -->
<section class="section" style="background: white;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; margin-bottom: 5rem;">
            <div>
                <h2 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1.5rem; color: #1e1e2d;">Sejarah Kami</h2>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #666; margin-bottom: 1.5rem;">
                    Santana Motor didirikan dengan visi untuk menjadi dealer motor terpercaya dan terkemuka di Indonesia. Berawal dari sebuah showroom kecil, kini kami telah melayani ribuan pelanggan dengan berbagai pilihan motor berkualitas.
                </p>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #666; margin-bottom: 1.5rem;">
                    Dengan pengalaman lebih dari 10 tahun di industri otomotif, kami memahami kebutuhan setiap pelanggan dan berkomitmen untuk memberikan solusi terbaik.
                </p>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #666;">
                    Kepercayaan pelanggan adalah aset terbesar kami. Setiap motor yang kami jual telah melewati pemeriksaan kualitas yang ketat untuk memastikan kepuasan Anda.
                </p>
            </div>
            <div style="position: relative;">
                <div style="width: 100%; height: 400px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.2);">
                    <img src="<?= base_url('assets/static/images/logo/santana-logo.png') ?>"
                        alt="Santana Motor Showroom"
                        style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="section" style="background: #f8f9fa;">
    <div class="container">
        <h2 class="section-title">Nilai-Nilai Kami</h2>
        <p class="section-subtitle">Prinsip yang memandu setiap langkah kami</p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            <div style="background: white; padding: 2.5rem; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); text-align: center; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.15)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.08)'">
                <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #1e1e2d;">Integritas</h3>
                <p style="color: #666; line-height: 1.8;">
                    Kami beroperasi dengan transparansi penuh dan kejujuran dalam setiap transaksi dengan pelanggan.
                </p>
            </div>

            <div style="background: white; padding: 2.5rem; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); text-align: center; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.15)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.08)'">
                <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #1e1e2d;">Kualitas</h3>
                <p style="color: #666; line-height: 1.8;">
                    Setiap motor dipilih dengan cermat dan melewati inspeksi ketat untuk memastikan standar kualitas tertinggi.
                </p>
            </div>
            <div style="background: white; padding: 2.5rem; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); text-align: center; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.15)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.08)'">
                <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #1e1e2d;">Kepuasan Pelanggan</h3>
                <p style="color: #666; line-height: 1.8;">
                    Prioritas utama kami adalah memastikan setiap pelanggan puas dengan pembelian dan layanan mereka.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="section" style="background: #f8f9fa;">
    <div class="container">
        <h2 class="section-title">Mengapa Memilih Kami?</h2>
        <p class="section-subtitle">Keunggulan yang membuat kami berbeda</p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                <div style="background: #e7f3ff; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; padding: 0;">
                    <i class="bi bi-check-circle" style="font-size: 2rem; color: #435ebe; line-height: 0; display: block; margin-left: -10px; margin-top: -15px;"></i>
                </div>
                <h3 style="font-size: 1.2rem; font-weight: 700; margin-bottom: 1rem; color: #1e1e2d;">Motor Berkualitas</h3>
                <p style="color: #666; line-height: 1.8;">Semua motor telah melewati inspeksi menyeluruh dan bergaransi</p>
            </div>

            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                <div style="background: #e7f3ff; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; padding: 0;">
                    <i class="bi bi-cash-coin" style="font-size: 2rem; color: #435ebe; line-height: 0; display: block; margin-left: -10px; margin-top: -15px;"></i>
                </div>
                <h3 style="font-size: 1.2rem; font-weight: 700; margin-bottom: 1rem; color: #1e1e2d;">Harga Kompetitif</h3>
                <p style="color: #666; line-height: 1.8;">Harga terbaik di pasaran dengan kualitas yang tidak diragukan</p>
            </div>

            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                <div style="background: #e7f3ff; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; padding: 0;">
                    <i class="bi bi-credit-card" style="font-size: 2rem; color: #435ebe; line-height: 0; display: block; margin-left: -10px; margin-top: -15px;"></i>
                </div>
                <h3 style="font-size: 1.2rem; font-weight: 700; margin-bottom: 1rem; color: #1e1e2d;">Proses Mudah</h3>
                <p style="color: #666; line-height: 1.8;">Proses pembelian yang cepat, mudah, dan tanpa ribet</p>
            </div>

            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                <div style="background: #e7f3ff; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; padding: 0;">
                    <i class="bi bi-headset" style="font-size: 2rem; color: #435ebe; line-height: 0; display: block; margin-left: -10px; margin-top: -15px;"></i>
                </div>
                <h3 style="font-size: 1.2rem; font-weight: 700; margin-bottom: 1rem; color: #1e1e2d;">Layanan Prima</h3>
                <p style="color: #666; line-height: 1.8;">Dukungan pelanggan yang responsif dan profesional</p>
            </div>

            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                <div style="background: #e7f3ff; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; padding: 0;">
                    <i class="bi bi-file-earmark-check" style="font-size: 2rem; color: #435ebe; line-height: 0; display: block; margin-left: -10px; margin-top: -15px;"></i>
                </div>
                <h3 style="font-size: 1.2rem; font-weight: 700; margin-bottom: 1rem; color: #1e1e2d;">Dokumen Lengkap</h3>
                <p style="color: #666; line-height: 1.8;">Semua dokumen motor lengkap dan legal</p>
            </div>

            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                <div style="background: #e7f3ff; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; padding: 0;">
                    <i class="bi bi-truck" style="font-size: 2rem; color: #435ebe; line-height: 0; display: block; margin-left: -10px; margin-top: -15px;"></i>
                </div>
                <h3 style="font-size: 1.2rem; font-weight: 700; margin-bottom: 1rem; color: #1e1e2d;">Test Drive</h3>
                <p style="color: #666; line-height: 1.8;">Fasilitas test drive untuk memastikan pilihan Anda tepat</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-align: center;">
    <div class="container">
        <h2 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem;">Siap Bergabung dengan Ribuan Pelanggan Puas Kami?</h2>
        <p style="font-size: 1.2rem; margin-bottom: 2rem; opacity: 0.95;">Kunjungi showroom kami atau hubungi tim kami untuk informasi lebih lanjut</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="<?= base_url('/catalog') ?>"
                style="display: inline-block; background: white; color: #435ebe; padding: 1rem 3rem; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 1.1rem; transition: all 0.3s;"
                onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.3)'"
                onmouseout="this.style.transform=''; this.style.boxShadow=''">
                Lihat Katalog <i class="bi bi-arrow-right"></i>
            </a>
            <a href="<?= base_url('/contact') ?>"
                style="display: inline-block; background: transparent; color: white; border: 2px solid white; padding: 1rem 3rem; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 1.1rem; transition: all 0.3s;"
                onmouseover="this.style.background='white'; this.style.color='#435ebe'"
                onmouseout="this.style.background='transparent'; this.style.color='white'">
                Hubungi Kami <i class="bi bi-telephone"></i>
            </a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('extra_css') ?>
<style>
    @media (max-width: 768px) {
        .container>div {
            grid-template-columns: 1fr !important;
        }
    }
</style>
<?= $this->endSection() ?>