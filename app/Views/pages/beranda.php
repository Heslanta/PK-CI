<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php $session = session() ?>


<style>
    span {
        color: red;
    }
</style>



<div class="container">
    <div class="row">
        <div class="col">
            <div class="mt-4">
                <div class="opening-container">
                    <h1>Selamat Datang di Website HLP Consultant Banjarmasin, <?php echo $session->get('nama') ?>!</h1>
                    <p style="font-size: 20px;">Anda saat ini masuk sebagai <b><?= $session->get('level') ?></b>, mohon gunakan sistem dengan bijaksana!</p>
                </div><br>

                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col">
                        <div class="card-1 bg-warning">
                            <!-- <img src="..." class="card-img-top" alt="..."> -->
                            <div style="display: inline-block;">
                                <i class="fa fa-user" aria-hidden="true" style="display:inline-block; font-size:30px">&nbsp;</i>
                                <h2 style="font-family:sans-serif; display:inline-block;"><b>Klien berjumlah : <?= $jmlklien; ?></b> </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card-2 bg-success">
                            <div style="display:inline-block;">
                                <i class="fa fa-file-text" aria-hidden="true" style="display:inline-block; font-size:30px">&nbsp;</i>
                                <h2 style="font-family:sans-serif; display:inline-block;"><b>Konsultasi berjumlah : <?= $jmlkonsul; ?></b></h2>
                            </div>
                            <!-- <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            </div> -->
                        </div>
                    </div>
                </div>


                <br>

                <!-- Bagian tabel jadwal konsultasi klien -->
                <!-- Mulai -->
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">
                        <h5>Jadwal Konsultasi Klien</h5>

                    </div>

                    <div class="card-body bg-white">
                        <button type="button" class="btn btn-success mb-2 btn-add">Tambah Jadwal</button>
                        <!-- menampilkan data jadwal -->
                        <p class="card-text viewdata">

                        </p>

                    </div>
                </div>
                <!-- End dari tabel jadwal konsul klien -->


                <!-- Bagian tabel permintaan jadwal klien -->
                <!-- Mulai -->
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">
                        <h5>Permintaan Jadwal Klien</h5>
                    </div>

                    <div class="card-body bg-white">
                        <!-- <button type="button" class="btn btn-success mb-2 btn-add" data-toggle="modal" data-target="#addModal">Tambah Jadwal</button> -->
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Tujuan</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Status</th>
                                        <th>Proses</th>
                                        <?php if ($session->get('level') == 'admin') : ?>
                                            <th>Info</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $i = 1 + ($jmldata * ($currentPage - 1)); ?>

                                    <?php foreach ($proses as $jad) : ?>
                                        <tr>
                                            <?php
                                            if ($jad['proses'] == 'menunggu') : ?>
                                                <?php
                                                if ($jad['status'] == 'baru') {
                                                    $status = "Baru";
                                                } else {
                                                    $status = "Datang Kembali";
                                                }
                                                ?>
                                                <?php
                                                if ($jad['proses'] == 'menunggu') {
                                                    $proses = "Menunggu";
                                                }
                                                if ($jad['proses'] == 'diterima') {
                                                    $proses = "Diterima ";
                                                }
                                                if ($jad['proses'] == 'ditolak') {
                                                    $proses = "Ditolak ";
                                                }
                                                ?>
                                                <?php if ($jad['jam'] == 'pagi') {
                                                    $jam = "Jam 09:00-11:00 Pagi";
                                                }
                                                if ($jad['jam'] == 'siang') {
                                                    $jam = "Jam 12:00-14:00 Siang ";
                                                }
                                                if ($jad['jam'] == 'sore') {
                                                    $jam = "Jam 15:00-17:00 Sore ";
                                                }
                                                if ($jad['jam'] == '') {
                                                    $jam = "";
                                                } ?>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $jad['nama']; ?></td>
                                                <td><?= $jad['tujuan_jdw']; ?></td>
                                                <td><?= tgl_indo($jad['tanggal']); ?></td>
                                                <td><?= $jam; ?></td>
                                                <td><?= $status; ?></td>
                                                <td><?= $proses ?></td>
                                                <td>
                                                    <?php if ($session->get('level') == 'admin') : ?>
                                                        <ul class="list-inline m-0">
                                                            <a href="#" class="btn btn-success btn-sm btn-terima" data-placement="top" title="Terima" data-id_jadwal="<?= $jad['id_jadwal']; ?>" data-id_user="<?= $jad['id_user']; ?>" data-nama="<?= $jad['nama']; ?>" data-tanggal="<?= $jad['tanggal']; ?>" data-jam="<?= $jad['jam']; ?>" data-tujuan="<?= $jad['tujuan_jdw']; ?>" data-status="<?= $jad['status']; ?>">Terima</i></a>
                                                            <a href="#" class="btn btn-danger btn-sm btn-tolak" data-toggle="tooltip" data-placement="top" title="Tolak" data-id="<?= $jad['id_jadwal']; ?>">Tolak</i></a>
                                                        </ul>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>


                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End dari tabel jadwal konsul klien -->


                <!-- Start grafik -->
                <div class="col-lg-8">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">
                            <h5>Grafik Jumlah Konsultasi</h5>
                        </div>

                        <div class="card-body bg-white">
                            <div class="form-group">
                                <label for="">Pilih Tahun</label>
                                <input type="number" class="form-control" id="tahun" value="<?= date('Y') ?>">
                                <button type="button" class="btn btn-sm btn-primary" id="tombolTampil">
                                    Tampil
                                </button>
                            </div>
                            <div class="viewTampilGrafik"></div>
                        </div>
                    </div>
                </div>
                <!-- End grafik -->
                <br><br>




                <!-- Modal Add Jadwal-->
                <div class="modaltambah" style="display: none;"></div>


                <!-- End Modal Add Jadwal-->

                <!-- Modal Delete Jadwal-->
                <form action="/jadwal/delete" method="post">
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-primary">Ya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End Modal Delete Jadwal-->

                <!-- Modal Edit Jadwal-->
                <div class="modaledit" style="display: none;"></div>


                <!-- End Modal Edit Jadwal-->


                <!-- Modal Terima Jadwal-->
                <form action="/proses/terima" method="post">
                    <div class="modal fade" id="terimaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Terima Jadwal</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h4>Apakah anda yakin untuk menerima permintaan jadwal ?</h4>
                                </div>
                                <div class="modal-footer">
                                    <!-- <input type="hidden" name="id_jadwal" class="id_jadwal"> -->
                                    <input type="hidden" name="id_user" class="id_user">
                                    <input type="hidden" name="id_jadwal" class="id_jadwal">
                                    <input type="hidden" name="nama" class="nama">
                                    <input type="hidden" name="tujuan_jdw" class="tujuan_jdw">
                                    <input type="hidden" name="tanggal" class="tanggal">
                                    <input type="hidden" name="jam" class="jam">
                                    <input type="hidden" name="status" class="status">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-primary">Ya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End modal terima jadwal -->

                <!-- Modal Tolak Jadwal-->
                <form action="/proses/tolak" method="post">
                    <div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tolak Jadwal</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <h4>Apakah anda yakin untuk menolak?</h4>
                                    <div class="form-group">
                                        <label>Alasan Menolak Permintaan Jadwal</label>
                                        <!-- <input type="text" class="form-control tujuan_jdw" placeholder=""> -->
                                        <select name="alasan" class="form-control">
                                            <option value="Berhalangan">Berhalangan</option>
                                            <option value="Bukan hari kerja">Bukan hari kerja</option>
                                            <option value="Kuota konsultasi penuh">Kuota konsultasi penuh </option>

                                        </select>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <input type="hidden" name="id_jadwal" class="id_jadwal">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-primary">Ya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End Modal Tolak Jadwal-->
            </div>
        </div>

    </div>

