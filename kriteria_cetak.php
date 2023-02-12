<h1>Kriteria</h1>
<table>
	<thead>
		<tr>
			<th>Kode</th>
			<th>Nama Kriteria</th>
			<th>Tipe</th>
			<th>Bobot</th>
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
		</tr>
	<?php endforeach; ?>
	<tfoot>
		<tr>
			<td colspan="3" class="text-right">Total Bobot</td>
			<td><?= $bobot ?></td>
		</tr>
	</tfoot>
</table>