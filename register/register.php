<?php
require_once("../apps/config.php");
include_once("../apps/koneksi.php");
session_start();

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi</title>

    <link rel="stylesheet" href="<?php echo $config; ?>assets/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo $config; ?>assets/styles/style.css">

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
        <div class="col-6" style="background-color: #FFE6E7; height: 100vh;">
            <!-- <img class="img-login" src="assets/img/background-login.jpg" alt="background-login"> -->
        </div>
        <div class="col-6 d-flex align-items-center">
            <div class="container w-75">
                <form action="register-process.php" method="POST">
                    <h2 class="fw-bold text-center">Register</h2>
                    <small class="d-flex justify-content-center mb-3">Create an Account</small>
                    <!-- <div style="border-bottom: 4px solid; margin-bottom: 1rem; border-color: #D5EBFF; width: 20%;"></div> -->
                    <div class="mb-3">
                        <label for="inputNama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" id="inputNama" placeholder="Masukan Nama Lengkap Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Masukan Email Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Masukan Password Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="inputNotelp" class="form-label">No Telepon</label>
                        <input type="text" name="notelp" class="form-control" id="inputNotelp" placeholder="Masukan No Telepon Anda" required>
                    </div>
                    <input type="datetime" class="d-none" name="created_at" value="<?= $today ?>">
                    <div class="mb-2">
                        <button type="submit" name="submit" class="btn w-100 text-white pt-2 pb-2" style="background-color: #1B1C30;">Create An Account</button>
                    </div>
                    <small class="font-weight-bold">Anda Sudah Mempunyai akun? <a class="mt-2" style="color: #6A5BE2;" href="../index.php">Masuk disini</a></small>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo $config; ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo $config; ?>assets/script/jquery.js"></script>

    <script src="<?php echo $config; ?>assets/script/sweetalert.js"></script>

    <script src="<?php echo $config; ?>assets/script/alert.js"></script>
</body>

</html>