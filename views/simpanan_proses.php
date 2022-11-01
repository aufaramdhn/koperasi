<?php

require("../koneksi.php");

if (isset($_GET['id_simpan'])) {
    $id = $_GET['id_simpan'];
    $sql = mysqli_query($koneksi, "DELETE FROM tbl_simpan WHERE id_simpan= '$id'");

    if ($sql) {
        echo "<script>alert('Data Anda Telah Berhasil Di Tambahkan, dan akan di konfirmasi oleh admin');</script>";
        header("Location: simpanan.php");
    } else {
        echo "<script>alert('Data Anda Telah Berhasil Di Tambahkan, dan akan di konfirmasi oleh admin');</script>";
        header("Location: simpanan.php");
    }
}
