<?php
session_start();

include'../../config.php';
include'../components/header.php';
include'../components/footer.php';

if(isset($_POST['tambah'])){
    $kode_barang=$_POST['kode_barang'];
    $nama_produk=$_POST['nama_produk'];
    $qty=$_POST['qty'];
    $id_pelanggan=$_POST['id_pelanggan'];

    $sql_cari="SELECT * FROM produk WHERE id_produk='$kode_barang'";
    $result_cari = mysqli_query($conn, $sql_cari);
    $row_cari=mysqli_fetch_assoc($result_cari);

    if(mysqli_num_rows($result_cari)>0){
        $total_harga=$row_cari['harga'] * $qty;

        $sql_tambah="INSERT INTO penjualan (id_penjualan,nama_produk,total_harga,id_pelanggan) VALUES ('$kode_barang','$row_cari[nama_produk]','$total_harga','$id_pelanggan')";
        $result_tambah=mysqli_query($conn, $sql_tambah);
        header("Location: transaksi.php");

        mysqli_query($conn,"UPDATE produk SET stok = stok-$qty where id_produk='$kode_barang'");
    }
    else{
        echo"<script>alert('Barang tidak ditemukan')</script>";
    }

    
}

if(isset($_POST['hitung'])){
    $subtotal = mysqli_query($conn, "SELECT SUM(total_harga) AS total_harga FROM penjualan");
    $row_total = mysqli_fetch_assoc($subtotal);

    $uang = $_POST['uang'];
    $diskon = $_POST['diskon'] / 100;

    $harga_total = $row_total['total_harga'] - ($row_total['total_harga'] * $diskon);
    $kembali = $uang - $harga_total;

    $_SESSION['diskon'] = $_POST['diskon'];
    $_SESSION['uang'] = $uang;
    $_SESSION['total'] = $harga_total;
    $_SESSION['kembali'] = $kembali;

    mysqli_query($conn, "INSERT INTO laporan_harian (total_penjualan, tanggal_penjualan, nama_kasir, id_user) VALUES ('$harga_total', NOW(), 'Rio', '123123')");
}

if(isset($_POST['reset_keranjang'])) {
    mysqli_query($conn, "DELETE FROM penjualan");
    echo "<script>alert('Keranjang dikosongkan');window.location='transaksi.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link rel="stylesheet" href="../../src/style/style.css">
</head>
<body>
    <h1 class="body-title">Transaksi</h1>

    <form action="" method="post" class="frm-tbh_barang">
        <input type="number" name="kode_barang" id="kode_barang" placeholder="Kode Barang">
        <input type="number" name="qty" id="qty" placeholder="Kuantitas">
        <input type="number" name="id_pelanggan" id="id_pelanggan" placeholder="ID Pelanggan">
        <button type="submit" name="tambah">Tambah</button>
        <button type="submit" name="reset_keranjang" style="background-color:darkred;color:white;padding:5px;margin-top:10px;">Reset Keranjang</button>
    </form>

    <center>
        <table border="2" cellpadding="10" class="tble-daftar" style="margin-block: 30px;">
        <thead>
            <tr>
                <td>No</td>
                <td>ID Penjualan</td>
                <td>Nama Produk</td>
                <td>Total Harga</td>
                <td>ID Pelanggan</td>
            </tr>
        </thead>
<?php
$no=1;
$result_penjualan=mysqli_query($conn,"SELECT * FROM penjualan");
while($row=mysqli_fetch_assoc($result_penjualan)){?> 

        <tbody>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['id_penjualan']?></td>
                <td><?= $row['nama_produk']?></td>
                <td>Rp<?= number_format($row['total_harga'],0,",",".")?></td>
                <td><?= $row['id_pelanggan']?></td>
            </tr>
        </tbody>
 <?php  } ?>  
    </table>
    </center>

        <form action="" method="post" class="frm-uang">
        <input type="number" name="uang" id="uang" placeholder="Uang yang dibayarkan">
        <input type="number" name="diskon" id="diskon" placeholder="Diskon (%)">    
        <input type="number" name="total" id="total" placeholder="Total Harga" value="<?= $harga_total?>" readonly>
        <input type="number" name="kembali" id="kembali" placeholder="kembali" value="<?= $kembali?>" readonly>
        <button type="submit" name="hitung">Hitung</button>
        <a href="struk.php" class="cetak-struk" style=" font-size: 18px;padding: 6px;font-weight: 600;background-color:red;color:white;border:2px solid black;"> Cetak Struk</a> 
    </form>

</body>
</html>