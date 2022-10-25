<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<?php $session = session() ?>


<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-2">Jadwal Klien</h1>
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
            <a href="/users/create" class="btn btn-success mt-3">Tambah Jadwal</a>
            <br>
            <!-- menunjukkan alert tambah data -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Nomor HP</th>
                        <th scope="col">Level</th>
                    </tr>
                </thead>
                <tbody>



                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>





<?= $this->endSection(); ?>