<?php
// include file koneksi ke database
include "koneksi.php";

// fungsi untuk menambah barang
function tambah_barang($nama_barang, $stok, $harga) {
   global $conn;
   $sql = "INSERT INTO barang (nama_barang, stok, harga) VALUES ('$nama_barang', $stok, $harga)";
   mysqli_query($conn, $sql);
   echo "Barang berhasil ditambahkan";
}

// cek koneksi ke database
cek_koneksi();

// proses form jika disubmit
if(isset($_POST['submit'])) {
   tambah_barang($_POST['nama_barang'], $_POST['stok'], $_POST['harga']);
}
?>

<h2>Tambah Barang ke Gudang</h2>

<form method="POST">
   <label for="nama_barang">Nama Barang:</label>
   <input type="text" id="nama_barang" name="nama_barang"><br><br>
   <label for="stok">Stok:</label>
   <input type="number" id="stok" name="stok"><br><br>
   <label for="harga">Harga:</label>
   <input type="number" id="harga" name="harga"><br><br>
   <input type="submit" name="submit" value="Tambah Barang">
</form>
