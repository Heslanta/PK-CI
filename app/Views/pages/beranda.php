<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php $session = session() ?>



<link rel="stylesheet" href="<?= base_url() . 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' ?>">
<link rel="stylesheet" href="<?= base_url() . 'https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css' ?>">
<link rel="stylesheet" href="<?= base_url() . 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css' ?>">



<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/jquery-3.5.1.js"></script>
<script src="http://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="http://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="mt-4">
                <div class="opening-container">
                    <h1>Selamat Datang di Website HLP Consultant Banjarmasin, <?php echo $session->get('nama') ?>!</h1>
                    <p>Anda saat ini masuk sebagai <?= $session->get('level') ?>, mohon gunakan sistem dengan bijaksana!</p>
                </div>

                <div class="klien-container">
                </div>
                <h2>Klien berjumlah : <?= $jmlklien; ?> | Konsultasi berjumlah : <?= $jmlkonsul; ?></h2>
                <br>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div><?php endif; ?>
                <?php if (session()->getFlashdata('pesan-hapus')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan-hapus'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('errors')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('errors'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <!-- Bagian tabel jadwal konsultasi klien -->
                <!-- Mulai -->
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">
                        <h5>Jadwal Konsultasi Klien</h5>

                    </div>

                    <div class="card-body bg-white">
                        <button type="button" class="btn btn-success mb-2 btn-add" data-toggle="modal" data-target="#addModal">Tambah Jadwal</button>

                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Tujuan</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Status</th>
                                    <?php if ($session->get('level') == 'admin') : ?>
                                        <th>Info</th>
                                    <?php endif; ?>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 + ($jmldata * ($currentPage - 1)); ?>
                                <?php if ($jadwal != "") : ?>
                                    <?php foreach ($jadwal as $jad) : ?>
                                        <tr>
                                            <?php
                                            if ($jad['status'] == 'baru') {
                                                $status = "Baru";
                                            } else {
                                                $status = "Datang Kembali";
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
                                            <?php if ($session->get('level') == 'admin') : ?>
                                                <td>
                                                    <ul class="list-inline m-0">
                                                        <?php if (strtotime($jad['tanggal']) < time() + 172800) :  ?>

                                                            <a href="#" class="btn btn-primary btn-sm btn-edit" data-toggle=" tooltip" data-placement="top" title="Edit tanggal jadwal" data-id="<?= $jad['id_jadwal']; ?>" data-nama="<?= $jad['nama']; ?>" data-tanggal="<?= $jad['tanggal']; ?>" data-tujuan="<?= $jad['tujuan_jdw']; ?>" data-jam="<?= $jad['jam']; ?>" data-status="<?= $jad['status']; ?>"><i class="fa fa-edit"></i></a>
                                                            <!-- <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus" data-id="<?= $jad['id_jadwal']; ?>"><i class="fa fa-trash"></i></a> -->
                                                        <?php endif; ?>
                                                    </ul>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
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
                <!-- End dari tabel jadwal konsul klien -->

                <br><br><br>
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
                <form action="/jadwal/save" method="post">
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
                                        <label>Nama</label>
                                        <!-- <input type="text" class="form-control" name="nama" placeholder="Nama Wajib Pajak"> -->
                                        <template id="resultstemplate">
                                            <?php if ($nama != "") : ?>
                                                <?php foreach ($nama as $name) : ?>
                                                    <option><?= $name ?></option>

                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </template>
                                        <input type="text" class="form-control" name="nama" id="search" placeholder="Nama Wajib Pajak" list="searchresults" autocomplete="off" />
                                        <datalist id="searchresults"></datalist>
                                    </div>

                                    <div class="form-group">
                                        <label>Tujuan</label>
                                        <select name="tujuan_jdw" class="form-control" onchange="showDiv('dll', this)" required>
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

                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal" placeholder="">

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
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
                <form action="/jadwal/update" method="post">
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
                                        <label>Nama Wajib Pajak</label>
                                        <input type="text" class="form-control nama" name="nama" placeholder="">

                                    </div>

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
                                        <input type="date" class="form-control tanggal" name="tanggal" placeholder="">
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
                                    <input type="hidden" name="id_jadwal" class="id_jadwal">
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
    //function hidden input danlainlain
    function showDiv(dll, element) {
        document.getElementById(dll).style.display = element.value == 1 ? 'block' : 'none';
    }
    //function hidden input danlainlain
    function showDivUpdate(dllupdate, element) {
        document.getElementById(dllupdate).style.display = element.value == 1 ? 'block' : 'none';
    }
    //function pilihan baru
    // function myFunction() {
    //     document.getElementById("Pilihan").value = "baru";
    // }
    // function data table
    $(document).ready(function() {
        $('#example').DataTable({
            ordering: false,


            // info: false
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
</script>






<?= $this->endSection(); ?>