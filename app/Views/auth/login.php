<meta name="viewport" content="width=device-width, initial-scale=1">
<?= $this->extend('layout/header'); ?>

<?= $this->section('content'); ?>
<div class="container-login">
    <div class="left-half">
        <img src="images/themis.png">
    </div>


    <div class="right-half">
        <h1>HLP Consultant</h1>
        <br>
        <img src="images/logo.png" class="center"><br>
        <h2>Login</h2>


        <form action="logincek.php" method="POST">

            <p><input type="username" class="input-form" id="username" name="username" value="username" onBlur="if(this.value=='')this.value='username'" onFocus="if(this.value=='username')this.value=''" required></p>

            <p><input type="password" class="input-form" id="password" name="password" value="password" onBlur="if(this.value=='')this.value='password'" onFocus="if(this.value=='password')this.value=''" required></p>

            <div class="checkbox-container">
            <p><input type="checkbox" onclick="myFunction()">&nbsp;Show Password </p>
            </div>
            <p><input type="submit" class="submit-form" name="login" value="Login" id="tombol"></p>
            
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