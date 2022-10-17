<?php

include "../layout/header.php";
require "../koneksi.php";

$id = $_SESSION['id_user'];
$profile = mysqli_query($koneksi, "SELECT * FROM tbl user WHERE id_user = '$id'");
$data    = mysqli_fetch_array($profile);
if (mysqli_num_rows($profile) > 0) {
    $nama = $data['nama'];
}

?>
<div class="card p-5">
    <div class="card-body">
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" value="<?= $nama ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" value="">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" value="">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" value="">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" value="">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Agama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" value="">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Pekerjaan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" value="">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">No. Telepon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" value="">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <textarea type="text" class="form-control" rows="3" id="inputPassword" value=""></textarea>
            </div>
        </div>
    </div>
</div>
<?php include "../layout/footer.php" ?>