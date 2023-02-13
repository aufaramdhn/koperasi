<?php
require_once("../../apps/config.php");
require_once("../../apps/koneksi.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi</title>

    <link rel="stylesheet" href="<?php echo $config; ?>assets/styles/output.css" />

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

    <!-- <div class="row">
        <div class="col-6 d-flex align-items-center">
            <div class="container w-75">
                <form action="auth/login_proses.php" method="POST">
                    <h2 class="mb-4 text-center fw-bold">Login</h2>
                    <div class="mb-4">
                        <label for="inputEmail" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Masukan Email Anda" required>
                    </div>
                    <div class="mb-4">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Masukan Password Anda" required>
                    </div>
                    <div class="mb-2">
                        <button type="submit" name="submit" class="pt-2 pb-2 text-white btn w-100" style="background-color: #1B1C30;">Login</button>
                    </div>
                    <small class="font-weight-bold">Anda Belum Mempunyai akun? <a class="mt-2" style="color: #6A5BE2;" href="register/register.php">Buat Akun</a></small>
                </form>
            </div>
        </div>
        <div class="col-6" style="background-color: #D5EBFF; height: 100vh;">
            <div class="d-flex justify-content-center align-items-center h-100">
                <img src="assets/images/bg-login.png"> 
                <img src="assets/images/undraw_access_account_re_8spm.svg" width="500">
            </div>
        </div>
    </div> -->

    <section class="flex items-center justify-center min-h-screen bg-gradient-to-br from-[#9896F0] to-[#FBC8D5]">
        <!-- Login Container -->
        <div class="flex items-center w-10/12 py-10 bg-white shadow-lg md:py-0 rounded-2xl">
            <!-- Form -->
            <div class="md:w-1/2 rounded-tl-2xl rounded-bl-2xl">
                <form action="login_proses.php" method="POST">
                    <div class="flex flex-col justify-center gap-2 px-20">
                        <h2 class="mb-3 text-3xl font-bold text-center">Login</h2>
                        <div class="flex flex-col w-full mb-3">
                            <label for="" class="mb-2">Email</label>
                            <input type="text" name="email" placeholder="Masukan Email Anda" class="form-control-login" required />
                        </div>
                        <div class="flex flex-col w-full mb-3">
                            <label for="" class="mb-2">Password</label>
                            <input type="password" name="password" placeholder="Masukan Password Anda" class="form-control-login" required />
                        </div>
                        <button type="submit" name="submit" class="w-full p-2 text-white rounded-md bg-[#9896F0]">
                            Login
                        </button>
                        <span href="">Belum mempunyai akun?
                            <a href="register.php" class="text-[#5D69BE]">Register disini</a></span>
                    </div>
                </form>
            </div>

            <!-- Image -->
            <div class="md:w-1/2 md:block hidden bg-[#D5EBFF] rounded-tr-2xl rounded-br-2xl">
                <div class="flex items-center justify-center py-24">
                    <img src="<?php echo $config; ?>assets/images/undraw_access_account_re_8spm.svg" class="w-9/12" />
                </div>
            </div>
        </div>
    </section>

    <script src="<?php echo $config; ?>assets/script/jquery.js"></script>

    <script src="<?php echo $config; ?>assets/script/sweetalert.js"></script>

    <script src="<?php echo $config; ?>assets/script/alert.js"></script>
</body>

</html>