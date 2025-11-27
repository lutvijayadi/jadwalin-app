<?php
include '../koneksi/koneksi.php';

$id = $_POST['id'];
$tanggal = $_POST['tanggal'];
$acara = $_POST['acara'];
$keterangan = $_POST['keterangan'];
$lokasi = $_POST['lokasi'];

$query = "INSERT INTO jadwal (id, tanggal, acara, keterangan, lokasi) 
          VALUES ('$id','$tanggal','$acara','$keterangan','$lokasi')";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../index/admin.php"); 
} else {
    echo "Error: " . mysqli_error($koneksi);
}



