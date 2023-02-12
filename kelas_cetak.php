<h1>Kelas</h1>
<table>
	<thead>
		<tr>
			<th>Kode</th>
			<th>Nama Kelas</th>
		</tr>
	</thead>
	<?php
	$q = esc_field(_get('q'));
	$rows = $db->get_results("SELECT * FROM tb_kriteria WHERE nama_kriteria LIKE '%$q%' ORDER BY kode_kriteria");
	$no = 0;
	foreach ($rows as $row) : ?>
		<tr>
			<td><?= $row->kode_kriteria ?></td>
			<td><?= $row->nama_kriteria ?></td>
		</tr>
	<?php endforeach ?>
</table>