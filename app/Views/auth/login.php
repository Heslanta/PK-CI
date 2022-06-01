<?= $this->extend('layout/header_login'); ?>

<?= $this->section('content'); ?>
<div class="container-login">
    <div class="left-half">
        <div class="img-container">
            <img src="images/themis.png">
        </div>
    </div>


    <div class="right-half">
        <h1>HLP Consultant</h1>
        <br>
        <img src="images/logo.png" class="center"><br>
        <h2><?= lang('Auth.loginTitle') ?></h2>
        <?= view('Myth\Auth\Views\_message_block') ?>

        <form action="<?= route_to('login') ?>" method="POST">
            <?= csrf_field() ?>
            <p><input type="text" class="input-form <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" id=" username" name="username" placeholder="<?= lang('Auth.username') ?>" onFocus="if(this.value=='username')this.value=''" required></p>
            <div class="invalid-feedback">
                <?= session('errors.username') ?>
            </div>
            <p><input type="password" class="input-form <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="password" name="password" placeholder="<?= lang('Auth.password') ?>" onFocus="if(this.value=='password')this.value=''" required></p>
            <div class="invalid-feedback">
                <?= session('errors.password') ?>
            </div>
            <div class="checkbox-container">
                <p><input type="checkbox" onclick="myFunction()" id="checkbox">&nbsp; <label for="checkbox">Show Password</label> </p>
            </div>
            <?php if ($config->allowRemembering) : ?>

                <p> <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>&nbsp; <?= lang('Auth.rememberMe') ?> </p>


            <?php endif; ?>
            <p>
                <!-- <input type="submit" class="submit-form" name="login" value="Login" id="tombol"> -->
                <button type="submit" class="submit-form"><?= lang('Auth.loginAction') ?></button>
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