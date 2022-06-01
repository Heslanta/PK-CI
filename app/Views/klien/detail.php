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
                    <div class="row">
                        <div class="col-sm-5">
                            <h5 class="card-title"> Wajib Pajak : <br><?= $klien['wajibpajak']; ?></h5>
                            <p class="card-text">NPWP : <br><?= $klien['npwp']; ?></p>
                            <p class="card-text">Nomor EFIN : <br><?= $klien['efin']; ?></p>
                            <p class="card-text">Nomor HP Wajibpajak : <br><?= $klien['notelp']; ?></p>
                            <p class="card-text">Nomor HP Perusahaan : <br><?= $klien['notelp_per']; ?></p>
                            <p class="card-text">Bidang Usaha : <br><?= $klien['bidang_usaha']; ?></p>
                            <p class="card-text">Email : <br><?= $klien['email']; ?></p>
                            <p class="card-text">Password Email : <br><?= $klien['email_pass']; ?></p>
                            <p class="card-text">ENOFA : <br><?= $klien['enofa']; ?></p>
                            <p class="card-text">Tanggal PKP(Tahun/Bulan/Hari) : <br><?= $klien['pkp']; ?></p>
                            <p class="card-text">Catatan : <?php echo "<table><tbody><tr><td><textarea disabled rows=\"10\" cols=\"130\" >" . $klien['catatan'] . "</textarea></td></tr></tbody></table>"; ?> </p>
                            <a href="/klien/edit/<?= $klien['id']; ?>" class="btn btn-primary">Edit</a>
                            <button onclick="history.back()" class="btn btn-warning">Kembali</button>
                            <form action="/klien/<?= $klien['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Hapus</button>
                            </form>
                        </div>
                        <div class="col-sm-5">
                            <h5>Akun Klien</h5>
                            <?php foreach (array_reverse($user) as $user) :  ?>

                                <p class="card-text">Nama akun : <?= $user['nama']; ?></p>
                                <p class="card-text">Username : <?= $user['username']; ?></p>
                                <p class="card-text">Password : <?= $user['password']; ?></p>

                            <?php endforeach; ?>
                        </div>
                    </div>
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