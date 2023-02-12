<?php
$row = $db->get_row("SELECT * FROM tb_user WHERE id_user='$_GET[ID]'");
?>
<div class="page-header">
    <h1>Ubah Pengguna</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="mb-3">
                <label>Nama User <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_user" value="<?= set_value('nama_user', $row->nama_user) ?>" />
            </div>
            <div class="mb-3">
                <label>Username <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="user" value="<?= set_value('user', $row->user) ?>" />
            </div>
            <div class="mb-3">
                <label>Password <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="pass" value="<?= set_value('pass', $row->pass) ?>" />
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <input class="form-control" type="text" name="alamat" value="<?= set_value('alamat', $row->alamat) ?>" />
            </div>
            <div class="mb-3">
                <label>Tanggal Lahir</label>
                <input class="form-control" type="date" name="tanggal_lahir" value="<?= set_value('tanggal_lahir', $row->tanggal_lahir) ?>" />
            </div>
            <div class="mb-3">
                <label>Telpon</label>
                <input class="form-control" type="text" name="telpon" value="<?= set_value('telpon', $row->telpon) ?>" />
            </div>
            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select class="form-select" name="jk">
                    <?= get_jk_option(set_value('jk', $row->jk)) ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Level <span class="text-danger">*</span></label>
                <select class="form-select" name="level">
                    <?= get_level_option(set_value('level', $row->level)) ?>
                </select>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=user"><span class="fa fa-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>