<?php
// include file koneksi ke database
require ('koneksi.php');

// cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// mengambil data barang yang akan diedit
if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];
    
    // menggunakan prepared statement
    $stmt = $conn->prepare("SELECT * FROM barang WHERE id_barang = ?");
    $stmt->bind_param("i", $id_barang);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // jika data barang tidak ditemukan, kembali ke halaman index
    if (!$result || $result->num_rows == 0) {
        header("Location: index.php");
        exit;
    }
    
    $row = $result->fetch_assoc();
    $stmt->close();
} else {
    header("Location: gudang.php");
    exit;
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
</head>
<body>
    <h1>Edit Barang</h1>
    <form method="POST" action="proses_edit.php">
        <input type="hidden" name="id_barang" value="<?php echo $row["id_barang"]; ?>">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" id="nama_barang" name="nama_barang" value="<?php echo $row["nama_barang"]; ?>"><br>
        <label for="stok">Stok:</label>
        <input type="number" id="stok" name="stok" value="<?php echo $row["stok"]; ?>"><br>
        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" value="<?php echo $row["harga"]; ?>"><br>
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>

<?php mysqli_close($conn); ?>

