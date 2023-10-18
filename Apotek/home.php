<?php include '/xampp/htdocs/Blocking_Okt/Apotek/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body align='center'>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-light bg-Light" style="margin-bottom: 25px;">
            <div class="container-fluid">
                <img src="assets/img/apotek.png" alt="Logo" width="20" height="20" class="d-inline-block align-text-top">
                <a class="navbar-brand" href="#">Apotek Herbalia</a>
                <button class="navbar-toggler" type="button" data-bstoggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link btn btn-primary btn-sm dflex justify-content-end" style="color: white;" aria-current="page" href="login.php">Login</a>

                    <?php } else { ?>
                        <div class="dropdown-center">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <b><?php echo $_SESSION['nmUser']; ?></b>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="obat/index.php">Dashboard Data obat
                                <li><a class="dropdown-item" href="pegawai/index.php">Dashboard Data Pegawai
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </nav>
        <main align="center" style="margin-bottom: 70px;">
            <h2 style="margin-bottom: 40px;">Selamat Datang di Halaman Utama</h2>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-4">
                    <div class="card" style="width: 22rem;">
                        <img src="assets/img/obat1.jpg" class="card-img-top" alt="Obat" width="22rem" height="240px">
                        <div class="card-body">
                            <h5 class="card-title">Data Obat</h5>
                            <p class="card-text">Data obat sangat penting dalam dunia kesehatan untuk memastikan pasien menerima perawatan yang tepat dan aman.</p>
                            <a href="obat/index.php" class="btn btn-success">Manajemen Data Obat</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="width: 22rem;">
                        <img src="assets/img/pegawai.jpg" class="card-img-top" alt="Pegawai" width="22rem" height="240px">
                        <div class="card-body">
                            <h5 class="card-title">Data Pegawai</h5>
                            <p class="card-text">Data pegawai penting untuk memantau, mengelola, dan mengembangkan potensi dan kinerja pegawai.</p>
                            <a href="pegawai/index.php" class="btn btn-success">Manajemen Data Pegawai</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>