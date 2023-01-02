<?php $session = session() ?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin mau keluar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a type="button" class="btn btn-primary" href="<?= base_url('/auth/logout'); ?>">Keluar</a>
            </div>
        </div>
    </div>
</div>


<div class="sidebar-wrapper">

    <div class="sidebar-menu">

        <div class="sidebar-nama">
            <div class="logo-sidebar">
                <a href="/pages/index">
                    <img src="../../images/logo.png" alt="hlp"> &nbsp; HLP Banjarmasin
                </a>
            </div>

        </div>
        <?php $level = $session->get('level') ?>
        <p>Dashboard <?= $level; ?></p>

        <!-- Jika session klien, muncul sidebar klien  -->
        <?php if ($session->get('level') == 'klien') : ?>
            <div class="sidebar-klien">
                <a href="<?= base_url('/pages/klienberanda'); ?>">
                    <div class="sidebar-list">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="fas fa-house"></i>&nbsp;&nbsp;
                        Beranda
                    </div>
                </a>
                <a href="<?= base_url('/pages/profil'); ?>">
                    <div class="sidebar-list">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="fa-solid fa-user"></i>&nbsp;&nbsp;
                        Profil
                    </div>
                </a>
                <a href="<?= base_url('/jadwal/riwayatkonsul'); ?>">
                    <div class="sidebar-list">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="fa-solid fa-user"></i>&nbsp;&nbsp;
                        Riwayat Konsultasi
                    </div>
                </a>
                <a href="<?= base_url('/pages/bantuan'); ?>">
                    <div class="sidebar-list">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="fa-solid fa-question"></i>&nbsp;&nbsp;
                        Bantuan
                    </div>
                </a>

            </div>

            <!-- Jika buhan session klien =  session admin or pegawai, muncul sidebar  -->
        <?php else : ?>
            <div class="sidebar-admin">
                <a href="<?= base_url('/pages/index'); ?>">
                    <div class="sidebar-list">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="fas fa-house"></i>&nbsp;&nbsp;
                        Beranda
                    </div>
                </a>
                <a href="<?= base_url('/pages/profil'); ?>">
                    <div class="sidebar-list">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="fa-solid fa-user"></i>&nbsp;&nbsp;
                        Profil
                    </div>
                </a>
                <a href="<?= base_url('/klien'); ?>">
                    <div class="sidebar-list">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="fa-solid fa-user-group"></i>&nbsp;&nbsp;
                        Klien
                    </div>
                </a>


                <!-- <a href="<?= base_url('/jadwal'); ?>">
            <div class="sidebar-list">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <i class="fa-solid fa-user-group"></i>&nbsp;&nbsp;
                Jadwal
            </div>
                </a> -->

                <!-- Jika session admin, tampilkan bagian user -->
                <?php if ($session->get('level') == 'admin') : ?>
                    <a href="<?= base_url('/users'); ?>">
                        <div class="sidebar-list">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa-solid fa-image-portrait"></i>&nbsp;&nbsp;
                            Pengguna
                        </div>
                    </a>
                    <a href="<?= base_url('/tujuan-konsul'); ?>">
                        <div class="sidebar-list">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa-solid fa-cog"></i>&nbsp;&nbsp;
                            Tujuan Konsul
                        </div>
                    </a>

                <?php endif; ?>
                <a href="<?= base_url('/pages/bantuan'); ?>">
                    <div class="sidebar-list">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="fa-solid fa-question"></i>&nbsp;&nbsp;
                        Bantuan
                    </div>
                </a>
            </div>

            <!-- End sidebar admin dan pegawai -->
        <?php endif; ?>










        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <div class="sidebar-footer">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;&nbsp;
                Log Out
            </div>
        </a>
        <!-- Button trigger modal -->


        <!-- Modal -->

    </div>
</div>