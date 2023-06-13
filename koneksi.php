<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "kipertan";

$conn = mysqli_connect($host, $user, $pass, $db);

function cek_koneksi() {
   global $conn;
   if (!$conn) {
      die("Koneksi gagal: " . mysqli_connect_error());
   }
   echo "Koneksi berhasil";
}
?>
