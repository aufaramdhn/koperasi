<?php
include "../layout/header.php";

date_default_timezone_set('Asia/jakarta');


$id = $_GET['id_pinjam'];

$confirmQuery = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pinjam JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) WHERE tbl_pinjam.id_pinjam=$id");
$confirmArray = mysqli_fetch_array($confirmQuery);

$today = date("Y-m-d H:i:s");
$expires = strtotime('+30 days', strtotime($confirmArray['tgl_konfirmasi']));
$expired = date('Y-m-d H:i:s', $expires);

$today1 = date("Y-m-d H:i:s");
$expires1 = strtotime('+7 days', strtotime($today));
$expired1 = date('Y-m-d H:i:s', $expires1);

$today2 = date("Y-m-d H:i:s");
$expires2 = strtotime('+14 days', strtotime($today2));
$expired2 = date('Y-m-d H:i:s', $expires2);

$today3 = date("Y-m-d H:i:s");
$expires3 = strtotime('+21 days', strtotime($today3));
$expired3 = date('Y-m-d H:i:s', $expires3);

$total_bayar = $confirmArray['jumlah_pinjam'] / $confirmArray['id_bunga'];

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
                        <input type="hidden" name="id_pinjam" value="<?= $confirmArray['id_pinjam'] ?>">
                        <input type="hidden" name="pengembalian" value="pengembaiian">
                        <input type="hidden" class="form-control" name="id_konfirmasi_pinjam" value="<?= $confirmArray['id_konfirmasi_pinjam'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah-pinjaman" class="form-label">Jumlah Pengembalian</label>
                        <input type="number" class="form-control" id="jumlah-pinjaman" name="jumlah" value="<?= round($total_bayar) ?>" readonly>
                    </div>
                    <?php if ($expired1  >= $expired) : ?>
                        <div class="mb-3">
                            <label for="jumlah-denda" class="form-label">Denda</label>
                            <input type="number" class="form-control" id="jumlah-denda" name="denda" value="20000" readonly>
                        </div>
                    <?php elseif ($expired2  >= $expired) : ?>
                        <div class="mb-3">
                            <label for="jumlah-denda" class="form-label">Denda</label>
                            <input type="number" class="form-control" id="jumlah-denda" name="denda" value="50000" readonly>
                        </div>
                    <?php elseif ($expired3  >= $expired) : ?>
                        <div class="mb-3">
                            <label for="jumlah-denda" class="form-label">Denda</label>
                            <input type="number" class="form-control" id="jumlah-denda" name="denda" value="100000" readonly>
                        </div>
                    <?php endif ?>
                    <div class="mb-3">
                        <label for="tanggal-bayar" class="form-label">Tanggal Bayar</label>
                        <input type="datetime" class="form-control" id="tanggal-bayar" name="tanggal_bayar" value="<?= $today ?>" readonly>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" name="bpengembalian">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "../layout/footer.php" ?>