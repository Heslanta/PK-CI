<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php $session = session() ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="mt-4">
                <div class="opening-container">
                    <h1>Selamat Datang di Website HLP Consultant Banjarmasin, <?= $session->get('nama') ?>!</h1>
                    <p>Mohon gunakan sistem dengan bijaksana!</p>
                </div>
                <br>
                <h2>Jadwal Konsultasi</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tujuan Konsultasi</th>
                            <th scope="col">Jadwal</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>



                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>