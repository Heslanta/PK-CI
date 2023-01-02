<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<style>
    h6 {
        color: darkgrey;
        font-size: 12px;
    }
</style>
<div class="container">
    <!-- <div class="row"> -->
    <!-- <div class="col-8"> -->
    <h2 class="my-3">Ubah Data Klien</h2>
    <form action="/klien/update/<?= $klien['id']; ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <input type="hidden" name="id" value="<?= $klien['id']; ?>">
        <input type="hidden" name="gambarLama" value="<?= $klien['filegambar']; ?>">
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
            <label for="status" class="col-sm-2 col-form-label"><b>Status</b></label>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="Proses" name="status" id="Proses" <?php if ($klien['status'] == 'Proses') echo 'checked' ?>>
                    <label class="form-check-label" for="Proses">
                        Proses
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="Selesai" name="status" id="Selesai" <?php if ($klien['status'] == 'Selesai') echo 'checked' ?>>
                    <label class="form-check-label" for="Selesai">
                        Selesai
                    </label>
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
            <label for="notelp" class="col-sm-2 col-form-label"><b>Nomor HP Wajibpajak</b></label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('notelp')) ? 'is-invalid'
                                                            : ''; ?>" id=" notelp" name="notelp" value="<?= (old('notelp')) ? old('notelp') : $klien['notelp'] ?>">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= $validation->getError('notelp'); ?>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="bidang_usaha" class="col-sm-2 col-form-label"><b>Bidang Usaha</b></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="bidang_usaha" name="bidang_usaha" value="<?= (old('bidang_usaha')) ? old('bidang_usaha') : $klien['bidang_usaha'] ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label"><b>Email</b></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email" value="<?= (old('email')) ? old('email') : $klien['email'] ?>">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= $validation->getError('email'); ?>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="email_pass" class="col-sm-2 col-form-label"><b>Password Email</b></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email_pass" name="email_pass" value="<?= (old('email_pass')) ? old('email_pass') : $klien['email_pass'] ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="notelp_per" class="col-sm-2 col-form-label"><b>Nomor HP Perusahaan</b></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="notelp_per" name="notelp_per" value="<?= (old('notelp_per')) ? old('notelp_per') : $klien['notelp_per'] ?>">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= $validation->getError('notelp_per'); ?>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="enofa" class="col-sm-2 col-form-label"><b>ENOFA</b></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="enofa" name="enofa" value="<?= (old('enofa')) ? old('enofa') : $klien['enofa'] ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="pkp" class="col-sm-2 col-form-label"><b>Tanggal PKP</b></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="pkp" name="pkp" value="<?= (old('pkp')) ? old('pkp') : $klien['pkp'] ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="catatan" class="col-sm-2 col-form-label"><b>Catatan</b></label>
            <div class="col-sm-10">
                <textarea rows="10" type="text" class="form-control" id="catatan" name="catatan"><?= (old('catatan')) ? old('catatan') : $klien['catatan'] ?> </textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="formFile" class="form-label">Data Pemilik Saham ( kalau ada )</label>
            <input class="form-control <?= ($validation->hasError('filegambar')) ? 'is-invalid'
                                            : ''; ?>" type="file" id="filegambar" name="filegambar">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= $validation->getError('filegambar'); ?>
            </div>

        </div>
        <button type="submit" class="btn btn-primary">Ubah data Klien</button>
    </form>
    <!-- </div> -->
    <!-- </div> -->
</div>


<?= $this->endSection(); ?>