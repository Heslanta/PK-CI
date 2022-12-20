<?= $this->extend('layout/header_login'); ?>

<?= $this->section('content'); ?>
<div class="container-login">
    <div class="left-half">
        <div class="img-container">
            <img src="images/themis.png">
        </div>
    </div>
    <?php
    $session = session();
    $login = $session->getFlashdata('login');
    $username = $session->getFlashdata('username');
    $password = $session->getFlashdata('password');
    ?>

    <div class="right-half">
        <h1>HLP Consultant</h1>
        <br>
        <img src="images/logo.png" class="center"><br>
        <h2>Login</h2>
        <?php if (session()->getFlashdata('username')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('username'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div><?php endif; ?>
        <?php if (session()->getFlashdata('password')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('password'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div><?php endif; ?>
        <?php if (!empty(session()->getFlashdata('fail'))) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif ?>
        <form action="/auth/valid_login" method="POST">
            <?= csrf_field() ?>
            <p><input type="text" class="input-form" id=" username" name="username" placeholder="Username" required></p>

            <p><input type="password" class="input-form" id="password" name="password" placeholder="Password" required></p>
            <div class="checkbox-container">
                <p><input type="checkbox" onclick="myFunction()" id="checkbox">&nbsp; <label for="checkbox">Tampilkan Password</label> </p>
            </div>



            <p>
                <!-- <input type="submit" class="submit-form" name="login" value="Login" id="tombol"> -->
                <button type="submit" class="submit-form">Login</button>
            </p>

        </form>

        <br> <br> <br> <br>
    </div> <!-- end login -->
</div>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<?= $this->endSection(); ?>