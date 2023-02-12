<div class="page-header">
    <h1>Hasil Perhitungan</h1>
</div>
<?php
$kode_periode = _get('kode_periode');
?>
<div class="card mb-3">
    <div class="card-header">
        <form class="row g-1 align-items-center">
            <input type="hidden" name="m" value="hitung" />
            <div class="col-auto">
                <select class="form-select" name="kode_periode" onchange="this.form.submit()">
                    <option value="">Pilih periode</option>
                    <?= get_periode_option($kode_periode) ?>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary"><span class="fa fa-signal"></span> Hitung</a>
            </div>
        </form>
    </div>
</div>
<?php
if ($kode_periode) {
    $rel_siswa = get_rel_siswa($kode_periode);
    if ($rel_siswa)
        include 'hitung_hasil.php';
    else
        print_msg('Data periode ini masih kosong!');
}
?>