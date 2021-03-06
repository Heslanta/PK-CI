<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <!-- <div class="row">
        <div class="col-8"> -->
    <h2 class="my-3">Buat akun baru</h2>

    <form action="/users/save" method="POST">
        <?= csrf_field(); ?>
        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label"><b>Nama </b></label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid'
                                                            : ''; ?>" id="nama" name="nama" value="<?= old('nama'); ?>">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= $validation->getError('nama'); ?>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="username" class="col-sm-2 col-form-label"><b>Username </b></label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid'
                                                            : ''; ?>" id="username" name="username" value="<?= old('username'); ?>">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= $validation->getError('username'); ?>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="password" class="col-sm-2 col-form-label"><b>Password </b></label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid'
                                                            : ''; ?>" id="password" name="password" value="<?= old('password'); ?>">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= $validation->getError('password'); ?>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="notelp" class="col-sm-2 col-form-label"><b>Nomor HP </b></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="notelp" name="notelp" value="<?= old('notelp'); ?>">
            </div>
        </div>

        <div class="button-2-container">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="reset" value="cancel" onclick="history.back()" class="btn btn-secondary">Batal</button>
        </div>
    </form>
    <!-- </div>
    </div> -->
</div>


<?= $this->endSection(); ?>