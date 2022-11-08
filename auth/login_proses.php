<?php

include("../apps/koneksi.php");

session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $data = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE email='$email'");

    $row = mysqli_fetch_array($data);

    if (mysqli_num_rows($data) == 1) {

        if ($password == $row['password']) {
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['nama'] =  $row['nama'];
            $_SESSION['email'] =  $row['email'];
            $_SESSION['level'] = $row['level'];
            $_SESSION['info'] = "Berhasil";
            header("Location: ../views/index.php");
        } else {
            $_SESSION['info'] = 'Kosong';
            header("Location: ../index.php");
        }
    }
}
