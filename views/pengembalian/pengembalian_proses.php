<?php

session_start();

require("../../apps/koneksi.php");

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

if (isset($_GET['id_pengembalian'])) {
    $id = $_GET['id_pengembalian'];
    $sql = mysqli_query($koneksi, "DELETE FROM tbl_pengembalian WHERE id_pengembalian= '$id'");

    header("Location: pengembalian_admin.php");
}

if (isset($_POST['bpengembalian'])) {

    if (isset($_POST['denda'])) {
        $id = $_POST['id_pinjam'];
        $id_konfirmasi = $_POST['id_konfirmasi_pinjam'];
        $jumlah = $_POST['jumlah'];
        $denda = $_POST['denda'];
        $pengembalian_ke = $_POST['pengembalian_ke'];

        $total = $jumlah + $denda;

        $select = "UPDATE tbl_pinjam SET status_pinjam = 'pengembalian' WHERE id_pinjam = '$id'";
        $result = mysqli_query($koneksi, $select);

        $sql = mysqli_query($koneksi, "INSERT INTO tbl_pengembalian VALUES (NULL, '$id_konfirmasi', '$total', '$pengembalian_ke', '$today', 'pending');");
        if ($sql == true) {
            $_SESSION['info'] = 'Disimpan';
            header("Location: ../pinjaman/pinjaman_user.php");
        } else {
            $_SESSION['info'] = 'Gagal';
            header("Location: ../pinjaman/pinjaman_user.php");
        }
    } else {
        $id = $_POST['id_pinjam'];
        $id_konfirmasi = $_POST['id_konfirmasi_pinjam'];
        $jumlah = $_POST['jumlah'];
        $pengembalian_ke = $_POST['pengembalian_ke'];

        $select = "UPDATE tbl_pinjam SET status_pinjam = 'pengembalian' WHERE id_pinjam = '$id'";
        $result = mysqli_query($koneksi, $select);

        $sql = mysqli_query($koneksi, "INSERT INTO tbl_pengembalian VALUES (NULL, '$id_konfirmasi', '$jumlah', '$pengembalian_ke', '$today', 'pending');");
        if ($sql == true) {
            $_SESSION['info'] = 'Disimpan';
            header("Location: ../pinjaman/pinjaman_user.php");
        } else {
            $_SESSION['info'] = 'Gagal';
            header("Location: ../pinjaman/pinjaman_user.php");
        }
    }
}

if (isset($_POST['konfirmasi'])) {
    $id = $_POST['id_pinjam'];
    $konfirmasi = "UPDATE konfirmasi_pinjam SET tgl_konfirmasi = '$today' WHERE id_pinjam = '$id'";
    $result_select = mysqli_query($koneksi, $konfirmasi);
    $select_pinjam = "UPDATE tbl_pinjam SET status_pinjam = 'konfirmasi' WHERE id_pinjam = '$id'";
    $select_pengembalian = "UPDATE tbl_pengembalian SET status_pengembalian = 'konfirmasi' WHERE id_pengembalian = '$_POST[id_pengembalian]'";
    $result_select = mysqli_query($koneksi, $select_pinjam);
    $result_select = mysqli_query($koneksi, $select_pengembalian);
    $_SESSION['info'] = 'Konfirmasi';
    header("Location: ../pengembalian/pengembalian_admin.php");
}
