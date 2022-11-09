<?php
include '../apps/koneksi.php';

$id_bunga = $_POST['id_bunga'];

$query = $koneksi->query("SELECT * FROM tbl_bunga where id_bunga = '$id_bunga'");
$data = array();
while ($row = mysqli_fetch_array($query)) {
    $data['bunga'] = $row['bunga'];
    // $data['bulan'] = $row['bulan'];
}
echo json_encode($data);
