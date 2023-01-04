<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-2">Daftar Pengguna </h1>
            <!-- <form action="" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan pencarian..." name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                </div>
            </form> -->
        </div>
    </div>
    <div class="row">
        <div class="col">
            <!-- <a href="/users/create" class="btn btn-success mt-3">Tambah Data Pengguna</a> -->

            <!-- menunjukkan alert tambah data -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <br>
            <div class="col-sm-12">

                <div class="card m-b-30">
                    <div class="card-body">
                        <button type="button" class="btn btn-success mb-2 btn-add" title="Tambah Data">
                            Tambah Data
                        </button>
                        <!-- menampilkan tabel user -->
                        <p class="card-text viewdata">

                        </p>
                    </div>
                </div>
            </div>


            <!-- Bagian Model Popup -->

            <div class="modaltambah" style="display: none;"></div>
            <!-- Modal Add Akun-->

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

            <div class="modaledit" style="display: none;"></div>


            <!-- End Modal Edit Akun-->
        </div>
    </div>
</div>

<script>
    function displayDivDemo(id, elementValue) {
        document.getElementById(id).style.display = elementValue.value == 'klien' ? 'none' : 'block';
        // document.getElementById(id).style.display = showklien.value == 'admin' || 'pegawai' ? 'none' : 'block';
    };

    function datauser() {
        $.ajax({
            url: "<?= site_url('users/ambildata'); ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        });
    };

    $(document).ready(function() {


        datauser();
        $('.btn-add').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('users/formtambah'); ?>",
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

        // get Edit akun



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



    // function hover tool tip
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    // function data table
    // $(document).ready(function() {
    //     $('#example').DataTable({
    //         ordering: true,
    //         info: false
    //     });
    // });
</script>

<?= $this->endSection(); ?>