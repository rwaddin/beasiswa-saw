<div class="page-header">
    <h1>Pengguna</h1>
</div>
<div class="card card-default">
    <div class="card-header">
        <form class="row g-1 align-items-center">
            <input type="hidden" name="m" value="user" />
            <div class="col-auto">
                <a class="btn btn-primary" href="?m=user_tambah"><span class="fa fa-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <table class="table table-bordered table-hover table-striped m-0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>User</th>
                <th>Level</th>
                <th>Alamat</th>
                <th>Tgl Lahir</th>
                <th>Telpon</th>
                <th>Jenis Kelamin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field(_get('q'));
        $pg = new Paging();
        $limit = 10;
        $offset = $pg->get_offset($limit, _get('page'));

        $from = "FROM tb_user";
        $where = "WHERE nama_user LIKE '%$q%'";

        $rows = $db->get_results("SELECT * $from $where ORDER BY id_user LIMIT $offset, $limit");
        $jumrec = $db->get_var("SELECT COUNT(*) $from $where");
        $no = $offset;
        foreach ($rows as $row) : ?>
            <tr>
                <td><?= ++$no ?></td>
                <td><?= $row->nama_user ?></td>
                <td><?= $row->user ?></td>
                <td><?= $row->level ?></td>
                <td><?= $row->alamat ?></td>
                <td><?= $row->tanggal_lahir ?></td>
                <td><?= $row->telpon ?></td>
                <td><?= $row->jk ?></td>
                <td>
                    <a class="btn btn-sm btn-warning" href="?m=user_ubah&ID=<?= $row->id_user ?>"><span class="fa fa-edit"></span></a>
                    <a class="btn btn-sm btn-danger" href="aksi.php?act=user_hapus&ID=<?= $row->id_user ?>" onclick="return confirm('Hapus data?')"><span class="fa fa-trash"></span></a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    <div class="card-footer">
        <?= $pg->show("m=user&q=$q&page=", $jumrec, $limit, _get('page')) ?>
    </div>
</div>