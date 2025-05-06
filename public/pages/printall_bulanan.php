<?php
include '../../config.php';

$sql = "SELECT * FROM laporan_bulanan";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Semua Laporan Bulanan</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        h2 { text-align: center; }
        @media print {
            button { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <h2>Laporan Bulanan (Semua Data)</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Laporan</th>
                <th>Total Penjualan</th>
                <th>Tanggal Penjualan</th>
                <th>Nama Kasir</th>
                <th>ID User</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['id_laporan_bulanan']}</td>
                    <td>Rp" . number_format($row['total_penjualan'], 0, ',', '.') . "</td>
                    <td>{$row['tanggal_penjualan']}</td>
                    <td>{$row['nama_kasir']}</td>
                    <td>{$row['id_user']}</td>
                </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>
