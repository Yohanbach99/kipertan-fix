<?php
// menghubungkan ke database
include('koneksi.php');

// cek apakah tombol simpan sudah ditekan atau belum
if(isset($_POST['simpan'])){
    // ambil data dari form
    $nama_toko = $_POST['nama_toko'];

    // query untuk menyimpan data ke database
    $sql = "INSERT INTO toko (nama_toko) VALUES ('$nama_toko')";

    // eksekusi query dan cek apakah berhasil atau tidak
    if(mysqli_query($conn, $sql)){
        echo "Data toko berhasil disimpan.";
    } else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Toko</title>
</head>
<body>
    <h1>Tambah Toko</h1>

    <form method="post" action="">
        <label for="nama_toko">Nama Toko:</label><br>
        <input type="text" name="nama_toko" id="nama_toko"><br><br>

        <button type="submit" name="simpan">Simpan</button>
    </form>
    
    <br>
    
    <a href="toko.php">Kembali ke Daftar Toko</a>
</body>
</html>
