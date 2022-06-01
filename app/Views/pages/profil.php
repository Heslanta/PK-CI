<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<?php $session = session() ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div><?php endif; ?>
                <div class="card-header">
                    Profil Saya
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <h5 class="card-title"> Wajib Pajak : <br><?= $session->get('nama') ?></h5>
                            <p class="card-text">Username : <br><?= $session->get('username') ?></p>
                            <p class="card-text">Password : <br><?= $session->get('password') ?></p>
                            <p class="card-text">Level : <br><?= $session->get('level') ?></p>
                            <p class="card-text">Nomor Telpon : <br><?= $session->get('notelp') ?></p>

                            <?php if ($session->get('level') !== 'klien') : ?>

                                <a href="/users/editprofil/<?= $session->get('id') ?>" class="btn btn-primary">Edit</a>
                            <?php endif; ?>

                            <button onclick="history.back()" class="btn btn-warning">Kembali</button>
                        </div>
                    </div>

                </div>
            </div>
            <br><br>
        </div>
        <?= $this->endSection(); ?>