<?php
include "../layout/header.php";
include "../koneksi.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");
$expires = date("2022-10-30 12:42:00");

$id_pinjaman = $_SESSION['id_user'];

$tbl_pinjaman_a = mysqli_query($koneksi, "SELECT * FROM tbl_pinjam JOIN tbl_user ON tbl_user.id_user = tbl_pinjam.id_user ORDER BY tgl_pinjam DESC");
$data_a = mysqli_fetch_array($tbl_pinjaman_a);

$querySimpan = mysqli_query($koneksi, "SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user WHERE tbl_simpan.id_user = $id_pinjaman ");
$cek = mysqli_num_rows($querySimpan);

$confirmQuery = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pinjam JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) WHERE tbl_user.id_user=$_SESSION[id_user]");
$confirmArray = mysqli_fetch_array($confirmQuery);
?>

<!-- Alert -->
<?php if (isset($_SESSION['info'])) : ?>
    <div class="info-data" data-infodata="<?php echo $_SESSION['info']; ?>"></div>
<?php
    unset($_SESSION['info']);
endif;
?>

<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header p-4 d-flex justify-content-between align-items-center">
            <?php if (isset($_POST['btambah'])) : ?>
                <span class="fs-2 fw-bold">
                    Tambah Pinjaman
                </span>
                <form method="POST">
                    <button type="submit" name="bkembali" class="btn btn-danger">Kembali</button>
                </form>
            <?php elseif (isset($_POST['bpengembalian'])) : ?>
                <span class="fs-2 fw-bold">
                    Pengembalian
                </span>
                <form method="POST">
                    <button type="submit" name="bkembali" class="btn btn-danger">Kembali</button>
                </form>
            <?php else : ?>
                <span class="fs-2 fw-bold">
                    Pinjaman
                </span>
                <form method="POST">
                    <button type="submit" name="btambah" class="btn btn-success">Tambah Pinjaman</button>
                </form>
            <?php endif ?>
        </div>
        <div class="card-body">
            <?php if (isset($_POST['btambah'])) : ?>
                <form action="pinjaman_proses.php" method="POST">
                    <div class="container">
                        <div class="mb-3">
                            <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                            <select type="text" class="form-select" id="nama-lengkap" name="nama">
                                <?php $query = mysqli_query($koneksi, "SELECT * FROM tbl_user");
                                while ($data = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?= $data['id_user'] ?>"><?= $data['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah-pinjaman" class="form-label">Jumlah Pinjaman</label>
                            <input type="number" min="0" max="10000000" class="form-control" id="jumlah-pinjaman" name="jumlah">
                        </div>
                        <div class="mb-3 d-none">
                            <input type="datetime" class="form-control" name="tgl_pinjam" value="<?= $today ?>">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" name="bpinjamadmin">Pinjam</button>
                        </div>
                    </div>
                </form>
            <?php else : ?>
                <table id="example" class="table table-striped table-bordered d-md-block d-lg-table overflow-sm-auto">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Pinjaman</th>
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
                                <td class="text-center"><?= $pinjam['jumlah_pinjam'] ?></td>
                                <td class="text-center"><?= $pinjam['tgl_pinjam'] ?></td>
                                <td class="text-center">
                                    <?php if ($pinjam['status'] == 'konfirmasi') { ?>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="me-1">
                                                <span class="border text-uppercase fw-bold border-2 border-success rounded text-success px-2 fs-6">Konfirmasi</span>
                                            </div>
                                            <form action="pinjaman_proses.php" method="POST">
                                                <input type="hidden" name="id_pinjam" value="<?= $pinjam['id_pinjam'] ?>">
                                                <input class="btn btn-sm btn-success" type="submit" name="selesai" value="selesai">
                                            </form>
                                        </div>
                                    <?php } else if ($pinjam['status'] == 'tolak') { ?>
                                        <span class="border text-uppercase fw-bold border-2 border-danger rounded text-danger px-2 fs-6">Tolak</span>
                                    <?php } else if ($pinjam['status'] == 'selesai') { ?>
                                        <span class="border text-uppercase fw-bold border-2 border-success rounded text-success px-2 fs-6">Selesai</span>
                                    <?php } else if ($pinjam['status'] == 'pending') { ?>
                                        <form action="pinjaman_proses.php" method="POST">
                                            <input type="hidden" name="id_pinjam" value="<?= $pinjam['id_pinjam'] ?>">
                                            <input class="btn btn-sm btn-success" type="submit" name="konfirmasi" value="Konfirmasi">
                                            <input class="btn btn-sm btn-danger" type="submit" name="tolak" value="Tolak">
                                        </form>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <a button class="btn btn-sm btn-success" href="https://api.whatsapp.com/send?phone="><i class='bx bxl-whatsapp'></i></a>
                                    <a button class="btn btn-delete btn-sm btn-danger" href="pinjaman_proses.php?id_pinjam=<?= $pinjam['id_pinjam'] ?>"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
    </div>
</div>
<?php include "../layout/footer.php" ?>