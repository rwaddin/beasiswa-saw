<div class="page-header">
    <h1>Nilai Subkriteria</h1>
</div>
<div class="card card-default">
    <div class="card-header">
        <form class="row row-cols-lg-auto g-1">
            <div class="col">
                <a class="btn btn-primary" href="?m=crisp_tambah"><span class="fa fa-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped m-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kriteria</th>
                    <th>Nama Subkriteria</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field(_get('q'));
            $rows = $db->get_results("SELECT *
                FROM tb_crisp c INNER JOIN tb_kriteria k ON k.kode_kriteria=c.kode_kriteria 
                WHERE k.nama_kriteria LIKE '%$q%' 
                ORDER BY k.kode_kriteria, nilai");
            $no = 1;
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->nama_kriteria ?></td>
                    <td><?= $row->nama_crisp ?></td>
                    <td><?= $row->nilai ?></td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="?m=crisp_ubah&ID=<?= $row->kode_crisp ?>&kode_kriteria=<?= $row->kode_kriteria ?>"><span class="fa fa-edit"></span></a>
                        <a class="btn btn-sm btn-danger" href="aksi.php?act=crisp_hapus&ID=<?= $row->kode_crisp ?>&kode_kriteria=<?= $row->kode_kriteria ?>" onclick="return confirm('Hapus data?')"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>