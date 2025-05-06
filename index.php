<?php
include'config.php';

if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql="SELECT * FROM akun WHERE email='$email' AND password='$password'";
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0){
        echo"<script>alert('Login Berhasil')</script>";
        header("Location: public/pages/dashboard.php");
    }
    else{
        echo"<script>alert('Password atau Email yang anda masukkan salah')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="src/style/style.css">
</head>
<body>
    <center><form action="" method="post" class="form-login" style="margin-top:5rem;">
        <h2>Login</h2>
        <br>
        <h4>Masukkan email dan password</h4>
        <br> <br>

        <input type="email" name="email" id="email" placeholder="Email" required>
        <br>

        <input type="password" name="password" id="password" placeholder="Password" required>
        <br>

        <a href="#">Lupa password?</a>
        <br>

        <button type="submit" name="submit">Login</button>
    </form>
    </center>
</body>
</html>