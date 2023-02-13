<?php
require_once 'functions.php';
/** login */
if ($mod == 'login') {
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);

    $row = $db->get_row("SELECT * FROM tb_user WHERE user='$user' AND pass='$pass'");
    if ($row) {
        $_SESSION['login'] = $row->user;
        $_SESSION['level'] = $row->level;
        redirect_js("index.php");
    } else {
        print_msg("Salah kombinasi username dan password.");
    }
} elseif ($act == 'logout') {
    unset($_SESSION['login'], $_SESSION['level'], $_SESSION['ID']);
    header("location:index.php?m=login");
} else if ($mod == 'password') {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];

    $tb = $_SESSION['level'] == 'siswa' ? 'tb_siswa' : 'tb_user';
    $row = $db->get_row("SELECT * FROM $tb WHERE user='$_SESSION[login]' AND pass='$pass1'");

    if ($pass1 == '' || $pass2 == '' || $pass3 == '')
        print_msg('Field bertanda * harus diisi.');
    elseif (!$row)
        print_msg('Password lama salah.');
    elseif ($pass2 != $pass3)
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else {
        $db->query("UPDATE tb_user SET pass='$pass2' WHERE user='$_SESSION[login]'");
        print_msg('Password berhasil diubah.', 'success');
    }
} elseif ($mod == 'daftar_kode') {
    $kode_siswa = $_POST['kode_siswa'];
    if (!$db->get_row("SELECT * FROM tb_siswa WHERE kode_siswa='$kode_siswa'"))
        print_msg("Kode tidak ditemukan!");
    else {
        redirect_js("daftar.php?kode_siswa=$kode_siswa");
    }
} elseif ($mod == 'daftar_nilai') {
    $kode_siswa = $_POST['kode_siswa'];
    $kode_periode = $_POST['kode_periode'];
    $kode_crisp = $_POST['kode_crisp'];
    foreach ($kode_crisp as $key => $val) {
        if ($val == '')
            $error = true;
    }

    if ($kode_siswa == '' || $kode_periode == '' || isset($error))
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif(count($_FILES["file"]["name"]) < count($kode_crisp)) {
        print_msg("Semua file harus diisi!");
    }elseif ($db->get_row("SELECT * FROM tb_rel_siswa WHERE kode_siswa='$kode_siswa' AND kode_periode='$kode_periode'")){
        print_msg("Anda sudah mendaftar di periode ini!");
    }else {
        foreach ($kode_crisp as $key => $val) {
    
            $tmp_name = $_FILES["file"]["tmp_name"][$key];
            $file_name = $_FILES["file"]["name"][$key];
            $file_name = $kode_siswa."-".$key."-".$file_name;
            if (move_uploaded_file($tmp_name, "files/$file_name")){
                $db->query("INSERT INTO tb_rel_siswa (kode_siswa, kode_periode, kode_kriteria, kode_crisp, status_rel_siswa, file) VALUES ('$kode_siswa', '$kode_periode', '$key', '$val', 'Pending', '$file_name')");
            }else{
                set_msg('Gagal upload file');
            }
        }
        set_msg('Pendaftaran berhasil! Data akan diproses oleh petugas.');
        redirect_js("login.php");
    }
}
/** siswa */
elseif ($mod == 'siswa_tambah') {
    $kode_siswa = $_POST['kode_siswa'];
    $nama_siswa = $_POST['nama_siswa'];
    $kode_kelas = $_POST['kode_kelas'];

    if ($kode_siswa == '' || $nama_siswa == '' || $kode_kelas == '')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif ($db->get_row("SELECT * FROM tb_siswa WHERE kode_siswa='$kode_siswa'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_siswa (kode_siswa, nama_siswa, kode_kelas) VALUES ('$kode_siswa', '$nama_siswa', '$kode_kelas')");
        redirect_js("index.php?m=siswa");
    }
} else if ($mod == 'siswa_ubah') {
    $nama_siswa = $_POST['nama_siswa'];
    $kode_kelas = $_POST['kode_kelas'];

    if ($nama_siswa == '' || $kode_kelas == '')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_siswa SET nama_siswa='$nama_siswa', kode_kelas='$kode_kelas' WHERE kode_siswa='$_GET[ID]'");
        redirect_js("index.php?m=siswa");
    }
} else if ($act == 'siswa_hapus') {
    $db->query("DELETE FROM tb_siswa WHERE kode_siswa='$_GET[ID]'");
    header("location:index.php?m=siswa");
}
/** kriteria */
elseif ($mod == 'kriteria_tambah') {
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_kriteria = $_POST['nama_kriteria'];
    $atribut = $_POST['atribut'];
    $bobot = $_POST['bobot'];

    if ($kode_kriteria == '' || $nama_kriteria == '' || $atribut == '' || $bobot == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_row("SELECT * FROM tb_kriteria WHERE kode_kriteria='$kode_kriteria'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_kriteria (kode_kriteria, nama_kriteria, atribut, bobot) 
            VALUES ('$kode_kriteria', '$nama_kriteria', '$atribut', '$bobot')");

        $db->query("INSERT INTO tb_rel_siswa(kode_siswa, kode_kriteria) SELECT kode_siswa, '$kode_kriteria' FROM tb_siswa");

        redirect_js("index.php?m=kriteria");
    }
} else if ($mod == 'kriteria_ubah') {
    $nama_kriteria = $_POST['nama_kriteria'];
    $atribut = $_POST['atribut'];
    $bobot = $_POST['bobot'];

    if ($nama_kriteria == '' || $atribut == '' || $bobot == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_kriteria SET nama_kriteria='$nama_kriteria', atribut='$atribut', bobot='$bobot' WHERE kode_kriteria='$_GET[ID]'");
        redirect_js("index.php?m=kriteria");
    }
} else if ($act == 'kriteria_hapus') {
    $db->query("DELETE FROM tb_kriteria WHERE kode_kriteria='$_GET[ID]'");
    header("location:index.php?m=kriteria");
}
/** kelas */
elseif ($mod == 'kelas_tambah') {
    $kode_kelas = $_POST['kode_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    if ($kode_kelas == '' || $nama_kelas == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_row("SELECT * FROM tb_kelas WHERE kode_kelas='$kode_kelas'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_kelas (kode_kelas, nama_kelas) VALUES ('$kode_kelas', '$nama_kelas')");
        redirect_js("index.php?m=kelas");
    }
} else if ($mod == 'kelas_ubah') {
    $nama_kelas = $_POST['nama_kelas'];
    if ($nama_kelas == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_kelas SET nama_kelas='$nama_kelas' WHERE kode_kelas='$_GET[ID]'");
        redirect_js("index.php?m=kelas");
    }
} else if ($act == 'kelas_hapus') {
    $db->query("DELETE FROM tb_kelas WHERE kode_kelas='$_GET[ID]'");
    header("location:index.php?m=kelas");
}
/** rel_siswa */
else if ($mod == 'rel_siswa') {
    $kode_periode = $_GET['kode_periode'];
    $kode_siswa = $_POST['kode_siswa'];
    if ($kode_periode == '') {
        print_msg('Pilih periode!');
    } else if ($db->get_row("SELECT * FROM tb_rel_siswa WHERE kode_siswa='$kode_siswa' AND kode_periode='$kode_periode'")) {
        print_msg('Siswa sudah masuk ke periode ini!');
    } else {
        $db->query("INSERT INTO tb_rel_siswa (kode_periode, kode_siswa, kode_kriteria, status_rel_siswa) SELECT '$kode_periode', '$kode_siswa', kode_kriteria, 'Pending' FROM tb_kriteria");
        print_msg('Siswa berhasil ditambahkan!', 'success');
    }
} else if ($mod == 'rel_siswa_ubah') {
    foreach ((array)$_POST['kode_crisp'] as $key => $val) {
        $db->query("UPDATE tb_rel_siswa SET kode_crisp='$val', status_rel_siswa='Acc' WHERE ID='$key'");
    }
    redirect_js("index.php?m=rel_siswa&kode_periode=" . $_GET['kode_periode']);
} else if ($act == 'rel_siswa_hapus') {
    $db->query("DELETE FROM tb_rel_siswa WHERE kode_periode='$_GET[kode_periode]' AND kode_siswa='$_GET[kode_siswa]'");
    header('location:index.php?m=rel_siswa&kode_periode=' . $_GET['kode_periode']);
} else if ($act == 'rel_siswa_status') {
    $db->query("UPDATE tb_rel_siswa SET status_rel_siswa='$_GET[status]' WHERE kode_periode='$_GET[kode_periode]' AND kode_siswa='$_GET[kode_siswa]'");
    header('location:index.php?m=rel_siswa&kode_periode=' . $_GET['kode_periode']);
} else if ($mod == 'rel_siswa_daftar') {
    $kode_periode = $_GET['kode_periode'];
    $kode_siswa = $_GET['kode_siswa'];
    if ($kode_periode == '') {
        print_msg('Pilih periode!');
    } else if ($db->get_row("SELECT * FROM tb_rel_siswa WHERE kode_siswa='$kode_siswa' AND kode_periode='$kode_periode'")) {
        print_msg('Anda sudah masuk ke periode ini!');
    } else {
        $db->query("INSERT INTO tb_rel_siswa (kode_periode, kode_siswa, kode_kriteria, status_rel_siswa) SELECT '$kode_periode', '$kode_siswa', kode_kriteria, 'Pending' FROM tb_kriteria");
        set_msg('Pendaftaran berhasil! Silahkan ubah data anda pada detail', 'success');
        redirect_js("index.php?m=periode_view");
    }
} else if ($mod == 'nilai_ubah') {
    foreach ((array)$_POST['kode_crisp'] as $key => $val) {
        $db->query("UPDATE tb_rel_siswa SET kode_crisp='$val', status_rel_siswa='Pending' WHERE ID='$key'");
    }
    set_msg('Ubah data berhasil!', 'success');
    redirect_js("index.php?m=periode_view");
}
/** user */
elseif ($mod == 'user_tambah') {
    $nama_user = $_POST['nama_user'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $level = $_POST['level'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $telpon = $_POST['telpon'];
    $jk = $_POST['jk'];

    if ($nama_user == '' || $user == '' || $pass == '' || $level == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("INSERT INTO tb_user (nama_user, user, pass, level, alamat, tanggal_lahir, telpon, jk) VALUES ('$nama_user', '$user', '$pass', '$level', '$alamat', '$tanggal_lahir', '$telpon', '$jk')");
        redirect_js("index.php?m=user");
    }
} else if ($mod == 'user_ubah') {
    $nama_user = $_POST['nama_user'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $level = $_POST['level'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $telpon = $_POST['telpon'];
    $jk = $_POST['jk'];

    if ($nama_user == '' || $user == '' || $pass == '' || $level == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_user SET nama_user='$nama_user', user='$user', pass='$pass', level='$level', alamat='$alamat', tanggal_lahir='$tanggal_lahir', telpon='$telpon', jk='$jk' WHERE id_user='$_GET[ID]'");
        redirect_js("index.php?m=user");
    }
} else if ($act == 'user_hapus') {
    $db->query("DELETE FROM tb_user WHERE id_user='$_GET[ID]'");
    header("location:index.php?m=user");
}

/** crisp */
elseif ($mod == 'crisp_tambah') {
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_crisp = $_POST['nama_crisp'];
    $nilai = $_POST['nilai'];

    if ($kode_kriteria == '' || $nama_crisp == '' || $nilai == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("INSERT INTO tb_crisp (kode_kriteria, nama_crisp, nilai) VALUES ('$kode_kriteria', '$nama_crisp', '$nilai')");
        redirect_js("index.php?m=crisp&kode_kriteria");
    }
} else if ($mod == 'crisp_ubah') {
    $kode_kriteria = $_POST['kode_kriteria'];
    $nama_crisp = $_POST['nama_crisp'];
    $nilai = $_POST['nilai'];

    if ($kode_kriteria == '' || $nama_crisp == '' || $nilai == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_crisp SET kode_kriteria='$kode_kriteria', nama_crisp='$nama_crisp', nilai='$nilai' WHERE kode_crisp='$_GET[ID]'");
        redirect_js("index.php?m=crisp&kode_kriteria");
    }
} else if ($act == 'crisp_hapus') {
    $db->query("DELETE FROM tb_crisp WHERE kode_crisp='$_GET[ID]'");
    header("location:index.php?m=crisp&kode_kriteria");
}
/** periode */
elseif ($mod == 'periode_tambah') {
    $kode_periode = $_POST['kode_periode'];
    $nama_periode = $_POST['nama_periode'];

    if ($kode_periode == '' || $nama_periode == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_row("SELECT * FROM tb_periode WHERE kode_periode='$kode_periode'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_periode (kode_periode, nama_periode) VALUES ('$kode_periode', '$nama_periode')");
        redirect_js("index.php?m=periode");
    }
} else if ($mod == 'periode_ubah') {
    $nama_periode = $_POST['nama_periode'];

    if ($nama_periode == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_periode SET nama_periode='$nama_periode' WHERE kode_periode='$_GET[ID]'");
        redirect_js("index.php?m=periode");
    }
} else if ($act == 'periode_hapus') {
    $db->query("DELETE FROM tb_periode WHERE kode_periode='$_GET[ID]'");
    header("location:index.php?m=periode");
}
