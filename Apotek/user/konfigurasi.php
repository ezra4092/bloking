<?php include '../config.php';

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $nmUser = $_POST['nmUser'];
    $password = $_POST['password'];

    $koneksi->query("INSERT INTO user (username, nmUser, password) VALUES ('$username', '$nmUser', '$password')");
    header("location:index.php");
} else {
    $_SESSION['gagalposting'] = "Masukan data dengan lengkap!";
    header("location:index.php?gagal");
}


if (isset($_GET['delete'])) {
    $username = $_GET['delete'];
    $koneksi->query("DELETE FROM user WHERE username = '$username'");
    header("location:index.php");
}

if (isset($_POST['editposting'])) {
    $username = $_POST['username'];
    $nmUser = $_POST['nmUser'];
    $password = $_POST['password'];

    $koneksi->query("UPDATE user SET nmUser='$nmUser', password='$password' WHERE username='$username'");
    header("location:index.php");
}
?>