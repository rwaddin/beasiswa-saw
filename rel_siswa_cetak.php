<h1>Laporan Nilai Bobot Siswa</h1>
<table class="table table-bordered table-hover table-striped m-0">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kelas</th>
            <?php foreach ($KRITERIA as $key => $val) : ?>
                <th><?= $val->nama_kriteria ?></th>
            <?php endforeach ?>
            <th>Status</th>
        </tr>
    </thead>
    <?php
    $rel_siswa = get_rel_siswa(_get('kode_periode'));
    $rel_status = get_rel_status(_get('kode_periode'));
    foreach ($rel_siswa as $key => $val) : ?>
        <tr>
            <td><?= $key ?></td>
            <td><?= $SISWA[$key]->nama_siswa ?></td>
            <td><?= $SISWA[$key]->nama_kelas ?></td>
            <?php foreach ($val as $k => $v) : ?>
                <td><?= isset($CRISP[$v]) ? $CRISP[$v]->nama_crisp : '' ?></td>
            <?php endforeach ?>
            <td><?= $rel_status[$key] ?></td>
        </tr>
    <?php endforeach; ?>
</table>