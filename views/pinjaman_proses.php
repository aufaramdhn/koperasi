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

    $confirm = "INSERT INTO konfirmasi_pinjam VALUES ('','$id','$today','$expired   ')";
    $result_confirm = mysqli_query($koneksi, $confirm);

    echo '<script type = "text/javascript">';
    echo 'alert("Pesanan Telah Di Konfirmasi");';
    echo 'window.location.href = "pinjaman.php"';
    echo '</script>';
}

if (isset($_POST['tolak'])) {
    $id = $_POST['id_pinjam'];

    $select = "UPDATE tbl_pinjam SET status = 'tolak' WHERE id_pinjam = '$id'";
    $result = mysqli_query($koneksi, $select);

    echo '<script type = "text/javascript">';
    echo 'alert("Pesanan Di Tolak");';
    echo 'window.location.href = "pinjaman.php"';
    echo '</script>';
}

if (isset($_POST['selesai'])) {
    $id = $_POST['id_pinjam'];

    $select = "UPDATE tbl_pinjam SET status = 'selesai' WHERE id_pinjam = '$id'";
    $result = mysqli_query($koneksi, $select);

    echo '<script type = "text/javascript">';
    echo 'alert("Pesanan Sudah Selesai");';
    echo 'window.location.href = "pinjaman.php"';
    echo '</script>';
}

if (isset($_POST['bpinjam'])) {

    $id = $_SESSION['id_user'];
    $jumlah = $_POST['jumlah'];
    $tgl_pinjam = $_POST['tgl_pinjam'];

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_pinjam VALUES (NULL, '$id', '$jumlah', '$tgl_pinjam', 'pending');");
    if ($sql == true) {
        echo "<script>alert('Data Anda Telah Berhasil Di Tambahkan, dan akan di konfirmasi oleh admin');</script>";
        echo "<script>window.location=' pinjaman.php'</script>";
    } else {
        echo "<script>alert('Data Anda Gagal Ditambahkan');</script>";
        echo "<script>window.location=' pinjaman.php'</script>";
    }
}