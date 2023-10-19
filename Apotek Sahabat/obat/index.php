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
            <a class="navbar-brand text-light ms-5" href="#">
                <h4>Dashboard Pegawai</h4>
            </a>
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
    <main>
        <div class="container">
            <div class="row">
                <div class="col mt-3">
                    <h4>Manajemen Data Obat</h4>
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
            <nav style="--bs-breadcrumb-divider: url(&#34; data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 6 1.5 4.5 0 4.5 0 2.5 0z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">

                <table class="table table-striped table-sm mt-1" id="tabel">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Kode Obat</th>
                            <th>Nama Obat</th>
                            <th>Kategori</th>
                            <th>Konsumsi oleh</th>
                            <th>Stok</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        <?php
                        $no = 1;
                        $panggil = $koneksi->query("SELECT * FROM obat ");
                        while ($row = $panggil->fetch_array()) {
                        ?>
                            <tr align="center">
                                <td class="align-middle"><?= $no++; ?></td>
                                <td class="align-middle"><?= $row['kdObat']; ?></td>
                                <td class="align-middle"><?= $row['nmObat'] ?></td>
                                <td class="align-middle"><?= $row['kategori'] ?></td>
                                <td class="align-middle"><?= $row['konsumsi'] ?></td>
                                <td class="align-middle"><?= $row['stok'] ?></td>
                                <td class="align-middle"><?= $row['harga'] ?></td>
                                <td class="align-middle"><a data-href="#" class="btn btn-warning btn-sm update" data-bs-toggle="modal" data-bs-target="#editdata" data-kdObat="<?= $row['kdObat'] ?>" data-nmObat="<?= $row['nmObat'] ?>" data-kategori="<?= $row['kategori'] ?>"><i class="fas fa-pen"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm delete" data-bs-toggle="modal" data-bs-target="#hapusdata" data-kdObat="<?= $row['kdObat'] ?>""><i class="fas fa-trash"></i></a>
                            </tr>
                    </tbody>
                <?php } ?>
                </table>
        </div>
    </main>
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
                        <button type="submit" class="btn btn-danger" id="kdObat_u" name="hapusdata">Hapus</button>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="konfigurasi.php" method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label for="kdObat" class="col-sm-3 col-form-label">Kode Obat</label>
                            <div class="col-sm-9">
                                <input type="text" name="kdObat" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nmObat" class="col-sm-3 col-form-label">Nama Obat</label>
                            <div class="col-sm-9">
                                <input type="text" name="nmObat" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <input type="text" name="kategori" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="konsumsi" class="col-sm-3 col-form-label">Konsumsi oleh</label>
                            <div class="col-sm-9">
                                <select name="konsumsi" id="konsumsi" class="form-control">
                                    <option value="Dewasa">Dewasa</option>
                                    <option value="Anak-anak">Anak-anak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                            <div class="col-sm-9">
                                <input type="text" name="stok" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="text" name="harga" class="form-control" required>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Data Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="konfigurasi.php" method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label for="nmObat" class="col-sm-3 col-form-label">Nama Obat</label>
                            <div class="col-sm-9">
                                <input type="text" name="nmObat" id="nmObat_u" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <input type="text" name="kategori" id="kategori_u" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="konsumsi" class="col-sm-3 col-form-label">Konsumsi</label>
                            <div class="col-sm-9">
                                <select name="konsumsi" id="konsumsi" class="form-control">
                                    <option value="Dewasa">Dewasa</option>
                                    <option value="Anak-anak">Anak-anak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                            <div class="col-sm-9">
                                <input type="text" name="stok" id="" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="text" name="harga" class="form-control" required>
                            </div>
                        </div>
                </div>

                <div class="modal-footer">
                    <div class="col-sm">
                        <input type="text" name="kdObat" id="kode" class="form-control" readonly>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="editposting" class="btn btn-success">Edit</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        $(document).on('click', '.update', function(e) {
            var kode = $(this).attr("data-kdObat");
            var nmObat = $(this).attr("data-nmObat");
            var kategori = $(this).attr("data-kategori");
            var stok = $(this).attr("data-stok");
            var harga = $(this).attr("data-harga");
            $('#kode').val(kode);
            $('#nmObat_u').val(nmObat);
            $('#kategori_u').val(kategori);
        });
    </script>
    <script>
        $(document).on('click', '.delete', function(e) {
            var kdObat = $(this).attr("data-kdObat");
            var nmObat = $(this).attr("data-nmObat");
            var kategori = $(this).attr("data-kategori");
            $('#kdObat_u').val(kdObat);
            $('#nmObat_u').val(nmObat);
            $('#kategori_u').val(kategori);
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