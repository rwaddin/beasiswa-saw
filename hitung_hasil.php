<?php
$rel_siswa = get_rel_siswa($kode_periode);
$rel_status = get_rel_status($kode_periode);
foreach ($rel_status as $key => $val) {
    if ($val != 'Acc')
        unset($rel_siswa[$key]);
}
foreach ($KRITERIA as $key => $val) {
    $bobot[$key] = $val->bobot;
    $atribut[$key] = $val->atribut;
}
$rel_nilai = get_rel_nilai($rel_siswa);

$saw = new SAW($rel_nilai, $atribut, $bobot);
?>
<div class="card mb-3">
    <div class="card-header">
        <strong>Kriteria</strong>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover m-0">
            <thead>
                <tr>
                    <th>Kode Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot</th>
                </tr>
            </thead>
            <?php foreach ($saw->bobot as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $KRITERIA[$key]->nama_kriteria ?></td>
                    <td><?= $val ?></td>
                </tr>
            <?php endforeach ?>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-right">Total</td>
                    <td><?= array_sum($saw->bobot) ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <strong>Data Siswa</strong>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover m-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($rel_siswa as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $SISWA[$key]->nama_siswa ?></td>
                    <td><?= $SISWA[$key]->nama_kelas ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= isset($CRISP[$v]) ? $CRISP[$v]->nama_crisp : '' ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <strong>Data Nilai</strong>
         <h6>Pengkonfersian atribut data siswa ke kode kriteria dan nilai subkriteria</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover m-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($rel_nilai   as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $SISWA[$key]->nama_siswa ?></td>
                    <td><?= $SISWA[$key]->nama_kelas ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= $v ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="3">Min</td>
                    <?php foreach ($saw->minmax as $key => $val) : ?>
                        <td><?= $val['min'] ?></td>
                    <?php endforeach ?>
                </tr>
                <tr>
                    <td class="text-right" colspan="3">Max</td>
                    <?php foreach ($saw->minmax as $key => $val) : ?>
                        <td><?= $val['max'] ?></td>
                    <?php endforeach ?>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <strong>Normalisasi Matriks</strong>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover m-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($saw->normal as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $SISWA[$key]->nama_siswa ?></td>
                    <td><?= $SISWA[$key]->nama_kelas ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($v, 4) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <strong>Pembobotan</strong>
        <h6>( W = 0.2, 0.35, 0.25, 0.2)</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover m-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($saw->terbobot as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $SISWA[$key]->nama_siswa ?></td>
                    <td><?= $SISWA[$key]->nama_kelas ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($v, 4) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <strong>Perangkingan</strong>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover m-0">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Total</th>
                </tr>
            </thead>
            <?php foreach ($saw->rank as $key => $val) :
                $db->query("UPDATE tb_rel_siswa SET total='{$saw->total[$key]}', rank='$val' WHERE kode_siswa='$key' AND kode_periode='$kode_periode'"); ?>
                <tr>
                    <td><?= $val ?></td>
                    <td><?= $key ?></td>
                    <td><?= $SISWA[$key]->nama_siswa ?></td>
                    <td><?= $SISWA[$key]->nama_kelas ?></td>
                    <td><?= round($saw->total[$key], 4) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <div class="card-body">
        <a class="btn btn-secondary" target="_blank" href="cetak.php?m=hitung&kode_periode=<?= $kode_periode ?>"><span class="fa fa-print"></span> Cetak</a>
    </div>
</div>