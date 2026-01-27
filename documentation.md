# Dokumentasi Aplikasi Peminjaman Alat

## A. Deskripsi Program
Aplikasi Peminjaman Alat adalah sistem informasi berbasis web yang dirancang untuk mengelola proses peminjaman dan pengembalian alat di lingkungan perusahaan/sekolah. Aplikasi ini memfasilitasi tiga peran pengguna:
1. **Admin**: Mengelola data master (User, Kategori, Alat) dan memantau log aktivitas.
2. **Petugas**: Memproses permohonan peminjaman, menyetujui/menolak, dan memproses pengembalian serta denda.
3. **Peminjam**: Melihat katalog alat, mengajukan peminjaman, dan melihat riwayat peminjaman mereka.

Teknologi yang digunakan:
- **Framework**: Laravel 11
- **Database**: MySQL/MariaDB
- **Frontend**: Tailwind CSS

## B. Entity Relationship Diagram (ERD)
Struktur database terdiri dari tabel-tabel berikut:
1. **users**: Menyimpan data pengguna (Admin, Petugas, Peminjam).
2. **categories**: Mengelompokkan jenis alat.
3. **tools**: Menyimpan data alat (Stok, Deskripsi, Relasi ke Kategori).
4. **loans**: Mencatat transaksi peminjaman (Tanggal Pinjam, Tanggal Kembali, Status, Denda).
5. **activity_logs**: Mencatat riwayat aktivitas sistem.

**Relasi:**
- `categories` -> `tools` (One-to-Many)
- `users` -> `loans` (One-to-Many)
- `tools` -> `loans` (One-to-Many)
- `users` -> `activity_logs` (One-to-Many)

## C. Dokumentasi Fungsi/Prosedur Database
Sesuai persyaratan, aplikasi menggunakan fitur *Advanced Database* berikut:

### 1. Trigger: Manajemen Stok Otomatis
- **`decrease_stock_after_approve`**: Mengurangi stok alat sebanyak 1 unit ketika status peminjaman berubah menjadi 'approved'.
- **`increase_stock_after_return`**: Menambah stok alat sebanyak 1 unit ketika status peminjaman berubah menjadi 'returned'.

### 2. Stored Procedure: `process_loan_approval`
- **Tujuan**: Menangani persetujuan peminjaman secara *atomic*.
- **Input**: `loanId`, `adminId`
- **Proses**:
  1. Memulai Transaksi Database.
  2. Mengupdate status tabel `loans` menjadi 'approved'.
  3. Mencatat aktivitas ke tabel `activity_logs`.
  4. Commit transaksi jika sukses, Rollback jika gagal.

### 3. Function: `calculate_fine`
- **Tujuan**: Menghitung denda keterlambatan.
- **Logika**: Jika `return_date` > `due_date`, maka Denda = (Selisih Hari * Rp 5.000). Jika tidak, Denda = 0.

## D. Cara Pengujian (Testing)
### Skenario Login
1. Buka halaman Login.
2. Masukkan Email & Password (default password: 'password').
   - Admin: `admin@admin.com`
   - Petugas: `petugas@petugas.com`
   - Peminjam: `siswa@siswa.com`
3. Klik tombol Login. Sistem harus mengarahkan ke Dashboard sesuai role.

### Skenario Peminjaman (Flow Lengkap)
1. **Login sebagai Peminjam**.
2. Buka menu "Borrow Tools". Pilih alat dan tentukan durasi. Klik "Borrow Request".
   - *Hasil*: Data masuk ke tabel Loan dengan status 'pending'.
3. **Login sebagai Petugas**.
4. Buka menu "Manage Loans". Lihat permintaan baru. Klik "Approve".
   - *Hasil*: Status berubah jadi 'approved'. Stok alat berkurang 1 (via Trigger).
5. **Login sebagai Peminjam**. Cek menu "My Loans". Status harus 'approved'.
6. **Login sebagai Petugas**. Klik "Process Return" pada peminjaman tersebut.
   - *Hasil*: Status berubah jadi 'returned'. Stok alat bertambah 1. Jika terlambat, denda terhitung.
