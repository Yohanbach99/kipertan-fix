<?php
// menghubungkan ke database
include('koneksi.php');
// cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// mengambil data barang yang akan diambil
$id_barang = $_POST['id_barang'];
$jumlah = $_POST['jumlah'];

// mengambil stok barang
$sql_stok = "SELECT stok FROM barang WHERE id_barang = $id_barang";
$result_stok = mysqli_query($conn, $sql_stok);
$row_stok = mysqli_fetch_assoc($result_stok);
$stok = $row_stok['stok'];

// menghitung stok baru setelah barang diambil
$stok_baru = $stok - $jumlah;

// update stok barang di tabel barang
$sql_update_barang = "UPDATE barang SET stok = $stok_baru WHERE id_barang = $id_barang";
mysqli_query($conn, $sql_update_barang);

// mengambil data persediaan toko
$id_toko = $_POST['id_toko'];
$sql_persediaan = "SELECT stok FROM persediaan WHERE id_toko = $id_toko AND id_barang = $id_barang";
$result_persediaan = mysqli_query($conn, $sql_persediaan);

// Jika tidak ada data persediaan di toko, maka buat data baru di tabel persediaan
if (mysqli_num_rows($result_persediaan) == 0) {
    $sql_insert_persediaan = "INSERT INTO persediaan (id_toko, id_barang, stok) VALUES ($id_toko, $id_barang, $jumlah)";
    mysqli_query($conn, $sql_insert_persediaan);
} else {
    $row_persediaan = mysqli_fetch_assoc($result_persediaan);
    $stok_persediaan = $row_persediaan['stok'];

    // menghitung stok baru di persediaan toko
    $stok_persediaan_baru = $stok_persediaan + $jumlah;

    // update stok persediaan toko di tabel persediaan
    $sql_update_persediaan = "UPDATE persediaan SET stok = $stok_persediaan_baru WHERE id_toko = $id_toko AND id_barang = $id_barang";
    mysqli_query($conn, $sql_update_persediaan);
}

// redirect ke halaman toko
header("Location: toko.php?id_toko=$id_toko");

mysqli_close($conn);
?>
