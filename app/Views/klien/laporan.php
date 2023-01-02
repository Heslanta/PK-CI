<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<style>
    .judul_laporan {
        text-align: center;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;

    }

    h5 {
        text-align: justify;
    }

    td {
        border: none;
        vertical-align: top;
        text-align: left;
        padding-left: 0px;
        padding-top: 0px;
        width: 50%;
        border-spacing: 0;
        height: fit-content;
    }
</style>

<body>


    <h2 class="judul_laporan">Laporan Konsultasi Pajak</h2>

    <hr>

    <h3>Data Klien</h4>

        <table cellspacing="0">
            <tr>
                <td>
                    <p><b>Wajib pajak : </b><?= $klien['wajibpajak']; ?></p>
                </td>
                <td>
                    <p><b>NPWP : </b><?= $klien['npwp']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p><b>Nomor EFIN : </b><?= $klien['efin']; ?></p>
                </td>
                <td>
                    <p><b>Nomor HP Wajib pajak : </b><?= $klien['notelp']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="card-text"><b>Bidang Usaha : </b><?= $klien['bidang_usaha']; ?></p>
                </td>
                <td>
                    <p class="card-text"><b>Email : </b><?= $klien['email']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="card-text"><b>Tanggal PKP : </b><?= tgl_indo($klien['pkp']) ?></p>
                </td>
                <td>
                    <p class="card-text"><b>ENOFA : </b><?= $klien['enofa']; ?></p>
                </td>
            </tr>
            <tr>


            </tr>


        </table>


        <hr>
        <br>
        <?php foreach ($konsultasi as $kon) :  ?>
            <h3>Konsultasi ke - <?= $kon->konsul_ke; ?></h3>
            <h4>Tanggal : <?= tgl_indo($kon->hari_tanggal); ?></h4>
            <h4>Tujuan Konsultasi : <?= $kon->tujuan; ?></h4>
            <h4>Hasil Konsultasi : <p><?= nl2br($kon->hasil_konsul); ?></p>
            </h4>
            <h4>Catatan Konsultasi : <p><?= nl2br($kon->catatan_konsul); ?></p>
            </h4>
            <br>
            <hr>
        <?php endforeach; ?>
</body>

</html>