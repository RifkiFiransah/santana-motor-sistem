<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div id="auth">
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <img src="<?= base_url('assets/static/images/logo/santana-logo.png') ?>" alt="Santana Motor Logo" style="width: 100px; height: auto;">
                <img src="<?= base_url('assets/static/images/logo/fkom-uniku.png') ?>" alt="FKOM UNIKU" style="width: 100px; height: auto;">
                <h1 class="auth-title">Login</h1>
                <p class="auth-subtitle mb-5">Sistem Informasi Manajemen Motor</p>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="iconly-boldDanger"></i> <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('login') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" name="username" placeholder="Username" autocomplete="username" required autofocus>
                        <div class="form-control-icon">
                            <i class="iconly-boldProfile"></i>
                        </div>
                    </div>
                    
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" name="password" placeholder="Password" autocomplete="current-password" required>
                        <div class="form-control-icon">
                            <i class="iconly-boldLock"></i>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Login</button>
                </form>
                
                <div class="text-center mt-5 text-lg fs-4">
                    <p class='text-gray-600'>Aplikasi Santana Motor &copy; <?= date('Y') ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; height: 100vh;">
                <div class="text-center text-white p-5">
                    <i class="iconly-boldBuy" style="font-size: 8rem;"></i>
                    <h2 class="mt-4">Selamat Datang</h2>
                    <p class="lead">Sistem Informasi Manajemen Motor Santana</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
