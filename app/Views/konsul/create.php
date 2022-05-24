<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Tambah Data Konsultasi</h2>
            <form action="/konsul/save" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <br>
                <div class="row mb-3">

                    <label for="wajibpajak" class="col-sm-2 col-form-label">Wajib Pajak</label>
                    <div class="col-sm-10">
                        <input type="text" id=" wajibpajak" name="wajibpajak" class="form-control <?= ($validation->hasError('wajibpajak')) ? 'is-invalid'
                                                                                                        : ''; ?>" value="<?= old('wajibpajak'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('wajibpajak'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="npwp" class="col-sm-2 col-form-label">NPWP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('npwp')) ? 'is-invalid'
                                                                    : ''; ?>" value="<?= old('npwp'); ?>" id="npwp" name="npwp">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('npwp'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="notelp" class="col-sm-2 col-form-label">Nomor HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="notelp" name="notelp" value="<?= old('notelp'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="catatan" class="col-sm-2 col-form-label">Catatan</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="catatan" name="catatan" rows="10" cols="130"><?= old('catatan'); ?> </textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Tambah Klien</button>
            </form>
            <br><br>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>