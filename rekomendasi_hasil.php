<?php
$rel_siswa = get_rel_siswa();
$kode_crisp  = $_POST['kode_crisp'];

$rel_siswa['A00'] = $kode_crisp;
$SISWA['A00'] = current($SISWA);
$SISWA['A00'] = 'Pilihan User';
ksort($rel_siswa);

$rel_nilai = get_rel_nilai($rel_siswa);

foreach ($KRITERIA as $key => $val) {
    $bobot[$key] = $val->bobot;
    $atribut[$key] = $val->atribut;
}
$smart = new SMART($rel_nilai, $bobot, $atribut);
?>
<div class="card mb-3">
    <div class="card-header">
        <strong>Normalisasi Kriteria</strong>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover m-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Bobot</th>
                    <th>Normal</th>
                </tr>
            </thead>
            <?php foreach ($smart->bobot as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $KRITERIA[$key]->nama_kriteria ?></td>
                    <td><?= $val ?></td>
                    <td><?= round($smart->bobot_normal[$key], 4) ?></td>
                </tr>
            <?php endforeach ?>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-right">Total</td>
                    <td><?= array_sum($smart->bobot) ?></td>
                    <td><?= array_sum($smart->bobot_normal) ?></td>
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
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($rel_siswa as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $SISWA[$key] ?></td>
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
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover m-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($rel_nilai   as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= $v ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
            <tfoot>
                <tr>
                    <td class="text-right">Min</td>
                    <?php foreach ($smart->minmax as $key => $val) : ?>
                        <td><?= $val['min'] ?></td>
                    <?php endforeach ?>
                </tr>
                <tr>
                    <td class="text-right">Max</td>
                    <?php foreach ($smart->minmax as $key => $val) : ?>
                        <td><?= $val['max'] ?></td>
                    <?php endforeach ?>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <strong>Nilai Utility</strong>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover m-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($smart->normal as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
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
        <strong>Terbobot</strong>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover m-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($smart->terbobot as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
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
        <strong>Total</strong>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover m-0">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Total</th>
                    <th>Selisih (<?= round($smart->tujuan, 4) ?>)</th>
                </tr>
            </thead>
            <?php foreach ($smart->rank as $key => $val) :
                $db->query("UPDATE tb_siswa SET total='{$smart->selisih[$key]}', rank='$val' WHERE kode_siswa='$key'") ?>
                <tr>
                    <td><?= $val ?></td>
                    <td><?= $key ?></td>
                    <td><?= $SISWA[$key] ?></td>
                    <td><?= round($smart->total[$key], 4) ?></td>
                    <td><?= round($smart->selisih[$key], 4) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <div class="card-body">
        <a class="btn btn-secondary" target="_blank" href="cetak.php?m=rekomendasi"><span class="fa fa-print"></span> Cetak</a>
    </div>
</div>