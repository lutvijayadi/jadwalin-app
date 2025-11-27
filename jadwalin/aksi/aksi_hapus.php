<?php
include '../koneksi/koneksi.php';

$id = $_GET['id']; // ambil primary key dari URL

$query = "DELETE FROM jadwal WHERE id='$id'";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../index/admin.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>