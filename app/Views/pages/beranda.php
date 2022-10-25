<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php $session = session() ?>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="<?= base_url() . 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' ?>">

<div class="container">
    <div class="row">
        <div class="col">
            <div class="mt-4">
                <div class="opening-container">
                    <h1>Selamat Datang di Website HLP Consultant Banjarmasin, <?php echo $session->get('nama') ?>!</h1>
                    <p>Anda saat ini masuk sebagai <?= $session->get('level') ?>, mohon gunakan sistem dengan bijaksana!</p>
                </div>

                <div class="klien-container">
                </div>
                <h2>Klien berjumlah : <?= $jmlklien; ?> | Konsultasi berjumlah : <?= $jmlkonsul; ?></h2>
                <br>
                <!-- Start grafik -->
                <div class="col-lg-8">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">
                            <h5>Grafik Jumlah Konsultasi</h5>
                        </div>

                        <div class="card-body bg-white">
                            <div class="form-group">
                                <label for="">Pilih Tahun</label>
                                <input type="number" class="form-control" id="tahun" value="<?= date('Y') ?>">
                                <button type="button" class="btn btn-sm btn-primary" id="tombolTampil">
                                    Tampil
                                </button>
                            </div>
                            <div class="viewTampilGrafik"></div>
                        </div>
                    </div>
                </div>
                <!-- End grafik -->

                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tujuan</th>
                            <th>Tanggal</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + ($jmldata * ($currentPage - 1)); ?>

                        <?php foreach ($jadwal as $jad) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $jad['nama']; ?></td>
                                <td><?= $jad['tujuan_jdw']; ?></td>
                                <td><?= $jad['tanggal']; ?></td>
                                <td><?= $jad['status']; ?></td>


                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
<script>
    function tampilGrafik() {
        $.ajax({
            type: "post",
            url: "/pages/tampilGrafikKonsul",
            data: {
                tahun: $('#tahun').val()
            },
            dataType: "json",
            beforeSend: function() {
                $('.viewTampilGrafik').html('');
            },
            success: function(response) {
                if (response.data) {
                    $('.viewTampilGrafik').html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }

    $(document).ready(function() {
        tampilGrafik();
        $('#tombolTampil').click(function(e) {
            e.preventDefault();
            tampilGrafik();
        });
    });
</script>






<?= $this->endSection(); ?>