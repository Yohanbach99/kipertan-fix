<?php
// menghubungkan ke database
include('koneksi.php');
// cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// mengambil id barang yang akan dihapus
$id_barang = $_POST['id_barang'];

// menghapus data barang dari tabel barang
$sql_delete_barang = "DELETE FROM barang WHERE id_barang = $id_barang";
mysqli_query($conn, $sql_delete_barang);

// menghapus data persediaan barang dari tabel persediaan
$sql_delete_persediaan = "DELETE FROM persediaan WHERE id_barang = $id_barang";
mysqli_query($conn, $sql_delete_persediaan);

// redirect ke halaman gudang
header("Location: gudang.php");

mysqli_close($conn);
?>
