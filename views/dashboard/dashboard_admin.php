<?php
$active = "dashboard";
$title = "Dashboard | Koperasi";
include "../../layout/header.php";

// Session ID
$id = $_SESSION['id_user'];

// Saldo Pinjaman
$saldo_pinjaman_a = mysqli_query($koneksi, "SELECT jumlah_pinjam FROM tbl_pinjam JOIN tbl_user ON tbl_user.id_user = tbl_pinjam.id_user");
// Akhir Saldo Pinjaman

// Saldo Simpanan
$saldo_simpanan_a = mysqli_query($koneksi, "SELECT jumlah_simpan FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user");
// Akhir Saldo Simpanan

// Bulan
$queryBulan = mysqli_query($koneksi, "SELECT * FROM tbl_bunga");

// Metode pembayaran
$queryPembayaran = mysqli_query($koneksi, "SELECT * FROM tbl_pembayaran");

$user = mysqli_num_rows($koneksi->query("SELECT nama FROM tbl_user"));

?>

<div class="pt-5 container-fluid">
    <div class="d-flex">
        <div class="col-md-4">
            <div class="text-white card bg-danger" style="width: 18rem;">
                <div class="card-body row d-flex align-items-center">
                    <div class="text-center col-2">
                        <i class='bx bx-credit-card fs-1'></i>
                    </div>
                    <div class="col-10 d-flex flex-column align-items-end">
                        <h5 class="card-title fw-bold">User</h5>
                        <span class="fw-bold"><?= $user ?></span>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="text-decoration-none text-light fw-bold fs-6" href="../user/index.php">View detail </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-sm-2">
            <div class="text-white card bg-success" style="width: 18rem;">
                <div class="card-body row d-flex align-items-center">
                    <div class="text-center col-2">
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
        <div class="col-md-4 mb-sm-2">
            <div class="text-white card bg-warning" style="width: 18rem;">
                <div class="card-body row d-flex align-items-center">
                    <div class="text-center col-2">
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
    </div>
    <div class="row">
        <div class="col-12">
            <?php include "../../components/chart.php" ?>
        </div>
        <div class="mb-3 col-12">
            <div class="shadow-sm card">
                <div class="card-header">
                    <div class="p-2 d-flex justify-content-between">
                        <h4>Metode Pembayaran</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPembayaran">
                            Tambah
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="pembayaran" class="table table-sm table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 4%;" scope="col">No</th>
                                <th class="text-center" scope="col">No Payment</th>
                                <th class="text-center" scope="col">Metode Payment</th>
                                <th class="text-center" style="width: 10%;" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($queryPembayaran as $pembayaran) { ?>
                                <tr>
                                    <td class="text-end"><?= $no++ ?></td>
                                    <td class="text-center"><?= $pembayaran['no_pembayaran'] ?></td>
                                    <td class="text-center"><?= $pembayaran['method_pembayaran'] ?></td>
                                    <td class="text-center">
                                        <a button class="text-white btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalEditPembayaran<?= $no ?>"><i class='bx bx-edit'></i></a>
                                        <a button class="btn btn-delete btn-sm btn-danger" href="dashboard_proses.php?id_pembayaran=<?= $pembayaran['id_pembayaran'] ?>"><i class='bx bx-trash'></i></a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modalEditPembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pembayaran</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="dashboard_proses.php" method="POST">
                                                <input type="hidden" name="id_pembayaran" value="<?= $pembayaran['id_pembayaran'] ?>">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">No Pembayaran</label>
                                                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $pembayaran['no_pembayaran'] ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Methode Pembayaran</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" value="<?= $pembayaran['method_pembyaran'] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary" name="simpan_pembayaran">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mb-5 col-12">
            <div class="shadow-sm card">
                <div class="card-header">
                    <div class="p-2 d-flex justify-content-between">
                        <h4>Tenor Bulan</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBunga">
                            Tambah
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="bulan" class="table table-sm table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 4%;" scope="col">No</th>
                                <th class="text-center" scope="col">Bunga</th>
                                <th class="text-center" scope="col">Jumlah Bulan</th>
                                <th class="text-center" style="width: 10%;" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($queryBulan as $bulan) { ?>
                                <tr>
                                    <td class="text-end"><?= $no++ ?></td>
                                    <td class="text-center"><?= $bulan['bunga'] ?>%</td>
                                    <td class="text-center"><?= $bulan['bulan'] ?> Bulan</td>
                                    <td class="text-center">
                                        <a button class="text-white btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalEditBunga<?= $no ?>"><i class='bx bx-edit'></i></a>
                                        <a button class="btn btn-delete btn-sm btn-danger" href="dashboard_proses.php?id_bunga=<?= $bulan['id_bunga'] ?>"><i class='bx bx-trash'></i></a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modalEditBunga<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Bunga</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="dashboard_proses.php" method="POST">
                                                <input type="hidden" name="id_bunga" value="<?= $bunga['id_bunga'] ?>">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Bunga (%)</label>
                                                        <input type="number" class="form-control" name="bunga" value="<?= $bulan['bunga'] ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Bulan</label>
                                                        <input type="number" max="12" class="form-control" name="bulan" value="<?= $bulan['bulan'] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary" name="simpan_bunga">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pembayaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="dashboard_proses.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">No Pembayaran</label>
                        <input type="number" class="form-control" name="no_pembayaran">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <input type="text" class="form-control" name="metode_pembayaran">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="tambah_pembayaran">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalBunga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Tenor Bulan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="dashboard_proses.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Bunga</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bulan</label>
                        <input type="number" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="tambah_bunga">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<?php
include "../../layout/footer.php"
?>