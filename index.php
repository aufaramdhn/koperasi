<?php
require_once "koneksi.php";
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
    <div class="row" style="background-color: #FFF7E9;">
        <div class="col">
            <img class="img-login" src="assets/img/background-login.jpg" alt="background-login">
        </div>
        <div class="col d-flex align-items-center">
            <div class="container w-75">
                <form method="POST">
                    <!-- <span class="fs-2"> -->
                    <h2>Login</h2>
                    <!-- </span> -->
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
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
</body>

</html>

<?php

session_start();
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $data = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE email='$email'");

    $row = mysqli_fetch_array($data);

    if (mysqli_num_rows($data) == 1) {

        if ($password == $row['password']) {
            $_SESSION['user'] = true;
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['nama'] =  $row['nama'];
            $_SESSION['email'] =  $row['email'];
            $_SESSION['level'] = $row['level'];

            echo "
            <script>
            alert('Login Berhasil');
            document.location.href = 'views/index.php';
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Login Gagal');
            document.location.href = 'index.php';
            </script>
            ";
        }
    }
}
