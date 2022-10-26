<?php
include "../layout/header.php";
include "../koneksi.php";

$id_pinjaman = $_SESSION['id_user'];
$tbl_pinjaman_u = mysqli_query($koneksi, "SELECT * FROM tbl_pinjam JOIN tbl_user ON tbl_user.id_user = tbl_pinjam.id_user where tbl_pinjam.id_user = $id_pinjaman ");
$data_u = mysqli_fetch_array($tbl_pinjaman_u);

$tbl_pinjaman_a = mysqli_query($koneksi, "SELECT * FROM tbl_pinjam JOIN tbl_user ON tbl_user.id_user = tbl_pinjam.id_user ORDER BY tgl_pinjam DESC");
$data_a = mysqli_fetch_array($tbl_pinjaman_a);

?>
<div class="container-fluid pt-3">
    <div class="card">
        <div class="card-header p-4 d-flex justify-content-between align-items-center">
            <?php if (isset($_POST['btambah'])) : ?>
                <span class="fs-2 fw-bold">
                    Pinjaman
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
        <div class="card-body px-3 pt-3">
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
                        <div class="mb-3">
                            <label class="form-label">Tempo</label>
                            <select class="form-select" name="tempo_pinjam">
                                <option>Pilih Tempo</option>
                                <option>1 bln</option>
                                <option>2 bln</option>
                                <option>3 bln</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" name="bpimpan">Pinjam</button>
                        </div>
                    </div>
                </form>
            <?php else : ?>
                <div class="d-flex justify-content-end">
                    <div>
                        <input class="form-control mb-3 d-flex justify-content-end" type="text" placeholder="Cari Disini">
                    </div>
                </div>
                <table class="table table-responsive table-bordered table-striped">
                    <thead>
                        <?php if ($_SESSION['level'] == 'admin') : ?>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Nama</th>
                                <th class="text-center" scope="col">Pinjaman</th>
                                <th class="text-center" scope="col">Tempo</th>
                                <th class="text-center" scope="col">Tanggal Pinjam</th>
                                <!-- <th class="text-center" scope="col">Tanggal Mulai</th>
                                <th class="text-center" scope="col">Tanggal Selesai</th> -->
                                <th class="text-center" scope="col">Status</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        <?php else : ?>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center" scope="col">Nama</th>
                                <th class="text-center" scope="col">Pinjaman</th>
                                <th class="text-center" scope="col">tempo</th>
                                <th class="text-center" scope="col">Hari dan Tanggal</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        <?php endif ?>
                    </thead>
                    <tbody>
                        <?php if ($_SESSION['level'] == 'admin') : ?>
                            <?php
                            $no = 1;
                            foreach ($tbl_pinjaman_a as $pinjam) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $pinjam['nama'] ?></td>
                                    <td class="text-center"><?= $pinjam['jumlah_pinjam'] ?></td>
                                    <td class="text-center"><?= $pinjam['tempo_pinjam'] ?></td>
                                    <td class="text-center"><?= $pinjam['tgl_pinjam'] ?></td>
                                    <!-- <td class="text-center"><?= $pinjam['tgl_pinjam'] ?></td>
                                    <td class="text-center"><?= $pinjam['tgl_pinjam'] ?></td> -->
                                    <td class="text-center">
                                        <?php if ($pinjam['status'] == 'accept') { ?>
                                            <span class="border text-uppercase fw-bold border-2 border-success rounded text-success px-2 fs-6">Accept</span>
                                            <form class="" action="opsi-orders.php" method="POST">
                                                <input type="hidden" name="id_transaksi" value="">
                                                <input class="btn btn-sm btn-success" type="submit" name="done" value="Done">
                                            </form>
                                        <?php } else if ($pinjam['status'] == 'reject') { ?>
                                            <span class="border text-uppercase fw-bold border-2 border-danger rounded text-danger px-2 fs-6">Reject</span>
                                        <?php } else if ($pinjam['status'] == 'done') { ?>
                                            <span class="border text-uppercase fw-bold border-2 border-success rounded text-success px-2 fs-6">Done</span>
                                        <?php } else if ($pinjam['status'] == 'pending') { ?>
                                            <form class="" action="opsi-orders.php" method="POST">
                                                <input type="hidden" name="id_transaksi" value="">
                                                <input class="btn btn-sm btn-success" type="submit" name="accept" value="Accept">
                                                <input class="btn btn-sm btn-danger" type="submit" name="reject" value="Reject">
                                            </form>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a button class="btn btn-sm btn-success" href="https://api.whatsapp.com/send?phone="><i class='bx bxl-whatsapp'></i></a>
                                        <a button class="btn btn-sm btn-danger"><i class='bx bx-trash'></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php else : ?>
                            <?php
                            $no = 1;
                            foreach ($tbl_pinjaman_u as $pinjam) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $pinjam['nama'] ?></td>
                                    <td class="text-center"><?= $pinjam['jumlah_pinjam'] ?></td>
                                    <td class="text-center"><?= $pinjam['tempo_pinjam'] ?></td>
                                    <td class="text-center"><?= $pinjam['tgl_pinjam'] ?></td>
                                    <td class="text-center">
                                        <a button class="btn btn-sm btn-info text-white fs-6" href="https://api.whatsapp.com/send?phone="><i class='bx bxs-edit'></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php endif ?>
                    <?php endif  ?>
                    </tbody>
                </table>
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