<?php
include'../../config.php';
include'../components/header.php';
include'../components/footer.php';

// Produk
$sql_produk="SELECT * FROM produk";
$result_produk=mysqli_query($conn,$sql_produk);
$row_produk=mysqli_num_rows($result_produk);

// Laporan Harian
$sql_harian="SELECT * FROM laporan_harian";
$result_harian=mysqli_query($conn,$sql_harian);
$row_harian=mysqli_num_rows($result_harian);

// Laporan Bulanan
$sql_bulanan="SELECT * FROM laporan_bulanan";
$result_bulanan=mysqli_query($conn,$sql_bulanan);
$row_bulanan=mysqli_num_rows($result_bulanan);

// Akun
$sql_akun="SELECT * FROM akun";
$result_akun=mysqli_query($conn,$sql_akun);
$row_akun=mysqli_num_rows($result_akun);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1 class="body-title">DASHBOARD</h1>
    <div class="card">
        <div class="card1">
            <h3>Produk</h3>
            <br>
            <hr>
            <h1> <?= $row_produk?></h1>
            <hr>
            <br>
            <center><a href="produk.php">>>Lihat Laporan</a></center>
        </div>

        <div class="card2">
        <h3>Laporan Harian</h3>
        <br>
            <hr>
            <h1> <?= $row_harian?> </h1>
            <hr>
            <br>
            <center><a href="laporan_harian.php">>>Lihat Laporan Harian</a></center>
        </div>

        <div class="card3">
        <h3>Laporan Bulanan</h3>
        <br>
            <hr>
            <h1>  <?= $row_bulanan?> </h1>
            <hr>
            <br>
            <center><a href="laporan_bulanan.php">>>Lihat Laporan Bulanan</a></center>
        </div>

        <div class="card4">
        <h3>Akun</h3>
        <br>
            <hr>
            <h1>  <?= $row_akun?> </h1>
            <hr>
            <br>
            <center><a href="profil.php">>>Lihat Profil</a></center>
        </div>
    </div>
</body>
</html>