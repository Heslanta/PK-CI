<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Ubah Data Klien</h2>
            <form action="/konsul/update/<?= $konsultasi['id_konsul']; ?>" method="POST">
                <?= csrf_field(); ?>

                <div class="row mb-3">
                    <input type="hidden" name="id_klien" id="id_klien" value="<?= $konsultasi['id_klien'] ?>">
                    <input type="hidden" name="id_konsul" id="id_konsul" value="<?= $konsultasi['id_konsul'] ?>">

                    <label for="konsul_ke" class="col-sm-2 col-form-label">Konsul ke- : </label>
                    <div class="col-sm-10">
                        <input type="number" id=" konsul_ke" name="konsul_ke" class="form-control <?= ($validation->hasError('konsul_ke')) ? 'is-invalid'
                                                                                                        : ''; ?>" value="<?= (old('konsul_ke')) ? old('konsul_ke') : $konsultasi['konsul_ke'] ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('konsul_ke'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="hari_tanggal" class="col-sm-2 col-form-label">Tanggal Konsultasi :
                        <p style="font-size: 12px;">(Tanggal/Bulan/Tahun)</p>
                    </label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control <?= ($validation->hasError('hari_tanggal')) ? 'is-invalid'
                                                                    : ''; ?>" value="<?= (old('hari_tanggal')) ? old('hari_tanggal') : $konsultasi['hari_tanggal'] ?>" id="hari_tanggal" name="hari_tanggal">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('hari_tanggal'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tujuan" class="col-sm-2 col-form-label">Tujuan Konsultasi :</label>
                    <div class="col-sm-10">
                        <select name="tujuan_jdw" class="form-control tujuan_jdw" onchange="showDiv('dll', this)" value="<?= old('tujuan_jdw'); ?>" required>
                            <?php if ($tujuan != "") : ?>
                                <?php foreach ($tujuan as $tuju) : ?>
                                    <option><?= $tuju ?></option>

                                <?php endforeach; ?>
                            <?php endif; ?>
                            <option value="1">dan lain-lain</option>
                        </select>
                        <br>
                        <input type="text" id="dll" class="form-control" name="tujuan_dll" placeholder="Tujuan Konsultasi" style="display: none;" value="<?= old('tujuan_dll'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('tujuan'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="hasil_konsul" class="col-sm-2 col-form-label">Hasil Konsultasi :</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="hasil_konsul" name="hasil_konsul" rows="10" cols="130"><?= (old('hasil_konsul')) ? old('hasil_konsul') : $konsultasi['hasil_konsul'] ?> </textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="catatan_konsul" class="col-sm-2 col-form-label">Catatan Konsultasi :</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="catatan_konsul" name="catatan_konsul" rows="10" cols="130"><?= (old('catatan_konsul')) ? old('catatan_konsul') : $konsultasi['catatan_konsul'] ?></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ubah Data</button>
            </form>
            <br><br>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>