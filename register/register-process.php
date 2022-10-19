<?php

include "../koneksi.php";

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];
$tempat_lahir = $_POST['tempat_lahir'];
$tgl_lahir = $_POST['tgl_lahir'];
$jk = $_POST['jk'];
$agama = $_POST['agama'];
$pekerjaan = $_POST['pekerjaan'];
$telp = $_POST['telp'];
$alamat = $_POST['alamat'];
$created_at = $_POST['created_at'];

$result = mysqli_query($koneksi, "INSERT INTO tbl_user VALUES( '$nama', '$email', '$password', '$tempat_lahir', '$tgl_lahir', '$jk', '$agama', '$pekerjaan', '$telp', '$alamat', '$created_at')");
if ($result > 0) {
    echo "<script>
    alert('Akun Anda Berhasil Di Buat');
</script>";
    echo "<script>
    window.location = '../index.php'
</script>";
}
// else if ($password2 != $password1) {
//     echo "Password Tidak Sama";
// } 
else {
    echo "Email Sudah Di gunakan";
}
