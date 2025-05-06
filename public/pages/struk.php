<?php
session_start();
include '../../config.php';

$data = mysqli_query($conn, "SELECT * FROM penjualan");

$diskon = isset($_SESSION['diskon']) ? $_SESSION['diskon'] : 0;
$uang = isset($_SESSION['uang']) ? $_SESSION['uang'] : 0;
$total = isset($_SESSION['total']) ? $_SESSION['total'] : 0;
$kembali = isset($_SESSION['kembali']) ? $_SESSION['kembali'] : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembelian</title>
    <style>
        body { font-family: Arial; }
        h2 { text-align: center; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        td, th { border: 1px solid black; padding: 8px; text-align: center; }
        .summary { width: 100%; font-size: 16px; }
        .summary td { padding: 5px; }
    </style>
</head>
<body onload="window.print()">
    <h2>Struk Pembelian</h2>

    <table>
        <tr>
            <th>No</th>
            <th>ID Penjualan</th>
            <th>Nama Produk</th>
            <th>Total Harga</th>
            <th>ID Pelanggan</th>
        </tr>
        <?php
        $no = 1;
        while($row = mysqli_fetch_assoc($data)) {?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['id_penjualan'] ?></td>
                <td><?= $row['nama_produk'] ?></td>
                <td>Rp<?= number_format($row['total_harga'], 0, ",", ".") ?></td>
                <td><?= $row['id_pelanggan'] ?></td>
            </tr>
        <?php } ?>
    </table>

    <table class="summary">
        <tr>
            <td><strong>Diskon:</strong></td>
            <td><?= $diskon ?>%</td>
        </tr>
        <tr>
            <td><strong>Total Harga Setelah Diskon:</strong></td>
            <td>Rp<?= number_format($total, 0, ",", ".") ?></td>
        </tr>
        <tr>
            <td><strong>Uang Dibayar:</strong></td>
            <td>Rp<?= number_format($uang, 0, ",", ".") ?></td>
        </tr>
        <tr>
            <td><strong>Kembali:</strong></td>
            <td>Rp<?= number_format($kembali, 0, ",", ".") ?></td>
        </tr>
    </table>
</body>
</html>

<?php session_destroy();?>