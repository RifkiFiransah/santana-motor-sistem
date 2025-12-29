<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'AuthController::index');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');
$routes->get('sign-out', 'AuthController::logout'); // Alternative logout route

// Image Serving (Secure)
$routes->get('uploads/motorcycles/(:any)', 'ImageController::serve/$1');

// 1. Jalur PEMILIK (Sesuai Diagram User & Master Data & Laporan)
$routes->group('pemilik', ['filter' => 'role:pemilik'], function($routes) {
    $routes->get('dashboard', 'Pemilik\Dashboard::index');
    
    // Master Data User (Diagram User)
    $routes->resource('users', ['controller' => 'Pemilik\UserController']);
    
    // Master Data Motor (Diagram Master Data Motor - Full Access)
    $routes->get('motor', 'Pemilik\MotorController::index');
    $routes->get('motor/catalog', 'Pemilik\MotorController::catalog');
    $routes->get('motor/(:num)', 'Pemilik\MotorController::show/$1');
    $routes->post('motor/(:num)', 'Pemilik\MotorController::delete/$1');
    
    // Laporan (Diagram Laporan)
    $routes->get('laporan-pembelian', 'Pemilik\LaporanController::pembelian');
    $routes->get('laporan-pembelian/pdf', 'Pemilik\LaporanController::pembelianPdf');
    $routes->get('laporan-pembelian/excel', 'Pemilik\LaporanController::pembelianExcel');
    
    $routes->get('laporan-penjualan', 'Pemilik\LaporanController::penjualan');
    $routes->get('laporan-penjualan/pdf', 'Pemilik\LaporanController::penjualanPdf');
    $routes->get('laporan-penjualan/excel', 'Pemilik\LaporanController::penjualanExcel');
    
    $routes->get('laporan-stok-opname', 'Pemilik\LaporanController::stokOpname');
    $routes->get('laporan-stok-opname/pdf', 'Pemilik\LaporanController::stokOpnamePdf');
    $routes->get('laporan-stok-opname/excel', 'Pemilik\LaporanController::stokOpnameExcel');
});

// 2. Jalur GUDANG (Sesuai Diagram Motor Masuk & Update & Stok Opname)
$routes->group('gudang', ['filter' => 'role:gudang'], function($routes) {
    $routes->get('dashboard', 'Gudang\Dashboard::index');
    
    // Input Motor Masuk (Diagram Petugas Gudang)
    $routes->get('motor/masuk', 'Gudang\MotorMasukController::new');
    $routes->post('motor/masuk', 'Gudang\MotorMasukController::create');
    
    // Update Data Motor (Diagram Petugas Gudang)
    $routes->get('motor', 'Gudang\MotorController::index'); // List untuk dipilih
    $routes->get('motor/catalog', 'Gudang\MotorController::catalog');
    $routes->get('motor/show/(:num)', 'Gudang\MotorController::show/$1');
    $routes->get('motor/edit/(:num)', 'Gudang\MotorController::edit/$1');
    $routes->post('motor/update/(:num)', 'Gudang\MotorController::update/$1');
    
    // Stok Opname (Diagram Petugas Gudang)
    $routes->get('stok-opname', 'Gudang\StokOpnameController::index');
    $routes->post('stok-opname', 'Gudang\StokOpnameController::create');
});

// 3. Jalur KASIR (Sesuai Diagram Transaksi & Cek Motor)
$routes->group('kasir', ['filter' => 'role:kasir'], function($routes) {
    $routes->get('dashboard', 'Kasir\Dashboard::index');
    
    // Cek Ketersediaan (Diagram Kasir)
    $routes->get('motor', 'Kasir\MotorController::index');
    $routes->get('motor/catalog', 'Kasir\MotorController::catalog');
    $routes->get('motor/(:num)', 'Kasir\MotorController::show/$1');
    
    // Transaksi (Diagram Kasir)
    $routes->get('transaksi', 'Kasir\TransaksiController::new');
    $routes->post('transaksi', 'Kasir\TransaksiController::create');
    $routes->get('invoice/(:any)', 'Kasir\TransaksiController::invoice/$1');
});
