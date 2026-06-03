<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Santana Motor' ?> - Jual Beli Motor Berkualitas</title>
    <meta name="description" content="Santana Motor - Dealer motor terpercaya dengan koleksi motor berkualitas dan harga terbaik">

    <!-- Mazer CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/app-dark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/iconly.css') ?>">

    <link rel="shortcut icon" href="<?= base_url('assets/static/images/logo/santana-logo.png') ?>" type="image/png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Santana Motor">
    <link rel="apple-touch-icon" href="<?= base_url('assets/static/images/logo/santana-logo.png') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- PWA Manifest -->
    <link rel="manifest" href="<?= base_url('manifest.json') ?>">
    <meta name="theme-color" content="#2E7D32">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Santana Motor">
    <link rel="apple-touch-icon" href="<?= base_url('assets/static/images/logo/santana-logo.png') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Landing Page CSS -->
    <style>
        :root {
            --primary-color: #435ebe;
            --secondary-color: #6c757d;
            --dark-color: #1e1e2d;
            --light-color: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        /* Navigation */
        .landing-navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .landing-navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 30px rgba(0, 0, 0, 0.15);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0.8rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .logo-section .brand-logos {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding-right: 1.2rem;
            border-right: 2px solid #e0e0e0;
        }

        .logo-section .brand-logos img {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-color);
            text-decoration: none;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo img.logo-icon {
            height: 35px;
            width: auto;
            object-fit: contain;
        }

        .logo span {
            white-space: nowrap;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-menu a {
            color: #333;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
            font-size: 0.95rem;
        }

        .nav-menu a:hover {
            color: var(--primary-color);
        }

        .btn-login {
            background: var(--primary-color);
            color: white !important;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background: #364a99;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 94, 190, 0.3);
        }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--primary-color);
        }

        /* Hero Section */
        .hero-section {
            margin-top: 80px;
            min-height: 600px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('<?= base_url('assets/static/images/bg/hero-pattern.svg') ?>') center/cover;
            opacity: 0.1;
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
            position: relative;
            z-index: 1;
            text-align: center;
            color: white;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            font-weight: 300;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-hero {
            padding: 1rem 2.5rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-block;
            font-size: 1rem;
        }

        .btn-primary-hero {
            background: white;
            color: var(--primary-color);
        }

        .btn-primary-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary-hero {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-secondary-hero:hover {
            background: white;
            color: var(--primary-color);
        }

        /* Stats Section */
        .stats-section {
            background: white;
            padding: 3rem 2rem;
            box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.05);
        }

        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            text-align: center;
        }

        .stat-item {
            padding: 1rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            color: #666;
            font-weight: 600;
        }

        /* Section Common Styles */
        .section {
            padding: 5rem 2rem;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Footer */
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 3rem 2rem 1.5rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .footer-section p,
        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            line-height: 2;
            display: block;
        }

        .footer-section a:hover {
            color: white;
            padding-left: 5px;
            transition: all 0.3s;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            justify-content: center;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            font-size: 1.2rem;
        }

        .social-links a i {
            line-height: 1;
        }

        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .mobile-toggle {
                display: block;
            }

            .nav-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                padding: 2rem;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            }

            .nav-menu.active {
                display: flex;
            }

            .navbar-container {
                padding: 0.8rem 1rem;
            }

            .logo-section {
                gap: 0.8rem;
            }

            .logo-section .brand-logos {
                gap: 0.5rem;
                padding-right: 0.8rem;
            }

            .logo-section .brand-logos img {
                height: 28px;
            }

            .logo {
                font-size: 1.1rem;
            }

            .logo img.logo-icon {
                height: 25px;
            }

            .logo span {
                display: none;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .logo-section .brand-logos img {
                height: 24px;
            }

            .logo img.logo-icon {
                height: 22px;
            }
        }
    </style>

    <?= $this->renderSection('extra_css') ?>
</head>

