<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php $session = session() ?>

<?php

use SebastianBergmann\Exporter\Exporter;

function timestamp_indo($tanggal)
{
    $tz = 'Asia/Makassar';
    $dt = new DateTime($tanggal, new DateTimeZone($tz));
    $timestamp = $dt->format('d-m-Y G:i:s');
    return $timestamp;
}

?>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/jquery-3.5.1.js"></script>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <span class="header-text"> Detail Konsultasi</span>

                    <!-- <div class="info-btn">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-container="body" title="Detail" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="Dibuat pada : <?= tglwaktu_indo($konsul['created_at']); ?>
                           <?php if (!empty($konsul['updated_at'])) : ?>
                              Diperbarui pada : <?= tglwaktu_indo($konsul['updated_at']); ?>
                            <?php endif; ?>">
                            <i class="fa fa-info" aria-hidden="true"></i>
                        </button>
                    </div> -->

                </div>

                <div class="card-body">
                    <!-- <a href="/konsul/generate/<?= $konsul['id_konsul'] ?>">
                        Download PDF
                    </a> -->
                    <h5 class="card-title"> Konsultasi ke - <?= $konsul['konsul_ke']; ?></h5>
                    <p class="card-text">Tanggal : <?= tgl_indo($konsul['hari_tanggal']); ?></p>
                    <p class="card-text"> Tujuan : <?= $konsul['tujuan']; ?></p>
                    <p class="card-text">Hasil Konsultasi : <?php echo "<table><tbody><tr><td><textarea disabled rows=\"10\" cols=\"130\" >" . $konsul['hasil_konsul'] . "</textarea></td></tr></tbody></table>"; ?> </p>

                    <?php if ($session->get('level') !== 'klien') : ?>

                        <p class="card-text">Catatan Konsultasi : <?php echo "<table><tbody><tr><td><textarea disabled rows=\"10\" cols=\"130\" >" . $konsul['catatan_konsul'] . "</textarea></td></tr></tbody></table>"; ?> </p>
                        <?php if ($session->get('level') == 'admin') : ?>
                            <a href="/konsul/edit/<?= $konsul['id_konsul']; ?>" class="btn btn-primary">Edit</a>


                            <form action="/konsul/<?= $konsul['id_konsul']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" value="<?= $konsul['id_klien']; ?>" name="id_klien" id="id_klien">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Hapus</button>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>

                    <p class="card-text">Dibuat pada : <?= tglwaktu_indo($konsul['created_at']); ?></p>
                    <?php if (!empty($konsul['updated_at'])) : ?>
                        <p class="card-text">Diperbarui pada : <?= tglwaktu_indo($konsul['updated_at']); ?></p>
                    <?php endif; ?>


                </div>
            </div>

        </div>
    </div>
    <br>

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
        var popover = new bootstrap.Popover(document.querySelector('.popover-dismiss'), {
            trigger: 'focus'
        })
    </script>
</div>
<?= $this->endSection(); ?>