<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('jadwal/simpandata', ['class' => 'formjadwal']) ?>
            <?= csrf_field(); ?>

            <div class="modal-body">

                <div class="form-group">
                    <label>Nama<span>*</span></label>
                    <!-- <input type="text" class="form-control" name="nama" placeholder="Nama Wajib Pajak"> -->
                    <template id="resultstemplate">
                        <?php if ($nama != "") : ?>
                            <?php foreach ($nama as $name) : ?>
                                <option><?= $name ?></option>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </template>
                    <input type="text" class="form-control" name="nama" id="search" placeholder="Nama Wajib Pajak" list="searchresults" autocomplete="off" />
                    <div class="invalid-feedback errorNama">
                    </div>
                    <datalist id="searchresults"></datalist>
                </div>

                <div class="form-group">
                    <label>Tujuan</label>
                    <select name="tujuan_jdw" class="form-control" onchange="showDiv('dll', this)">
                        <?php if ($tujuan != "") : ?>
                            <?php foreach ($tujuan as $tuju) : ?>
                                <option><?= $tuju ?></option>

                            <?php endforeach; ?>
                        <?php endif; ?>

                        <option value="1">dan lain-lain</option>
                    </select>
                </div>
                <br>
                <input type="text" id="dll" class="form-control" name="tujuan_dll" placeholder="Tujuan Konsultasi" style="display: none;">
                <div class="invalid-feedback errorTujuan">
                </div>
                <div class="form-group">
                    <label>Tanggal<span>*</span></label>
                    <input type="date" class="form-control" name="tanggal" placeholder="" id="tanggal">
                    <div class="invalid-feedback errorTanggal">
                    </div>
                </div>
                <div class="form-group">
                    <label>Jam</label>
                    <select name="jam" class="form-control" required>
                        <option value="pagi">Jam 09:00-11:00 Pagi</option>
                        <option value="siang">Jam 12:00-14:00 Siang</option>
                        <option value="sore">Jam 15:00-17:00 Sore</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="baru">Baru</option>
                        <option value="balik">Datang Kembali</option>

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
                            $('#search').addClass('is-invalid');
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
                            $('#dll').addClass('is-invalid');
                            $('.errorTujuan').html(response.error.tujuan);
                        } else {
                            $('#dll').removeClass('is-invalid');
                            $('.errorTujuan').html("");

                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                        $('#modaltambah').modal('hide');
                        datajadwal();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        });
        var search = document.querySelector('#search');
        var results = document.querySelector('#searchresults');
        var templateContent = document.querySelector('#resultstemplate').content;
        search.addEventListener('keyup', function handler(event) {
            while (results.children.length) results.removeChild(results.firstChild);
            var inputVal = new RegExp(search.value.trim(), 'i');
            var clonedOptions = templateContent.cloneNode(true);
            var set = Array.prototype.reduce.call(clonedOptions.children, function searchFilter(frag, el) {
                if (inputVal.test(el.textContent) && frag.children.length < 10) frag.appendChild(el);
                return frag;
            }, document.createDocumentFragment());
            results.appendChild(set);
        });
    });
</script>