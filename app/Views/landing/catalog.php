<?= $this->extend('layouts/landing') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section" style="min-height: 400px;">
    <div class="hero-overlay"></div>
    <div class="hero-container">
        <h1 class="hero-title" style="font-size: 3rem;">Katalog Motor</h1>
        <p class="hero-subtitle">Jelajahi koleksi motor terlengkap kami</p>
    </div>
</section>

<!-- Catalog Section -->
<section class="section" style="background: #f8f9fa; padding-top: 3rem;">
    <div class="container">
        <!-- Filter Section -->
        <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); margin-bottom: 3rem;">
            <form action="<?= base_url('/catalog') ?>" method="GET">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Cari Motor</label>
                        <input type="text" name="search" value="<?= $search ?? '' ?>" 
                               placeholder="Merk, tipe, warna..." 
                               style="width: 100%; padding: 0.8rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; transition: all 0.3s;"
                               onfocus="this.style.borderColor='#435ebe'"
                               onblur="this.style.borderColor='#e0e0e0'">
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Merk</label>
                        <select name="merk" 
                                style="width: 100%; padding: 0.8rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; transition: all 0.3s;"
                                onfocus="this.style.borderColor='#435ebe'"
                                onblur="this.style.borderColor='#e0e0e0'">
                            <option value="">Semua Merk</option>
                            <?php if (!empty($merks)): ?>
                                <?php foreach ($merks as $m): ?>
                                    <option value="<?= esc($m['merk']) ?>" <?= ($merk ?? '') === $m['merk'] ? 'selected' : '' ?>>
                                        <?= esc($m['merk']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Tahun</label>
                        <select name="tahun" 
                                style="width: 100%; padding: 0.8rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; transition: all 0.3s;"
                                onfocus="this.style.borderColor='#435ebe'"
                                onblur="this.style.borderColor='#e0e0e0'">
                            <option value="">Semua Tahun</option>
                            <?php if (!empty($tahuns)): ?>
                                <?php foreach ($tahuns as $t): ?>
                                    <option value="<?= esc($t['tahun']) ?>" <?= ($tahun ?? '') === $t['tahun'] ? 'selected' : '' ?>>
                                        <?= esc($t['tahun']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <button type="submit" 
                            style="background: #435ebe; color: white; padding: 0.8rem 2rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s;"
                            onmouseover="this.style.background='#364a99'"
                            onmouseout="this.style.background='#435ebe'">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    <a href="<?= base_url('/catalog') ?>" 
                       style="background: #6c757d; color: white; padding: 0.8rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s; display: inline-block;"
                       onmouseover="this.style.background='#5a6268'"
                       onmouseout="this.style.background='#6c757d'">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Results Info -->
        <?php if (!empty($search) || !empty($merk) || !empty($tahun)): ?>
            <div style="margin-bottom: 2rem; padding: 1rem; background: #e7f3ff; border-left: 4px solid #435ebe; border-radius: 8px;">
                <strong>Filter aktif:</strong>
                <?php if (!empty($search)): ?>
                    <span style="display: inline-block; background: white; padding: 0.3rem 0.8rem; border-radius: 5px; margin-left: 0.5rem;">
                        Pencarian: <?= esc($search) ?>
                    </span>
                <?php endif; ?>
                <?php if (!empty($merk)): ?>
                    <span style="display: inline-block; background: white; padding: 0.3rem 0.8rem; border-radius: 5px; margin-left: 0.5rem;">
                        Merk: <?= esc($merk) ?>
                    </span>
                <?php endif; ?>
                <?php if (!empty($tahun)): ?>
                    <span style="display: inline-block; background: white; padding: 0.3rem 0.8rem; border-radius: 5px; margin-left: 0.5rem;">
                        Tahun: <?= esc($tahun) ?>
                    </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Motors Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
            <?php if (!empty($motors)): ?>
                <?php foreach ($motors as $motor): ?>
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
                <div style="grid-column: 1/-1; text-align: center; padding: 4rem; background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                    <i class="bi bi-inbox" style="font-size: 5rem; opacity: 0.3; color: #666;"></i>
                    <p style="margin-top: 1.5rem; font-size: 1.2rem; color: #666;">
                        <?php if (!empty($search) || !empty($merk) || !empty($tahun)): ?>
                            Tidak ada motor yang sesuai dengan filter Anda
                        <?php else: ?>
                            Belum ada motor tersedia
                        <?php endif; ?>
                    </p>
                    <a href="<?= base_url('/catalog') ?>" 
                       style="display: inline-block; margin-top: 1rem; color: #435ebe; text-decoration: none; font-weight: 600;">
                        Reset Filter
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
