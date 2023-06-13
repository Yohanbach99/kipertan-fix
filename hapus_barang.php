<?php
// include file koneksi ke database
include "koneksi.php";

// cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// query untuk mengambil data barang dari tabel barang
$sql = "SELECT * FROM barang";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Hapus Barang</title>
</head>
<body>
    <h1>Hapus Barang</h1>
    <form method="POST" action="proses_hapus.php">
        <label for="barang">Pilih Barang:</label>
        <select id="barang" name="id_barang">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $row["id_barang"]; ?>"><?php echo $row["nama_barang"]; ?></option>
            <?php } ?>
        </select>
        <br>
        <button type="submit">Hapus Barang</button>
    </form>
</body>
</html>

<?php mysqli_close($conn); ?>
