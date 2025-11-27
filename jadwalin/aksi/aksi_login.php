<?php
session_start();

include '../koneksi/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];



$login = mysqli_query($koneksi, "SELECT * FROM user where username='$username' and password='$password'");
$cek = mysqli_num_rows($login) == 1;
if ($cek > 0) {

   $data = mysqli_fetch_assoc($login);

   // login sebagai admin
   if ($data['level'] == "admin") {


      $_SESSION['username'] = $username;
      $_SESSION['level'] = "admin";

      header("location:../index/admin.php");

      // login sebagai user
   } else if ($data['level'] == "user") {

      $_SESSION['username'] = $username;
      $_SESSION['level'] = "user";

      header("location:../public/dasboard.php");

   } else {

      // alihkan ke halaman login kembali
      header("location:../index/index.php?pesan=gagal");
   }
} else {
   header("location:../index/index.php?pesan=gagal");
}

?>