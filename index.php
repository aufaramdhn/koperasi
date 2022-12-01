<?php
require_once("apps/config.php");
require_once("apps/koneksi.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi</title>

    <link rel="stylesheet" href="<?php echo $config; ?>assets/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo $config; ?>assets/style/style.css">

</head>

<body class="overflow-hidden">
    <!-- Alert -->
    <?php if (isset($_SESSION['info'])) : ?>
        <div class="info-data" data-infodata="<?php echo $_SESSION['info']; ?>"></div>
    <?php
        session_destroy();
    // unset($_SESSION['info']);
    endif;
    ?>

    <div class="row">
        <div class="col-6 d-flex align-items-center">
            <div class="container w-75">
                <form action="auth/login_proses.php" method="POST">
                    <h2 class="fw-bold text-center mb-4">Login</h2>
                    <div class="mb-4">
                        <label for="inputEmail" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Masukan Email Anda" required>
                    </div>
                    <div class="mb-4">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Masukan Password Anda" required>
                    </div>
                    <div class="mb-2">
                        <button type="submit" name="submit" class="btn w-100 text-white pt-2 pb-2" style="background-color: #1B1C30;">Login</button>
                    </div>
                    <small class="font-weight-bold">Anda Belum Mempunyai akun? <a class="mt-2" style="color: #6A5BE2;" href="register/register.php">Buat Akun</a></small>
                </form>
            </div>
        </div>
        <div class="col-6" style="background-color: #D5EBFF; height: 100vh;">
            <div class="d-flex justify-content-center align-items-center h-100">
                <!-- <img src="assets/images/bg-login.png"> -->
                <img src="assets/images/undraw_access_account_re_8spm.svg" width="400">
            </div>
        </div>
    </div>

    <script src="<?php echo $config; ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo $config; ?>assets/script/jquery.js"></script>

    <script src="<?php echo $config; ?>assets/script/sweetalert.js"></script>

    <script src="<?php echo $config; ?>assets/script/alert.js"></script>
</body>

</html>