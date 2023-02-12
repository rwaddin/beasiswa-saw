<h1>Periode</h1>
<table>
	<thead>
		<tr>
			<th>Kode</th>
			<th>Nama Periode</th>
			<th>Status</th>
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
			<td><?= $row->status_periode ?></td>
		</tr>
	<?php endforeach ?>
</table>