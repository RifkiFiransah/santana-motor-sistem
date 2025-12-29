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

### 4. Konfigurasi File `.env`

Buka file `.env` dan sesuaikan konfigurasi berikut:

```plaintext
# ENVIRONMENT
CI_ENVIRONMENT = development
# Ubah ke 'production' untuk production

# BASE URL
app.baseURL = 'http://localhost:8080/'
# Sesuaikan dengan URL aplikasi Anda

# DATABASE CONFIGURATION
database.default.hostname = localhost
database.default.database = santana_motor
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.DBPrefix = 
database.default.port = 3306

# ENCRYPTION
encryption.key = 
# Generate key: php spark key:generate
```

### 5. Generate Encryption Key

```bash
php spark key:generate
```

Perintah ini akan menghasilkan encryption key secara otomatis di file `.env`.

### 6. Setup Database

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

### 7. Konfigurasi Web Server

#### Untuk Apache

Buat Virtual Host atau pastikan DocumentRoot mengarah ke folder `public`:

```apache
<VirtualHost *:80>
    ServerName santana-motor.local
    DocumentRoot /path/to/santana-motor-sistem/public
    
    <Directory /path/to/santana-motor-sistem/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
        
        <IfModule mod_rewrite.c>
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteRule ^(.*)$ index.php/$1 [L]
        </IfModule>
    </Directory>
</VirtualHost>
```

Tambahkan domain ke hosts file:
- Windows: `C:\Windows\System32\drivers\etc\hosts`
- Linux/Mac: `/etc/hosts`

```
127.0.0.1 santana-motor.local
```

#### Untuk Development (PHP Built-in Server)

```bash
php spark serve
```

Aplikasi akan berjalan di `http://localhost:8080`

### 8. Beri Izin Folder Writable

Pastikan folder `writable` dapat ditulis oleh web server:

```bash
# Windows (di Command Prompt, jalankan sebagai Administrator)
icacls writable /grant:r "%USERNAME%":F /t

# Linux/Mac
chmod -R 755 writable
```

## Testing

Jalankan unit tests dengan:

```bash
composer test
# atau
php spark phpunit
```

## Struktur Project

```
santana-motor-sistem/
├── app/                    # Aplikasi utama
│   ├── Controllers/        # Controller untuk setiap modul
│   ├── Models/            # Database models
│   ├── Views/             # Template views
│   ├── Config/            # Konfigurasi aplikasi
│   ├── Filters/           # Authentication & authorization
│   └── Libraries/         # Library (PDF, Excel generator)
├── public/                # Folder public (DocumentRoot)
│   ├── index.php          # Entry point aplikasi
│   └── assets/            # CSS, JS, images
├── tests/                 # Unit tests
├── writable/              # Folder untuk cache, logs, uploads
├── composer.json          # Dependency management
├── .env                   # Environment configuration
└── spark                  # CLI command tool
```

## Troubleshooting

### Error: "Composer not installed"
**Solusi**: Install Composer dari https://getcomposer.org/

### Error: "Database connection failed"
**Solusi**: 
- Pastikan MySQL/MariaDB running
- Verifikasi credentials di `.env`
- Pastikan database sudah dibuat

### Error: "404 Not Found" pada URL yang seharusnya ada
**Solusi**:
- Pastikan DocumentRoot mengarah ke folder `public`
- Aktifkan mod_rewrite di Apache
- Periksa konfigurasi `.htaccess` di folder `public`

### Error: "Permission denied" pada folder writable
**Solusi**:
- Beri permission 755 (Linux/Mac) atau Full Control (Windows)
- Pastikan web server memiliki write access

### Composer update gagal
**Solusi**:
```bash
# Clear composer cache
composer clear-cache

# Update composer
composer self-update

# Install ulang
composer install
```

## Default Credentials

Setelah instalasi selesai, gunakan credential berikut untuk login:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@santana-motor.com | admin123 |
| Kasir | kasir@santana-motor.com | kasir123 |
| Gudang | gudang@santana-motor.com | gudang123 |
| Pemilik | pemilik@santana-motor.com | pemilik123 |

**⚠️ Penting**: Ubah password setelah login pertama kali!

## Tips Pengembangan

- Gunakan `ENVIRONMENT = development` di `.env` untuk development
- Enable error display dan debug toolbar untuk debugging
- Gunakan migrations untuk database changes
- Ikuti Code Igniter coding standards
- Run tests sebelum push ke repository

## Support

Untuk pertanyaan atau masalah, silakan hubungi tim development atau buat issue di repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
