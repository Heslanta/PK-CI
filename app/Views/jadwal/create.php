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
                    <label for="tujuan_jdw" class="col-sm-2 col-form-label">Tujuan Konsultasi : </label>


                    <div class="col-sm-12 inline">
                        <table class="table ">
                            <tr>
                                <td><?php echo form_radio('tujuan_jdw', 'npwp', false); ?>
                                    <label for="npwp" class="">Pembuatan NPWP & PKP</label>
                                </td>
                                <td><?php echo form_radio('tujuan_jdw', 'cv', false); ?>
                                    <label for="cv" class="">Pendirian CV/PT/OP</label>
                                </td>
                                <td><?php echo form_radio('tujuan_jdw', 'spt', false); ?>
                                    <label for="spt" class="">Konsultasi SPT OP/Badan</label>
                                </td>

                            </tr>
                            <tr>
                                <td><?php echo form_radio('tujuan_jdw', 'ppn', false); ?>
                                    <label for="ppn" class="">Surat Himbauan</label>
                                </td>
                                <td><?php echo form_radio('tujuan_jdw', 'ppn', false); ?>
                                    <label for="ppn" class="">Pemeriksaan</label>
                                </td>
                                <td><?php echo form_radio('tujuan_jdw', 'ppn', false); ?>
                                    <label for="ppn" class="">Keberatan</label>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo form_radio('tujuan_jdw', 'ppn', false); ?>
                                    <label for="ppn" class="">Pengurangan, Penghapusan, Pembatalan</label>
                                </td>
                                <td><?php echo form_radio('tujuan_jdw', 'ppn', false); ?>
                                    <label for="ppn" class="">Banding</label>
                                </td>
                                <td><?php echo form_radio('tujuan_jdw', 'ppn', false); ?>
                                    <label for="ppn" class="">Gugatan</label>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo form_radio('tujuan_jdw', 'ppn', false); ?>
                                    <label for="ppn" class="">Peninjauan Kembali</label>
                                </td>
                                <td><?php echo form_radio('tujuan_jdw', 'ppn', false); ?>
                                    <label for="ppn" class="">Dan lain-lain</label>
                                </td>

                            </tr>
                        </table>



                        <!-- <input type="text" class="form-control <?= ($validation->hasError('tujuan_jdw')) ? 'is-invalid'
                                                                        : ''; ?>" id="tujuan_jdw" name="tujuan_jdw" value="<?= old('tujuan_jdw'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div> -->
                    </div>
                    <div class="row mb-3">
                        <label for="tanggal" class="col-sm-2 col-form-label">Deskripsi : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('tujuan_jdw')) ? 'is-invalid'
                                                                        : ''; ?>" id="tujuan_jdw" name="tujuan_jdw" value="<?= old('tujuan_jdw'); ?>" placeholder="Masukan deskripsi tujuan konsultasi">
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