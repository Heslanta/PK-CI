<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php $session = session() ?>

<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/klien">Klien</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> <?= $klien['wajibpajak']; ?></li>
                </ol>
            </nav>
            <div class="card">
                <form action="/klien/generate/<?= $klien['id']; ?>" method="post">
                    <div class="card-header" style="height: 50px;">
                        <b style="font-size: 24px; font-weight:600;">Detail Wajib Pajak</b>
                        <input type="hidden" name="wajibpajak" value="<?= $klien['wajibpajak']; ?>">

                        <button type="submit" class="btn btn-primary btn-sm" formtarget="_blank" style="float: right;">Download PDF</button>
                        </a>
                    </div>
                </form>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <h5 class="card-title"><b> Wajib Pajak : <br>
                                    <?= $klien['wajibpajak']; ?> &nbsp;
                                    <?php if ($klien['status'] == 'Proses') :  ?>
                                        <span class="badge bg-primary inline"><?= $klien['status']; ?></span>
                                    <?php endif; ?>
                                    <?php if ($klien['status'] == 'Selesai') :  ?>
                                        <span class="badge bg-success inline"><?= $klien['status']; ?></span>
                                    <?php endif; ?>


                            </h5>

                            <p class="card-text"><b>NPWP : </b><br><?= $klien['npwp']; ?></p>
                            <p class="card-text"><b>Nomor EFIN : </b><br><?= $klien['efin']; ?></p>
                            <p class="card-text"><b>Nomor HP Wajib pajak : </b><br><?= $klien['notelp']; ?></p>
                            <p class="card-text"><b>Nomor HP Perusahaan : </b><br><?= $klien['notelp_per']; ?></p>
                            <p class="card-text"><b>Bidang Usaha : </b><br><?= $klien['bidang_usaha']; ?></p>
                            <p class="card-text"><b>Email : </b><br><?= $klien['email']; ?></p>
                            <p class="card-text"><b>Password Email : </b><br><?= $klien['email_pass']; ?></p>
                            <p class="card-text"><b>ENOFA : </b><br><?= $klien['enofa']; ?></p>
                            <p class="card-text"><b>Tanggal PKP : </b><br><?= tgl_indo($klien['pkp']) ?></p>
                            <p class="card-text"><b>Catatan : </b><?php echo "<table><tbody><tr><td><textarea disabled rows=\"10\" cols=\"100\" >" . $klien['catatan'] . "</textarea></td></tr></tbody></table>"; ?> </p>
                            <a href="/klien/edit/<?= $klien['id']; ?>" class="btn btn-primary">Edit</a>

                            <?php if ($session->get('level') == 'admin') : ?>

                                <a href="#" class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus" data-id="<?= $klien['id']; ?>">Hapus</a>

                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>

            <a href="/konsul/create/<?= $klien['id'] ?>" class="add" id="tombol" style="font-family:sans-serif;">Tambah</a><br>

            <form action="/klien/<?= $klien['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hapus Klien</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <h4>Apakah anda yakin untuk menghapus?</h4>

                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" class="id">
                                <button type="submit" class="btn btn-primary">Hapus</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- <a href="/konsul/create" class="add" id="tombol"><i class="fa-solid fa-square-plus fa-lg"></i>&nbsp;&nbsp;Tambah</a><br> -->
            <?php foreach (array_reverse($konsultasi) as $kon) :  ?>

                <div class="tabel">
                    <a href="/konsul/<?= $kon->id_konsul ?>" title="Konsultasi ke-<?= $kon->konsul_ke ?>">
                        <div class="tabel-header">Konsultasi ke-<?= $kon->konsul_ke ?></div>

                        <div class="tabel-list"><?= tgl_indo($kon->hari_tanggal) ?></div>
                        <div class="tabel-list"><?= $kon->tujuan ?></div>
                    </a>
                </div>
            <?php endforeach; ?><br>
            <br>
            <div class="card">
                <div class="card-header">Pemegang Saham Perusahaan</div>
                <div class="card-body">
                    <!-- style untuk ukuran gambar mengikuti card body -->
                    <style>
                        .gambar-saham img {
                            width: 100%;
                            height: 100%;
                        }

                        .gambar-default img {
                            width: 22%;
                            height: 10%;
                        }
                    </style>
                    <!-- Pekondisian jika tidak ada gambar pada database -->


                    <?php if (!empty($klien['filegambar'])) : ?>
                        <?php if ($klien['filegambar'] == 'default.png') : ?>
                            <div class="gambar-default">
                                <a href="/img/<?= $klien['filegambar']; ?>" target="_blank"><img src="/img/<?= $klien['filegambar']; ?>" alt=""></a>
                            </div>
                        <?php else : ?>
                            <div class="gambar-saham">
                                <a href="/img/<?= $klien['filegambar']; ?>" target="_blank"><img src="/img/<?= $klien['filegambar']; ?>" alt=""></a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>


                </div>


            </div>


        </div>
    </div>
    <br><br>
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
    $('.btn-delete').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        $('.id').val(id);
        // Call Modal Edit
        $('#deleteModal').modal('show');
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