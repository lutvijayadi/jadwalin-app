<?php

include '../koneksi/koneksi.php';

$id = $_POST['id'];
$judul = $_POST['judul'];
$keterangan = $_POST['keterangan'];
$tanggal_publikasi = $_POST['tanggal_publikasi'];

$query = "INSERT INTO pengumuman (id, judul, keterangan, tanggal_publikasi)
          VALUES ('$id','$judul','$keterangan','$tanggal_publikasi')";

if (mysqli_query($koneksi, $query)) {
    header("Location:../admin/pengumuman.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}



