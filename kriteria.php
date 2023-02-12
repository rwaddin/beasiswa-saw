<div class="page-header">
    <h1>Kriteria</h1>
</div>
<div class="card">
    <div class="card-header">
        <form class="row g-1 align-items-center">
            <div class="col-auto">
                <a class="btn btn-primary" href="?m=kriteria_tambah"><span class="fa fa-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped m-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Kriteria</th>
                    <th>Tipe</th>
                    <th>Bobot</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field(_get('q'));
            $rows = $db->get_results("SELECT * FROM tb_kriteria WHERE nama_kriteria LIKE '%$q%' ORDER BY kode_kriteria");
            $no = 0;
            $bobot = 0;
            foreach ($rows as $row) : $bobot += $row->bobot ?>
                <tr>
                    <td><?= $row->kode_kriteria ?></td>
                    <td><?= $row->nama_kriteria ?></td>
                    <td><?= $row->atribut ?></td>
                    <td><?= $row->bobot ?></td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="?m=kriteria_ubah&ID=<?= $row->kode_kriteria ?>"><span class="fa fa-edit"></span></a>
                        <a class="btn btn-sm btn-danger" href="aksi.php?act=kriteria_hapus&ID=<?= $row->kode_kriteria ?>" onclick="return confirm('Hapus data?')"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach ?>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right">Total Bobot</td>
                    <td><?= $bobot ?></td>
                    <td>&nbsp;</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>