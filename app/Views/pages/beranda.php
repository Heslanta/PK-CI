<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="mt-4">
                <h1>About Me</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, magnam.
                    Expedita doloremque, magni illum, officiis, minima exercitationem quas laudantium ipsam debitis sequi
                    dolorum laborum sit quam neque labore hic! Provident.</p>
                <h1>Klien berjumlah : <?= $jmlklien; ?></h1>
                <h1>Konsultasi berjumlah : <?= $jmlkonsul; ?></h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Nomor HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($users as $u) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $u['nama']; ?></td>
                                <td><?= $u['username']; ?></td>
                                <td><?= $u['password']; ?></td>
                                <td><?= $u['notelp']; ?></td>


                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>