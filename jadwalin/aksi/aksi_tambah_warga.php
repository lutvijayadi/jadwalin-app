<?php

include '../koneksi/koneksi.php';

// Validasi dasar: pastikan data POST ada
if (!isset($_POST['id'], $_POST['nama'], $_POST['status'], $_POST['alamat'], $_POST['no_telepon'])) {
    die("Data tidak lengkap.");
}

$id = mysqli_real_escape_string($koneksi, $_POST['id']);
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$no_telepon = mysqli_real_escape_string($koneksi, $_POST['no_telepon']);

$query = "INSERT INTO warga (id, nama, status, alamat, no_telepon)
          VALUES ('$id','$nama','$status','$alamat','$no_telepon')";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../admin/manajement_warga.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
