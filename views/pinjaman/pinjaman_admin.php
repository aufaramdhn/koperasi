<?php
$active = "pinjaman";
$title = "Pinjaman | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");
$expires = date("2022-10-30 12:42:00");

$id_pinjaman = $_SESSION['id_user'];

$queryPinjaman = mysqli_query($koneksi, "SELECT id_user, nama, SUM(jumlah_pinjam) AS total_pinjam FROM tbl_pinjam LEFT JOIN tbl_user USING(id_user) GROUP BY id_user");
$pinjamanArray = mysqli_fetch_array($queryPinjaman);
?>

<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header p-4 d-flex justify-content-between align-items-center" style="background-color: #fff;">
            <span class="fs-2 fw-bold">
                Pinjaman
            </span>
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered d-md-block d-lg-table overflow-sm-auto">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Pinjaman</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($queryPinjaman as $pinjam) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $pinjam['nama'] ?></td>
                            <td class="text-center">Rp. <?= number_format($pinjam['total_pinjam'], '0', '.', '.') ?></td>
                            <td class="text-center">
                                <a class="fw-bold text-uppercase" href="detail_pinjaman.php?id_user=<?= $pinjam['id_user'] ?>">Lihat Selengkapnya</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include "../../layout/footer.php" ?>