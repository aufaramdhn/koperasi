<?php

session_start();

require("../../apps/koneksi.php");

if (isset($_GET['id_simpan'])) {
    $id = $_GET['id_simpan'];
    $sql = mysqli_query($koneksi, "DELETE FROM tbl_simpan WHERE id_simpan= '$id'");

    header("Location: simpanan_admin.php");
}

// if (isset($_POST['bsimpanadmin'])) {

//     $id = $_POST['nama'];
//     $jumlah = $_POST['jumlah'];

//     $sql = mysqli_query($koneksi, "INSERT INTO tbl_simpan VALUES (NULL, '$id', '$jumlah', current_timestamp(), 'pending');");
//     if ($sql == true) {
//         $_SESSION['info'] = 'Disimpan';
//         echo "<script>window.location=' simpanan_admin.php'</script>";
//     } else {
//         $_SESSION['info'] = 'Gagal';
//         echo "<script>window.location=' simpanan_admin.php'</script>";
//     }
// }

if (isset($_POST['bUser'])) {

    $id = $_SESSION['id_user'];
    $jumlah = $_POST['jumlah'];
    $folder = '../../assets/bukti/';
    $bukti = $_FILES['bukti']['name'];
    $source = $_FILES['bukti']['tmp_name'];
    $upload = move_uploaded_file($source, $folder . $bukti);

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_simpan VALUES (NULL, '$id', '$jumlah', '$bukti', current_timestamp(), 'pending');");
    if ($sql == true) {
        $_SESSION['info'] = 'Disimpan';
        header("Location: simpanan_user.php");
    } else {
        $_SESSION['info'] = 'Gagal';
        header("Location: simpanan_user.php");
    }
}

if (isset($_POST['konfirmasi'])) {
    $id = $_POST['id_simpan'];

    $select = "UPDATE tbl_simpan SET status_simpan = 'konfirmasi' WHERE id_simpan = '$id'";
    $result_select = mysqli_query($koneksi, $select);

    $_SESSION['info'] = 'Konfirmasi';
    header("Location: simpanan_admin.php");
}

if (isset($_POST['tolak'])) {
    $id = $_POST['id_simpan'];

    $select = "UPDATE tbl_simpan SET status_simpan = 'tolak' WHERE id_simpan = '$id'";
    $result = mysqli_query($koneksi, $select);

    $_SESSION['info'] = 'Tolak';
    header("Location: simpanan_admin.php");
}
