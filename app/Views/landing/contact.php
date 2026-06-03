<?= $this->extend('layouts/landing') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section" style="min-height: 400px;">
    <div class="hero-overlay"></div>
    <div class="hero-container">
        <h1 class="hero-title" style="font-size: 3rem;">Hubungi Kami</h1>
        <p class="hero-subtitle">Kami siap membantu Anda menemukan motor impian</p>
    </div>
</section>

<!-- Contact Section -->
<section class="section" style="background: #f8f9fa;">
    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
            <div style="background: #d4edda; border-left: 4px solid #28a745; padding: 1.5rem; border-radius: 10px; margin-bottom: 2rem; color: #155724;">
                <i class="bi bi-check-circle" style="font-size: 1.5rem; margin-right: 0.5rem;"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <div style="background: #f8d7da; border-left: 4px solid #dc3545; padding: 1.5rem; border-radius: 10px; margin-bottom: 2rem; color: #721c24;">
                <i class="bi bi-exclamation-circle" style="font-size: 1.5rem; margin-right: 0.5rem;"></i>
                <ul style="margin: 0; padding-left: 1.5rem;">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; margin-bottom: 3rem;">
            <!-- Contact Form -->
            <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
                <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1.5rem; color: #1e1e2d;">Kirim Pesan</h2>
                <p style="color: #666; margin-bottom: 2rem;">Isi formulir di bawah ini dan kami akan segera menghubungi Anda</p>
                
                <form action="<?= base_url('/contact/submit') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Nama Lengkap</label>
                        <input type="text" name="name" required
                               value="<?= old('name') ?>"
                               placeholder="Masukkan nama Anda"
                               style="width: 100%; padding: 1rem; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 1rem; transition: all 0.3s;"
                               onfocus="this.style.borderColor='#435ebe'"
                               onblur="this.style.borderColor='#e0e0e0'">
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Email</label>
                        <input type="email" name="email" required
                               value="<?= old('email') ?>"
                               placeholder="email@example.com"
                               style="width: 100%; padding: 1rem; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 1rem; transition: all 0.3s;"
                               onfocus="this.style.borderColor='#435ebe'"
                               onblur="this.style.borderColor='#e0e0e0'">
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Nomor Telepon (Opsional)</label>
                        <input type="tel" name="phone"
                               value="<?= old('phone') ?>"
                               placeholder="08123456789"
                               style="width: 100%; padding: 1rem; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 1rem; transition: all 0.3s;"
                               onfocus="this.style.borderColor='#435ebe'"
                               onblur="this.style.borderColor='#e0e0e0'">
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Pesan</label>
                        <textarea name="message" required rows="6"
                                  placeholder="Tuliskan pesan atau pertanyaan Anda..."
                                  style="width: 100%; padding: 1rem; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 1rem; resize: vertical; transition: all 0.3s;"
                                  onfocus="this.style.borderColor='#435ebe'"
                                  onblur="this.style.borderColor='#e0e0e0'"><?= old('message') ?></textarea>
                    </div>

                    <button type="submit"
                            style="width: 100%; background: #435ebe; color: white; padding: 1.2rem; border: none; border-radius: 10px; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: all 0.3s;"
                            onmouseover="this.style.background='#364a99'; this.style.transform='translateY(-2px)'"
                            onmouseout="this.style.background='#435ebe'; this.style.transform=''">
                        <i class="bi bi-send"></i> Kirim Pesan
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div>
                <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); margin-bottom: 2rem;">
                    <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 2rem; color: #1e1e2d;">Informasi Kontak</h2>
                    
                    <div style="display: grid; gap: 2rem;">
                        <div style="display: flex; gap: 1.5rem; align-items: start;">
                            <div style="background: #e7f3ff; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-geo-alt" style="font-size: 1.8rem; color: #435ebe; margin-left: -10px; margin-top: -15px;"></i>
                            </div>
                            <div>
                                <h3 style="font-weight: 700; margin-bottom: 0.5rem; color: #1e1e2d;">Alamat</h3>
                                <p style="color: #666; line-height: 1.6;">Jl. Raya Motor No. 123<br>Jakarta Selatan, 12345<br>Indonesia</p>
                            </div>
                        </div>

                        <div style="display: flex; gap: 1.5rem; align-items: start;">
                            <div style="background: #e7f3ff; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-telephone" style="font-size: 1.8rem; color: #435ebe; margin-left: -10px; margin-top: -15px;"></i>
                            </div>
                            <div>
                                <h3 style="font-weight: 700; margin-bottom: 0.5rem; color: #1e1e2d;">Telepon</h3>
                                <p style="color: #666; line-height: 1.6;">
                                    <a href="tel:+6281234567890" style="color: #435ebe; text-decoration: none;">+62 812 3456 7890</a><br>
                                    <a href="tel:+622112345678" style="color: #435ebe; text-decoration: none;">+62 21 1234 5678</a>
                                </p>
                            </div>
                        </div>

                        <div style="display: flex; gap: 1.5rem; align-items: start;">
                            <div style="background: #e7f3ff; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-envelope" style="font-size: 1.8rem; color: #435ebe; margin-left: -10px; margin-top: -15px;"></i>
                            </div>
                            <div>
                                <h3 style="font-weight: 700; margin-bottom: 0.5rem; color: #1e1e2d;">Email</h3>
                                <p style="color: #666; line-height: 1.6;">
                                    <a href="mailto:info@santanamotor.com" style="color: #435ebe; text-decoration: none;">info@santanamotor.com</a><br>
                                    <a href="mailto:sales@santanamotor.com" style="color: #435ebe; text-decoration: none;">sales@santanamotor.com</a>
                                </p>
                            </div>
                        </div>

                        <div style="display: flex; gap: 1.5rem; align-items: start;">
                            <div style="background: #e7f3ff; width: 60px; height: 60px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-clock" style="font-size: 1.8rem; color: #435ebe; margin-left: -10px; margin-top: -15px;"></i>
                            </div>
                            <div>
                                <h3 style="font-weight: 700; margin-bottom: 0.5rem; color: #1e1e2d;">Jam Operasional</h3>
                                <p style="color: #666; line-height: 1.6;">
                                    Senin - Jumat: 08:00 - 17:00<br>
                                    Sabtu: 08:00 - 15:00<br>
                                    Minggu: Tutup
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 2.5rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); color: white;">
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">Hubungi Kami Langsung</h3>
                    <div style="display: grid; gap: 1rem;">
                        <a href="https://wa.me/6281234567890" target="_blank"
                           style="display: flex; align-items: center; gap: 1.5rem; background: rgba(255,255,255,0.2); padding: 1.5rem; border-radius: 10px; color: white; text-decoration: none; transition: all 0.3s;"
                           onmouseover="this.style.background='rgba(255,255,255,0.3)'"
                           onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                            <i class="bi bi-whatsapp" style="font-size: 2rem; margin-left: -10px; margin-top: -15px;"></i>
                            <span style="font-weight: 600;">Chat via WhatsApp</span>
                        </a>
                        <a href="tel:+6281234567890"
                           style="display: flex; align-items: center; gap: 1.5rem; background: rgba(255,255,255,0.2); padding: 1.5rem; border-radius: 10px; color: white; text-decoration: none; transition: all 0.3s;"
                           onmouseover="this.style.background='rgba(255,255,255,0.3)'"
                           onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                            <i class="bi bi-telephone" style="font-size: 2rem; margin-left: -10px; margin-top: -15px;"></i>
                            <span style="font-weight: 600;">Telepon Sekarang</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div style="background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
            <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1.5rem; color: #1e1e2d; text-align: center;">Lokasi Kami</h2>
            <div style="width: 100%; height: 450px; background: #f0f0f0; border-radius: 15px; overflow: hidden;">
                <!-- Google Maps Embed - Ganti dengan koordinat sebenarnya -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5491.827574504839!2d108.58486107499714!3d-6.973435893027264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f122734468ef9%3A0x620b967d6c28aa8c!2sSantana%20Motor!5e1!3m2!1sen!2sid!4v1767925265712!5m2!1sen!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('extra_css') ?>
<style>
    @media (max-width: 768px) {
        .container > div:first-child {
            grid-template-columns: 1fr !important;
        }
    }
</style>
<?= $this->endSection() ?>
