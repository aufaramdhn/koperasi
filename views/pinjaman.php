<?php
include "../layout/header.php";
include "../koneksi.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-i H:i:s");

$id_pinjaman = $_SESSION['id_user'];
$tbl_pinjaman_u = mysqli_query($koneksi, "SELECT * FROM tbl_pinjam JOIN tbl_user ON tbl_user.id_user = tbl_pinjam.id_user where tbl_pinjam.id_user = $id_pinjaman ");
$data_u = mysqli_fetch_array($tbl_pinjaman_u);

$tbl_pinjaman_a = mysqli_query($koneksi, "SELECT * FROM tbl_pinjam JOIN tbl_user ON tbl_user.id_user = tbl_pinjam.id_user ORDER BY tgl_pinjam DESC");
$data_a = mysqli_fetch_array($tbl_pinjaman_a);

$confirmQuery = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pinjam JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) WHERE tbl_user.id_user=$_SESSION[id_user]");
$confirmArray = mysqli_fetch_array($confirmQuery);

?>
<div class="container-fluid pt-3">
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
                <form method="POST">
                    <div class="container">
                        <div class="mb-3">
                            <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama-lengkap" value="<?= $_SESSION['nama'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah-pinjaman" class="form-label">Jumlah Pinjaman</label>
                            <input type="number" min="0" max="10000000" class="form-control" id="jumlah-pinjaman" name="jumlah">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" name="bpimpan">Pinjam</button>
                        </div>
                    </div>
                </form>
            <?php elseif (isset($_POST['bpengembalian'])) : ?>
                <form method="POST">
                    <div class="container">
                        <div class="mb-3">
                            <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama-lengkap" value="<?= $_SESSION['nama'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah-pinjaman" class="form-label">Jumlah Pengembalian</label>
                            <input type="number" min="0" max="10000000" class="form-control" id="jumlah-pinjaman" name="jumlah">
                        </div>
                        <?php if ($confirmArray['expired'] > $today) : ?>
                            <div class="mb-3">
                                <label for="jumlah-denda" class="form-label">Jumlah Denda</label>
                                <input type="number" class="form-control" id="jumlah-denda" name="denda" value="200000" disabled>
                            </div>
                        <?php endif ?>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" name="bpimpan">Submit</button>
                        </div>
                    </div>
                </form>
            <?php else : ?>
                <table id="example" class="table table-striped table-bordered">
                    <?php if ($_SESSION['level'] == 'admin') : ?>
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Pinjaman</th>
                                <th scope="col">Tanggal Pinjam</th>
                                <th scope="col">Status</th>
                                <th class="text-center" scope="col">Aksi</th>
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
                                    <td><?= $pinjam['jumlah_pinjam'] ?></td>
                                    <td><?= $pinjam['tgl_pinjam'] ?></td>
                                    <td class="text-center">
                                        <?php if ($pinjam['status'] == 'konfirmasi') { ?>
                                            <span class="border text-uppercase fw-bold border-2 border-success rounded text-success px-2 fs-6">Accept</span>
                                            <form class="" action="pinjaman_proses.php" method="POST">
                                                <input type="hidden" name="id_user" value="">
                                                <input class="btn btn-sm btn-success" type="submit" name="selesai" value="selesai">
                                            </form>
                                        <?php } else if ($pinjam['status'] == 'tolak') { ?>
                                            <span class="border text-uppercase fw-bold border-2 border-danger rounded text-danger px-2 fs-6">Reject</span>
                                        <?php } else if ($pinjam['status'] == 'selesai') { ?>
                                            <span class="border text-uppercase fw-bold border-2 border-success rounded text-success px-2 fs-6">Done</span>
                                        <?php } else if ($pinjam['status'] == 'pending') { ?>
                                            <form class="" action="pinjaman_proses.php" method="POST">
                                                <input type="hidden" name="id_user" value="">
                                                <input class="btn btn-sm btn-success" type="submit" name="konfirmasi" value="Konfirmasi">
                                                <input class="btn btn-sm btn-danger" type="submit" name="tolak" value="Tolak">
                                            </form>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a button class="btn btn-sm btn-success" href="https://api.whatsapp.com/send?phone="><i class='bx bxl-whatsapp'></i></a>
                                        <a button class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php else : ?>
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Pinjaman</th>
                                <th scope="col">Hari dan Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($tbl_pinjaman_u as $pinjam) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $pinjam['nama'] ?></td>
                                    <td><?= $pinjam['jumlah_pinjam'] ?></td>
                                    <td><?= $pinjam['tgl_pinjam'] ?></td>
                                    <td class="text-center">
                                        <form method="POST">
                                            <button type="submit" name="bpengembalian" class="btn btn-sm btn-success text-white">Pengembalian</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php endif ?>
                </table>
            <?php endif ?>
        </div>
    </div>
</div>
<?php
if (isset($_POST['bpimpan'])) {

    $id = $_SESSION['id_user'];
    $jumlah = $_POST['jumlah'];
    $tempo = $_POST['tempo_pinjam'];

    $sql = mysqli_query($koneksi, "INSERT INTO tbl_pinjam VALUES (NULL, '$id', '$jumlah', '1 Bln', current_timestamp(), 'pending');");
    if ($sql == true) {
        echo "<script>alert('Data Anda Telah Berhasil Di Tambahkan, dan akan di konfirmasi oleh admin');</script>";
        echo "<script>window.location=' pinjaman.php'</script>";
    } else {
        echo "<script>alert('Data Anda Gagal Ditambahkan');</script>";
        echo "<script>window.location=' pinjaman.php'</script>";
    }
}
?>
<?php include "../layout/footer.php" ?>