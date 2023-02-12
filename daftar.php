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

    <title>Daftar | Beasiswa SAW</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/fontawesome/css/all.min.css" rel="stylesheet" />
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-info h-100">
    <div class="container d-flex h-100">
        <div class="row align-items-center w-100">
            <div class="col-md-4 mx-auto">
                <?php
                $kode_siswa = _get('kode_siswa');
                if (!$kode_siswa)
                    include 'daftar_kode.php';
                else
                    include 'daftar_nilai.php';
                ?>
            </div>
        </div>
    </div>
</body>

</html>