<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php $session = session() ?>

<link rel="stylesheet" href="<?= base_url() . 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' ?>">
<link rel="stylesheet" href="<?= base_url() . 'https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css' ?>">
<link rel="stylesheet" href="<?= base_url() . 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css' ?>">

<style>
    span {
        color: red;
    }
</style>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/jquery-3.5.1.js"></script>
<script src="http://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="http://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="mt-4">
                <div class="opening-container">
                    <h1>Selamat Datang di Website HLP Consultant Banjarmasin, <?= $session->get('nama') ?>!</h1>
                    <p>Mohon gunakan sistem dengan bijaksana!</p>
                </div>
                <br>
                <h2>Jadwal Konsultasi</h2>
                <!-- <a href="/jadwal/create" class="btn btn-success mt-3">Tambah Jadwal Konsultasi</a> -->
                <br>
                <button type="button" class="btn btn-success mb-2 btn-add" data-toggle="modal" title="Tambah Jadwal" data-target="#addModal">Tambah Jadwal</button>
                <!-- menunjukkan alert tambah data -->

                <?php if (session()->getFlashdata('errors')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('errors'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>



                <br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tujuan Konsultasi</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam</th>
                                <th scope="col">Status</th>
                                <th scope="col">Proses</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($jadwal as $jadwalklien) : ?>
                                <tr>
                                    <?php
                                    if ($jadwalklien['status'] == 'baru') {
                                        $status = "Baru";
                                    } else {
                                        $status = "Datang Kembali";
                                    }
                                    ?>
                                    <?php
                                    if ($jadwalklien['proses'] == 'menunggu') {
                                        $proses = "Menunggu";
                                        $warna = 'secondary';
                                    }
                                    if ($jadwalklien['proses'] == 'diterima') {
                                        $proses = "Diterima ";
                                        $warna = 'success';
                                    }
                                    if ($jadwalklien['proses'] == 'ditolak') {
                                        $proses = "Ditolak ";
                                        $warna = 'danger';
                                    }

                                    ?>
                                    <?php if ($jadwalklien['jam'] == 'pagi') {
                                        $jam = "Jam 09:00-11:00 Pagi";
                                    }
                                    if ($jadwalklien['jam'] == 'siang') {
                                        $jam = "Jam 12:00-14:00 Siang ";
                                    }
                                    if ($jadwalklien['jam'] == 'sore') {
                                        $jam = "Jam 15:00-17:00 Sore ";
                                    }
                                    if ($jadwalklien['jam'] == '') {
                                        $jam = "";
                                    } ?>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $jadwalklien['tujuan_jdw']; ?></td>
                                    <td><?= tgl_indo($jadwalklien['tanggal']); ?></td>
                                    <td><?= $jam; ?></td>
                                    <td><?= $status; ?></td>
                                    <td><span class="badge bg-<?= $warna; ?>"><?= $proses; ?></span></td>
                                    <td>
                                        <ul class="list-inline m-0">
                                            <?php if ($jadwalklien['proses'] == 'menunggu') : ?>

                                                <a href="#" class="btn btn-primary btn-sm btn-edit" data-toggle=" tooltip" data-placement="top" title="Edit" data-id="<?= $jadwalklien['id_jadwal']; ?>" data-nama="<?= $jadwalklien['nama']; ?>" data-tanggal="<?= $jadwalklien['tanggal']; ?>" data-jam="<?= $jadwalklien['jam']; ?>" data-tujuan="<?= $jadwalklien['tujuan_jdw']; ?>" data-status="<?= $jadwalklien['status']; ?>"><i class="fa fa-edit"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus" data-id="<?= $jadwalklien['id_jadwal']; ?>"><i class="fa fa-trash"></i></a>
                                                &nbsp;
                                            <?php endif; ?>
                                            <?php if ($jadwalklien['proses'] == 'ditolak') : ?>
                                                <a tabindex="0" type="button" data-bs-toggle="popover" data-bs-trigger="focus" title="Alasan ditolak" data-bs-content="<?= $jadwalklien['alasan']; ?>"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus" data-id="<?= $jadwalklien['id_jadwal']; ?>"><i class="fa fa-trash"></i></a>

                                            <?php endif; ?>
                                            <ul class=" list-inline m-0">
                                                <?php if (strtotime($jadwalklien['tanggal']) < time() - 100000 && $jadwalklien['proses'] == 'diterima') :  ?>
                                                    <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus" data-id="<?= $jadwalklien['id_jadwal']; ?>"><i class="fa fa-trash"></i></a>

                                                <?php endif; ?>
                                            </ul>
                                        </ul>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add Jadwal-->
    <form action="/proses/saveklien" method="post" class="validation-add_jadwal">
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tujuan</label>
                            <select name="tujuan_jdw" class="form-control" onchange="showDiv('dll', this)" required>
                                <?php if ($tujuan != "") : ?>
                                    <?php foreach ($tujuan as $tuju) : ?>
                                        <option><?= $tuju ?></option>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <option value="1">Dan lain-lain</option>
                            </select>
                        </div>
                        <br>
                        <input type="text" id="dll" class="form-control" name="tujuan_dll" placeholder="Tujuan Konsultasi" style="display: none;">

                        <div class="form-group">
                            <label>Tanggal<span>*</span></label>
                            <input type="date" class="form-control" name="tanggal" placeholder="" required>
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
                        <input type="hidden" name="id" class="id_user" value="<?= $session->get('id') ?>">
                        <input type="hidden" name="nama" class="nama" value="<?= $session->get('nama') ?>">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Add Jadwal-->

    <!-- Modal Delete jadwal klien-->
    <form action="/proses/delete" method="post">
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Jadwal</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Apakah anda yakin untuk menghapus?</h4>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_jadwal" class="id_jadwal">
                        <input type="hidden" name="id_user" class="id_user">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Delete Jadwal-->

    <!-- Modal Edit Jadwal-->
    <form action="/proses/upjadwalklien" method="post">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Jadwal</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tujuan</label>
                            <select name="tujuan_jdw" class="form-control tujuan_jdw" onchange="showDivUpdate('dllupdate', this)" required>
                                <?php if ($tujuan != "") : ?>
                                    <?php foreach ($tujuan as $tuju) : ?>
                                        <option><?= $tuju ?></option>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <option value="1">dan lain-lain</option>
                            </select>
                        </div>
                        <br>
                        <input type="text" id="dllupdate" class="form-control tujuan_dll" name="tujuan_dll" placeholder="Tujuan Konsultasi" style="display: none;">

                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control tanggal" name="tanggal" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Jam</label>
                            <select name="jam" class="form-control jam" required>
                                <option value="pagi">Jam 09:00-11:00 Pagi</option>
                                <option value="siang">Jam 12:00-14:00 Siang</option>
                                <option value="sore">Jam 15:00-17:00 Sore</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control status" id="Pilihan">
                                <option value="baru">Baru</option>
                                <option value="balik">Datang Kembali</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_user" class="id_user">
                        <input type="hidden" name="id_jadwal" class="id_jadwal">
                        <input type="hidden" name="nama" class="nama">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Edit Jadwal-->
</div>



<script>
    //function hidden input danlainlain
    function showDiv(dll, element) {
        document.getElementById(dll).style.display = element.value == 1 ? 'block' : 'none';
    }

    function showDivUpdate(dllupdate, element) {
        document.getElementById(dllupdate).style.display = element.value == 1 ? 'block' : 'none';
    }
    $(function() {

        <?php if (session()->has("pesan")) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= session("pesan") ?>'
            })
        <?php } ?>
        <?php if (session()->has("delete")) { ?>
            Swal.fire({
                icon: 'warning',
                title: 'Hapus!',
                text: '<?= session("delete") ?>'
            })
        <?php } ?>
    });


    function myFunction() {
        document.getElementById("Pilihan").value = "baru";
    }
    // function modal pop up
    $(document).ready(function() {
        $('.btn-add').on('click', function() {

            // Call Modal tambah jadwal
            $('#addModal').modal('show');
        });

        // get Edit Jadwal
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            const tujuan = $(this).data('tujuan');
            const tanggal = $(this).data('tanggal');
            const jam = $(this).data('jam');
            const status = $(this).data('status');

            // Set data to Form Edit
            $('.id_jadwal').val(id);
            $('.nama').val(nama);
            $('.tujuan_jdw').val(tujuan).trigger('change');
            $('.tanggal').val(tanggal);
            $('.tujuan_dll').val(tujuan);
            $('.jam').val(jam).trigger('change');
            $('.status').val(status).trigger('change');
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Jadwal
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('.id_jadwal').val(id);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });

    });

    // function hover tool tip
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
    var popover = new bootstrap.Popover(document.querySelector('.popover-dismiss'), {
        trigger: 'focus'
    })
</script>
<?= $this->endSection(); ?>