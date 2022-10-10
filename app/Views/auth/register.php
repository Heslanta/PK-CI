<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<?php

$dataPoints = array(
    array("y" => 15, "label" => "Januari"),
    array("y" => 30, "label" => "Februari"),
    array("y" => 25, "label" => "Maret"),
    array("y" => 18, "label" => "April"),
    array("y" => 10, "label" => "Mei"),
    array("y" => 76, "label" => "Juni"),
    array("y" => 21, "label" => "Juli"),
    array("y" => 80, "label" => "Agustus"),
    array("y" => 40, "label" => "September"),
    array("y" => 10, "label" => "Oktober"),
    array("y" => 90, "label" => "November"),
    array("y" => 85, "label" => "Desember")
);

?>
<style>
    .canvasjs-chart-credit {
        display: none !important;
    }
</style>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<div class="container">
    <div class="col-5">

        <script>
            window.onload = function() {

                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "light2",
                    title: {
                        text: "Jumlah Konsultasi Tahun ini"
                    },
                    axisY: {
                        title: "Jumlah Konsul"
                    },
                    data: [{
                        type: "column",
                        yValueFormatString: "#,##0.## konsultasi",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart.render();

            }
        </script>
        </head>

        <body>
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>

        </body>
    </div>
</div>



<?= $this->endSection() ?>