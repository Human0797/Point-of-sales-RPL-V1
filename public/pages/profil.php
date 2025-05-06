<?php
include'../../config.php';
include'../components/header.php';
include'../components/footer.php';


if(isset($_POST['search'])){
$cariID=$_POST['cariID'];

$sql="SELECT * FROM akun WHERE id_user='$cariID'";
$result=mysqli_query($conn,$sql);
}


if(isset($_POST['submit'])){
    $id=$_POST['id_user'];
    $nama_kasir=$_POST['nama_kasir'];
    $level=$_POST['level'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $no_hp=$_POST['no_hp'];
    $tgl_lahir=$_POST['tgl_lahir'];
    $alamat=$_POST['alamat'];

    $sql_update="UPDATE akun SET
    nama_kasir='$nama_kasir',
    level='$level',
    email='$email',
    password='$password',
    no_hp='$no_hp',
    tgl_lahir='$tgl_lahir',
    alamat='$alamat'
    where id_user='$id'";

    if($hasil=mysqli_query($conn, $sql_update)){
        echo"<script>alert('Data berhasil diubah')</script>";
        header("Location: profil.php");
    }
    else{
        echo"<script>alert('Data gagal diubah')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<h1 class="body-title">Profil</h1>
<body>

<center>
<form action="" method="post" class="frm-cariID">
<input type="text" name="cariID" id="cariID" placeholder="Cari ID">
<button type="submit" name="search" id="search">Cari ID</button>
</form>


    <form action="" method="post" class="form-login">
        <h3>UPDATE PROFIL</h3>
        <br>

        <?php
        
        if (isset($result) && $result && $row = mysqli_fetch_assoc($result)) {?>
        
        
        <input type="number" name="id_user" id="id_user" value="<?= $row['id_user']?>" readonly>
        <br>

        <input type="text" name="nama_kasir" id="nama_kasir" value="<?= $row['nama_kasir']?>">
        <br>

        <input type="text" name="level" id="level" value="<?= $row['level']?>">
        <br>

        <input type="email" name="email" id="email" value="<?= $row['email']?>">
        <br>

        <input type="password" name="password" id="password" value="<?= $row['password']?>">
        <br>

        <input type="number" name="no_hp" id="no_hp" value="<?= $row['no_hp']?>">
        <br>

        <input type="date" name="tgl_lahir" id="tgl_lahir" value="<?= $row['tgl_lahir']?>">
        <br>

        <input type="text" name="alamat" id="alamat" value="<?= $row['alamat']?>">
        <br>
        <br>

    <?php } 
    
    else{
        echo"Data tidak ditemukan";
    }?>

        <button type="submit" name="submit" id="click">Update Profil</button>
        <br>

        <a href="../../index.php">Logout</a>
    </form>
    </center>
</body>
</html>
