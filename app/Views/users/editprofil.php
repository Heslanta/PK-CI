    <?= $this->extend('layout/template'); ?>
    <?php $session = session() ?>

    <?= $this->section('content'); ?>
    <div class="container">
        <!-- <div class="row"> -->
        <!-- <div class="col-8"> -->
        <h2 class="my-3">Ubah Data Profil</h2>
        <form action="/users/updateprofil/<?= $session->get('id') ?>" method="POST">
            <?= csrf_field(); ?>
            <?php $type = 'hidden'; ?>

            <input type="hidden" name="id" value="<?= $session->get('id') ?>">

            <div class="row mb-3">
                <?php if ($session->get('level') == 'klien') : ?>
                    <?php $type = 'disabled readonly'; ?>
                    <input type="hidden" name="nama" value="<?= (old('nama')) ? old('nama') : $profil['nama']; ?>">

                <?php endif; ?>
                <?php if ($session->get('level') != 'klien') : ?>
                    <?php $type = 'type="text"'; ?>

                <?php endif; ?>
                <label for="nama" type="hidden" class="col-sm-2 col-form-label"><b>Nama :</b></label>
                <div class="col-sm-10">
                    <input <?= $type; ?> id=" nama" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid'
                                                                                        : ''; ?>" value="<?= (old('nama')) ? old('nama') : $profil['nama']; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('nama'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="username" class="col-sm-2 col-form-label"><b>Username :</b></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid'
                                                                : ''; ?>" value="<?= (old('username')) ? old('username') : $profil['username']; ?>" id="username" name="username">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('username'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="password" class="col-sm-2 col-form-label"><b>Password : </b></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid'
                                                                : ''; ?>" value="<?= (old('password')) ? old('password') : $profil['password']; ?>" id="password" name="password">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('password'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="notelp" class="col-sm-2 col-form-label"><b>Nomor HP :</b></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('notelp')) ? 'is-invalid'
                                                                : ''; ?>" value="<?= (old('notelp')) ? old('notelp') : $profil['notelp']; ?>" id=" notelp" name="notelp">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('notelp'); ?>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Ubah Data</button>

        </form>
        <!-- </div> -->
        <!-- </div> -->
    </div>


    <?= $this->endSection(); ?>