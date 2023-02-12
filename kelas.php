<div class="page-header">
    <h1>Kelas</h1>
</div>
<div class="card">
    <div class="card-header">
        <form class="row g-1 align-items-center">
            <div class="col-auto">
                <a class="btn btn-primary" href="?m=kelas_tambah"><span class="fa fa-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped m-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field(_get('q'));
            $rows = $db->get_results("SELECT * FROM tb_kelas WHERE nama_kelas LIKE '%$q%' ORDER BY kode_kelas");
            $no = 0;
            foreach ($rows as $row) :  ?>
                <tr>
                    <td><?= $row->kode_kelas ?></td>
                    <td><?= $row->nama_kelas ?></td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="?m=kelas_ubah&ID=<?= $row->kode_kelas ?>"><span class="fa fa-edit"></span></a>
                        <a class="btn btn-sm btn-danger" href="aksi.php?act=kelas_hapus&ID=<?= $row->kode_kelas ?>" onclick="return confirm('Hapus data?')"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>