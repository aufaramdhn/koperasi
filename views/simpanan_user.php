<?php

$active = "simpanan";
include "../layout/header.php";


$id_simpanan = $_SESSION['id_user'];

$tbl_user = $koneksi->query("SELECT * FROM tbl_user Where id_user = $id_simpanan");
$tbl_simpanan_u = $koneksi->query("SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_simpan.id_user = tbl_user.id_user Where tbl_simpan.id_user = $id_simpanan");
$data_u = mysqli_fetch_array($tbl_user);
$cek = mysqli_num_rows($tbl_simpanan_u);
?>

<!-- Alert -->
<?php if (isset($_SESSION['info'])) : ?>
    <div class="info-data" data-infodata="<?php echo $_SESSION['info']; ?>"></div>
<?php
    unset($_SESSION['info']);
endif;
?>

<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header p-4 d-flex justify-content-between align-items-center">
            <?php if (isset($_POST['btambah'])) : ?>
                <span class="fs-2 fw-bold">
                    Tambah Simpanan
                </span>
                <form method="POST">
                    <button href="" class="btn btn-danger" name="bkembali">Kembali</button>
                </form>
            <?php else : ?>
                <span class="fs-2 fw-bold">
                    Simpanan
                </span>
                <form method="POST">
                    <button href="" class="btn btn-success" name="btambah">Tambah Simpanan</button>
                </form>
            <?php endif ?>
        </div>
        <div class="card-body">
            <?php if (isset($_POST['btambah'])) : ?>
                <?php
                if (empty($data_u['tempat_lahir'])) :
                ?>
                    <div class="text-center">
                        <span class="fw-bold text-uppercase fs-3">Maaf Data Diri Anda Belum Lengkap, harap isi data diri anda <a href="profile.php">disini</a></span>
                    </div>
                <?php
                else :
                ?>
                    <form action="simpanan_proses.php" method="POST">
                        <div class="container">
                            <div class="mb-3">
                                <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama-lengkap" value="<?= $_SESSION['nama'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah-pinjaman" class="form-label">Jumlah Sinjaman</label>
                                <input type="number" min="0" max="10000000" class="form-control" name="jumlah" id="jumlah-pinjaman">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button id="btn-tambah" type="submit" class="btn btn-primary" name="bUser">Sinjam</button>
                            </div>
                        </div>
                    </form>
                <?php
                endif
                ?>
            <?php else : ?>
                <table id="example" class="table table-responsive table-bordered table-striped d-md-block d-lg-table overflow-auto">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Hari dan Tanggal</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        date_default_timezone_set('Asia/jakarta');
                        $today = date("Y-m-i H:i:s");
                        foreach ($tbl_simpanan_u as $simpan) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $simpan['nama'] ?></td>
                                <td class="text-center">Rp. <?= number_format($simpan['jumlah_simpan'], '0', '.', '.') ?></td>
                                <td class="text-center"><?= $simpan['tgl_simpan'] ?></td>
                                <td>aksi</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
    </div>
</div>
<?php include "../layout/footer.php" ?>