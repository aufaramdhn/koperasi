<?php
$active = "pinjaman";
$title = "Pinjaman | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");
$expires = date("2022-10-30 12:42:00");

$id_user = $_GET['id_user'];

$tbl_pinjaman_a = mysqli_query($koneksi, "SELECT id_pinjam, nama, jumlah_pinjam, bulan, tgl_pinjam, status_pinjam FROM tbl_pinjam JOIN tbl_user ON (tbl_user.id_user = tbl_pinjam.id_user) JOIN tbl_bunga ON (tbl_bunga.id_bunga = tbl_pinjam.id_bunga) WHERE tbl_pinjam.id_user = '$id_user' ORDER BY tgl_pinjam DESC");
$data_a = mysqli_fetch_array($tbl_pinjaman_a);
?>

<div class="py-3 container-fluid">
    <div class="card">
        <div class="p-4 card-header d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Pinjaman
            </span>
            <a href="pinjaman_admin.php" class="btn btn-danger">Kembali</a>
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered d-md-block d-lg-table overflow-sm-auto">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Pinjaman</th>
                        <th scope="col">Tenor Bulan</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($tbl_pinjaman_a as $pinjam) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $pinjam['nama'] ?></td>
                            <td class="text-center">Rp. <?= number_format($pinjam['jumlah_pinjam'], '0', '.', '.') ?></td>
                            <td class="text-center"><?= $pinjam['bulan'] ?> Bulan</td>
                            <td class="text-center"><?= $pinjam['tgl_pinjam'] ?></td>
                            <td class="text-center">
                                <?php if ($pinjam['status_pinjam'] == 'konfirmasi') { ?>
                                    <span class="px-2 border rounded text-uppercase fw-bold border-success text-success fs-6">Konfirmasi</span>
                                <?php } else if ($pinjam['status_pinjam'] == 'pengembalian') { ?>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="me-1">
                                            <span class="px-2 border rounded text-uppercase fw-bold border-warning text-warning fs-6">pengembalian</span>
                                        </div>
                                        <form action="pinjaman_proses.php" method="POST">
                                            <input type="hidden" name="id_pinjam" value="<?= $pinjam['id_pinjam'] ?>">
                                            <input class="btn btn-sm btn-success" type="submit" name="selesai" value="selesai">
                                        </form>
                                    </div>
                                <?php } else if ($pinjam['status_pinjam'] == 'tolak') { ?>
                                    <span class="px-2 border rounded text-uppercase fw-bold border-danger text-danger fs-6">Tolak</span>
                                <?php } else if ($pinjam['status_pinjam'] == 'selesai') { ?>
                                    <span class="px-2 border rounded text-uppercase fw-bold border-success text-success fs-6">Selesai</span>
                                <?php } else if ($pinjam['status_pinjam'] == 'pending') { ?>
                                    <form action="pinjaman_proses.php" method="POST">
                                        <input type="hidden" name="id_pinjam" value="<?= $pinjam['id_pinjam'] ?>">
                                        <input type="hidden" name="id_bunga" value="<?= $pinjam['bulan'] ?>">
                                        <input class="btn btn-sm btn-success" type="submit" name="konfirmasi" value="Konfirmasi">
                                        <input class="btn btn-sm btn-danger" type="submit" name="tolak" value="Tolak">
                                    </form>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <a button class="btn btn-sm btn-success" href="https://api.whatsapp.com/send?phone="><i class='bx bxl-whatsapp'></i></a>
                                <?php
                                // if ($pinjam['tgl_konfirmasi'] >= $expired) : 
                                ?>
                                <!-- <a button class="btn btn-sm btn-success" href="https://api.whatsapp.com/send?phone="><i class='bx bxl-whatsapp'></i></a> -->
                                <?php
                                // endif 
                                ?>
                                <a button class="btn btn-delete btn-sm btn-danger" href="pinjaman_proses.php?id_pinjam=<?= $pinjam['id_pinjam'] ?>"><i class='bx bx-trash'></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include "../../layout/footer.php" ?>