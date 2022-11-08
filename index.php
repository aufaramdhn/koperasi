<?php
require_once "apps/koneksi.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/style/style.css">

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

    <div class="row" style="background-color: #FFF7E9;">
        <div class="col">
            <img class="img-login" src="assets/img/background-login.jpg" alt="background-login">
        </div>
        <div class="col d-flex align-items-center">
            <div class="container w-75">
                <form action="auth/login_proses.php" method="POST">
                    <!-- <span class="fs-2"> -->
                    <h2>Login</h2>
                    <!-- </span> -->
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <div class="mb-2 ">
                        <small class="font-weight-bold">Anda Belum Mempunyai akun? <a class="text-danger text-blue mt-2" href="register/register.php">Buat Account</a></small>
                    </div>
                    <!-- <div class="mb-2 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                        </div> -->
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/script/jquery.js"></script>

    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/sweetalert.js"></script>

    <script src="assets/script/alert.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/script/jquery.js"></script>

    <script src="assets/script/sidebar.js"></script>

    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/datatables.min.js"></script>

    <script src="assets/js/custom.js"></script>

    <script src="assets/js/sweetalert.js"></script>

    <script src="assets/script/alert.js"></script>
</body>

</html>