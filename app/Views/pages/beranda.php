<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php $session = session() ?>


<link rel="stylesheet" href="<?= base_url() . 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' ?>">
<link rel="stylesheet" href="<?= base_url() . 'https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css' ?>">
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


                <button type="button" class="btn btn-success mb-2 btn-add" data-toggle="modal" data-target="#addModal">Tambah Jadwal</button>

                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tujuan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Info</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + ($jmldata * ($currentPage - 1)); ?>

                        <?php foreach ($jadwal as $jad) : ?>
                            <tr>
                                <?php
                                if ($jad['status'] == 'baru') {
                                    $jad['status'] = "Baru";
                                } else {
                                    $jad['status'] = "Datang Kembali";
                                }
                                ?>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $jad['nama']; ?></td>
                                <td><?= $jad['tujuan_jdw']; ?></td>
                                <td><?= $jad['tanggal']; ?></td>
                                <td><?= $jad['status']; ?></td>
                                <td>
                                    <ul class="list-inline m-0">

                                        <a href="#" class="btn btn-primary btn-sm btn-edit" data-toggle=" tooltip" data-placement="top" title="Edit" data-id="<?= $jad['id_jadwal']; ?>" data-nama="<?= $jad['nama']; ?>" data-tanggal="<?= $jad['tanggal']; ?>" data-tujuan="<?= $jad['tujuan_jdw']; ?>" data-status="<?= $jad['status']; ?>"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus" data-id="<?= $jad['id_jadwal']; ?>"><i class="fa fa-trash"></i></a>

                                    </ul>
                                </td>



                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Modal Add Jadwal-->
                <form action="/jadwal/save" method="post">
                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama Wajib Pajak">
                                    </div>

                                    <div class="form-group">
                                        <label>Tujuan</label>
                                        <input type="text" class="form-control" name="tujuan_jdw" placeholder="Tujuan Konsultasi">
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal" placeholder="">
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
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End Modal Add Product-->

                <!-- Modal Delete Product-->
                <form action="/jadwal/delete" method="post">
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <h4>Are you sure want to delete this product?</h4>

                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="id_jadwal" class="id_jadwal">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-primary">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End Modal Delete Jadwal-->

                <!-- Modal Edit Product-->
                <form action="/jadwal/update" method="post">
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                        <input type="text" class="form-control tujuan" name="tujuan_jdw" placeholder="Tujuan Komsultasi">
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control tanggal" name="tanggal" placeholder="">
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
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End Modal Edit Product-->
            </div>
        </div>

    </div>

</div>
<script>
    function myFunction() {
        document.getElementById("Pilihan").value = "baru";
    }
    // function modal pop up
    $(document).ready(function() {
        $('.btn-add').on('click', function() {

            // Call Modal tambah jadwal
            $('#addModal').modal('show');
        });

        // get Edit Product
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id_jadwal = $(this).data('id_jadwal');
            const nama = $(this).data('nama');
            const tujuan = $(this).data('tujuan_jdw');
            const tanggal = $(this).data('tanggal');
            const status = $(this).data('status');
            // Set data to Form Edit
            $('.id_jadwal').val(id_jadwal);
            $('.nama').val(nama);
            $('.tujuan').val(tujuan);
            $('.tanggal').val(tanggal);
            $('.status').val(status).trigger('change');
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('.productID').val(id);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });

    });

    // function hover tool tip
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    // function data table
    $(document).ready(function() {
        $('#example').DataTable({
            ordering: true,
            info: false
        });
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