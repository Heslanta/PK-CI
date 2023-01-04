<?php $session = session() ?>
<style>
    .nav-item:last-child {
        position: absolute;
        right: 0;
    }

    @media screen and (max-width:600px) {
        .nav-item:last-child {
            position: relative;
            left: 0;
        }
    }

    .notif {
        text-decoration: none;
        color: inherit;

    }

    a:hover {
        color: #1D1D1D;
    }
</style>
<div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a type="button" class="btn btn-primary" href="<?= base_url('/auth/logout'); ?>">Keluar</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
<div class="sticky">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #013B64;">

        <div class="container-fluid">
            <div class="logo-header">
                <a href="#">
                    <!-- <img src="../images/logo.png" alt="hlp" srcset=""> -->
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button> -->


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <a href="" class="notif"> <i class="fa-solid fa-bars fa-xl" style="margin-top: 15px;color:white"></i></a>

                    <?php if ($session->get('level') !== 'klien') : ?>

                        <li class="nav-item">
                            <a class="nav-link active" style="color:white" href="<?= base_url('/pages/index'); ?>">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color:white" href="<?= base_url('/pages/profil'); ?>">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color:white" href="<?= base_url('/klien'); ?>">Klien</a>
                        </li>
                        <?php if ($session->get('level') == 'admin') : ?>
                            <li class="nav-item">
                                <a class="nav-link" style="color:white" href="<?= base_url('/users'); ?>">Pengguna</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" style="color:white" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">Keluar</a>
                        </li>



                    <?php endif; ?>

                    <?php if ($session->get('level') == 'klien') : ?>

                        <li class="nav-item">
                            <a class="nav-link active" style="color:white" href="<?= base_url('/pages/klienberanda'); ?>">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color:white" href="<?= base_url('/pages/profil'); ?>">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color:white" href="<?= base_url('/riwayatkonsul'); ?>">Riwayat Konsultasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color:white" href="<?= base_url('/pages/bantuan'); ?>">Bantuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color:white" data-bs-toggle="modal" data-bs-target="#exampleModal">Keluar</a>
                        </li>


                    <?php endif; ?>

                </ul>
                <!-- Button trigger modal -->


            </div>
        </div>

    </nav>
</div>