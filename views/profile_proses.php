<?php

session_start();

include("../apps/koneksi.php");

if (isset($_POST['bsimpan'])) {
    $id_user = $_POST['id_user'];
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

    $query = mysqli_query($koneksi, "UPDATE tbl_user SET nama='$nama',email='$email', password='$password', tempat_lahir='$tempat', tgl_lahir='$tgl', jk='$jk', agama='$agama', pekerjaan='$pekerjaan', telp='$telp', alamat='$alamat', level='user' WHERE id_user = $id_user");

    if ($query == true) {
        $_SESSION['info'] = 'Disimpan';
        header("Location: profile.php");
    } else {
        $_SESSION['info'] = 'Gagal';
        header("Location: profile.php");
    }
}
