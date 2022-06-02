<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php $session = session() ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Buat Jadwal Konsultasi</h2>

            <form action="/jadwal/save" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_user" id="id_user" value="<?= $session->get('id') ?>">
                <input type="hidden" name="nama" id="nama" value="<?= $session->get('nama') ?>">
                <div class="row mb-3">
                    <label for="tujuan_jdw" class="col-sm-2 col-form-label">Tujuan Konsultasi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('tujuan_jdw')) ? 'is-invalid'
                                                                    : ''; ?>" id="tujuan_jdw" name="tujuan_jdw" value="<?= old('tujuan_jdw'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Konsultasi :
                        <p style="font-size: 12px;">(Bulan/Hari/Tahun)</p>
                    </label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid'
                                                                    : ''; ?>" value="<?= old('tanggal'); ?>" id="tanggal" name="tanggal">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('tanggal'); ?>
                        </div>
                    </div>
                </div>


                <div class="button-2-container">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <button type="reset" value="cancel" onclick="history.back()" class="btn btn-secondary">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>