<?php
$active = 'pengembalian';
$title = "Pengembalian | Koperasi";
include "../../layout/header.php";

$id = $_SESSION['id_user'];

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

$pengembalianQuery = mysqli_query($koneksi, "SELECT id_user, tbl_pinjam.id_pinjam, tgl_pinjam, nama, jumlah_pinjam, bulan, MAX(pengembalian_ke) AS sisa_tenor FROM tbl_pinjam LEFT JOIN tbl_user USING(id_user) LEFT JOIN konfirmasi_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) LEFT JOIN tbl_pengembalian ON (tbl_pengembalian.id_konfirmasi_pinjam = konfirmasi_pinjam.id_konfirmasi_pinjam) LEFT JOIN tbl_bunga ON (tbl_bunga.id_bunga = tbl_pinjam.id_bunga) WHERE tbl_user.id_user = '$id' GROUP BY tbl_pinjam.id_pinjam");

?>
<div class="pt-3 container-fluid">
    <div class="card">
        <div class="p-4 card-header d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Pengembalian
            </span>
        </div>
        <div class="card-body">
            <table id="example" class="table overflow-auto table-sm table-striped table-bordered d-md-block d-lg-table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jumlah Pinjaman</th>
                        <th scope="col">Tenor Bulan</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Sisa Tenor</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    // if (mysqli_num_rows($cek) > 1) :
                    foreach ($pengembalianQuery as $kembali) :
                        $sisa_tenor = $kembali['bulan'] - $kembali['sisa_tenor'];
                    ?>
                        <tr>
                            <td class="text-end"><?= $no++ ?></td>
                            <td><?= $kembali['nama'] ?></td>
                            <td class="text-center">Rp. <?= number_format($kembali['jumlah_pinjam'], '0', '.', '.') ?></td>
                            <td class="text-center"><?= $kembali['bulan'] ?> Bulan</td>
                            <td class="text-center"><?= $kembali['tgl_pinjam'] ?></td>
                            <?php if ($sisa_tenor == 0) { ?>
                                <td class="text-center">
                                    <span class="px-2 border rounded text-uppercase fw-bold border-success text-success fs-6">Lunas</span>
                                </td>
                            <?php } else { ?>
                                <td class="text-center"><?= $kembali['bulan'] - $kembali['sisa_tenor'] ?> Bulan</td>
                            <?php } ?>
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