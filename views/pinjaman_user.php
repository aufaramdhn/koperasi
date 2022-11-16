<?php
$active = "pinjaman";
include "../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");
$expires = date("2022-10-30 12:42:00");

$id_pinjaman = $_SESSION['id_user'];

$tbl_pinjaman_u = mysqli_query($koneksi, "SELECT * FROM tbl_pinjam JOIN tbl_user ON (tbl_user.id_user = tbl_pinjam.id_user) JOIN tbl_bunga ON (tbl_bunga.id_bunga = tbl_pinjam.id_bunga) WHERE tbl_pinjam.id_user = $id_pinjaman ORDER BY tgl_pinjam DESC");
$data_u = mysqli_fetch_array($tbl_pinjaman_u);
$cek_pinjam = mysqli_num_rows($tbl_pinjaman_u);

$querySimpan = mysqli_query($koneksi, "SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user WHERE tbl_simpan.id_user = $id_pinjaman");
// $limit = mysqli_fetch_array($querySimpan);
$cek = mysqli_num_rows($querySimpan);

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


if (empty($limit['jumlah_simpan'])) {
    $total = 0;
}
$total = 0;
while ($total_simpan = mysqli_fetch_array($querySimpan)) {
    $total += $total_simpan['jumlah_simpan'];
    $grand_total = $total * 25 / 100;
}

$queryPinjaman = mysqli_query($koneksi, "SELECT * FROM tbl_pinjam JOIN tbl_user ON (tbl_user.id_user = tbl_pinjam.id_user) where tbl_pinjam.id_user = $id_pinjaman");
$total_1 = 0;
while ($total_tampil = mysqli_fetch_array($queryPinjaman)) {
    $total_1 += $total_tampil['riba'];
}

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
                <?php if ($cek > 0) : ?>
                    <form action="pinjaman_proses.php" method="POST" enctype="multipart/form-data">
                        <div class="container">
                            <div class="mb-3">
                                <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama-lengkap" value="<?= $_SESSION['nama'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah Pinjaman</label>
                                <?php if ($cek_pinjam > 0) : ?>
                                    <input type="number" min="0" max="<?= $grand_total + $total_1 ?>" class="form-control" id="jumlah" name="jumlah" required>
                                <?php else : ?>
                                    <input type="number" min="0" max="<?= $grand_total ?>" class="form-control" id="jumlah" name="jumlah" required>
                                <?php endif ?>
                                <div class="form-text fst-italic">* Harap masukan nominal terlebih dahulu, setelah itu pilih tempo bulan yang anda inginkan</div>
                            </div>
                            <div class="mb-3">
                                <label for="selectBulan" class="form-label">Tempo Bulan</label>
                                <select class="form-select" name="selectBulan" id="selectBulan" required>
                                    <option hidden>
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
                                <div class="form-text fst-italic">* Harap masukan tempo bulan yang anda inginkan</div>
                            </div>
                            <span name="bunga" id="bunga" class="d-none"></span>
                            <input type="hidden" id="valueBunga" name="valueBunga">
                            <span name="bulan" id="bulan" class="d-none"></span>
                            <div class="mb-3">
                                <label for="riba" class="form-label">Riba</label>
                                <span name="riba" id="subtotal" class="form-control input">0</span>
                            </div>
                            <div class="mb-3">
                                <label for="total" class="form-label">Total Pinjaman</label>
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
                                    <?php if ($pinjam['status'] == 'konfirmasi') { ?>
                                        <span class="border text-uppercase fw-bold border-2 border-success rounded text-success px-2 fs-6">Konfirmasi</span>
                                    <?php } else if ($pinjam['status'] == 'tolak') { ?>
                                        <span class="border text-uppercase fw-bold border-2 border-danger rounded text-danger px-2 fs-6">Tolak</span>
                                    <?php } else if ($pinjam['status'] == 'pengembalian') { ?>
                                        <span class="border text-uppercase fw-bold border-2 border-warning rounded text-warning px-2 fs-6">pengembalian</span>
                                    <?php } else if ($pinjam['status'] == 'selesai') { ?>
                                        <span class="border text-uppercase fw-bold border-2 border-success rounded text-success px-2 fs-6">Selesai</span>
                                    <?php } else if ($pinjam['status'] == 'pending') { ?>
                                        <span class="border text-uppercase fw-bold border-2 border-warning rounded text-warning px-2 fs-6">pending</span>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($pinjam['status'] == "konfirmasi") : ?>
                                        <div class="d-flex justify-content-center">
                                            <a type="submit" href="detail_pinjaman.php?id_pinjam=<?= $pinjam['id_pinjam'] ?>" class="btn btn-sm btn-info text-white me-2"><i class='bx bxs-edit'></i></a>
                                            <form method="POST">
                                                <a type="submit" href="pengembalian.php?id_pinjam=<?= $pinjam['id_pinjam'] ?>" class="btn btn-sm btn-success text-white">Pengembalian</a>
                                            </form>
                                        </div>
                                    <?php else : ?>
                                        <a type="submit" href="detail_pinjaman.php?id_pinjam=<?= $pinjam['id_pinjam'] ?>" class="btn btn-sm btn-info text-white"><i class='bx bxs-edit'></i></a>
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
<?php include "../layout/footer.php" ?>
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