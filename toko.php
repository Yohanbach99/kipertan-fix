<?php
// menghubungkan ke database
include('koneksi.php');

// cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// jika form pembelian disubmit
if (isset($_POST['submit'])) {
    $id_toko = $_POST['id_toko'];
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];

    // memperbarui stok barang di toko
    $sql_update_stok = "UPDATE persediaan SET stok = stok - $jumlah WHERE id_toko = $id_toko AND id_barang = $id_barang";
    mysqli_query($conn, $sql_update_stok);
}

// mengambil data toko dari database
$sql_toko = "SELECT id_toko, nama_toko FROM toko";
$result_toko = mysqli_query($conn, $sql_toko);

// mengambil data persediaan barang di setiap toko
$sql_persediaan_barang = "SELECT persediaan.id_toko, persediaan.id_barang, barang.nama_barang, persediaan.stok 
FROM persediaan 
INNER JOIN barang ON persediaan.id_barang = barang.id_barang";
$result_persediaan_barang = mysqli_query($conn, $sql_persediaan_barang);
$persediaan_barang_per_toko = array();
while ($persediaan_barang = mysqli_fetch_assoc($result_persediaan_barang)) {
    $id_toko = $persediaan_barang['id_toko'];
    if (!isset($persediaan_barang_per_toko[$id_toko])) {
        $persediaan_barang_per_toko[$id_toko] = array();
    }
    $persediaan_barang_per_toko[$id_toko][] = $persediaan_barang;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Toko</title>
</head>
<body>
    <h1>Toko</h1>

    <?php if (mysqli_num_rows($result_toko) > 0) { ?>
        <?php while ($toko = mysqli_fetch_assoc($result_toko)) { ?>
            <h2><?php echo $toko['nama_toko']; ?></h2>
            <?php if (isset($persediaan_barang_per_toko[$toko['id_toko']])) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Pembelian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($persediaan_barang_per_toko[$toko['id_toko']] as $persediaan_barang) { ?>
                            <tr>
                                <td><?php echo $persediaan_barang['nama_barang']; ?></td>
                                <td><?php echo $persediaan_barang['stok']; ?></td>
                                <td>
                                    <form method="POST" action="">
                                        <input type="hidden" name="id_toko" value="<?php echo $toko['id_toko']; ?>">
                                        <input type="hidden" name="id_barang" value="<?php echo $persediaan_barang['id_barang']; ?>">
                                        <input type="number" name="jumlah" min="1" max="<?php echo $persediaan_barang['stok']; ?>" required>
                                        <input type="submit" name="submit"value="Beli">
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>Tidak ada persediaan barang di toko ini</p>
                  <?php } ?>
                     <?php } ?>
                  <?php } else { ?>
                      <p>Tidak ada toko yang tersedia</p>
                     <?php } ?>
     </body>
 </html> 
