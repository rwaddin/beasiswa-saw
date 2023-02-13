<div class="page-header">
    <h1>Laporan</h1>
</div>
<?php
$kode_periode = _get('kode_periode');
?>

<div class="card mb-3">
    <div class="card-header">
        <form class="" method="post">
            <?= get_periode_check($kode_periode) ?>
            <button class="btn btn-primary" type="submit"><i class="fa fa-chart-line"></i> Lihat</button>
        </form>
    </div>
</div>
<?php if ($_POST) :
    include 'aksi.php'
    ?>

<div class="card">
    <div class="card-body shadow">
        <figure class="highcharts-figure">
            <div id="container"></div>
        </figure>
    </div>
</div>

<script>
	Highcharts.chart('container', {

		title: {
			text: "Laporan Data Pendaftar"
		},
		yAxis: {
			title: {
				text: 'Jumlah Pendaftar'
			}
		},
		xAxis: {
          categories: <?= json_encode($chart["nama"]); ?>,
		},

		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'middle'
		},
		series: [{
			name: 'Pendaftar',
			data: <?= json_encode($chart["total"]); ?>
		}],

		responsive: {
			rules: [{
				condition: {
					maxWidth: 500
				},
				chartOptions: {
					legend: {
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom'
					}
				}
			}]
		}

	});
</script>

<?php endif; ?>