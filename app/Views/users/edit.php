<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <!-- <div class="row"> -->
    <!-- <div class="col-8"> -->
    <h2 class="my-3">Ubah Data Akun</h2>
    <form action="/users/update/<?= $user['id']; ?>" method="POST">
        <?= csrf_field(); ?>
        <input type="hidden" name="id" value="<?= $user['id']; ?>">
        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label"><b>Nama</b></label>
            <div class="col-sm-10">
                <input type="text" id=" nama" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid'
                                                                                    : ''; ?>" value="<?= (old('nama')) ? old('nama') : $user['nama'] ?>">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= $validation->getError('nama'); ?>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="username" class="col-sm-2 col-form-label"><b>Username</b></label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid'
                                                            : ''; ?>" value="<?= (old('username')) ? old('username') : $user['username'] ?>" id="username" name="username">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= $validation->getError('username'); ?>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="password" class="col-sm-2 col-form-label"><b>Password</b></label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid'
                                                            : ''; ?>" value="<?= (old('password')) ? old('password') : $user['password'] ?>" id="password" name="password">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= $validation->getError('password'); ?>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="notelp" class="col-sm-2 col-form-label"><b>Nomor HP</b></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="notelp" name="notelp" value="<?= (old('notelp')) ? old('notelp') : $user['notelp'] ?>">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Ubah Data</button>
    </form>
    <!-- </div> -->
    <!-- </div> -->
</div>


<?= $this->endSection(); ?>