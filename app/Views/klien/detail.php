<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>



<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div><?php endif; ?>
                <div class="card-header">
                    Detail Wajib Pajak
                </div>

                <div class="card-body">
                    <h5 class="card-title"> Wajib Pajak : <?= $klien['wajibpajak']; ?></h5>
                    <p class="card-text">NPWP : <?= $klien['npwp']; ?></p>
                    <p class="card-text">Nomor HP : <?= $klien['notelp']; ?></p>
                    <p class="card-text">Catatan : <?php echo "<table><tbody><tr><td><textarea disabled rows=\"10\" cols=\"130\" >" . $klien['catatan'] . "</textarea></td></tr></tbody></table>"; ?> </p>
                    <a href="/klien/edit/<?= $klien['id']; ?>" class="btn btn-primary">Edit</a>
                    <button onclick="history.back()" class="btn btn-warning">Kembali</button>
                    <form action="/klien/<?= $klien['id']; ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Hapus</button>
                    </form>
                </div>
            </div>

            <a href="/konsul/create/<?= $klien['id'] ?>" class="add" id="tombol"><i class="fa-solid fa-square-plus fa-lg"></i>&nbsp;&nbsp;Tambah</a><br>

            <!-- <a href="/konsul/create" class="add" id="tombol"><i class="fa-solid fa-square-plus fa-lg"></i>&nbsp;&nbsp;Tambah</a><br> -->
            <?php foreach (array_reverse($konsultasi) as $kon) :  ?>

                <div class="tabel">
                    <a href="/konsul/<?= $kon->id_konsul ?>">
                        <div class="tabel-header">Konsultasi ke-<?= $kon->konsul_ke ?></div>

                        <div class="tabel-list"><?= $kon->hari_tanggal ?></div>
                        <div class="tabel-list"><?= $kon->tujuan ?></div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <br><br>
</div>
<?= $this->endSection(); ?>