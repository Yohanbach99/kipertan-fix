<?php
// include file koneksi ke database
include "koneksi.php";

// ambil id_toko dari parameter GET
$id_toko = $_GET['id_toko'];

// ambil data toko dari database
$sql = "SELECT * FROM toko WHERE id_toko = $id_toko";
$result_toko = mysqli_query($conn, $sql);
$row_toko = mysqli_fetch_assoc($result_toko);
?>

<h2>Pembelian Barang di Toko <?php echo $row_toko['nama_toko']; ?></h2>

<?php
// jika form disubmit
if(isset($_POST['submit'])) {
    // ambil data dari form
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];

    // ambil stok barang dari database
    $sql = "SELECT stok FROM toko_barang WHERE id_toko = $id_toko AND id_barang = $id_barang";
    $result_stok = mysqli_query($conn, $sql);
    $row_stok = mysqli_fetch_assoc($result_stok);
    $stok = $row_stok['stok'];

    // jika stok cukup
    if($stok >= $jumlah) {
        // kurangi stok barang di database
        $sql = "UPDATE toko_barang SET stok = stok - $jumlah WHERE id_toko = $id_toko AND id_barang = $id_barang";
        mysqli_query($conn, $sql);

        // tambahkan data transaksi pembelian ke database
        $sql = "INSERT INTO transaksi_pembelian (id_toko, id_barang, jumlah) VALUES ($id_toko, $id_barang, $jumlah)";
        mysqli_query($conn, $sql);

        echo "Pembelian berhasil";
    } else {
        echo "Stok tidak cukup";
    }
}
?>

<form method="post">
   <label>ID Barang:</label>
   <select name="id_barang">
      <?php
      // ambil data barang dari database
      $sql = "SELECT * FROM barang";
      $result_barang = mysqli_query($conn, $sql);

      while($row_barang = mysqli_fetch_assoc($result_barang)) :
      ?>
      <option value="<?php echo $row_barang['id_barang']; ?>"><?php echo $row_barang['nama_barang']; ?></option>
      <?php endwhile; ?>
   </select>
   <br>
   <label>Jumlah:</label>
   <input type="number" name="jumlah" required>
   <br>
   <button type="submit" name="submit">Beli</button>
</form>
