<?php
include 'functions.php';
if (empty($_SESSION['login']))
    header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="favicon.ico" />
    <title>Beasiswa SAW</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/fontawesome/css/all.min.css" rel="stylesheet" />
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="?">SAW</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i> <?= _session('login') ?></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="?m=password">Password</a></li>
                    <li><a class="dropdown-item" href="aksi.php?act=logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark bg-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="?m=home">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Home
                        </a>
                        <?php if (_session('level') == 'admin') : ?>
                            <a class="nav-link" href="?m=user">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Pengguna
                            </a>
                            <a class="nav-link" href="?m=periode">
                                <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                                Periode
                            </a>
                            <a class="nav-link" href="?m=kriteria">
                                <div class="sb-nav-link-icon"><i class="fas fa-calculator"></i></div>
                                Kriteria
                            </a>
                            <a class="nav-link" href="?m=crisp">
                                <div class="sb-nav-link-icon"><i class="fas fa-calculator"></i></div>
                                Subkriteria
                            </a>
                            <a class="nav-link" href="?m=kelas">
                                <div class="sb-nav-link-icon"><i class="fas fa-th"></i></div>
                                Kelas
                            </a>
                            <a class="nav-link" href="?m=siswa">
                                <div class="sb-nav-link-icon"><i class="fas fa-th"></i></div>
                                Siswa
                            </a>
                            <a class="nav-link" href="?m=rel_siswa">
                                <div class="sb-nav-link-icon"><i class="fas fa-th"></i></div>
                                Pendaftaran
                            </a>
                        <?php elseif (_session('level') == 'user') : ?>
                            <a class="nav-link" href="?m=periode">
                                <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                                Periode
                            </a>
                            <a class="nav-link" href="?m=kriteria">
                                <div class="sb-nav-link-icon"><i class="fas fa-calculator"></i></div>
                                Kriteria
                            </a>
                            <a class="nav-link" href="?m=crisp">
                                <div class="sb-nav-link-icon"><i class="fas fa-calculator"></i></div>
                                Subkriteria
                            </a>
                            <a class="nav-link" href="?m=kelas">
                                <div class="sb-nav-link-icon"><i class="fas fa-th"></i></div>
                                Kelas
                            </a>
                            <a class="nav-link" href="?m=siswa">
                                <div class="sb-nav-link-icon"><i class="fas fa-th"></i></div>
                                Siswa
                            </a>
                            <a class="nav-link" href="?m=rel_siswa">
                                <div class="sb-nav-link-icon"><i class="fas fa-th"></i></div>
                                Pendaftaran
                            </a>
                        <?php else : ?>
                            <!-- SISWA -->
                            <a class="nav-link" href="?m=periode_view">
                                <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                                Beasiswa
                            </a>
                            <!-- <a class="nav-link" href="?m=profil">
                                <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                                Profil
                            </a> -->
                        <?php endif ?>
                        <a class="nav-link" href="?m=hitung">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Perhitungan
                        </a>
                        <a class="nav-link" href="?m=rank">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Rank
                        </a>
                        <a class="nav-link" href="?m=laporan">
                            <div class="sb-nav-link-icon"><i class="fas fa-print"></i></div>
                            Laporan
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 py-3">
                    <?php
                    if (!_session('login') && !in_array($mod, array('', 'home', 'hitung', 'login', 'tentang')))
                        $mod = 'login';

                    if (file_exists($mod . '.php'))
                        include $mod . '.php';
                    else
                        include 'home.php';
                    ?>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; SPK Penerimaan Beasiswa Kurang Mampu SAW</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>