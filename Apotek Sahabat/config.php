<?php
session_start();
$koneksi = new mysqli('localhost', 'root', '', 'apotek') or die(mysqli_error($koneksi));


if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = sha1($_POST['password']);
    $query = $koneksi->query("SELECT * FROM user WHERE username='$username' and password='$password'");
    $num = mysqli_num_rows($query);
    $c = mysqli_fetch_array($query);
    if ($num > 0) {
        if ($c['password'] == sha1('pegawai')) {
            $_SESSION['username'] = $c['username'];
            $_SESSION['nmUser'] = $c['nmUser'];
            header("location:home.php");
        } else if ($c['password'] == sha1('admin')) {
            $_SESSION['username'] = $c['username'];
            $_SESSION['nmUser'] = $c['nmUser'];
            header("location:user/index.php");
        }
    } else {
        header("location:gagal.php");
    }
}
