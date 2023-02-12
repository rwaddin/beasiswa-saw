<div class="page-header">
    <h1>Periode Beasiswa</h1>
</div>
<?php show_msg() ?>
<div class="card">
    <div class="card-header">
        <form class="row g-1 align-items-center">
            <input type="hidden" name="m" value="periode_view" />
            <div class="col-auto">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= _get('q') ?>" />
            </div>
            <div class="col-auto">
                <button class="btn btn-success"><span class="fa fa-refresh"></span> Refresh</button>
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
            $rows = $db->get_results("SELECT * FROM tb_periode WHERE nama_periode LIKE '%$q%' ORDER BY kode_periode DESC");
            $no = 0;
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $row->kode_periode ?></td>
                    <td><?= $row->nama_periode ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>