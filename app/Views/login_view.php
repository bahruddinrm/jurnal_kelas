<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMP Negeri 14 Pekalongan</title>
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
                <select class="status" name="jabatan" id="jabatan">
                    <option selected disabled>Pilih Salah Satu</option>
                    <?php foreach ($jabatan as $j) : ?>
                        <option value="<?= $j['jabatan']; ?>"><?= $j['jabatan']; ?></option>
                    <?php endforeach ?>
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