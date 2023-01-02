<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <!-- <div class="row">
        <div class="col-8"> -->
    <h2 class="my-3">Buat </h2>

    <form action="/tujuan/save" method="POST">
        <?= csrf_field(); ?>
        <div class="row mb-3">
            <label for="keterangan" class="col-sm-2 col-form-label"><b>Keterangan </b></label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid'
                                                            : ''; ?>" id="keterangan" name="keterangan" value="<?= old('keterangan'); ?>">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= $validation->getError('keterangan'); ?>
                </div>
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