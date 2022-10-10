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

                    <input type="hidden" name="id_klien" id="id_klien" value="<?= $klien['id'] ?>">

                    <label for="konsul_ke" class="col-sm-2 col-form-label">Konsul ke- : </label>
                    <div class="col-sm-10">
                        <input type="number" id=" konsul_ke" name="konsul_ke" class="form-control <?= ($validation->hasError('konsul_ke')) ? 'is-invalid'
                                                                                                        : ''; ?>" value="<?= old('konsul_ke'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('konsul_ke'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="hari_tanggal" class="col-sm-2 col-form-label">Tanggal Konsultasi :
                        <p style="font-size: 12px;">(Bulan/Hari/Tahun)</p>
                    </label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control <?= ($validation->hasError('hari_tanggal')) ? 'is-invalid'
                                                                    : ''; ?>" value="<?= old('hari_tanggal'); ?>" id="hari_tanggal" name="hari_tanggal">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('hari_tanggal'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tujuan" class="col-sm-2 col-form-label">Tujuan Konsultasi :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tujuan" name="tujuan" value="<?= old('tujuan'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="hasil_konsul" class="col-sm-2 col-form-label">Hasil Konsultasi :</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="hasil_konsul" name="hasil_konsul" rows="10" cols="130"><?= old('hasil_konsul'); ?> </textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="catatan_konsul" class="col-sm-2 col-form-label">Catatan Konsultasi :</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="catatan_konsul" name="catatan_konsul" rows="10" cols="130"><?= old('catatan_konsul'); ?> </textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
            <br><br>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>