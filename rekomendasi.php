<div class="page-header">
    <h1>Rekomendasi Produk</h1>
</div>
<div class="row">
    <div class="col-sm-4">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <?php foreach ($KRITERIA as $key => $val) : ?>
                <div class="mb-3">
                    <label><?= $val->nama_kriteria ?></label>
                    <select class="form-select" name="kode_crisp[<?= $key ?>]">
                        <?= get_crisp_option($key, isset($_POST['kode_crisp'][$key]) ? $_POST['kode_crisp'][$key] : '') ?>
                    </select>
                </div>
            <?php endforeach ?>
            <div class="mb-3">
                <button class="btn btn-primary"><span class="fa fa-signal"></span> Hitung</button>
            </div>
        </form>
    </div>
</div>
<?php if ($_POST) include 'rekomendasi_hasil.php' ?>