<?php include '../config.php';

if (isset($_POST['simpan'])) {
    $kdObat = $_POST['kdObat'];
    $nmObat = $_POST['nmObat'];
    $kategori = $_POST['kategori'];
    $konsumsi = $_POST['konsumsi'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    $koneksi->query("INSERT INTO obat (kdObat, nmObat, kategori, konsumsi, stok, harga) VALUES ('$kdObat', '$nmObat', '$kategori', '$konsumsi', '$stok', '$harga' )");
    header("location:index.php");
} else {
    $_SESSION['gagalposting'] = "Masukan data dengan lengkap!";
    header("location:index.php?gagal");
}


if (isset($_GET['hapusdata'])) {
    $kdObat = $_GET['hapusdata'];
    $koneksi->query("DELETE FROM obat WHERE kdObat = '$kdObat'");
    header("location:index.php");
}

if (isset($_POST['editposting'])) {
    $kdObat = $_POST['kdObat'];
    $nmObat = $_POST['nmObat'];
    $kategori = $_POST['kategori'];
    $konsumsi = $_POST['konsumsi'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    $koneksi->query("UPDATE obat SET nmObat='$nmObat', kategori='$kategori', konsumsi='$konsumsi', stok='$stok', harga='$harga' WHERE kdObat='$kdObat'");
    header("location:index.php");
}
