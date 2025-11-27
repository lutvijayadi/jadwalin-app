<?php
include '../koneksi/koneksi.php';

$id = $_POST['id']; // primary key lama
$tanggal = $_POST['tanggal'];
$acara = $_POST['acara'];
$keterangan = $_POST['keterangan'];
$lokasi = $_POST['lokasi'];

$query = "UPDATE jadwal 
          SET tanggal='$tanggal', acara='$acara', lokasi='$lokasi', keterangan='$keterangan' 
          WHERE id='$id'";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../index/admin.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>