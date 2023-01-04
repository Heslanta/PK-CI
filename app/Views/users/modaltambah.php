<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('users/simpandata', ['class' => 'formakun']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Akun">
                    <div class="invalid-feedback errorNama">
                    </div>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control " name="username" id="username" placeholder="Username">
                    <div class="invalid-feedback errorUsername">
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" id="password" placeholder="Password">
                    <div class="invalid-feedback errorPassword">
                    </div>
                </div>

                <div class="form-group">
                    <label>Nomor Hp</label>
                    <input type="text" class="form-control" name="notelp" id="notelp" placeholder="Nomor Hp">
                    <div class="invalid-feedback errorNotelp">
                    </div>
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select name="level" class="form-control">
                        <option value="pegawai">Pegawai</option>
                        <option value="admin">Admin</option>
                        <!-- <option value="klien">Klien</option> -->
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
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
                        $('#modaltambah').modal('hide');
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