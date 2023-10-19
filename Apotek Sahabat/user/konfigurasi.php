<?php include '../config.php';

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $nmUser = $_POST['nmUser'];
    $password = sha1($_POST['password']);
    $status = $_POST['status'];

    $koneksi->query("INSERT INTO user (username, nmUser, password, status) VALUES ('$username', '$nmUser', '$password', '$status')");
    header("location:index.php");
} else {
    $_SESSION['gagalposting'] = "Masukan data dengan lengkap!";
    header("location:index.php?gagal");
}


if (isset($_GET['hapusdata'])) {
    $username = $_GET['hapusdata'];
    $koneksi->query("DELETE FROM user WHERE username = '$username'");
    header("location:index.php");
}

if (isset($_POST['editposting'])) {
    $username = $_POST['username'];
    $nmUser = $_POST['nmUser'];
    $password = $_POST['password'];
    $status = $_POST['status'];
    
    $koneksi->query("UPDATE user SET nmUser='$nmUser', password='$password', status='$status' WHERE username='$username'");
    header("location:index.php");
}
?>