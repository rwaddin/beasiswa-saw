<h1> Laporan Data Siswa</h1>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kelas</th>
        </tr>
    </thead>
    <?php
    $kode_kelas = _get('kode_kelas');
    $q = esc_field(_get('q'));
    $where = "WHERE nama_siswa LIKE '%$q%'";
    if ($kode_kelas)
        $where .= " AND s.kode_kelas='$kode_kelas'";
    $rows = $db->get_results("SELECT * FROM tb_siswa s LEFT JOIN tb_kelas k ON k.kode_kelas=s.kode_kelas $where ORDER BY kode_siswa");
    $no = 0;
    foreach ($rows as $row) : ?>
        <tr>
            <td><?= ++$no ?></td>
            <td><?= $row->kode_siswa ?></td>
            <td><?= $row->nama_siswa ?></td>
            <td><?= $row->nama_kelas ?></td>
        </tr>
    <?php endforeach ?>
</table>