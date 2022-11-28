<?php
$active = 'pengembalian';
include ".././layout/header.php";


date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

$confirmQuery = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pinjam JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) JOIN tbl_pengembalian ON (konfirmasi_pinjam.id_konfirmasi_pinjam = tbl_pengembalian.id_konfirmasi_pinjam) WHERE tbl_pinjam.id_user = '$_GET[id_user]'");

?>
<div class="container-fluid pt-3">
    <div class="card">
        <div class="card-header p-4 d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Pengembalian
            </span>
            <a href="pengembalian_admin.php" class="btn btn-danger">Kembali</a>
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered  d-md-block d-lg-table overflow-auto">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Pengembalian Ke</th>
                        <th scope="col">Tempo Bulan</th>
                        <th scope="col">Tanggal Pengembalian</th>
                        <th scope="col">Status</th>
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
                            <td class="text-center"><?= $kembali['pengembalian_ke'] ?></td>
                            <td class="text-center"><?= $kembali['id_bunga'] ?> Bulan</td>
                            <td class="text-center"><?= $kembali['tgl_pengembalian'] ?></td>
                            <td class="text-center">
                                <?php if ($kembali['status_pengembalian'] == "pengembalian") : ?>
                                    <form action="pengembalian_proses.php" method="POST">
                                        <input type="hidden" name="id_pinjam" value="<?= $kembali['id_pinjam'] ?>">
                                        <input type="hidden" name="id_pengembalian" value="<?= $kembali['id_pengembalian'] ?>">
                                        <input class="btn btn-sm btn-success" type="submit" name="konfirmasi" value="Konfirmasi">
                                        <input class="btn btn-sm btn-danger" type="submit" name="tolak" value="Tolak">
                                    </form>
                                <?php elseif ($kembali['status_pengembalian'] == "konfirmasi") : ?>
                                    <span class="border text-uppercase fw-bold border-2 border-success rounded text-success px-2 fs-6">Lunas</span>
                                <?php endif  ?>
                            </td>
                            <td class="text-center">
                                -
                            </td>
                            <!-- <td class="text-center">
                                <a button class="btn btn-sm btn-success" href="https://api.whatsapp.com/send?phone="><i class='bx bxl-whatsapp'></i></a>
                                <a button class="btn btn-delete btn-sm btn-danger" href="pengembalian_proses.php?id_pengembalian=<?= $kembali['id_pengembalian'] ?>"><i class='bx bx-trash'></i></a>
                            </td> -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include "../../layout/footer.php" ?>