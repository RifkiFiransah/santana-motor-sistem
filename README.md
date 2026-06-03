# Santana Motor - Sistem Manajemen Penjualan Motor

Aplikasi web untuk manajemen penjualan dan inventori motor Santana Motor. Dibangun menggunakan CodeIgniter 4 dengan fitur manajemen gudang, penjualan, dan laporan pemilik.

## Fitur Utama

- 🏪 **Manajemen Gudang**: Kelola stok motor dan opname gudang
- 💳 **Sistem Kasir**: Proses penjualan dan transaksi
- 📊 **Dashboard Pemilik**: Laporan dan analisis penjualan
- 👥 **Manajemen User**: Kontrol akses berbasis role (Admin, Kasir, Gudang, Pemilik)
- 📄 **Export Data**: Export ke PDF dan Excel

## Requirements

Sebelum menginstall aplikasi, pastikan sistem Anda memiliki:

- **PHP**: >= 8.1
- **Composer**: [Download Composer](https://getcomposer.org/)
- **MySQL/MariaDB**: Database server
- **Web Server**: Apache atau Nginx
- **Git** (opsional): Untuk clone repository

## Instalasi

### 1. Clone atau Download Project

```bash
# Menggunakan Git
git clone <repository-url> santana-motor-sistem
cd santana-motor-sistem

# Atau download ZIP dan extract
```

### 2. Install Dependencies

Jalankan Composer untuk menginstall semua dependencies:

```bash
composer install
```

### 3. Konfigurasi Environment

Copy file `env` menjadi `.env`:

```bash
# Di Windows (Command Prompt)
copy env .env

# Atau di Git Bash/Terminal
cp env .env
```

### 4. Generate Encryption Key

```bash
php spark key:generate
```

Perintah ini akan menghasilkan encryption key secara otomatis di file `.env`.

### 4. Setup Database

#### a. Buat Database

Buat database baru di MySQL:

```sql
CREATE DATABASE santana_motor CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### b. Jalankan Migration

```bash
php spark migrate
```

Perintah ini akan membuat semua tabel yang diperlukan di database.

#### c. Seed Database (Opsional)

Jika ada seed untuk data awal:

```bash
php spark db:seed
```

#### Untuk Development (PHP Built-in Server)

```bash
php spark serve
```

Aplikasi akan berjalan di `http://localhost:8080`
