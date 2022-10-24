<?php
include "../layout/header.php";
include "../koneksi.php";

$id_simpanan = $_SESSION['id_user'];

$tbl_simpanan_u = mysqli_query($koneksi, "SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user where tbl_simpan.id_user = $id_simpanan ");
$data_u = mysqli_fetch_array($tbl_simpanan_u);

$tbl_simpanan_a = mysqli_query($koneksi, "SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user ORDER BY tgl_simpan DESC");
$data_a = mysqli_fetch_array($tbl_simpanan_a);


?>
<div class="container-fluid pt-3">
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
        <div class="card-body px-3 pt-3">
            <?php if (isset($_POST['btambah'])) : ?>
                <form>
                    <div class="container">
                        <div class="mb-3">
                            <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama-lengkap" value="<?= $_SESSION['nama'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah-pinjaman" class="form-label">Jumlah Pinjaman</label>
                            <input type="number" min="0" max="10000000" class="form-control" id="jumlah-pinjaman">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" name="bsimpan">Pinjam</button>
                        </div>
                    </div>
                </form>
            <?php else : ?>
                <div class="d-flex justify-content-end">
                    <div>
                        <input class="form-control mb-3 d-flex justify-content-end" type="text" placeholder="Cari Disini">
                    </div>
                </div>
                <table class="table table-responsive table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Hari dan Tanggal</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($_SESSION['level'] == 'admin') : ?>
                            <?php
                            $no = 1;
                            foreach ($tbl_simpanan_a as $simpan) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $simpan['nama'] ?></td>
                                    <td><?= $simpan['jumlah_simpan'] ?></td>
                                    <td><?= $simpan['tgl_simpan'] ?></td>
                                    <td>aksi</td>
                                </tr>
                            <?php } ?>
                        <?php else : ?>
                            <?php
                            $no = 1;
                            foreach ($tbl_simpanan_u as $simpan) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $simpan['nama'] ?></td>
                                    <td><?= $simpan['jumlah_simpan'] ?></td>
                                    <td><?= $simpan['tgl_simpan'] ?></td>
                                    <td>aksi</td>
                                </tr>
                            <?php } ?>
                        <?php endif ?>
                    </tbody>
                </table>
                <nav class="mt-3 d-flex justify-content-end" aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            <?php endif ?>
        </div>
    </div>
</div>
<?php include "../layout/footer.php" ?>