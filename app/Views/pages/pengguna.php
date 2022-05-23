<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Daftar Pengguna</h1>
            <a href="/pages/pengguna/create" class="btn btn-success">Tambah Data Pengguna</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Wajib Pajak</th>
                        <th scope="col">NPWP</th>
                        <th scope="col">Nomor HP</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($klien as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $k['wajibpajak']; ?></td>
                            <td><?= $k['npwp']; ?></td>
                            <td><?= $k['notelp']; ?></td>
                            <td>
                                <a href="/klien/<?= $k['slug']; ?>" class="btn btn-primary">Detail</button>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>