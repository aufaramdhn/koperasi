<?php
include "../layout/header.php";

// date_default_timezone_set('Asia/jakarta');
// $today = date("Y-m-d H:i:s");
// $expires = date("2022-10-30 12:42:00");

$id_pinjaman = $_SESSION['id_user'];

$confirmQuery = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pinjam JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) WHERE tbl_user.id_user=$id_pinjaman");
$confirmArray = mysqli_fetch_array($confirmQuery);
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
            <span class="fs-2 fw-bold">
                Detail Pinjaman
            </span>
            <a class="btn btn-danger" href="pinjaman_user.php">Kembali</a>
        </div>
        <div class="card-body">
            <div class="row py-4 px-5">
                <div class="col bg-primary text-light text-center rounded-start p-3">
                    <span class="fs-4 fw-bold text-uppercase">Pinjaman</span>
                    <div class="border-bottom border-3 mt-2 mb-4"></div>
                    <div class="px-4">
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="<?= $confirmArray['nama'] ?>" readonly>
                            </div>
                        </div>
                        <div class=" mb-3 row">
                            <label class="col-sm-4 col-form-label">Jumlah</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="<?= $confirmArray['jumlah_pinjam'] ?>">
                            </div>
                        </div>
                        <div class=" mb-3 row">
                            <label class="col-sm-4 col-form-label">Tanggal Pinjam</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="<?= $confirmArray['tgl_pinjam'] ?>">
                            </div>
                        </div>
                        <div class=" mb-3 row">
                            <label class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="<?= $confirmArray['status'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col bg-info text-light text-center rounded-end p-3">
                    <span class="fs-4 fw-bold text-uppercase">Tanggal Konfirmasi</span>
                    <div class="border-bottom border-3 mt-2 mb-4"></div>
                    <div class="px-4">
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="<?= $confirmArray['nama'] ?>" readonly>
                            </div>
                        </div>
                        <div class=" mb-3 row">
                            <label class="col-sm-4 col-form-label">Jumlah</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="<?= $confirmArray['jumlah_pinjam'] ?>">
                            </div>
                        </div>
                        <div class=" mb-3 row">
                            <label class="col-sm-4 col-form-label">Tanggal Pinjam</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="<?= $confirmArray['tgl_konfirmasi'] ?>">
                            </div>
                        </div>
                        <div class=" mb-3 row">
                            <label class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="<?= $confirmArray['expired'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../layout/footer.php" ?>