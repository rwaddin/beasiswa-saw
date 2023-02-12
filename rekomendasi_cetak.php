<div class="page-header">
    <h1>Perhitungan</h1>
</div>
<table>
    <thead>
        <tr>
            <th>Rank</th>
            <th>Kode</th>
            <th>Nama Siswa</th>
            <th>Selisih</th>
        </tr>
    </thead>
    <?php
    $q = esc_field(_get('q'));
    $rows = $db->get_results("SELECT * FROM tb_siswa WHERE nama_siswa LIKE '%$q%' ORDER BY rank");
    $no = 0;
    foreach ($rows as $row) : ?>
        <tr>
            <td><?= $row->rank ?></td>
            <td><?= $row->kode_siswa ?></td>
            <td><?= $row->nama_siswa ?></td>
            <td><?= round($row->total, 4) ?></td>
        </tr>
    <?php endforeach; ?>
</table>