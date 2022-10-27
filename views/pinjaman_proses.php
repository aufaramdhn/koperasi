<?php

if (isset($_POST['konfirmasi'])) {
    $id = $_POST['id_user'];

    $select = "UPDATE tbl_pinjam SET status = 'konfirmasi' WHERE id_user = '$id'";
    $result = mysqli_query($koneksi, $select);

    echo '<script type = "text/javascript">';
    echo 'alert("Pesanan Telah Di Konfirmasi");';
    echo 'window.location.href = "index.php"';
    echo '</script>';
}

if (isset($_POST['tolak'])) {
    $id = $_POST['id_user'];

    $select = "UPDATE tbl_pinjam SET status = 'tolak' WHERE id_user = '$id'";
    $result = mysqli_query($koneksi, $select);

    echo '<script type = "text/javascript">';
    echo 'alert("Pesanan Di Tolak");';
    echo 'window.location.href = "index.php"';
    echo '</script>';
}

if (isset($_POST['selesai'])) {
    $id = $_POST['id_user'];

    $select = "UPDATE tbl_pinjam SET status = 'selesai' WHERE id_user = '$id'";
    $result = mysqli_query($koneksi, $select);

    echo '<script type = "text/javascript">';
    echo 'alert("Pesanan Sudah Selesai");';
    echo 'window.location.href = "index.php"';
    echo '</script>';
}
