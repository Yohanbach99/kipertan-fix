<?php
// include file koneksi ke database
include "koneksi.php";

// cek koneksi ke database
cek_koneksi();

// ambil data toko dari database
$sql = "SELECT * FROM toko";
$result_toko = mysqli_query($conn, $sql);

// ambil data barang dari database
$sql = "SELECT * FROM barang";
$result_barang = mysqli_query($conn, $sql);

?>

<h2>Daftar Toko dan Stok Barang</h2>

<?php while($row_toko = mysqli_fetch_assoc($result_toko)) : ?>
<h3><?php echo $row_toko['nama_toko']; ?></h3>
<table>
   <thead>
      <tr>
         <th>ID Barang</th>
         <th>Nama Barang</th>
         <th>Stok</th>
      </tr>
   </thead>
   <tbody>
      <?php
      $id_toko = $row_toko['id_toko'];
      $sql = "SELECT toko_barang.id_barang, barang.nama_barang, toko_barang.stok
              FROM toko_barang
              INNER JOIN barang ON toko_barang.id_barang = barang.id_barang
              WHERE toko_barang.id_toko = $id_toko";
      $result_stok = mysqli_query($conn, $sql);

      while($row_stok = mysqli_fetch_assoc($result_stok)) :
      ?>
      <tr>
         <td><?php echo $row_stok['id_barang']; ?></td>
         <td><?php echo $row_stok['nama_barang']; ?></td>
         <td><?php echo $row_stok['stok']; ?></td>
      </tr>
      <?php endwhile; ?>
   </tbody>
</table>
<?php endwhile; ?>
