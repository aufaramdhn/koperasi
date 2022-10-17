<?php

include "../koneksi.php";

$name = $_POST['nama'];
$email = $_POST['email'];
$password1 = $_POST['password'];
$created_at = $_POST['created_at'];

$result = mysqli_query($koneksi, "INSERT INTO tbl_user (nama,email,password,created_at) VALUES( '$name', '$email', '$password1', '$created_at')");
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
