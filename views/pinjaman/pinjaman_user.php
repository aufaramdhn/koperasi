<?php
$active = "pinjaman";
$title = "Pinjaman | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");
$expires = date("2022-10-30 12:42:00");

$id_pinjaman = $_SESSION['id_user'];

// Cek pinjam
$tbl_pinjaman_u = mysqli_query($koneksi, "SELECT * FROM tbl_pinjam JOIN tbl_user ON (tbl_user.id_user = tbl_pinjam.id_user) JOIN tbl_bunga ON (tbl_bunga.id_bunga = tbl_pinjam.id_bunga) WHERE tbl_pinjam.id_user = $id_pinjaman ORDER BY tgl_pinjam DESC");
$cek_pinjam = mysqli_num_rows($tbl_pinjaman_u);

// Query Simpanan
$querySimpan = mysqli_query($koneksi, "SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user WHERE tbl_simpan.status_simpan = 'konfirmasi' AND tbl_simpan.id_user = $id_pinjaman");
$cek = mysqli_num_rows($querySimpan);

// Query konfirmasi
$confirmQuery = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pinjam JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) WHERE tbl_user.id_user=$_SESSION[id_user]");
$confirmArray = mysqli_fetch_array($confirmQuery);

// bunga
$id_bunga = 0;
$bunga = "";
$bulan = "";
$queryBulan = $koneksi->query("SELECT * FROM tbl_bunga");

// limit pinjaman
$limitQuery = mysqli_query($koneksi, "SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user ORDER BY tgl_simpan DESC");
$limit1 = mysqli_fetch_array($limitQuery);

// Cek limit
if (empty($limit['jumlah_simpan'])) {
    $total = 0;
}

// Perulangan limit simpan
$total = 0;
while ($total_simpan = mysqli_fetch_array($querySimpan)) {
    $total += $total_simpan['jumlah_simpan'];
    $grand_total = $total * 25 / 100;
}

// Perulangan limit pinjam
$queryPinjaman = mysqli_query($koneksi, "SELECT * FROM tbl_pinjam JOIN tbl_user ON (tbl_user.id_user = tbl_pinjam.id_user) WHERE tbl_pinjam.status_pinjam = 'konfirmasi' AND tbl_pinjam.id_user = $id_pinjaman");
$total_1 = 0;
while ($total_tampil = mysqli_fetch_array($queryPinjaman)) {
    $total_1 += $total_tampil['riba'];
}

// Limit Pengembalian
if (isset($confirmArray['tgl_konfirmasi'])) {
    $expires = strtotime('+0 days', strtotime($confirmArray['tgl_konfirmasi']));
    $expired = date('Y-m-d H:i:s', $expires);
}

?>

