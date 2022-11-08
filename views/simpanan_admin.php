<?php
$active = 'simpanan';
include "../layout/header.php";
include "../koneksi.php";


$id_simpanan = $_SESSION['id_user'];

$tbl_simpanan_a = mysqli_query($koneksi, "SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user ORDER BY tgl_simpan DESC");
$data_a = mysqli_fetch_array($tbl_simpanan_a);

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
                <form action="simpanan_proses.php" method="POST">
                    <div class="container">
                        <div class="mb-3">
                            <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                            <select type="text" class="form-select" id="nama-lengkap" name="nama">
                                <?php $query = mysqli_query($koneksi, "SELECT * FROM tbl_user");
                                while ($data = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?= $data['id_user'] ?>"><?= $data['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah-pinjaman" class="form-label">Jumlah Sinjaman</label>
                            <input type="number" min="0" max="10000000" class="form-control" name="jumlah" id="jumlah-pinjaman">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" name="bsimpanadmin">Sinjam</button>
                        </div>
                    </div>
                </form>
            <?php else : ?>
                <table id="example" class="table table-responsive table-bordered table-striped d-md-block d-lg-table overflow-auto">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th class="text-center" scope="col">Nama</th>
                            <th class="text-center" scope="col">Jumlah</th>
                            <th class="text-center" scope="col">Hari dan Tanggal</th>
                            <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($tbl_simpanan_a as $simpan) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $simpan['nama'] ?></td>
                                <td class="text-center">Rp. <?= number_format($simpan['jumlah_simpan'], '0', '.', '.') ?></td>
                                <td class="text-center"><?= $simpan['tgl_simpan'] ?></td>
                                <td class="text-center">
                                    <a button class="btn btn-sm btn-success me-1" href="https://api.whatsapp.com/send?phone="><i class='bx bxl-whatsapp'></i></a>
                                    <a button class="btn btn-delete btn-sm btn-danger" href="simpanan_proses.php?id_simpan=<?= $simpan['id_simpan'] ?>"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
    </div>
</div>
<?php include "../layout/footer.php" ?>