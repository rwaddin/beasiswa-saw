<div class="page-header">
    <h1>Laporan Perhitungan Penerimaan Beasiswa Kurang Mampu SAW MTs Aswaja Bumijawa</h1>
</div>
<table>
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
    $q = esc_field(_get('q'));
    $rows = $db->get_results("SELECT * FROM tb_rel_siswa r INNER JOIN tb_siswa s ON s.kode_siswa=r.kode_siswa LEFT JOIN tb_kelas k ON k.kode_kelas=s.kode_kelas WHERE kode_periode='$_GET[kode_periode]' AND status_rel_siswa='Acc' GROUP BY s.kode_siswa ORDER BY rank");

    $persen = isset($_GET["persen"]) && is_numeric($_GET["persen"]) ? $_GET["persen"] : 5;
    $limit = ceil($persen / 100 * count($rows));

    $no = 1;
    foreach ($rows as $row) :
        if ($no++ > $limit)
            continue; ?>
        <tr>
            <td><?= $row->rank ?></td>
            <td><?= $row->kode_siswa ?></td>
            <td><?= $row->nama_siswa ?></td>
            <td><?= $row->nama_kelas ?></td>
            <td><?= round($row->total, 4) ?></td>
        </tr>
    <?php endforeach ?>
</table>
  <footer class="py-4 bg-light mt-auto">
              <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Keterangan : hasil dari calon penerima beasiswa adalah <?= $persen; ?>% dari total jumlah siswa pada periode tersebut.</div>
                    </div>
                </div>
 </footer>