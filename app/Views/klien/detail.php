<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>



<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-header">
                    Detail Wajib Pajak
                </div>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div><?php endif; ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <h5 class="card-title"><b> Wajib Pajak : </b><br><?= $klien['wajibpajak']; ?></h5>
                            <p class="card-text"><b>NPWP : </b><br><?= $klien['npwp']; ?></p>
                            <p class="card-text"><b>Nomor EFIN : </b><br><?= $klien['efin']; ?></p>
                            <p class="card-text"><b>Nomor HP Wajibpajak : </b><br><?= $klien['notelp']; ?></p>
                            <p class="card-text"><b>Nomor HP Perusahaan : </b><br><?= $klien['notelp_per']; ?></p>
                            <p class="card-text"><b>Bidang Usaha : </b><br><?= $klien['bidang_usaha']; ?></p>
                            <p class="card-text"><b>Email : </b><br><?= $klien['email']; ?></p>
                            <p class="card-text"><b>Password Email : </b><br><?= $klien['email_pass']; ?></p>
                            <p class="card-text"><b>ENOFA : </b><br><?= $klien['enofa']; ?></p>
                            <p class="card-text"><b>Tanggal PKP(Tahun/Bulan/Hari) : </b><br><?= $klien['pkp']; ?></p>
                            <p class="card-text"><b>Catatan : </b><?php echo "<table><tbody><tr><td><textarea disabled rows=\"10\" cols=\"130\" >" . $klien['catatan'] . "</textarea></td></tr></tbody></table>"; ?> </p>
                            <a href="/klien/edit/<?= $klien['id']; ?>" class="btn btn-primary">Edit</a>
                            <button onclick="history.back()" class="btn btn-warning">Kembali</button>
                            <form action="/klien/<?= $klien['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Hapus</button>
                            </form>
                        </div>
                            
                    </div>
                </div>
            </div>
            <div class="akun-container">
                            <h5>Akun Klien</h5>
                            <?php foreach (array_reverse($user) as $user) :  ?>
                                <p class="card-text">Nama akun : <?= $user['nama']; ?></p>
                                <p class="card-text">Username : <?= $user['username']; ?></p>
                                <p class="card-text">Password : <?= $user['password']; ?></p>
                            <?php endforeach; ?>
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