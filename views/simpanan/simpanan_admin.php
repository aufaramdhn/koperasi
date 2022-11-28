<?php
$active = 'simpanan';
include "../../layout/header.php";


$id_simpanan = $_SESSION['id_user'];

$tbl_simpanan_a = mysqli_query($koneksi, "SELECT id_user, nama, SUM(jumlah_simpan) AS total_simpan FROM tbl_simpan LEFT JOIN tbl_user USING(id_user) GROUP BY id_user");
// $data_a = mysqli_fetch_array($tbl_simpanan_a);

?>

<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header p-4 d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Simpanan
            </span>
        </div>
        <div class="card-body">
            <table id="example" class="table table-responsive table-bordered table-striped d-md-block d-lg-table overflow-auto">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th class="text-center" scope="col">Nama</th>
                        <th class="text-center" scope="col">Jumlah</th>
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
                            <td class="text-center">Rp. <?= number_format($simpan['total_simpan'], '0', '.', '.') ?></td>
                            <td class="text-center">
                                <a class="fw-bold text-uppercase" href="detail_simpanan.php?id_user=<?= $simpan['id_user'] ?>">Lihat Selengkapnya</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include "../../layout/footer.php" ?>