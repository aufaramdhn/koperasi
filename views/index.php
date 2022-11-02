<!-- Header -->
<?php include "../layout/header.php"; ?>

<!-- Koneksi -->
<?php
require "../koneksi.php";

// Session ID
$id = $_SESSION['id_user'];

// Saldo Pinjaman
$saldo_pinjaman_u = mysqli_query($koneksi, "SELECT * FROM tbl_pinjam JOIN tbl_user ON tbl_user.id_user = tbl_pinjam.id_user WHERE tbl_pinjam.id_user = $id");
$saldo_pinjaman_a = mysqli_query($koneksi, "SELECT * FROM tbl_pinjam JOIN tbl_user ON tbl_user.id_user = tbl_pinjam.id_user");
// Akhir Saldo Pinjaman

// Saldo Simpanan
$saldo_simpanan_u = mysqli_query($koneksi, "SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user WHERE tbl_simpan.id_user = $id");
$saldo_simpanan_a = mysqli_query($koneksi, "SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user");
// Akhir Saldo Simpanan

?>

<!-- Alert -->
<?php if (isset($_SESSION['info'])) : ?>
    <div class="info-data" data-infodata="<?php echo $_SESSION['info']; ?>"></div>
<?php
    unset($_SESSION['info']);
endif;
?>

<div class="container pt-5">
    <?php if ($_SESSION['level'] == 'admin') : ?>
        <div class="row">
            <div class="col-md-3 mb-sm-2">
                <div class="card bg-info text-white" style="width: 18rem;">
                    <div class="card-body  row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-user fs-1'></i>
                        </div>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo</h5>
                            <span class="fw-bold">Rp.0</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../products/index.php">View detail </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-sm-2">
                <div class="card bg-success text-white" style="width: 18rem;">
                    <div class="card-body  row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-wallet fs-1'></i>
                        </div>
                        <?php
                        $total_simpanan_a = 0;
                        while ($tampil_simpanan_a = mysqli_fetch_array($saldo_simpanan_a)) {
                            $total_simpanan_a += $tampil_simpanan_a['jumlah_simpan'];
                        } ?>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo Simpanan</h5>
                            <span class="fw-bold">Rp. <?= number_format($total_simpanan_a) ?></span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../products/index.php">View detail </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-sm-2">
                <div class="card bg-warning text-white" style="width: 18rem;">
                    <div class="card-body row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-money-withdraw fs-1'></i>
                        </div>
                        <?php
                        $total_pinjaman_a = 0;
                        while ($tampil_pinjaman_a = mysqli_fetch_array($saldo_pinjaman_a)) {
                            $total_pinjaman_a += $tampil_pinjaman_a['jumlah_pinjam'];
                        } ?>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo Pinjaman</h5>
                            <span class="fw-bold">Rp. <?= number_format($total_pinjaman_a) ?> </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../orders/index.php">View detail </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white" style="width: 18rem;">
                    <div class="card-body row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-credit-card fs-1'></i>
                        </div>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">User</h5>
                            <span class="fw-bold">0</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../user/index.php">View detail </a>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="row">
            <div class="col-md-3 mb-sm-2">
                <div class="card bg-info text-white" style="width: 18rem;">
                    <div class="card-body  row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-user fs-1'></i>
                        </div>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo</h5>
                            <span class="fw-bold">Rp.0</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../products/index.php">View detail </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-sm-2">
                <div class="card bg-success text-white" style="width: 18rem;">
                    <div class="card-body  row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-wallet fs-1'></i>
                        </div>
                        <?php
                        $total_simpanan_u = 0;
                        while ($tampil_simpanan_u = mysqli_fetch_array($saldo_simpanan_u)) {
                            $total_simpanan_u += $tampil_simpanan_u['jumlah_simpan'];
                        } ?>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo Simpanan</h5>
                            <span class="fw-bold">Rp. <?= number_format($total_simpanan_u) ?></span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../products/index.php">View detail </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-sm-2">
                <div class="card bg-warning text-white" style="width: 18rem;">
                    <div class="card-body row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-money-withdraw fs-1'></i>
                        </div>
                        <?php
                        $tota_pinjaman_u = 0;
                        while ($tampil_pinjaman_u = mysqli_fetch_array($saldo_pinjaman_u)) {
                            $tota_pinjaman_u += $tampil_pinjaman_u['jumlah_pinjam'];
                        } ?>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo Pinjaman</h5>
                            <span class="fw-bold">Rp. <?= number_format($tota_pinjaman_u) ?> </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../orders/index.php">View detail </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white" style="width: 18rem;">
                    <div class="card-body row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-credit-card fs-1'></i>
                        </div>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Hutang</h5>
                            <span class="fw-bold">Rp.0</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../user/index.php">View detail </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>

<!-- Chart -->
<?php if ($_SESSION['level'] == 'admin') {
    include "../components/chart.php";
}
?>

<!-- Footer -->
<?php include "../layout/footer.php" ?>