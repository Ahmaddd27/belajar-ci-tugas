# 🛒 Toko Online - CodeIgniter 4

<p align="center">
  <img src="https://img.shields.io/badge/CodeIgniter-4-red?style=for-the-badge&logo=codeigniter">
  <img src="https://img.shields.io/badge/PHP-8.x-blue?style=for-the-badge&logo=php">
  <img src="https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge&logo=mysql">
  <img src="https://img.shields.io/badge/Bootstrap-5-purple?style=for-the-badge&logo=bootstrap">
</p>

---

# 📌 Deskripsi Project

**Toko Online** merupakan aplikasi berbasis web yang dikembangkan menggunakan framework **CodeIgniter 4**. Sistem ini memungkinkan pengguna untuk melihat produk, menambahkan produk ke keranjang, melakukan checkout, menghitung ongkos kirim menggunakan **API RajaOngkir**, serta menyimpan transaksi ke database.

Project ini dibuat untuk mempelajari implementasi:

* Framework CodeIgniter 4
* Sistem autentikasi
* CRUD Produk
* Session Cart
* Integrasi API eksternal (RajaOngkir)
* Transaksi dan Detail Transaksi
* AJAX dan Select2

---

# ✨ Fitur Utama

## 👤 Autentikasi User

* Login
* Logout
* Session Authentication
* Filter Auth

## 📦 Manajemen Produk

* Menampilkan daftar produk
* Menambahkan produk
* Mengubah produk
* Menghapus produk
* Download data produk

## 🛒 Keranjang Belanja

* Menambahkan produk ke keranjang
* Mengubah jumlah produk
* Menghapus produk dari keranjang
* Mengosongkan keranjang

## 🚚 Checkout dan Pengiriman

* Input alamat pelanggan
* Pencarian tujuan pengiriman menggunakan Select2
* Integrasi API RajaOngkir
* Menampilkan layanan pengiriman
* Menghitung ongkos kirim otomatis
* Menghitung total pembayaran

## 💳 Transaksi

* Menyimpan data transaksi
* Menyimpan detail transaksi
* Menghitung subtotal
* Menghitung total akhir

---

# 🏗️ Teknologi yang Digunakan

| Teknologi          | Keterangan              |
| ------------------ | ----------------------- |
| PHP                | Bahasa Pemrograman      |
| CodeIgniter 4      | Framework Backend       |
| MySQL              | Database                |
| Bootstrap 5        | User Interface          |
| jQuery             | Manipulasi DOM          |
| AJAX               | Komunikasi Asynchronous |
| Select2            | Dropdown Pencarian      |
| RajaOngkir API     | Perhitungan Ongkir      |
| NiceAdmin Template | Dashboard UI            |

---

# 📁 Struktur Project

```bash
app/
│
├── Controllers/
│   ├── AuthController.php
│   ├── Home.php
│   ├── ProdukController.php
│   ├── TransaksiController.php
│   └── ProfileController.php
│
├── Models/
│   ├── ProductModel.php
│   ├── TransactionModel.php
│   └── TransactionDetailModel.php
│
├── Services/
│   └── RajaOngkirService.php
│
├── Views/
│   ├── v_checkout.php
│   ├── v_keranjang.php
│   ├── layout.php
│   └── components/
│
└── Config/
```

---

# 🔄 Flow Sistem

## 1️⃣ User Login

```text
User → Login Form → AuthController → Validasi
→ Session Dibuat → Dashboard
```

---

## 2️⃣ Menampilkan Produk

```text
User → Home Page
→ ProdukController
→ Mengambil Data Produk
→ Menampilkan Produk
```

---

## 3️⃣ Menambahkan Produk ke Keranjang

```text
User Klik "Tambah ke Keranjang"
↓
TransaksiController::cart_add()
↓
Data Produk Disimpan ke Session Cart
↓
Keranjang Ditampilkan
```

---

## 4️⃣ Checkout

```text
User Membuka Halaman Checkout
↓
Input Alamat
↓
Cari Kelurahan (AJAX + Select2)
↓
Request ke RajaOngkir API
↓
Menampilkan Daftar Layanan
↓
User Memilih Layanan
↓
Ongkir Dihitung
↓
Total Harga Dihitung
```

---

## 5️⃣ Proses Pembelian

```text
User Klik "Buat Pesanan"
↓
TransaksiController::buy()
↓
Hitung Subtotal
↓
Tambah Ongkir
↓
Simpan ke Tabel Transaction
↓
Simpan Detail Produk
↓
Kosongkan Keranjang
↓
Redirect ke Dashboard
```

---

# 🔌 Integrasi API RajaOngkir

Sistem menggunakan API RajaOngkir untuk:

* Mencari tujuan pengiriman
* Mengambil biaya pengiriman
* Menampilkan estimasi pengiriman

Contoh Service:

```php
$service = new RajaOngkirService();

$response = $service->getDestination('Semarang');

$cost = $service->getCost(
    '64999',
    '65042',
    1000,
    'jne'
);
```

---

# 🗄️ Database

## Tabel Product

| Field |
| ----- |
| id    |
| nama  |
| harga |
| foto  |
| stok  |

---

## Tabel Transaction

| Field       |
| ----------- |
| id          |
| username    |
| alamat      |
| ongkir      |
| total_harga |
| status      |

---

## Tabel Transaction Detail

| Field          |
| -------------- |
| id             |
| transaction_id |
| product_id     |
| jumlah         |
| diskon         |
| subtotal_harga |

---

# ⚙️ Instalasi

## Clone Repository

```bash
git clone https://github.com/username/toko-online.git
```

## Masuk ke Folder

```bash
cd toko-online
```

## Install Dependency

```bash
composer install
```

## Salin File Environment

```bash
cp env .env
```

## Konfigurasi Database

```env
database.default.hostname = localhost
database.default.database = toko
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

## Konfigurasi RajaOngkir

```env
RAJAONGKIR_API_KEY=YOUR_API_KEY
RAJAONGKIR_BASE_URL=https://rajaongkir.komerce.id/api/v1/
```

## Jalankan Server

```bash
php spark serve
```

Akses aplikasi:

```bash
http://localhost:8080
```

---

# 📸 Tampilan Aplikasi

* Dashboard
* Daftar Produk
* Keranjang Belanja
* Checkout
* Profil User

---

# 👨‍💻 Author

**Nama :** Your Name

**Framework :** CodeIgniter 4

**Database :** MySQL

**Tahun :** 2025

---

# 📄 Lisensi

Project ini dibuat untuk tujuan pembelajaran dan pengembangan sistem informasi berbasis web.
