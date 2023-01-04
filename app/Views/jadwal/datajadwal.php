<?php $session = session() ?>
<div class="table-responsive">
    <table id="datajadwal" class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Tujuan</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Status</th>
                <?php if ($session->get('level') == 'admin') : ?>
                    <th>Info</th>
                <?php endif; ?>

            </tr>
        </thead>
        <tbody>
            <?php $i = 1 + (10 * (1 - 1)); ?>
            <?php if ($tampildata != "") : ?>
                <?php foreach ($tampildata as $jad) : ?>
                    <tr>
                        <?php
                        if ($jad['status'] == 'baru') {
                            $status = "Baru";
                        } else {
                            $status = "Datang Kembali";
                        }
                        ?>
                        <?php if ($jad['jam'] == 'pagi') {
                            $jam = "Jam 09:00-11:00 Pagi";
                        }
                        if ($jad['jam'] == 'siang') {
                            $jam = "Jam 12:00-14:00 Siang ";
                        }
                        if ($jad['jam'] == 'sore') {
                            $jam = "Jam 15:00-17:00 Sore ";
                        }
                        if ($jad['jam'] == '') {
                            $jam = "";
                        } ?>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $jad['nama']; ?></td>
                        <td><?= $jad['tujuan_jdw']; ?></td>
                        <td width="15%"><?= tgl_indo($jad['tanggal']); ?></td>
                        <td width="20%"><?= $jam; ?></td>
                        <td><?= $status; ?></td>
                        <?php if ($session->get('level') == 'admin') : ?>
                            <td>
                                <ul class=" list-inline m-0">
                                    <?php if (strtotime($jad['tanggal']) < time() + 172800) :  ?>
                                        <button type="button" class="btn btn-primary btn-sm" title="Edit" onclick="edit('<?= $jad['id_jadwal'], $jad['nama']; ?>')" data-nama="<?= $jad['nama']; ?>">
                                            <i class="fa fa-edit"></i></button>

                                    <?php endif; ?>
                                </ul>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('#datajadwal').DataTable({
            ordering: true,
            language: {
                searchPlaceholder: "Cari Jadwal ...."
            },
            responsive: true


            // info: false
        })
    });

    function edit(id_jadwal, nama) {
        $.ajax({
            type: 'post',
            url: '<?= site_url('pages/formedit') ?>',
            data: {
                id_jadwal: id_jadwal,
                nama: nama
            },
            dataType: 'json',
            success: function(response) {
                if (response.sukses) {
                    $('.modaledit').html(response.sukses).show();
                    $('#modaledit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        });
    }
</script>