</div>
<script>
    $(function() {

        <?php if (session()->has("pesan")) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= session("pesan") ?>'
            })
        <?php } ?>
        <?php if (session()->has("pesan-hapus")) { ?>
            Swal.fire({
                icon: 'warning',
                title: 'Hapus!',
                text: '<?= session("pesan-hapus") ?>'
            })
        <?php } ?>
    });
    //function hidden input danlainlain
    function showDiv(dll, element) {
        document.getElementById(dll).style.display = element.value == 1 ? 'block' : 'none';
    }
    //function hidden input danlainlain
    function showDivUpdate(dllupdate, element) {
        document.getElementById(dllupdate).style.display = element.value == 1 ? 'block' : 'none';
    }

    function datajadwal() {
        $.ajax({
            url: "<?= site_url('pages/ambildata'); ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        });
    };

    // function data table
    $(document).ready(function() {

        datajadwal();
        $('.btn-add').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('pages/formtambah'); ?>",
                dataType: "json",
                success: function(response) {
                    $('.modaltambah').html(response.data).show();
                    $('#modaltambah').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        });
    });

    // get Terima Jadwal
    $('.btn-terima').on('click', function() {
        // get data from button edit
        const id_jadwal = $(this).data('id_jadwal');
        const id_user = $(this).data('id_user');
        const nama = $(this).data('nama');
        const tujuan = $(this).data('tujuan');
        const tanggal = $(this).data('tanggal');
        const jam = $(this).data('jam');
        const status = $(this).data('status');


        // Set data to Form Edit
        $('.id_jadwal').val(id_jadwal);
        $('.id_user').val(id_user);
        $('.nama').val(nama);
        $('.tujuan_jdw').val(tujuan).trigger('change');
        $('.tanggal').val(tanggal);
        $('.jam').val(jam).trigger('change');
        $('.status').val(status).trigger('change');


        // Call Modal Edit
        $('#terimaModal').modal('show');
    });

    // get Tolak Jadwal
    $('.btn-tolak').on('click', function() {
        // get data from button 
        const id = $(this).data('id');
        // Set data to Form Tolak
        $('.id_jadwal').val(id);
        // Call Modal Tolak
        $('#tolakModal').modal('show');
    });

    // function modal pop up

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



    // function hover tool tip
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });




    // function grafik
    function tampilGrafik() {
        $.ajax({
            type: "post",
            url: "/pages/tampilGrafikKonsul",
            data: {
                tahun: $('#tahun').val()
            },
            dataType: "json",
            beforeSend: function() {
                $('.viewTampilGrafik').html('');
            },
            success: function(response) {
                if (response.data) {
                    $('.viewTampilGrafik').html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }

    $(document).ready(function() {
        tampilGrafik();
        $('#tombolTampil').click(function(e) {
            e.preventDefault();
            tampilGrafik();
        });
    });
</script>






<?= $this->endSection(); ?>