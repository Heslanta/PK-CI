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
            <h1 class="mt-2">Daftar Pengguna </h1>
            <form action="" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan pencarian..." name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <!-- <a href="/users/create" class="btn btn-success mt-3">Tambah Data Pengguna</a> -->
            <br><br>
            <button type="button" class="btn btn-success mb-2 btn-add" data-toggle="modal" data-target="#addModal">Tambah User</button>

            <!-- menunjukkan alert tambah data -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <br>
            <!-- Bagian Show Tabel -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Nomor HP</th>
                        <th scope="col">Level</th>
                        <th scope="col">Info</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + ($jmldata * ($currentPage - 1)); ?>

                    <?php foreach ($users as $u) : ?>
                        <tr>
                            <?php
                            if ($u['level'] == 'admin') {
                                $level = "Admin";
                            }
                            if ($u['level'] == 'pegawai') {
                                $level = "Pegawai";
                            }
                            if ($u['level'] == 'klien') {
                                $level = "Klien";
                            }
                            ?>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $u['nama']; ?></td>
                            <td><?= $u['username']; ?></td>
                            <td><?= $u['password']; ?></td>
                            <td><?= $u['notelp']; ?></td>
                            <td><?= $level; ?></td>
                            <td>
                                <ul class="list-inline m-0">

                                    <a href="#" class="btn btn-primary btn-sm btn-edit" data-toggle=" tooltip" data-placement="top" title="Edit" data-id="<?= $u['id']; ?>" data-nama="<?= $u['nama']; ?>" data-username="<?= $u['username']; ?>" data-password="<?= $u['password']; ?>" data-notelp="<?= $u['notelp']; ?>" data-level="<?= $u['level']; ?>"><i class="fa fa-edit"></i></a>
                                    <?php if ($u['level'] != 'admin') : ?>
                                        <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus" data-id="<?= $u['id']; ?>"><i class="fa fa-trash"></i></a>
                                    <?php endif; ?>
                                </ul>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('user', 'pagination_user'); ?>
            <!-- End Tabel -->


            <!-- Bagian Model Popup -->
            <!-- Modal Add Akun-->
            <form action="/users/save" method="post">
                <?= csrf_field(); ?>
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Akun">
                                </div>

                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password" placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <label>Nomor Hp</label>
                                    <input type="text" class="form-control" name="notelp" placeholder="Nomor Hp">
                                </div>

                                <div class="form-group">
                                    <label>Level</label>
                                    <select name="level" class="form-control">
                                        <option value="admin">Admin</option>
                                        <option value="pegawai">Pegawai</option>
                                        <option value="klien">Klien</option>

                                    </select>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End Modal Add Akun-->

            <!-- Modal Delete Akun-->
            <form action="/users/delete" method="post">
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End Modal Delete Akun-->

            <!-- Modal Edit Akun-->
            <form action="/users/update" method="post">
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Akun</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Akun</label>
                                    <input type="text" class="form-control nama" name="nama" placeholder="">

                                </div>

                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control username" name="username" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control password" name="password" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Nomor HP</label>
                                    <input type="text" class="form-control notelp" name="notelp" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label>Level</label>
                                    <select name="level" class="form-control level" id="Pilihan">
                                        <option value="admin">Admin</option>
                                        <option value="pegawai">Pegawai</option>
                                        <option value="klien">Klien</option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id" class="id">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
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
    $(document).ready(function() {
        $('.btn-add').on('click', function() {

            // Call Modal tambah akun
            $('#addModal').modal('show');
        });

        // get Edit akun
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            const username = $(this).data('username');
            const password = $(this).data('password');
            const notelp = $(this).data('notelp');
            const level = $(this).data('level');

            // Set data to Form Edit
            $('.id').val(id);
            $('.nama').val(nama);
            $('.username').val(username);
            $('.password').val(password);
            $('.notelp').val(notelp);
            $('.level').val(level).trigger('change');
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
            info: false
        });
    });
</script>

<?= $this->endSection(); ?>