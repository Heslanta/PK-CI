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
                    <label for="tujuan_jdw" class="col-sm-2 col-form-label">Tujuan Konsultasi: </label>


                    <div class="col-sm-10">

                        <select class="form-select" aria-label="Default select example">
                            <option selected>Pilih Tujuan Konsultasi</option>
                            <option value="1">Pembuatan NPWP & PKP</option>
                            <option value="2">Pendirian CV/PT/OP</option>
                            <option value="3">Konsultasi SPT OP/Badan</option>
                            <option value="4">Surat Himbauan</option>
                            <option value="5">Pemeriksaan</option>
                            <option value="6">Keberatan</option>
                            <option value="7">Pengurangan, Penghapusan, Pembatalan</option>
                            <option value="8">Banding</option>
                            <option value="9">Gugatan</option>
                            <option value="10">Peninjauan Kembali</option>
                            <option value="11">Dan lain-lain</option>
                        </select>






                    </div>
                </div>
                <div class="row mb-3">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid'
                                                                    : ''; ?>" id="deskripsi" name="deskripsi" value="<?= old('deskripsi'); ?>" placeholder="Masukan deskripsi tujuan konsultasi">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('deskripsi'); ?>
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