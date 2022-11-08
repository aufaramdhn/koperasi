<?php

$active = "profile";
include "../layout/header.php";

$id = $_SESSION['id_user'];
$profile = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE id_user = '$id'");
$data    = mysqli_fetch_array($profile);

?>
<div class="container-fluid py-5">
    <div class="card">
        <div class="card-header p-4 d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Profile
            </span>
        </div>
        <div class="card-body pe-5 ps-3 py-5 row">
            <?php if (isset($_POST['bedit'])) : ?>
                <form action="profile_proses.php" method="post">
                    <div class="row pe-5 ps-3 py-5">
                        <div class="d-flex justify-content-xs-center flex-column align-items-center col-3 mb-5">
                            <div class="mb-3">
                                <img src="../assets/person-circle.svg" width="200" alt="">
                            </div>
                            <div class="mb-3">
                                <input class="form-control d-none" name="img" type="file" id="img">
                                <label class="btn btn-primary" for="img">Kirim Foto</label>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="mb-3 row">
                                <label for="nama-lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama-lengkap" name="nama" value="<?= $data['nama'] ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $data['email'] ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password" value="<?= $data['password'] ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                                <div class="col-2">
                                    <input type="text" class="form-control" name="tempat" value="<?= $data['tempat_lahir'] ?>">
                                </div>
                                <div class="col-8">
                                    <input type="date" class="form-control" name="tgl" value="<?= $data['tgl_lahir'] ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jenis-kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jenis-kelamin" name="jk" value="<?= $data['jk'] ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="agama" name="agama" value="<?= $data['agama'] ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= $data['pekerjaan'] ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="no-telepon" class="col-sm-2 col-form-label">No. Telepon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no-telepon" name="telp" value="<?= $data['telp'] ?>">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" rows="3" name="alamat" id="alamat" value="<?= $data['alamat'] ?>">
                                </div>
                            </div>
                            <input type="hidden" class="form-control" rows="3" name="created" value="<?= $data['created_at'] ?>">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-danger text-white me-2" name="bkembali">Kembali</button>
                                <button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php else : ?>
                <div class="d-flex justify-content-xs-center flex-column align-items-center col-3 mb-5">
                    <div class="mb-3">
                        <img src="../assets/person-circle.svg" width="200" alt="">
                    </div>
                    <div class="mb-3">
                        <input class="form-control d-none" name="img" type="file" id="img">
                        <label class="btn btn-primary" for="img">Kirim Foto</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="mb-3 row">
                        <label for="nama-lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama-lengkap" value="<?= $data['nama'] ?>" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" value="<?= $data['email'] ?>" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" value="<?= $data['password'] ?>" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                        <div class="col-2">
                            <input type="text" class="form-control" value="<?= $data['tempat_lahir'] ?>" disabled>
                        </div>
                        <div class="col-8">
                            <input type="date" class="form-control" value="<?= $data['tgl_lahir'] ?>" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jenis-kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jenis-kelamin" value="<?= $data['jk'] ?>" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="agama" value="<?= $data['agama'] ?>" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pekerjaan" value="<?= $data['pekerjaan'] ?>" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="no-telepon" class="col-sm-2 col-form-label">No. Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no-telepon" value="<?= $data['telp'] ?>" disabled>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" rows="3" id="alamat" value="<?= $data['alamat'] ?>" disabled>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <form action="" method="post">
                            <button type="submit" class="btn btn-warning text-white" name="bedit">Edit</button>
                        </form>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<?php include "../layout/footer.php" ?>