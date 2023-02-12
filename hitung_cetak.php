<div class="page-header">
    <h1>Laporan Perhitungan Penerimaan Beasiswa Kurang Mampu SAw MTs Aswaja Bumijawa</h1>
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
    $no = 0;
    foreach ($rows as $row) : ?>
        <tr>
            <td><?= $row->rank ?></td>
            <td><?= $row->kode_siswa ?></td>
            <td><?= $row->nama_siswa ?></td>
            <td><?= $row->nama_kelas ?></td>
            <td><?= round($row->total, 4) ?></td>
        </tr>
    <?php endforeach ?>
</table>