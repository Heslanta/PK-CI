<?php $session = session() ?>
<style>
    li:last-child {
        position: absolute;
        right: 0;
    }

    @media screen and (max-width:600px) {
        li:last-child {
            position: relative;
            left: 0;
        }
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #013B64;">

    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="color:white">HLP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button> -->

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
                    <a class="nav-link" style="color:white" href="<?= base_url('/auth/logout'); ?>">Logout</a>
                </li>
            </ul>


        </div>
    </div>

</nav>