<body>
    <!-- Navigation -->
    <nav class="landing-navbar" id="navbar">
        <div class="navbar-container">
            <div class="logo-section">
                <div class="brand-logos">
                    <img src="<?= base_url('assets/static/images/logo/fkom-uniku.png') ?>" alt="FKOM Universitas Kuningan" title="FKOM Universitas Kuningan">
                </div>
                <a href="<?= base_url('/') ?>" class="logo">
                    <img src="<?= base_url('assets/static/images/logo/santana-logo.png') ?>" alt="Santana Motor Logo" class="logo-icon" style="height: auto; width: 70px; object-fit: contain;">
                    <span>Santana Motor</span>
                </a>
            </div>
            <button class="mobile-toggle" onclick="toggleMenu()">
                <i class="bi bi-list"></i>
            </button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="<?= base_url('/') ?>">Home</a></li>
                <li><a href="<?= base_url('/catalog') ?>">Katalog</a></li>
                <li><a href="<?= base_url('/about') ?>">Tentang Kami</a></li>
                <li><a href="<?= base_url('/contact') ?>">Kontak</a></li>
                <li><a href="<?= base_url('login') ?>" class="btn-login">Login</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <?= $this->renderSection('content') ?>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <img src="<?= base_url('assets/static/images/logo/santana-logo.png') ?>" alt="Santana Motor" style="height: 50px; object-fit: contain;">
                    <h3 style="margin: 0;">Santana Motor</h3>
                </div>
                <p>Dealer motor terpercaya dengan koleksi motor berkualitas dan harga terbaik. Melayani dengan sepenuh hati untuk kepuasan pelanggan.</p>
                <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.2);">
                    <span style="font-size: 0.9rem; opacity: 0.8;">Didukung oleh:</span>
                    <img src="<?= base_url('assets/static/images/logo/fkom-uniku.png') ?>" alt="FKOM Uniku" style="height: 40px; object-fit: contain;">
                </div>
                <div class="social-links">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Link</h3>
                <a href="<?= base_url('/') ?>">Home</a>
                <a href="<?= base_url('/catalog') ?>">Katalog Motor</a>
                <a href="<?= base_url('/about') ?>">Tentang Kami</a>
                <a href="<?= base_url('/contact') ?>">Hubungi Kami</a>
            </div>
            <div class="footer-section">
                <h3>Kategori</h3>
                <a href="<?= base_url('/catalog?merk=Honda') ?>">Honda</a>
                <a href="<?= base_url('/catalog?merk=Yamaha') ?>">Yamaha</a>
                <a href="<?= base_url('/catalog?merk=Suzuki') ?>">Suzuki</a>
                <a href="<?= base_url('/catalog?merk=Kawasaki') ?>">Kawasaki</a>
            </div>
            <div class="footer-section">
                <h3>Kontak Kami</h3>
                <p><i class="bi bi-geo-alt"></i> Jl. Raya Motor No. 123, Jakarta</p>
                <p><i class="bi bi-telephone"></i> +62 812 3456 7890</p>
                <p><i class="bi bi-envelope"></i> info@santanamotor.com</p>
                <p><i class="bi bi-clock"></i> Senin - Sabtu: 08:00 - 17:00</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> Santana Motor. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        function toggleMenu() {
            const navMenu = document.getElementById('navMenu');
            navMenu.classList.toggle('active');
        }

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

    <?= $this->renderSection('extra_js') ?>

    <script src="<?= base_url('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('assets/compiled/js/bootstrap.bundle.min.js') ?>"></script>

    <script src="<?= base_url('assets/vendors/apexcharts/apexcharts.js') ?>"></script>
    <script src="<?= base_url('assets/compiled/js/pages/dashboard.js') ?>"></script>
    <script src="<?= base_url('assets/compiled/js/main.js') ?>"></script>
    <script>
        window.PWA_CONFIG = Object.assign({
            swUrl: '<?= base_url('service-worker.js') ?>',
            appName: 'Santana Motor'
        }, window.PWA_CONFIG || {});
    </script>
    <script src="<?= base_url('assets/compiled/js/pwa.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>