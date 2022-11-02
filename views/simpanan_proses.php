<?php

session_start();

require("../koneksi.php");

if (isset($_GET['id_simpan'])) {
    $id = $_GET['id_simpan'];
    $sql = mysqli_query($koneksi, "DELETE FROM tbl_simpan WHERE id_simpan= '$id'");

    header("Location: simpanan_admin.php");
}

if (isset($_POST['bsimpanadmin'])) {

    $id = $_POST['nama'];
    $jumlah = $_POST['jumlah'];

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_simpan VALUES (NULL, '$id', '$jumlah', current_timestamp());");
    if ($sql == true) {
        $_SESSION['info'] = 'Disimpan';
        echo "<script>window.location=' simpanan_admin.php'</script>";
    } else {
        $_SESSION['info'] = 'Gagal';
        echo "<script>window.location=' simpanan_admin.php'</script>";
    }
}

if (isset($_POST['bUser'])) {

    $id = $_SESSION['id_user'];
    $jumlah = $_POST['jumlah'];

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_simpan VALUES (NULL, '$id', '$jumlah', current_timestamp());");
    if ($sql == true) {
        $_SESSION['info'] = 'Disimpan';
        echo "<script>window.location=' simpanan_user.php'</script>";
    } else {
        $_SESSION['info'] = 'Gagal';
        echo "<script>window.location=' simpanan_user.php'</script>";
    }
}
