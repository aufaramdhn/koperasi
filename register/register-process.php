<?php

session_start();
include "../apps/koneksi.php";

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telp = $_POST['notelp'];
    $created_at = $_POST['created_at'];

    $result = mysqli_query($koneksi, "INSERT INTO tbl_user VALUES('','$nama','$email','$password','','','','','','$telp','','user','$created_at')");
    if ($result > 0) {
        $_SESSION['info'] = 'berhasil di buat';
        echo "<script>window.location=' ../index.php'</script>";
    } else {
        $_SESSION['info'] = 'email sudah di gunakan';
        echo "<script>window.location=' register.php'</script>";
    }
}
