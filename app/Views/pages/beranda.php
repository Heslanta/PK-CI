<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php $session = session() ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="mt-4">
                <div class="opening-container">
                    <h1>Selamat Datang di Website HLP Consultant Banjarmasin, <?php echo $session->get('nama') ?>!</h1>
                    <p>Anda saat ini masuk sebagai <?= $session->get('level') ?>, mohon gunakan sistem dengan bijaksana!</p>
                </div>

                <div class="klien-container">
                    <h2>Klien berjumlah : <?= $jmlklien; ?> | Konsultasi berjumlah : <?= $jmlkonsul; ?></h2>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tujuan Konsultasi</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>

                        <?php foreach ($jadwal as $u) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $u['tujuan_jdw']; ?></td>
                                <td><?= $u['tanggal']; ?></td>
                                <td><?= $u['status']; ?></td>
                                <td>Button</td>


                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>



            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>