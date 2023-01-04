<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<?php $session = session() ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-2">Daftar Klien </h1>
            <br>
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
            <a href="/klien/create" class="add" id="tombol"><b style="font-family: sans-serif;">Tambah</b></a>
            <div class="main-content-wrapper">
                <br>
                <div class="main-content">

                    <div class="card-1 bg-warning">
                        <!-- <img src="..." class="card-img-top" alt="..."> -->
                        <div style="display: inline-block;">
                            <i class="fa fa-user" aria-hidden="true" style="display:inline-block; font-size:30px">&nbsp;</i>
                            <h2 style="font-family:sans-serif; display:inline-block;"><b>Klien berjumlah : <?= $jumlah; ?></b> </h2>
                        </div>
                    </div>

                    <div class="tabel-wrap">
                        <?php foreach (array_reverse($klien) as $k) : ?>

                            <div class="tabel" title="<?= $k['wajibpajak']; ?>">

                                <a href="/klien/<?= $k['id']; ?>">
                                    <div class="tabel-header"><?= $k['wajibpajak']; ?>
                                        <?php if ($k['status'] == 'Proses') :  ?>
                                            <span class="badge rounded-pill bg-primary inline"><?= $k['status']; ?></span>
                                        <?php endif; ?>
                                        <?php if ($k['status'] == 'Selesai') :  ?>
                                            <span class="badge rounded-pill bg-success inline"><?= $k['status']; ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="tabel-list"><?= $k['npwp']; ?></div>
                                    <div class="tabel-list"><?= $k['notelp']; ?></div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <br><br>

                    <?= $pager->links('klien', 'pagination_klien'); ?>
                </div>
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
</script>
<?= $this->endSection(); ?>