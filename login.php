<?php
include 'functions.php';
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="favicon.ico" />

    <title>Login | Beasiswa SAW</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/fontawesome/css/all.min.css" rel="stylesheet" />
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-info h-100">
    <div class="container d-flex h-100">
        <div class="row align-items-center w-100">
            <div class="col-md-4 mx-auto">
                <h5 class="text-center">Sistem Pendukung Keputusan Penerimaan Beasiswa Kurang Mampu SAW</h5>
                <form method="POST" action="?m=login">
                    <div class="card ">
                        <div class="card-header text-center">
                            Silakan Login
                        </div>
                        <div class="card-body">
                            <?= show_msg() ?>
                            <?php if ($_POST) include 'aksi.php' ?>
                            <div class="mb-3">
                                <input class="form-control" type="text" placeholder="Username" name="user" focus />
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="password" placeholder="Password" name="pass" />
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary"><span class="fa fa-right-to-bracket"></span> Login</button>
                                <a class="btn btn-info float-end" href="daftar.php"><i class="fa fa-user"></i> Pendaftaran Siswa</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>