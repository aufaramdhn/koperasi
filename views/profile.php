<?php

include "../layout/header.php";
require "../koneksi.php";

$id = $_SESSION['id_user'];
$profile = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE id_user = '$id'");
$data    = mysqli_fetch_array($profile);

?>
<div class="container pt-5">
    <div class="card">
        <div class="card-header p-4 d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Pinjaman
            </span>
        </div>
        <div class="card-body p-5">
            <div class="mb-3 row">
                <label for="nama-lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama-lengkap" value="<?= $data['nama'] ?>" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" value="<?= $data['nama'] ?>" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" value="<?= $data['nama'] ?>" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                <div class="col-2">
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $data['nama'] ?>" disabled>
                </div>
                <div class="col-8">
                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $data['nama'] ?>" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jenis-kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="jenis-kelamin" value="<?= $data['nama'] ?>" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="agama" value="<?= $data['nama'] ?>" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pekerjaan" value="<?= $data['nama'] ?>" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="no-telepon" class="col-sm-2 col-form-label">No. Telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="no-telepon" value="<?= $data['nama'] ?>" disabled>
                </div>
            </div>
            <div class="mb-4 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" rows="3" id="alamat" value="<?= $data['nama'] ?>" disabled>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
</div>
<?php include "../layout/footer.php" ?>