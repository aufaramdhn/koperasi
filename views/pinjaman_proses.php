<?php

session_start();

require("../koneksi.php");

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");
$expires = strtotime('+30 days', strtotime($today));
$expired = date('Y-m-d H:i:s', $expires);

if (isset($_POST['konfirmasi'])) {
    $id = $_POST['id_pinjam'];

    $select = "UPDATE tbl_pinjam SET status = 'konfirmasi' WHERE id_pinjam = '$id'";
    $result_select = mysqli_query($koneksi, $select);

    $confirm = "INSERT INTO konfirmasi_pinjam VALUES ('','$id','$today','$expired')";
    $result_confirm = mysqli_query($koneksi, $confirm);

    $_SESSION['info'] = 'Konfirmasi';
    header("Location: pinjaman_admin.php");
}

if (isset($_POST['tolak'])) {
    $id = $_POST['id_pinjam'];

    $select = "UPDATE tbl_pinjam SET status = 'tolak' WHERE id_pinjam = '$id'";
    $result = mysqli_query($koneksi, $select);

    $_SESSION['info'] = 'Tolak';
    header("Location: pinjaman_admin.php");
}

if (isset($_POST['selesai'])) {
    $id = $_POST['id_pinjam'];

    $select = "UPDATE tbl_pinjam SET status = 'selesai' WHERE id_pinjam = '$id'";
    $result = mysqli_query($koneksi, $select);

    $_SESSION['info'] = 'Selesai';
    header("Location: pinjaman_admin.php");
}

if (isset($_POST['bpinjamadmin'])) {

    $id = $_POST['nama'];
    $jumlah = $_POST['jumlah'];
    $tgl_pinjam = $_POST['tgl_pinjam'];

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_pinjam VALUES (NULL, '$id', '$jumlah', '$tgl_pinjam', 'pending');");
    if ($sql == true) {

        $_SESSION['info'] = 'Disimpan';
        header("Location: pinjaman_admin.php");
    } else {
        $_SESSION['info'] = 'Gagal';
        header("Location: pinjaman_admin.php");
    }
}

if (isset($_POST['bpinjamuser'])) {

    $id = $_SESSION['id_user'];
    $jumlah = $_POST['jumlah'];
    $tgl_pinjam = $_POST['tgl_pinjam'];

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_pinjam VALUES (NULL, '$id', '$jumlah', '$tgl_pinjam', 'pending');");
    if ($sql == true) {

        $_SESSION['info'] = 'Disimpan';
        header("Location: pinjaman_user.php");
    } else {
        $_SESSION['info'] = 'Gagal';
        header("Location: pinjaman_user.php");
    }
}

if (isset($_GET['id_pinjam'])) {
    $id = $_GET['id_pinjam'];
    $sql = mysqli_query($koneksi, "DELETE FROM tbl_pinjam WHERE id_pinjam= '$id'");

    header("Location: pinjaman_admin.php");
}
