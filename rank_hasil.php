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
$limit = ceil(5 / 100 * count($rel_nilai));
?>

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
        <?php
        $no = 1;
        foreach ($saw->rank as $key => $val) :
            if ($no++ > $limit)
                continue;
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
    <a class="btn btn-secondary" target="_blank" href="cetak.php?m=rank&kode_periode=<?= $kode_periode ?>"><span class="fa fa-print"></span> Cetak</a>
</div>
  <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Keterangan : hasil dari calon penerima beasiswa adalah 5% dari total jumlah siswa pada periode tersebut.</div>
                    </div>
                </div>
            </footer>