<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Tambah Data Klien</h2>
            <form action="/klien/save" method="POST" enctype="multipart/form-data">
                <form action="/klien/save1" method="POST">
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
                        <label for="efin" class="col-sm-2 col-form-label">Nomor EFIN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('efin')) ? 'is-invalid'
                                                                        : ''; ?>" value="<?= old('efin'); ?>" id="efin" name="efin">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('efin'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="bidang_usaha" class="col-sm-2 col-form-label">Bidang Usaha</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('bidang_usaha')) ? 'is-invalid'
                                                                        : ''; ?>" value="<?= old('bidang_usaha'); ?>" id="bidang_usaha" name="bidang_usaha">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('bidang_usaha'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid'
                                                                        : ''; ?>" value="<?= old('email'); ?>" id="email" name="email">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email_pass" class="col-sm-2 col-form-label">Password Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('email_pass')) ? 'is-invalid'
                                                                        : ''; ?>" value="<?= old('email_pass'); ?>" id="email_pass" name="email_pass">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('email_pass'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="notelp" class="col-sm-2 col-form-label">Nomor HP Wajibpajak</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('notelp')) ? 'is-invalid'
                                                                        : ''; ?>" value="<?= old('notelp'); ?>" id="notelp" name="notelp">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('notelp'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="notelp_per" class="col-sm-2 col-form-label">Nomor HP Perusahaan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('notelp_per')) ? 'is-invalid'
                                                                        : ''; ?>" value="<?= old('notelp_per'); ?>" id="notelp_per" name="notelp_per">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('notelp_per'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="enofa" class="col-sm-2 col-form-label">ENOFA</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('enofa')) ? 'is-invalid'
                                                                        : ''; ?>" value="<?= old('enofa'); ?>" id="enofa" name="enofa">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('enofa'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pkp" class="col-sm-2 col-form-label">Tanggal PKP
                            <p style="font-size: 12px;">(Bulan/Hari/Tahun)</p>
                        </label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control <?= ($validation->hasError('pkp')) ? 'is-invalid'
                                                                        : ''; ?>" value="<?= old('pkp'); ?>" id="pkp" name="pkp">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('pkp'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="catatan" class="col-sm-2 col-form-label">Catatan</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" id="catatan" name="catatan" rows="10" cols="130"><?= old('catatan'); ?> </textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Data Pemilik Saham ( kalau ada )</label>
                        <input class="form-control <?= ($validation->hasError('filedata')) ? 'is-invalid'
                                                        : ''; ?>" type="file" id="filedata" name="filedata">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('filedata'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Klien</button>
                </form>
            </form>
            <br><br>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>