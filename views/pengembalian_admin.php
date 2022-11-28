<?php
$active = 'pengembalian';
include "../layout/header.php";


date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

$confirmQuery = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pinjam JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) JOIN tbl_pengembalian ON (konfirmasi_pinjam.id_konfirmasi_pinjam = tbl_pengembalian.id_konfirmasi_pinjam)");

?>
<div class="container-fluid pt-3">
    <div class="card">
        <div class="card-header p-4 d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Pengembalian
            </span>
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered  d-md-block d-lg-table overflow-auto">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Tempo Bulan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($confirmQuery as $kembali) {
                    ?>
                        <tr>
                            <td class="text-end"><?= $no++ ?></td>
                            <td><?= $kembali['nama'] ?></td>
                            <td class="text-center"><?= $kembali['jumlah_pengembalian'] ?></td>
                            <td class="text-center"><?= $kembali['id_bunga'] ?> Bulan</td>
                            <td class="text-center">
                                <a href="detail_pengembalian_admin.php?id_user=<?= $kembali['id_user'] ?>">Lihat Selengkapnya</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include "../layout/footer.php" ?>