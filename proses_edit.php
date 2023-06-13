<?php
// menghubungkan ke database
include('koneksi.php');
// cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// mengambil data barang yang akan diubah
$id_barang = $_POST['id_barang'];
$nama_barang = $_POST['nama_barang'];
$stok = $_POST['stok'];
$harga = $_POST['harga'];

// mengubah data barang di tabel barang
$sql_update_barang = "UPDATE barang SET nama_barang = '$nama_barang', stok = $stok, harga = $harga WHERE id_barang = $id_barang";
mysqli_query($conn, $sql_update_barang);

// redirect ke halaman gudang
header("Location: gudang.php");

mysqli_close($conn);
?>
