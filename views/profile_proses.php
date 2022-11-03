<?php

session_start();

include("../koneksi.php");

if (isset($_POST['editprofile'])) {
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

    $query = mysqli_query($koneksi, "INSERT INTO tbl_user VALUES (NULL, '$nama', '$email', '$password' , '$tempat', '$tgl', '$jk', '$agama', '$pekerjaan', '$telp', '$alamat',)");

    if ($query == true) {
        $_SESSION['info'] = 'Disimpan';
        header("Location: pinjaman_admin.php");
    } else {
        $_SESSION['info'] = 'Gagal';
        header("Location: pinjaman_admin.php");
    }
}
