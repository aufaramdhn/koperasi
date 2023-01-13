<?php
$active = 'pengembalian';
$title = "Pengembalian | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

$confirmQuery = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pinjam JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) JOIN tbl_pengembalian ON (konfirmasi_pinjam.id_konfirmasi_pinjam = tbl_pengembalian.id_konfirmasi_pinjam) JOIN tbl_bunga ON (tbl_bunga.id_bunga = tbl_pinjam.id_bunga) WHERE tbl_pinjam.id_pinjam = '$_GET[id_pinjam]'");

?>
<div class="pt-3 container-fluid">
    <div class="card">
        <div class="p-4 card-header d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Pengembalian
            </span>
            <a href="pengembalian_admin.php" class="btn btn-danger">Kembali</a>
        </div>
        <div class="card-body">
            <table id="example" class="table overflow-auto table-striped table-bordered d-md-block d-lg-table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Pengembalian Ke</th>
                        <th scope="col">Tanggal Pengembalian</th>
                        <th scope="col">Bukti</th>
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
                            <td class="text-center">Rp. <?= number_format($kembali['jumlah_pengembalian'], '0', '.', '.') ?></td>
                            <td class="text-center"><?= $kembali['pengembalian_ke'] ?></td>
                            <td class="text-center"><?= $kembali['tgl_pengembalian'] ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#bimg<?= $no ?>">
                                    <i class='bx bx-show'></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <?php if ($kembali['status_pengembalian'] == "pending") : ?>
                                    <form action="pengembalian_proses.php" method="POST">
                                        <input type="hidden" name="id_pinjam" value="<?= $kembali['id_pinjam'] ?>">
                                        <input type="hidden" name="id_pengembalian" value="<?= $kembali['id_pengembalian'] ?>">
                                        <input class="btn btn-sm btn-success" type="submit" name="konfirmasi" value="Konfirmasi">
                                        <input class="btn btn-sm btn-danger" type="submit" name="tolak" value="Tolak">
                                    </form>
                                <?php elseif ($kembali['status_pengembalian'] == "konfirmasi") : ?>
                                    <span class="px-2 border rounded text-uppercase fw-bold border-success text-success fs-6">Lunas</span>
                                <?php endif  ?>
                            </td>
                            <td class="text-center">
                                <a button class="btn btn-sm btn-success" href="https://api.whatsapp.com/send?phone="><i class='bx bxl-whatsapp'></i></a>
                                <a button class="btn btn-delete btn-sm btn-danger" href="pengembalian_proses.php?id_pengembalian=<?= $kembali['id_pengembalian'] ?>"><i class='bx bx-trash'></i></a>
                            </td>
                        </tr>

                        <div class="modal fade" id="bimg<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="../../assets/bukti_pengembalian/<?= $kembali['bukti_pengembalian'] ?>" alt="">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include "../../layout/footer.php" ?>