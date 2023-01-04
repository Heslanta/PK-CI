<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<link rel="stylesheet" href="<?= base_url() . 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' ?>">
<link rel="stylesheet" href="<?= base_url() . 'https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css' ?>">
<link rel="stylesheet" href="<?= base_url() . 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css' ?>">


<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/jquery-3.5.1.js"></script>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-2">Tujuan Konsultasi </h1>

        </div>
    </div>
    <div class="row">
        <div class="col">
            <!-- <a href="/users/create" class="btn btn-success mt-3">Tambah Data Pengguna</a> -->
            <br><br>
            <button type="button" class="btn btn-success mb-2 btn-add" data-toggle="modal" data-target="#addModal">Tambah Tujuan Konsultasi</button>

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
            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('errors'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <br>
            <!-- Bagian Show Tabel -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Keterangan</th>

                        <th scope="col">Info</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($tujuan as $tuju) : ?>

                        <tr>

                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $tuju['tujuan_konsul']; ?></td>

                            <td>
                                <ul class="list-inline m-0">

                                    <a href="#" class="btn btn-primary btn-sm btn-edit" data-toggle=" tooltip" data-placement="top" title="Edit" data-tujuan_konsul="<?= $tuju['tujuan_konsul']; ?>" data-id="<?= $tuju['id']; ?>"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus" data-id="<?= $tuju['id']; ?>"><i class="fa fa-trash"></i></a>
                                </ul>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- End Tabel -->


            <!-- Bagian Model Popup -->
            <!-- Modal Add Akun-->
            <form action="/tujuan/save" method="post">
                <?= csrf_field(); ?>
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Tujuan Konsultasi</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" class="form-control" name="tujuan_konsul" placeholder="Nama Konsultasi" required>
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
            <!-- End Modal Add Akun-->

            <!-- Modal Delete Akun-->
            <form action="/tujuan/delete" method="post">
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hapus Akun</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <h4>Apakah anda yakin untuk menghapus?</h4>

                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id" class="id">

                                <button type="submit" class="btn btn-primary">Ya</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End Modal Delete Akun-->

            <!-- Modal Edit Akun-->
            <form action="/tujuan/update" method="post">
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Tujuan</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Keterangan Tujuan Konsul</label>
                                    <input type="text" class="form-control tujuan_konsul" name="tujuan_konsul" placeholder="" required />

                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id" class="id">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End Modal Edit Akun-->
        </div>
    </div>
</div>

<script>
    function displayDivDemo(id, elementValue) {
        document.getElementById(id).style.display = elementValue.value == 'klien' ? 'none' : 'block';
        // document.getElementById(id).style.display = showklien.value == 'admin' || 'pegawai' ? 'none' : 'block';

    }
    $(document).ready(function() {

        $('.btn-add').on('click', function() {

            // Call Modal tambah akun
            $('#addModal').modal('show');
        });

        // get Edit akun
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const tujuan_konsul = $(this).data('tujuan_konsul');


            // Set data to Form Edit
            $('.id').val(id);
            $('.tujuan_konsul').val(tujuan_konsul);

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete akun
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('.id').val(id);
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
            info: false,
            responsive: true
        });
    });
</script>

<?= $this->endSection(); ?>