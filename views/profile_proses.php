<?php

session_start();

$id_user = $_SESSION['id_user'];

include("../apps/koneksi.php");

if (isset($_POST['bsimpan'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tempat = $_POST['tempat'];
    $tgl = $_POST['tgl'];
    $jk = $_POST['jk'];
    $agama = $_POST['agama'];
    $pekerjaan = $_POST['pekerjaan'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $created_at = $_POST['created_at'];

    $query = mysqli_query($koneksi, "INSERT INTO tbl_user VALUES ('$nama', '$email', '$password', '$tempat', '$tgl', '$jk', '$agama', '$pekerjaan', '$telp', '$alamat', 'user', '$created_at') WHERE id_user = $id_user");

    if ($query == true) {
        $_SESSION['info'] = 'Disimpan';
        header("Location: profile.php");
    } else {
        $_SESSION['info'] = 'Gagal';
        header("Location: profile.php");
    }
}
