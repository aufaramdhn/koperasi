<?php
$active = "tarik_simpanan";
$title = "Simpanan | Koperasi";
include "../../layout/header.php";


$id_user = $_GET['id_user'];

$tbl_simpanan_a = mysqli_query($koneksi, "SELECT id_ambil_simpan, nama, jumlah_ambil, status_ambil, DATE_FORMAT(tgl_ambil, '%d %M %Y - %H:%i:%s') as tgl FROM tbl_ambil_simpan JOIN tbl_user ON tbl_user.id_user = tbl_ambil_simpan.id_user WHERE tbl_ambil_simpan.id_user = '$id_user'");
$data_a = mysqli_fetch_array($tbl_simpanan_a);

?>

<div class="py-3 container-fluid">
    <div class="shadow card">
        <div class="p-4 card-header d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Simpanan
            </span>
            <a href="simpanan_admin.php" class="btn btn-danger">Kembali</a>
        </div>
        <div class="card-body">
            <div class="overflow-x-scroll table-responsive">
                <table id="example" class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th class="text-center" scope="col">Nama</th>
                            <th class="text-center" scope="col">Jumlah</th>
                            <th class="text-center" scope="col">Tanggal Simpan</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($tbl_simpanan_a as $simpan) {
                            $total = 0;
                            $total += $simpan['jumlah_ambil'];
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $simpan['nama'] ?></td>
                                <td class="text-center">Rp. <?= number_format($total, '0', '.', '.') ?></td>
                                <td class="text-center"><?= $simpan['tgl'] ?></td>
                                <td class="text-center">
                                    <?php if ($simpan['status_ambil'] == 'konfirmasi') { ?>
                                        <span class="px-2 border rounded text-uppercase fw-bold border-success text-success fs-6">Konfirmasi</span>
                                    <?php } else if ($simpan['status_ambil'] == 'tolak') { ?>
                                        <span class="px-2 border rounded text-uppercase fw-bold border-danger text-danger fs-6">Tolak</span>
                                    <?php } else if ($simpan['status_ambil'] == 'pending') { ?>
                                        <form action="simpanan_proses.php" method="POST">
                                            <input type="hidden" name="id_ambil" value="<?= $simpan['id_ambil_simpan'] ?>">
                                            <input class="btn btn-sm btn-success" type="submit" name="konfirmasi_tarik" value="Konfirmasi">
                                            <input class="btn btn-sm btn-danger" type="submit" name="tolak_tarik" value="Tolak">
                                        </form>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <a button class="btn btn-sm btn-success me-1" href="https://api.whatsapp.com/send?phone="><i class='bx bxl-whatsapp'></i></a>
                                    <a button class="btn btn-delete btn-sm btn-danger" href="simpanan_proses.php?id_simpan=<?= $simpan['id_ambil_simpan'] ?>"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include "../../layout/footer.php" ?>