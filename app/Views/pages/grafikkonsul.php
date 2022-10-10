<link rel="stylesheet" href="<?= base_url() . '/plugins/chart.js/Chart.min.css'  ?>">
<script src="<?= base_url() . '/plugins/chart.js/Chart.bundle.min.js'  ?>"></script>

<canvas id="myChart" style="height: 50vh; width:80vh;"></canvas>
<?php
$tahun = "";
$bulan = "";
$total = "";

foreach ($grafik as $row) :
    $bln = $row->Bulan;
    $bulan .= "'$bln'" . ",";
    $thn = $row->Tahun;

    $tahun .= "'$thn'" . ",";

    $totalKonsul = $row->Jumlah_Konsul;
    $total .= "'$totalKonsul'" . ",";

endforeach;



?>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        responsive: true,
        data: {
            labels: [<?= $bulan ?>],
            datasets: [{
                label: 'Total Konsultasi',
                backgroundColor: ['rgb(240,128,128)', 'rgb(255,165,0)', 'rgb(240,230,140)',
                    'rgb(152,251,152)', 'rgb(255,99,132)', 'rgb(255,99,132)', 'rgb(255,99,132)', 'rgb(255,99,132)',
                    'rgb(255,99,132)', 'rgb(255,99,132)', 'rgb(255,99,132)', 'rgb(255,99,132)',
                ],
                borderColor: ['rgb(255,991,130)'],
                data: [<?= $total ?>]
            }]
        },
        duration: 500
    })
</script>