<?php
include '../componen/config.php';

$id_method = $_POST['id_method'];

$query = $config->query("SELECT * FROM method where id_method = '$id_method'");
$data = array();
while ($row = mysqli_fetch_array($query)) {
    $data['payment'] = $row['payment'];
    $data['fee'] = $row['fee'];
    $data['rek'] = $row['rek'];
}
echo json_encode($data);
