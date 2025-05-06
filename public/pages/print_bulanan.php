<?php
include '../../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM laporan_bulanan WHERE id_laporan_bulanan='$id'";
    $result = mysqli_query($conn, $sql);
} else {
    echo "<script>alert('Produk tidak ditemukan dalam url')</script>";
    header("Location: laporan_bulanan.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Bulanan</title>
    <link rel="stylesheet" href="../../src/style/style.css">
</head>

<body onload="window.print()">
<?php

if($row=mysqli_fetch_assoc($result)){ ?>

<center>
<form action="" class="print-laporan">
    <h1>POS RPL 5</h1>
    <br>
    <h3>LAPORAN BULANAN</h3>
    <br>
    <h5>Tanggal : <?= $row['tanggal_penjualan']?></h5>
    <br>

    <p>_____________________________</p>
    <br>
    <input type="text" value="ID Laporan      : <?= $row['id_laporan_bulanan']?>" readonly>
    <br>

    <input type="text" value="Total Penjualan : <?= number_format($row['total_penjualan'],0,",","0") ?>" readonly>
    <br>


    <input type="text" value="Nama Kasir      : <?= $row['nama_kasir']?>" readonly>
    <br>

    <input type="text" value="ID User         : <?= $row['id_user']?>" readonly>
    <br>

    <p>_____________________________</p>
    <br>
    <p>@POS RPL by Rizki Rio</p>
<?php }?>
</body>

</html>