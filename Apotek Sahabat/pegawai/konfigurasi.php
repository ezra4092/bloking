<?php include '../config.php';

if (isset($_POST['simpan'])) {
    $idPegawai = $_POST['idPegawai'];
    $nmPegawai = $_POST['nmPegawai'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $pendidikan = $_POST['pendidikan'];
    $jabatan = $_POST['jabatan'];
    $gaji = $_POST['gaji'];

    $koneksi->query("INSERT INTO pegawai (idPegawai, nmPegawai, jk, alamat, pendidikan, jabatan, gaji) VALUES ('$idPegawai', '$nmPegawai', '$jk', '$alamat', '$pendidikan', '$jabatan', '$gaji')");
    header("location:index.php");
} else {
    $_SESSION['gagalposting'] = "Masukan data dengan lengkap!";
    header("location:index.php?gagal");
}


if (isset($_GET['hapusdata'])) {
    $idPegawai = $_GET['hapusdata'];
    $koneksi->query("DELETE FROM pegawai WHERE idPegawai = '$idPegawai'");
    header("location:index.php");
}

if (isset($_POST['editposting'])) {
    $idPegawai = $_POST['idPegawai'];
    $nmPegawai = $_POST['nmPegawai'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $pendidikan = $_POST['pendidikan'];
    $jabatan = $_POST['jabatan'];
    $gaji = $_POST['gaji'];
  
    $koneksi->query("UPDATE pegawai SET nmPegawai='$nmPegawai', jk='$jk', alamat='$alamat', pendidikan='$pendidikan', jabatan='$jabatan', gaji='$gaji' WHERE idPegawai='$idPegawai'");
    header("location:index.php");
}
?>