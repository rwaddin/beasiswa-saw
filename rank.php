<div class="page-header">
    <h1>Ranking</h1>
</div>
<?php
$kode_periode = _get('kode_periode');
?>
<div class="card mb-3">
    <div class="card-header">
        <form class="row g-1 align-items-center" method="get">
            <input type="hidden" name="m" value="rank" />
            <div class="col-auto">
                <select class="form-select" name="kode_periode" onchange="this.form.submit()">
                    <option value="">Pilih periode</option>
                    <?= get_periode_option($kode_periode) ?>
                </select>
            </div>
            <div class="col-2">
                <div class="input-group">
                    <input type="number" max="100" min="1" name="persen" class="form-control" value="<?= isset($_GET["persen"]) ? $_GET["persen"]: 5; ?>" required>
                    <span class="input-group-text" id="basic-addon2">%</span>
                </div>
            </div>
            <div class="col-1">
                <button class="btn btn-primary" type="submit">Lihat</button>
            </div>
        </form>
    </div>
    <?php
    if ($kode_periode) {
        $rel_siswa = get_rel_siswa($kode_periode);
        if ($rel_siswa)
            include 'rank_hasil.php';
        else
            print_msg('Data periode ini masih kosong!');
    }
    ?>
</div>