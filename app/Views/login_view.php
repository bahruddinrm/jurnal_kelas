<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Login & Registration Form</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/login_style.css') ?>">
</head>

<body>
    <div class="container">
        <span></span>
        <span></span>
        <span></span>
        <!-- LOGIN -->
        <form id="signinForm" action="" method="post">
            <h2>Login</h2>
            <?php if (session()->getFlashdata('error')) { ?>
                <div class="alert">
                    <p><?php echo session()->getFlashdata('error') ?></p>
                </div>
            <?php } ?>
            <div class="inputBox">
                <input type="text" placeholder="Username" name="username" id="username" value="<?php echo session()->getFlashdata('username') ?>" required>
            </div>
            <div class="inputBox">
                <input type="password" placeholder="Password" name="password" id="password" value="<?php echo session()->getFlashdata('password') ?>" required>
            </div>
            <div class="inputBox">
                <select class="status" name="status" id="status">
                    <option value="Guru">Guru</option>
                    <option value="Admin">Admin</option>
                    <option value="Kepala Sekolah">Kepala Sekolah</option>
                </select>
            </div>

            <div class="inputBox">
                <input type="submit" value="Sign In" name="sign_in">
            </div>
        </form>
    </div>

    <!-- <script>
        let signup = document.querySelector('#signup');
        let signin = document.querySelector('#signin');
        let body = document.querySelector('body');
        signup.onclick = function() {
            body.classList.add('signup');
        }
        signin.onclick = function() {
            body.classList.remove('signup');
        }
    </script> -->
</body>

</html>