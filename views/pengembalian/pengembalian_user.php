<?php
$active = 'pengembalian';
$title = "Pengembalian | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

$confirmQuery = mysqli_query($koneksi, "SELECT *, SUM(jumlah_pengembalian) AS total_pengembalian FROM konfirmasi_pinjam JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) JOIN tbl_pengembalian ON (konfirmasi_pinjam.id_konfirmasi_pinjam = tbl_pengembalian.id_konfirmasi_pinjam) JOIN tbl_bunga ON (tbl_bunga.id_bunga = tbl_pinjam.id_bunga) WHERE tbl_user.id_user = '$_SESSION[id_user]'");

?>
<div class="container-fluid pt-3">
    <div class="card">
        <div class="card-header p-4 d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Pengembalian
            </span>
        </div>
        <div class="card-body">
            <table id="example" class="table table-sm table-striped table-bordered d-md-block d-lg-table overflow-auto">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jumlah Pinjaman</th>
                        <th scope="col">Tempo Bulan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    // if (mysqli_num_rows($cek) > 1) :
                    foreach ($confirmQuery as $kembali) :
                    ?>
                        <tr>
                            <td class="text-end"><?= $no++ ?></td>
                            <td><?= $kembali['nama'] ?></td>
                            <td class="text-center">Rp. <?= number_format($kembali['jumlah_pinjam'], '0', '.', '.') ?></td>
                            <td class="text-center"><?= $kembali['bulan'] ?> Bulan</td>
                            <td class="text-center">
                                <a class="fw-bold text-uppercase" href="detail_pengembalian_user.php?id_pinjam=<?= $kembali['id_pinjam'] ?>">Lihat Selengkapnya</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    // endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include "../../layout/footer.php" ?>