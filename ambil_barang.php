<?php
// include file koneksi ke database
include "koneksi.php";

// cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// query untuk mengambil data toko dari tabel toko
$sql = "SELECT * FROM toko";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengambilan Barang</title>
</head>
<body>
    <h1>Pengambilan Barang</h1>
    <form method="POST" action="proses_pengambilan.php">
        <label for="toko">Pilih Toko:</label>
        <select id="toko" name="id_toko">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $row["id_toko"]; ?>"><?php echo $row["nama_toko"]; ?></option>
            <?php } ?>
        </select>
        <br>
        <label for="barang">Pilih Barang:</label>
        <select id="barang" name="id_barang">
            <?php
            // query untuk mengambil data barang dari tabel barang
            $sql2 = "SELECT * FROM barang";
            $result2 = mysqli_query($conn, $sql2);
            while($row = mysqli_fetch_assoc($result2)) { ?>
                <option value="<?php echo $row["id_barang"]; ?>"><?php echo $row["nama_barang"]; ?></option>
            <?php } ?>
        </select>
        <br>
        <label for="jumlah">Jumlah:</label>
        <input type="number" id="jumlah" name="jumlah" min="1" required>
        <br>
        <button type="submit">Ambil Barang</button>
    </form>
</body>
</html>

<?php mysqli_close($conn); ?>
