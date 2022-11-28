<?php
include '../apps/koneksi.php';

$id_user = $_POST['nama'];

$query = $koneksi->query("SELECT * FROM tbl_simpan join tbl_user on tbl_user.id_user = tbl_simpan.id_user where tbl_simpan.id_user = '$id_user'");
$data = array();
while ($row = mysqli_fetch_array($query)) {
    $data['jumlah_simpan'] = $row['jumlah_simpan'];
}
echo json_encode($data);
