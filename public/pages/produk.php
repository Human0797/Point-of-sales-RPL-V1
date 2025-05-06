<?php
include '../../config.php';
include '../components/header.php';
include '../components/footer.php';

if (isset($_POST['tambah'])) {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    mysqli_query($conn, "INSERT INTO produk (id_produk, nama_produk, harga, stok) VALUES ('$id_produk', '$nama_produk', '$harga', '$stok')");
    header("Location: produk.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM produk WHERE id_produk='$id'");
    header("Location: produk.php");
}

if (isset($_POST['update'])) {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    mysqli_query($conn, "UPDATE produk SET nama_produk='$nama_produk', harga='$harga', stok='$stok' WHERE id_produk='$id_produk'");
    header("Location: produk.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Produk</title>
    <link rel="stylesheet" href="../../src/style/style.css">
</head>

<body>
    <h1 class="body-title">Kelola Produk</h1>

    <form action="" method="post" class="frm-tbh_barang">
        <input type="number" name="id_produk" placeholder="ID Produk" required>
        <input type="text" name="nama_produk" placeholder="Nama Produk" required>
        <input type="number" name="harga" placeholder="Harga" required>
        <input type="number" name="stok" placeholder="Stok" required>
        <button type="submit" name="tambah">Tambah Produk</button>
    </form>

    <center>
        <table border="2" cellpadding="10" class="tble-daftar" style="margin-block: 30px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $produk = mysqli_query($conn, "SELECT * FROM produk");
                while ($row = mysqli_fetch_assoc($produk)) {
                    echo "<tr>
                        <td>$no</td>
                        <td>{$row['id_produk']}</td>
                        <td>{$row['nama_produk']}</td>
                        <td>Rp" . number_format($row['harga'], 0, ",", ".") . "</td>
                        <td>{$row['stok']}</td>
                        <td>
                            <a href='produk.php?edit={$row['id_produk']}' style='color:blue;'>Edit</a> |
                            <a href='produk.php?hapus={$row['id_produk']}' onclick=\"return confirm('Yakin ingin hapus?')\" style='color:red;'>Hapus</a>
                        </td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </center>

    <?php if (isset($_GET['edit'])):
        $id_edit = $_GET['edit'];
        $data_edit = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_edit'");
        $row = mysqli_fetch_assoc($data_edit);
        ?>
        <form action="" method="post" class="frm-tbh_barang">
            <h3>Edit Produk</h3>
            <br>
            <input type="number" name="id_produk" value="<?= $row['id_produk'] ?>" readonly>
            <input type="text" name="nama_produk" value="<?= $row['nama_produk'] ?>" required>
            <input type="number" name="harga" value="<?= $row['harga'] ?>" required>
            <input type="number" name="stok" value="<?= $row['stok'] ?>" required>
            <button type="submit" name="update">Simpan Perubahan</button>
        </form>
    <?php endif; ?>
</body>

</html>