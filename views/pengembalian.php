<?php
include "../layout/header.php";
include "../koneksi.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

$id = $_GET['id_pinjam'];

$confirmQuery = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pinjam JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) WHERE tbl_pinjam.id_pinjam=$id");
$confirmArray = mysqli_fetch_array($confirmQuery);

?>
<div class="container-fluid pt-3">
    <div class="card">
        <div class="card-header p-4 d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Pengembalian
            </span>
            <form method="POST">
                <a type="submit" href="pinjaman_user.php" class="btn btn-danger">Kembali</a>
            </form>
        </div>
        <div class="card-body">
            <form action="pengembalian_proses.php" method="POST">
                <div class="container">
                    <div class="mb-3">
                        <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama-lengkap" value="<?= $_SESSION['nama'] ?>" disabled>
                        <input type="hidden" class="form-control" name="id_konfirmasi_pinjam" value="<?= $confirmArray['id_konfirmasi_pinjam'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah-pinjaman" class="form-label">Jumlah Pengembalian</label>
                        <input type="number" class="form-control" id="jumlah-pinjaman" name="jumlah" value="<?= $confirmArray['jumlah_pinjam'] ?>">
                    </div>
                    <?php if ($today  >= $confirmArray['expired']) : ?>
                        <div class="mb-3">
                            <label for="jumlah-denda" class="form-label">Anda Dikenakan Denda</label>
                            <input type="number" class="form-control" id="jumlah-denda" name="denda" value="200000">
                        </div>
                    <?php endif ?>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" name="bpengembalian">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "../layout/footer.php" ?>