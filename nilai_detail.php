<?php
$row = $db->get_row("SELECT * FROM tb_siswa WHERE kode_siswa='$_GET[kode_siswa]'");
$kode_periode = _get('kode_periode');
?>
<div class="page-header">
    <h1>Detail Nilai &raquo; <small><?= $row->nama_siswa ?></small></h1>
</div>
<div class="row">
    <div class="col-sm-4">
        <table class="table table-bordered table-hover table-striped">

            <?php
            $rows = $db->get_results("SELECT * FROM tb_rel_siswa r LEFT JOIN tb_crisp c ON c.kode_crisp=r.kode_crisp WHERE kode_periode='$kode_periode' AND kode_siswa='$_GET[kode_siswa]' ORDER BY r.kode_kriteria");
            $status = '';
            foreach ($rows as $row) : $status = $row->status_rel_siswa ?>
                <tr>
                    <td><?= $KRITERIA[$row->kode_kriteria]->nama_kriteria ?></td>
                    <td><?= $row->nama_crisp ?></td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td>Status</td>
                <td><?= $status ?></td>
            </tr>
        </table>
        <div class="mb-3">
            <a class="btn btn-danger" href="?m=periode_view"><span class="fa fa-arrow-left"></span> Kembali</a>
        </div>
    </div>
</div>