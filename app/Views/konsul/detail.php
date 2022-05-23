<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>



<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Detail Konsultasi
                </div>

                <div class="card-body">
                    <h5 class="card-title"> Konsultasi ke - <?= $konsul['konsul_ke']; ?></h5>
                    <p class="card-text">Tanggal : <?= $konsul['hari_tanggal']; ?></p>
                    <p class="card-text"> Tujuan : <?= $konsul['tujuan']; ?></p>
                    <p class="card-text">Hasil Konsultasi : <?php echo "<table><tbody><tr><td><textarea disabled rows=\"10\" cols=\"130\" >" . $konsul['hasil_konsul'] . "</textarea></td></tr></tbody></table>"; ?> </p>
                    <p class="card-text">Catatan Konsultasi : <?php echo "<table><tbody><tr><td><textarea disabled rows=\"10\" cols=\"130\" >" . $konsul['catatan_konsul'] . "</textarea></td></tr></tbody></table>"; ?> </p>
                    <a href="/konsul/edit/<?= $konsul['id_konsul']; ?>" class="btn btn-primary">Edit</a>

                    <button onclick="history.back()" class="btn btn-warning">Kembali</button>

                    <form action="/konsul/<?= $konsul['id_konsul']; ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Hapus</button>
                    </form>
                </div>
            </div>
            <a href="/konsultasi/create" class="add" id="tombol"><i class="fa-solid fa-square-plus fa-lg"></i>&nbsp;&nbsp;Tambah</a><br>

        </div>
    </div>
    <br>
</div>
<?= $this->endSection(); ?>