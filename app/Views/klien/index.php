<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<div class="container">
    <div class="row">
        <div class="col">
            <a href="/klien/create" class="add" id="tombol"><i class="fa-solid fa-square-plus fa-lg"></i>&nbsp;&nbsp;Tambah</a>
            <div class="main-content-wrapper">
                <br>
                <div class="main-content">
                    <h1><i class="fas fa-database"></i>
                        &nbsp;&nbsp;Data Klien</h1>

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

                    <div class="tabel-wrap">

                        <?php foreach (array_reverse($klien) as $k) : ?>

                            <div class="tabel">
                                <a href="/klien/<?= $k['id']; ?>">
                                    <div class="tabel-header"><?= $k['wajibpajak']; ?></div>

                                    <div class="tabel-list"><?= $k['npwp']; ?></div>
                                    <div class="tabel-list"><?= $k['notelp']; ?></div>
                                </a>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <br><br>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>