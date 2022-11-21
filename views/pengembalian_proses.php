<?php

session_start();

require("../apps/koneksi.php");

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

if (isset($_GET['id_pengembalian'])) {
    $id = $_GET['id_pengembalian'];
    $sql = mysqli_query($koneksi, "DELETE FROM tbl_pengembalian WHERE id_pengembalian= '$id'");

    header("Location: pengembalian_admin.php");
}


if (isset($_POST['bpengembalian'])) {
    $id = $_POST['id_pinjam'];
    $id_konfirmasi = $_POST['id_konfirmasi_pinjam'];
    $jumlah = $_POST['jumlah'];

    if (isset($_POST['denda'])) {
        $id = $_POST['id_pinjam'];
        $id_konfirmasi = $_POST['id_konfirmasi_pinjam'];
        $jumlah = $_POST['jumlah'];
        $denda = $_POST['denda'];

        $total = $jumlah + $denda;

        $select = "UPDATE tbl_pinjam SET status_pinjam = 'pengembalian' WHERE id_pinjam = '$id'";
        $result = mysqli_query($koneksi, $select);

        $sql = mysqli_query($koneksi, "INSERT INTO tbl_pengembalian VALUES (NULL, '$id_konfirmasi', '$total', '$today');");
        if ($sql == true) {
            $_SESSION['info'] = 'Disimpan';
            echo "<script>window.location=' pinjaman_user.php'</script>";
        } else {
            $_SESSION['info'] = 'Gagal';
            echo "<script>window.location=' pinjaman_user.php'</script>";
        }
    }

    $select = "UPDATE tbl_pinjam SET status_pinjam = 'pengembalian' WHERE id_pinjam = '$id'";
    $result = mysqli_query($koneksi, $select);

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_pengembalian VALUES (NULL, '$id_konfirmasi', '$jumlah', '$today');");
    if ($sql == true) {
        $_SESSION['info'] = 'Disimpan';
        echo "<script>window.location=' pinjaman_user.php'</script>";
    } else {
        $_SESSION['info'] = 'Gagal';
        echo "<script>window.location=' pinjaman_user.php'</script>";
    }
}

if (isset($_POST['konfirmasi'])) {
    $id = $_POST['id_pinjam'];
    $konfirmasi = "UPDATE konfirmasi_pinjam SET tgl_konfirmasi = '$today' WHERE id_pinjam = '$id'";
    $result_select = mysqli_query($koneksi, $konfirmasi);
    $select = "UPDATE tbl_pinjam SET status_pinjam = 'konfirmasi' WHERE id_pinjam = '$id'";
    $result_select = mysqli_query($koneksi, $select);
    $_SESSION['info'] = 'Konfirmasi';
    header("Location: pinjaman_admin.php");
}
