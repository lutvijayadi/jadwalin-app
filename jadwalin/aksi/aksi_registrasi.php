<?php
// Memulai sesi (opsional)
session_start();

// Memanggil koneksi database
include '../koneksi/koneksi.php';

// Mendapatkan data dari form registrasi
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

// --- PENTING: LAKUKAN HASHING PASSWORD ---
// Menggunakan password_hash() untuk mengamankan password sebelum disimpan.
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// --- Validasi 1: Cek apakah username sudah ada di database ---
// Gunakan prepared statements jika bisa, tetapi untuk saat ini, kita stick dengan mysqli_query yang sudah ada
$cek_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
$jumlah_user = mysqli_num_rows($cek_user);

if ($jumlah_user > 0) {
    // Jika username sudah ada, alihkan kembali ke halaman registrasi dengan pesan error
    header("location:../index/registrasi.php?pesan=gagal_username");
    exit;
}

// --- Validasi 2: Lakukan penyimpanan data ke database ---
// Gunakan password yang sudah di-hash
$query_insert = "INSERT INTO user (nama, username, password, level) VALUES ('$nama', '$username', '$hashed_password', '$level')";

if (mysqli_query($koneksi, $query_insert)) {
    // Jika berhasil disimpan
    header("location:../index/registrasi.php?pesan=berhasil");
} else {
    // Jika gagal disimpan
    header("location:../index/registrasi.php?pesan=gagal_simpan");
}

mysqli_close($koneksi);
?>