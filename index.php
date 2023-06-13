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

// query untuk mengambil data persediaan dari tabel persediaan
$sql2 = "SELECT persediaan.id_toko, persediaan.id_barang, persediaan.stok, toko.nama_toko, barang.nama_barang FROM persediaan INNER JOIN toko ON persediaan.id_toko=toko.id_toko INNER JOIN barang ON persediaan.id_barang=barang.id_barang";
$result2 = mysqli_query($conn, $sql2);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Index Gudang</title>
</head>
<body>
    <h1>Daftar Barang</h1>
    <table>
        <thead>
            <tr>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row["id_barang"]; ?></td>
                    <td><?php echo $row["nama_barang"]; ?></td>
                    <td><?php echo $row["stok"]; ?></td>
                    <td><?php echo $row["harga"]; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h1>Persediaan di Toko-toko</h1>
    <table>
        <thead>
            <tr>
                <th>ID Toko</th>
                <th>Nama Toko</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result2)) { ?>
                <tr>
                    <td><?php echo $row["id_toko"]; ?></td>
                    <td><?php echo $row["nama_toko"]; ?></td>
                    <td><?php echo $row["id_barang"]; ?></td>
                    <td><?php echo $row["nama_barang"]; ?></td>
                    <td><?php echo $row["stok"]; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

<?php mysqli_close($conn); ?>
