<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('users/updatedata', ['class' => 'formakun']) ?>

            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Akun</label>
                    <input type="text" class="form-control nama" id="nama" name="nama" placeholder="" value="<?= $nama; ?>" />
                    <div class="invalid-feedback errorNama">
                    </div>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control username" id="username" name="username" placeholder="" value="<?= $username; ?>">
                    <div class="invalid-feedback errorUsername">
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control password" id="password" name="password" placeholder="" value="<?= $password; ?>">
                    <div class="invalid-feedback errorPassword">
                    </div>
                </div>
                <div class="form-group">
                    <label>Nomor HP</label>
                    <input type="text" class="form-control notelp" id="notelp" name="notelp" placeholder="" value="<?= $notelp; ?>">
                    <div class="invalid-feedback errorNotelp">
                    </div>
                </div>

                <div class="form-group" id="level" <?php if ($level == 'klien') echo "style ='display:none'"; ?>>
                    <label>Level</label>
                    <select name="level" class="form-control level" id="Pilihan" onchange="displayDivDemo('level', this)">
                        <option value="pegawai" <?php if ($level == 'pegawai') echo "selected"; ?>>Pegawai</option>
                        <option value="admin" <?php if ($level == 'admin') echo "selected"; ?>>Admin</option>
                        <option hidden value="klien" <?php if ($level == 'klien') echo "selected"; ?>>Klien</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" id="id" name="id" class="id" value="<?= $id; ?>">
                <button type="submit" class="btn btn-primary">Ubah</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
            <?= form_close() ?>

        </div>
    </div>
</div>
<script>
    $(document).ready(function(e) {
        $('.formakun').submit(function(e) {
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
                        if (response.error.username) {
                            $('#username').addClass('is-invalid');
                            $('.errorUsername').html(response.error.username);
                        } else {
                            $('#username').removeClass('is-invalid');
                            $('.errorUsername').html("");

                        }
                        if (response.error.password) {
                            $('#password').addClass('is-invalid');
                            $('.errorPassword').html(response.error.password);
                        } else {
                            $('#password').removeClass('is-invalid');
                            $('.errorPassword').html("");

                        }
                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.errorNama').html("");

                        }
                        if (response.error.notelp) {
                            $('#notelp').addClass('is-invalid');
                            $('.errorNotelp').html(response.error.notelp);
                        } else {
                            $('#notelp').removeClass('is-invalid');
                            $('.errorNotelp').html("");

                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                        $('#modaledit').modal('hide');
                        datauser();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        });
    });
</script>