<div class="py-3 container-fluid">
    <div class="card">
        <div class="p-4 card-header d-flex justify-content-between align-items-center">
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
                <?php if ($cek > 0) : ?>
                    <form action="pinjaman_proses.php" method="POST" enctype="multipart/form-data">
                        <div class="container">
                            <div class="mb-3">
                                <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama-lengkap" value="<?= $_SESSION['nama'] ?>" disabled>
                            </div>
                            <div class="mb-3 has-validation">
                                <?php if ($cek_pinjam > 0) : ?>
                                    <label for="jumlah" class="form-label">Jumlah Pinjaman <small class="form-text fst-italic">* (Maks Pinjaman <?= $grand_total + $total_1 ?>)</small></label>
                                    <input type="number" min="0" max="<?= $grand_total + $total_1 ?>" class="form-control" id="jumlah" name="jumlah" required>
                                <?php else : ?>
                                    <label for="jumlah" class="form-label">Jumlah Pinjaman <small class="form-text fst-italic">* (Maks Pinjaman <?= $grand_total ?>)</small></label>
                                    <input type="number" min="0" max="<?= $grand_total ?>" class="form-control" id="jumlah" name="jumlah" required>
                                <?php endif ?>
                                <small class="form-text fst-italic">* Harap masukan nominal terlebih dahulu, setelah itu pilih tempo bulan yang anda inginkan</small>
                                <div class="invalid-feedback">
                                    Please choose a username.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="selectBulan" class="form-label">Tempo Bulan</label>
                                <select class="form-select" name="selectBulan" id="selectBulan" required>
                                    <option value="" hidden>
                                        -- Pilih Bulan --
                                    </option>
                                    <?php $no = 1;
                                    foreach ($queryBulan as $pay) {
                                        if ($payment == $pay['id_bunga']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                        <option value="<?= $pay['id_bunga'] ?>" <?= $selected ?>> <?= $pay['bulan'] ?> Bulan</option>
                                    <?php } ?>
                                </select>
                                <small class="form-text fst-italic">* Harap masukan tempo bulan yang anda inginkan</small>
                            </div>
                            <span name="bunga" id="bunga" class="d-none"></span>
                            <input type="hidden" id="valueBunga" name="valueBunga">
                            <span name="bulan" id="bulan" class="d-none"></span>
                            <div class="mb-3">
                                <label for="riba" class="form-label">Riba</label>
                                <span name="riba" id="subtotal" class="form-control input">0</span>
                            </div>
                            <div class="mb-3">
                                <label for="total" class="form-label">Pinjaman yang harus di bayar</label>
                                <span id="total" class="form-control">0</span>
                            </div>
                            <div class="mb-3">
                                <label for="perbulan" class="form-label">Bayar per bulan</label>
                                <input type="number" class="form-control" id="perbulan" value="0" readonly>
                            </div>
                            <div class="mb-3 d-none">
                                <input type="datetime" class="form-control" name="tgl_pinjam" value="<?= $today ?>">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary" name="bpinjamuser">Pinjam</button>
                            </div>
                        </div>
                    </form>
                <?php else : ?>
                    <div class="text-center">
                        <span class="fw-bold text-uppercase fs-3">Maaf Anda Blm Menanam Modal Di koperasi kami</span>
                    </div>
                <?php endif ?>
            <?php else : ?>
                <table id="example" class="table table-striped table-bordered d-md-block d-lg-table overflow-sm-auto">

                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Pinjaman</th>
                            <th scope="col">Tempo Bulan</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
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
                                <td class="text-center"><?= $pinjam['jumlah_pinjam'] ?></td>
                                <td class="text-center"><?= $pinjam['bulan'] ?> Bulan</td>
                                <td class="text-center"><?= $pinjam['tgl_pinjam'] ?></td>
                                <td class="text-center">
                                    <?php if ($pinjam['status_pinjam'] == 'konfirmasi') { ?>
                                        <span class="px-2 border border-2 rounded text-uppercase fw-bold border-success text-success fs-6">Konfirmasi</span>
                                    <?php } else if ($pinjam['status_pinjam'] == 'tolak') { ?>
                                        <span class="px-2 border border-2 rounded text-uppercase fw-bold border-danger text-danger fs-6">Tolak</span>
                                    <?php } else if ($pinjam['status_pinjam'] == 'pengembalian') { ?>
                                        <span class="px-2 border border-2 rounded text-uppercase fw-bold border-warning text-warning fs-6">pengembalian</span>
                                    <?php } else if ($pinjam['status_pinjam'] == 'selesai') { ?>
                                        <span class="px-2 border border-2 rounded text-uppercase fw-bold border-success text-success fs-6">Selesai</span>
                                    <?php } else if ($pinjam['status_pinjam'] == 'pending') { ?>
                                        <span class="px-2 border border-2 rounded text-uppercase fw-bold border-warning text-warning fs-6">pending</span>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <?php if (($pinjam['status_pinjam'] == "konfirmasi") and ($confirmArray['tgl_konfirmasi'] >= $expired)) : ?>
                                        <div class="d-flex justify-content-center">
                                            <a type="submit" href="detail_pinjaman.php?id_pinjam=<?= $pinjam['id_pinjam'] ?>" class="text-white btn btn-sm btn-info me-2"><i class='bx bxs-edit'></i></a>
                                            <form method="POST">
                                                <a type="submit" href="../pengembalian/pengembalian.php?id_pinjam=<?= $pinjam['id_pinjam'] ?>" class="text-white btn btn-sm btn-success">Pengembalian</a>
                                            </form>
                                        </div>
                                    <?php else : ?>
                                        <a type="submit" href="../pengembalian/detail_pinjaman.php?id_pinjam=<?= $pinjam['id_pinjam'] ?>" class="text-white btn btn-sm btn-info"><i class='bx bxs-edit'></i></a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
    </div>
</div>
<?php include "../../layout/footer.php" ?>
<script>
    $(document).ready(function() {
        $("#selectBulan").click(function() {
            $.ajax({
                url: 'bunga.php',
                type: 'post',
                data: {
                    id_bunga: $("#selectBulan").val()
                },
                dataType: "JSON",
                success: function(data) {
                    $(".form-group").show();
                    // $("#fee").text(data.fee);
                    $("#bunga").text(data.bunga);
                    $("#bulan").text(data.bulan);
                    var jumlah = parseInt(document.getElementById('jumlah').value);
                    let bunga = parseInt($('span[name="bunga"]').html())
                    let bulan = parseInt($('span[name="bulan"]').html())
                    let subtotal = parseInt(jumlah * (bunga / 10))
                    let total = parseInt(jumlah + subtotal)
                    let perbulan = parseInt(total / bulan)

                    $('#valueBunga').html(bunga)
                    document.querySelector('#valueBunga').value = bunga
                    $('#subtotal').html(subtotal)
                    document.querySelector('#subtotal').value = subtotal
                    $('#perbulan').html(perbulan)
                    document.querySelector('#perbulan').value = perbulan
                    $('#total').html(total)
                    document.querySelector('#total').value = total
                }
            });
        });
    });
</script>