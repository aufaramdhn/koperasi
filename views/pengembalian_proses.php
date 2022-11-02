<?php

require("../koneksi.php");

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

if (isset($_GET['id_pengembalian'])) {
    $id = $_GET['id_pengembalian'];
    $sql = mysqli_query($koneksi, "DELETE FROM tbl_pengembalian WHERE id_pengembalian= '$id'");

    header("Location: pengembalian_admin.php");
}


if (isset($_POST['bpengembalian'])) {

    $id_konfirmasi = $_POST['id_konfirmasi_pinjam'];
    $jumlah = $_POST['jumlah'];
    $denda = $_POST['denda'];

    $total = $jumlah + $denda;

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_pengembalian VALUES (NULL, '$id_konfirmasi', '$total', '$today');");
    if ($sql == true) {
        echo "<script>alert('Data Anda Telah Berhasil Di Tambahkan, dan akan di konfirmasi oleh admin');</script>";
        echo "<script>window.location=' pengembalian_user.php'</script>";
    } else {
        echo "<script>alert('Data Anda Gagal Ditambahkan');</script>";
        echo "<script>window.location=' pengembalian_user.php'</script>";
    }
}
