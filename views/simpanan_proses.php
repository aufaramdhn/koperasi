<?php

require("../koneksi.php");

if (isset($_POST['bhapus'])) {
    $id = $_POST['id_simpan'];
    $sql = mysqli_query($koneksi, "DELETE FROM tbl_simpan WHERE id_simpan= '$id'");


    if ($sql) {
        echo '<script type="text/javascript">$(document).ready(function(){swal({position: "top-end",type: "success",title: "Your work has been saved",showConfirmButton: false,timer: 1500})});</script>';
        echo "<script>window.location='simpanan.php'</script>";
    } else {
        echo "<script>alert('Gagal');</script>";
        // echo "<script>window.location='index.php'</script>";
    }
}

echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
