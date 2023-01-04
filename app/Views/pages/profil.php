<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<?php $session = session() ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-header">
                    Profil Saya
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">

                            <h5 class="card-title"><b> Wajib Pajak : </b><br><?php echo $profil['nama']; ?></h5>
                            <p class="card-text"><b>Username : </b><br><?= $profil['username']; ?></p>
                            <p class="card-text"><b>Password : </b><br><?= $profil['password']; ?></p>
                            <?php if ($profil['level'] != 'klien') : ?>
                                <p class="card-text"><b>Level : </b><br><?= $profil['level']; ?></p>
                            <?php endif; ?>
                            <p class="card-text"><b>Nomor HP : </b><br><?= $profil['notelp']; ?></p>



                            <a href="/users/editprofil/<?= $session->get('id') ?>" class="btn btn-primary">Edit</a>
                            <!-- <button onclick="history.back()" class="btn btn-warning">Kembali</button> -->
                        </div>
                    </div>

                </div>
            </div>
            <br><br>
        </div>
        <script>
            $(function() {

                <?php if (session()->has("pesan")) { ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '<?= session("pesan") ?>'
                    })
                <?php } ?>

            });
        </script>
        <?= $this->endSection(); ?>