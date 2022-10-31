<?php
include "../layout/header.php";
include "../koneksi.php";

$id_simpanan = $_SESSION['id_user'];

$tbl_simpanan_u = mysqli_query($koneksi, "SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user WHERE tbl_simpan.id_user = $id_simpanan ");
$data_u = mysqli_fetch_array($tbl_simpanan_u);
$cek = mysqli_num_rows($tbl_simpanan_u);

$tbl_simpanan_a = mysqli_query($koneksi, "SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user ORDER BY tgl_simpan DESC");
$data_a = mysqli_fetch_array($tbl_simpanan_a);


?>
<div class="container-fluid py-3">
    <button id="delte">
        Click Me!!?
    </button>

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
                <?php if (($data_u['tempat_lahir'] and $data_u['tgl_lahir'] and $data_u['jk'] and $data_u['agama'] and $data_u['pekerjaan'] and $data_u['alamat']) == '') : ?>
                    <span>Maaf Data Diri Anda Belum Lengkap</span>
                <?php else : ?>
                    <form method="POST">
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
                                <button type="submit" class="btn btn-primary" name="bsimpan">Sinjam</button>
                            </div>
                        </div>
                    </form>
                <?php endif ?>
            <?php else : ?>
                <table id="example" class="table table-responsive table-bordered table-striped">
                    <?php if ($_SESSION['level'] == 'admin') : ?>
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
                                        <div class="d-flex justify-content-center">
                                            <a button class="btn btn-sm btn-success me-1" href="https://api.whatsapp.com/send?phone="><i class='bx bxl-whatsapp'></i></a>
                                            <form action="simpanan_proses.php" method="POST">
                                                <input type="hidden" name="id_simpan" value="<?= $simpan['id_simpan'] ?>">
                                                <button name="bhapus" class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php else : ?>
                        <?php if ($cek > 0) : ?>
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
                        <?php else : ?>
                            <div class="text-center">
                                <span class="fw-bold text-uppercase fs-3">Maaf Anda Blm Punya Pinjaman</span>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                </table>
            <?php endif ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    function ConfirmDelete() {
        if (confirm("Delete Account?"))
            location.href = 'linktoaccountdeletion';
    }
</script>

<?php
if (isset($_POST['bsimpan'])) {

    $id = $_SESSION['id_user'];
    $jumlah = $_POST['jumlah'];

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_simpan VALUES (NULL, '$id', '$jumlah', current_timestamp());");
    if ($sql == true) {
        echo "<script>alert('Data Anda Telah Berhasil Di Tambahkan, dan akan di konfirmasi oleh admin');</script>";
        echo "<script>window.location=' simpanan.php'</script>";
    } else {
        echo "<script>alert('Data Anda Gagal Ditambahkan');</script>";
        echo "<script>window.location=' simpanan.php'</script>";
    }
}
?>
<?php include "../layout/footer.php" ?>