<?php
// menghubungkan ke database
include('koneksi.php');

// cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// mengambil data barang dari database
$sql_barang = "SELECT * FROM barang";
$result_barang = mysqli_query($conn, $sql_barang);

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gudang</title>
</head>
<body>
    <h1>Gudang</h1>
    <?php if (mysqli_num_rows($result_barang) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($barang = mysqli_fetch_assoc($result_barang)) { ?>
                <tr>
                    <td><?php echo $barang['nama_barang']; ?></td>
                    <td><?php echo $barang['stok']; ?></td>
                    <td><?php echo $barang['harga']; ?></td>
                    <td>
                        <a href="edit_barang.php?id=<?php echo $barang['id_barang']; ?>">Edit</a>
                        <a href="hapus_barang.php">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>Tidak ada barang di gudang.</p>
<?php } ?>
</body>
</html>