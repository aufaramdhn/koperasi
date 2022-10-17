<?php
require_once "../koneksi.php";
$today = date("Y-m-d H:i:s")
?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div>
        <div class="row" style="background-color: #FFF7E9;">
            <div class="col">
                <img src="../assets/img/background-login.jpg" alt="background-login">
            </div>
            <div class="col d-flex align-items-center">
                <div class="container w-75">
                    <form action="register-process.php" method="POST">
                        <span class="fs-2"> 
                        <h2 class="mb-2">Register</h2>
                        < </span>
                        <div class="mb-2">
                            <label for="nama-lenkap" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" id="nama-lengkap" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                         <div class="mb-2">
                            <label for="c-password" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="c_password" class="form-control" id="c-password">
                        </div>
                        <div class="mb-2">
                            <input type="hidden" name="created_at" value="<?= $today ?>" class="form-control">
                        </div>
                        <div class="mb-2">
                            <small class="font-weight-bold">Anda Sudah Mempunyai Akun? <a class="text-danger text-blue mt-2" href="../index.php">Login</a></small>
                        </div>
                         <div class="mb-2 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                        </div> 
                        <button type="submit" name="submit" class="btn btn-primary">Buat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html> -->

<?php include "../layout/header.php" ?>

<?php include "../layout/footer.php" ?>