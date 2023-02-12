<div class="page-header">
    <h1>Periode</h1>
</div>
<div class="card">
    <div class="card-header">
        <form class="row g-1 align-items-center">
            <input type="hidden" name="m" value="periode" />
            <div class="col-auto">
                <a class="btn btn-primary" href="?m=periode_tambah"><span class="fa fa-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped m-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Periode</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field(_get('q'));
            $rows = $db->get_results("SELECT * FROM tb_periode WHERE nama_periode LIKE '%$q%' ORDER BY kode_periode");
            $no = 0;
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $row->kode_periode ?></td>
                    <td><?= $row->nama_periode ?></td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="?m=periode_ubah&ID=<?= $row->kode_periode ?>"><span class="fa fa-edit"></span></a>
                        <a class="btn btn-sm btn-danger" href="aksi.php?act=periode_hapus&ID=<?= $row->kode_periode ?>" onclick="return confirm('Hapus data?')"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>