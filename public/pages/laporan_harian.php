<?php
include'../../config.php';
include'../components/header.php';
include'../components/footer.php';

$sql="SELECT * FROM laporan_harian";
$result=mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Harian</title>
    <link rel="stylesheet" href="../../src/style/style.css">
</head>
<body>
    <h1 class="body-title">Laporan Harian</h1>
    <br>

    <form method="post" action="printall_harian.php" target="_blank">
    <button type="submit" class="tbl-print">Print All</button>
</form>

    <center>
        <table border="2" cellpadding="10" class="tble-daftar">
        <thead>
            <tr>
                <td>No</td>
                <td>ID Laporan</td>
                <td>Total Penjualan</td>
                <td>Tanggal Penjualan</td>
                <td>Nama Kasir</td>
                <td>ID User</td>
                <td>Aksi</td>
            </tr>
        </thead>

        <tbody>
            
            <tr>
            <?php
            $no=1;
            while($row=mysqli_fetch_assoc($result)){ ?>
                <td><?= $no++?></td>
                <td><?= $row['id_laporan_harian']?></td>
                <td>Rp<?= number_format($row['total_penjualan'],0,",",".") ?></td>
                <td><?= $row['tanggal_penjualan']?></td>
                <td><?= $row['nama_kasir']?></td>
                <td><?= $row['id_user']?></td>
                <td>
                    <a href="print_harian.php?id=<?= $row['id_laporan_harian'];?>" class="tbl-print" target="_blank">Print PDF</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </center>
</body>
</html>