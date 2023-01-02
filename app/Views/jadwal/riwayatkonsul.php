<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php $session = session() ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Riwayat Konsultasi <?= $session->get('nama') ?></h1>
            <?php $session = session() ?>


            <?php foreach (array_reverse($riwayat) as $kon) :  ?>
                <a href="/konsul/<?= $kon['id_konsul']; ?>" title="Konsultasi ke-<?= $kon['konsul_ke']; ?>">
                    <div class="tabel">

                        <div class="tabel-header">Konsultasi ke-<?= $kon['konsul_ke']; ?></div>

                        <div class="tabel-list"><?= tgl_indo($kon['hari_tanggal']); ?></div>
                        <div class="tabel-list"><?= $kon['tujuan']; ?></div>
                </a>
        </div>
    <?php endforeach; ?>

    </div>
</div>
</div>



<?= $this->endSection(); ?>