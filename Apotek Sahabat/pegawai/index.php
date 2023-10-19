<?php
include '../config.php';

if (!isset($_SESSION['username'])) {
    header("location:../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>

<body>
    <!-- <div class="container"> -->
        <nav class="navbar navbar-expand-sm navbar-light bg-success" style="margin-bottom: 50px; padding-bottom: 10px;">
            <div class="container-fluid">
                <a class="navbar-brand text-light ms-5" href="#"><h4>Dashboard Pegawai</h4></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        </li>
                    </ul>
                    <?php
                    if (!isset($_SESSION['username'])) {
                    ?>
                        <a class="nav-link btn btn-primary btn-sm d-flex justify-content-end" style="color: white;" aria-current="page" href="login.php">Login</a>
                    <?php } else { ?>
                        <div class="btn-group dropstart">
                            <button type="button" class="btn btn-light dropdown-toggle me-5" data-bs-toggle="dropdown" aria-expanded="false">
                                <b><?php echo $_SESSION['nmUser']; ?></b>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="../home.php">Halaman Utama</a></li>
                                <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </nav>
        <div class="container">
        <div class="row">
            <div class="col mt-3">
                <h4>Manajemen Data Pegawai</h4>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php if (isset($_GET['gagal'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i></strong> <?= $_SESSION['gagalposting']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <a href="#" class="btn btn-success btn-sm float-end mb-2" data-bs-toggle="modal" data-bs-target="#tambahdata"><i class="fas fa-plus"></i> Tambah Data</a>
            </div>
        </div>
        <table class="table table-striped table-sm mt-1" id="tabel">
            <thead>
                <tr align="center">
                    <th>No</th>
                    <th>ID Pegawai</th>
                    <th>Nama Pegawai</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Pendidikan terakhir</th>
                    <th>Jabatan</th>
                    <th>Gaji</th>
                </tr>
            </thead>
            <tbody align="center">
                <?php
                $no = 1;
                $panggil = $koneksi->query("SELECT * FROM pegawai ");
                while ($row = $panggil->fetch_array()) {
                ?>
                    <tr align="center">
                        <td class="align-middle"><?= $no++; ?></td>
                        <td class="align-middle"><?= $row['idPegawai']; ?></td>
                        <td class="align-middle"><?= $row['nmPegawai'] ?></td>
                        <td class="align-middle"><?= $row['jk'] ?></td>
                        <td class="align-middle"><?= $row['alamat'] ?></td>
                        <td class="align-middle"><?= $row['pendidikan'] ?></td>
                        <td class="align-middle"><?= $row['jabatan'] ?></td>
                        <td class="align-middle"><?= $row['gaji'] ?></td>
                        <td class="align-middle"><a data-href="#" class="btn btn-warning btn-sm update" data-bs-toggle="modal" data-bs-target="#editdata" data-idPegawai="<?= $row['idPegawai'] ?>" data-nmPegawai="<?= $row['nmPegawai'] ?>" data-alamat="<?= $row['alamat'] ?>"><i class="fas fa-pen"></i></a>
                                                 <a data-href="#" class="btn btn-danger btn-sm delete" data-bs-toggle="modal" data-bs-target="#hapusdata" data-idPegawai="<?= $row['idPegawai'] ?>" data-nmPegawai="<?= $row['nmPegawai'] ?>" data-alamat="<?= $row['alamat'] ?>"><i class="fas fa-trash"></i></a>
                    </tr>
            </tbody>
        <?php } ?>
        </table>
    </div>

        <!-- Modal Hapus-->
        <div class="modal fade" id="hapusdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="konfigurasi.php" method="get">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabell">Yakin ingin menghapus data ini?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="idPegawai_u" name="hapusdata">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal tambah data -->
    <div class="modal fade" id="tambahdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="konfigurasi.php" method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label for="idPegawai" class="col-sm-3 col-form-label">ID Pegawai</label>
                            <div class="col-sm-9">
                                <input type="text" name="idPegawai" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nmPegawai" class="col-sm-3 col-form-label">Nama Pegawai</label>
                            <div class="col-sm-9">
                                <input type="text" name="nmPegawai" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select name="jk" id="jk" class="form-control">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="pendidikan" class="col-sm-3 col-form-label">Pendidikan</label>
                            <div class="col-sm-9">
                                <input type="text" name="pendidikan" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <select name="jabatan" id="jabatan" class="form-control">
                                    <option value="Apoteker">Apoteker</option>
                                    <option value="Teknisi Farmasi">Teknisi Farmasi</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Kasir">Kasir</option>
                                    <option value="Ahli Gizi">Ahli Gizi</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="gaji" class="col-sm-3 col-form-label">Gaji</label>
                            <div class="col-sm-9">
                                <input type="text" name="gaji" class="form-control" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- Modal edit -->
    <div class="modal fade" id="editdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Data Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="konfigurasi.php" method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label for="nmPegawai" class="col-sm-3 col-form-label">Nama Pegawai</label>
                            <div class="col-sm-9">
                                <input type="text" name="nmPegawai" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select name="jk" id="jk" class="form-control">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="pendidikan" class="col-sm-3 col-form-label">Pendidikan</label>
                            <div class="col-sm-9">
                                <input type="text" name="pendidikan" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <select name="jabatan" id="jabatan" class="form-control">
                                    <option value="Apoteker">Apoteker</option>
                                    <option value="Teknisi Farmasi">Teknisi Farmasi</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Kasir">Kasir</option>
                                    <option value="Ahli Gizi">Ahli Gizi</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="gaji" class="col-sm-3 col-form-label">Gaji</label>
                            <div class="col-sm-9">
                                <input type="text" name="gaji" class="form-control" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm">
                        <input type="text" name="idPegawai" class="form-control" id="kode" readonly>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="editposting" class="btn btn-success">Edit</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        $(document).on('click', '.update', function(e) {
            var kode = $(this).attr("data-idPegawai");
            var nmPegawai = $(this).attr("data-nmPegawai");
            var alamat = $(this).attr("data-alamat");
            $('#kode').val(kode);
            $('#nmPegawai_u').val(nmPegawai);
            $('#alamat_u').val(alamat);
        });
    </script>
    <script>
        $(document).on('click', '.delete', function(e) {
            var idPegawai = $(this).attr("data-idPegawai");
            var nmPegawai = $(this).attr("data-nmPegawai");
            var alamat = $(this).attr("data-alamat");
            $('#idPegawai_u').val(idPegawai);
            $('#nmPegawai_u').val(nmPegawai);
            $('#alamat_u').val(alamat);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tabel').DataTable({
                "paging": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
</body>

</html>