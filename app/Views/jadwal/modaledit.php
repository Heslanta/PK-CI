<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Jadwal</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('jadwal/updatedata', ['class' => 'formjadwal']) ?>

            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Wajib Pajak</label>
                    <input type="text" class="form-control nama" id="nama" name="nama" placeholder="" value="<?= $nama; ?>">
                    <div class="invalid-feedback errorNama">
                    </div>
                </div>

                <div class="form-group">
                    <label>Tujuan</label>
                    <select name="tujuan_jdw" class="form-control tujuan_jdw" id="tujuan_jdw" onchange="showDivUpdate('dllupdate', this)" required>
                        <?php if ($tujuan != "") : ?>
                            <?php foreach ($tujuan as $tuju) : ?>
                                <option <?php if ($tujuan_jdw == $tuju) echo "selected"; ?>><?= $tuju ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <option value="1" <?php if (in_array($tujuan_jdw, $tujuan)) {
                                                echo "";
                                            } else {
                                                echo "selected";
                                            } ?>>dan lain-lain</option>
                    </select>
                </div>
                <br>
                <input type="text" id="dllupdate" class="form-control tujuan_dll" <?php if (in_array($tujuan_jdw, $tujuan)) {
                                                                                        echo "style='display:none'";
                                                                                    } ?> name="tujuan_dll" placeholder="Tujuan Konsultasi" style="display: block;" value="<?= $tujuan_jdw; ?>">
                <div class="invalid-feedback errorTujuan">
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" class="form-control tanggal" id="tanggal" name="tanggal" placeholder="" value="<?= $tanggal; ?>">
                    <div class="invalid-feedback errorTanggal">
                    </div>
                </div>

                <div class="form-group">
                    <label>Jam</label>
                    <select name="jam" class="form-control jam" id="jam">
                        <option value="pagi" <?php if ($jam == 'pagi') echo "selected"; ?>>Jam 09:00-11:00 Pagi</option>
                        <option value="siang" <?php if ($jam == 'siang') echo "selected"; ?>>Jam 12:00-14:00 Siang</option>
                        <option value="sore" <?php if ($jam == 'sore') echo "selected"; ?>>Jam 15:00-17:00 Sore</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control status" id="status">
                        <option value="baru" <?php if ($status == 'baru') echo "selected"; ?>>Baru</option>
                        <option value="balik" <?php if ($status == 'balik') echo "selected"; ?>>Datang Kembali</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_jadwal" class="id_jadwal" value="<?= $id_jadwal; ?>">
                <button type="submit" class="btn btn-primary">Ubah</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
            <?= form_close() ?>

        </div>
    </div>
</div>
<script>
    $(document).ready(function(e) {
        $('.formjadwal').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('btnsimpan').attr('disable', 'disabled');
                    $('btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('#search').removeClass('is-invalid');
                            $('.errorNama').html("");

                        }
                        if (response.error.tanggal) {
                            $('#tanggal').addClass('is-invalid');
                            $('.errorTanggal').html(response.error.tanggal);
                        } else {
                            $('#tanggal').removeClass('is-invalid');
                            $('.errorTanggal').html("");

                        }
                        if (response.error.tujuan) {
                            $('#dllupdate').addClass('is-invalid');
                            $('.errorTujuan').html(response.error.tujuan);
                        } else {
                            $('#dllupdate').removeClass('is-invalid');
                            $('.errorTujuan').html("");

                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                        $('#modaledit').modal('hide');
                        datajadwal();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        });
    });
</script>