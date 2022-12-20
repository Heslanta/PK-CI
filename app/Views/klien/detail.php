<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php




?>
<div class="container">
    <div class="row">
        <div class="col"><?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div><?php endif; ?>
            <div class="card">

                <div class="card-header">
                    Detail Wajib Pajak
                    <div class="info-icon">

                    </div>
                </div>


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
                            <p class="card-text"><b>Nomor HP Wajibpajak : </b><br><?= $klien['notelp']; ?></p>
                            <p class="card-text"><b>Nomor HP Perusahaan : </b><br><?= $klien['notelp_per']; ?></p>
                            <p class="card-text"><b>Bidang Usaha : </b><br><?= $klien['bidang_usaha']; ?></p>
                            <p class="card-text"><b>Email : </b><br><?= $klien['email']; ?></p>
                            <p class="card-text"><b>Password Email : </b><br><?= $klien['email_pass']; ?></p>
                            <p class="card-text"><b>ENOFA : </b><br><?= $klien['enofa']; ?></p>
                            <p class="card-text"><b>Tanggal PKP(Tahun/Bulan/Hari) : </b><br><?= tgl_indo($klien['pkp']) ?></p>
                            <p class="card-text"><b>Catatan : </b><?php echo "<table><tbody><tr><td><textarea disabled rows=\"10\" cols=\"130\" >" . $klien['catatan'] . "</textarea></td></tr></tbody></table>"; ?> </p>
                            <a href="/klien/edit/<?= $klien['id']; ?>" class="btn btn-primary">Edit</a>
                            <a href="/klien" class="btn btn-warning">Kembali</a>
                            <form action="/klien/<?= $klien['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Hapus</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <a href="/konsul/create/<?= $klien['id'] ?>" class="add" id="tombol"><i class="fa-solid fa-square-plus fa-lg"></i>&nbsp;&nbsp;Tambah</a><br>

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
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
    var popover = new bootstrap.Popover(document.querySelector('.popover-dismiss'), {
        trigger: 'focus'
    })
</script>

<?= $this->endSection(); ?>