<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <!-- <div class="row"> -->
        <!-- <div class="col-8"> -->
            <h2 class="my-3">Ubah Data Klien</h2>
            <form action="/klien/update/<?= $klien['id']; ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $klien['id']; ?>">
                <div class="row mb-3">
                    <label for="wajibpajak" class="col-sm-2 col-form-label"><b>Wajib Pajak</b></label>
                    <div class="col-sm-10">
                        <input type="text" id=" wajibpajak" name="wajibpajak" class="form-control <?= ($validation->hasError('wajibpajak')) ? 'is-invalid'
                                                                                                        : ''; ?>" value="<?= (old('wajibpajak')) ? old('wajibpajak') : $klien['wajibpajak'] ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('wajibpajak'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="npwp" class="col-sm-2 col-form-label"><b>NPWP</b></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('npwp')) ? 'is-invalid'
                                                                    : ''; ?>" value="<?= (old('npwp')) ? old('npwp') : $klien['npwp'] ?>" id="npwp" name="npwp">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('npwp'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="efin" class="col-sm-2 col-form-label"><b>Nomor EFIN</b></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('efin')) ? 'is-invalid'
                                                                    : ''; ?>" value="<?= (old('efin')) ? old('efin') : $klien['efin'] ?>" id="efin" name="efin">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('efin'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="notelp" class="col-sm-2 col-form-label"><b>Nomor HP</b></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="notelp" name="notelp" value="<?= (old('notelp')) ? old('notelp') : $klien['notelp'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="catatan" class="col-sm-2 col-form-label"><b>Catatan</b></label>
                    <div class="col-sm-10">
                        <textarea rows="10" type="text" class="form-control" id="catatan" name="catatan"><?= (old('catatan')) ? old('catatan') : $klien['catatan'] ?> </textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ubah data Klien</button>
            </form>
        <!-- </div> -->
    <!-- </div> -->
</div>


<?= $this->endSection(); ?>