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
                    <h1>Selamat Datang di Website HLP Consultant Banjarmasin, <?= $session->get('nama') ?>!</h1>
                    <p>Mohon gunakan sistem dengan bijaksana!</p>
                </div>
                <br>
                <h2>Jadwal Konsultasi</h2>
                <!-- <a href="/jadwal/create" class="btn btn-success mt-3">Tambah Jadwal Konsultasi</a> -->
                <br>
                <button type="button" class="btn btn-success mb-2 btn-add" data-toggle="modal" title="Tambah Jadwal" data-target="#addModal">Tambah Jadwal</button>
                <!-- menunjukkan alert tambah data -->
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('pesan-hapus')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan-hapus'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <br>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tujuan Konsultasi</th>
                            <th scope="col">Tanggal</th>
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
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $jadwalklien['tujuan_jdw']; ?></td>
                                <td><?= tgl_indo($jadwalklien['tanggal']); ?></td>
                                <td><?= $status; ?></td>
                                <td><span class="badge bg-<?= $warna; ?>"><?= $proses; ?></span></td>
                                <td>
                                    <ul class="list-inline m-0">
                                        <?php if ($jadwalklien['proses'] == 'menunggu') : ?>

                                            <a href="#" class="btn btn-primary btn-sm btn-edit" data-toggle=" tooltip" data-placement="top" title="Edit" data-id="<?= $jadwalklien['id_jadwal']; ?>" data-nama="<?= $jadwalklien['nama']; ?>" data-tanggal="<?= $jadwalklien['tanggal']; ?>" data-tujuan="<?= $jadwalklien['tujuan_jdw']; ?>" data-status="<?= $jadwalklien['status']; ?>"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus" data-id="<?= $jadwalklien['id_jadwal']; ?>"><i class="fa fa-trash"></i></a>
                                            &nbsp;
                                        <?php endif; ?>
                                        <?php if ($jadwalklien['proses'] == 'ditolak') : ?>
                                            <a tabindex="0" type="button" data-bs-toggle="popover" data-bs-trigger="focus" title="Alasan ditolak" data-bs-content="<?= $jadwalklien['alasan']; ?>"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                        <?php endif; ?>
                                    </ul>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Add Jadwal-->
    <form action="/proses/saveklien" method="post">
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
                        <input type="hidden" name="id" class="id_user" value="<?= $session->get('id') ?>">
                        <input type="hidden" name="nama" class="nama" value="<?= $session->get('nama') ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
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
                            <input type="text" class="form-control tujuan_jdw" name="tujuan_jdw" placeholder="">
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
                        <input type="hidden" name="id_user" class="id_user">
                        <input type="hidden" name="id_jadwal" class="id_jadwal">
                        <input type="hidden" name="nama" class="nama">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Edit Jadwal-->
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

        // get Edit Jadwal
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const id_user = $(this).data('id_user');
            const nama = $(this).data('nama');
            const tujuan = $(this).data('tujuan');
            const tanggal = $(this).data('tanggal');
            const status = $(this).data('status');

            // Set data to Form Edit
            $('.id_jadwal').val(id);
            $('.id_user').val(id_user);
            $('.nama').val(nama);
            $('.tujuan_jdw').val(tujuan);
            $('.tanggal').val(tanggal);
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