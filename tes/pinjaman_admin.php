<?php
$active = "pinjaman";
include "../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");
$expires = date("2022-10-30 12:42:00");

$id_pinjaman = $_SESSION['id_user'];

$tbl_pinjaman_a = mysqli_query($koneksi, "SELECT * FROM tbl_pinjam JOIN tbl_user ON tbl_user.id_user = tbl_pinjam.id_user ORDER BY tgl_pinjam DESC");
$data_a = mysqli_fetch_array($tbl_pinjaman_a);

$querySimpan = mysqli_query($koneksi, "SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_user.id_user = tbl_simpan.id_user WHERE tbl_simpan.id_user = $id_pinjaman");
$cek = mysqli_num_rows($querySimpan);

$confirmQuery = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pinjam JOIN tbl_pinjam ON (tbl_pinjam.id_pinjam = konfirmasi_pinjam.id_pinjam) JOIN tbl_user ON (tbl_user.id_user=tbl_pinjam.id_user) WHERE tbl_user.id_user=$_SESSION[id_user]");
$confirmArray = mysqli_fetch_array($confirmQuery);

$id_bunga = 0;
$bunga = "";
$bulan = "";
$queryBulan = $koneksi->query("SELECT * FROM tbl_bunga");
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
                <form action="pinjaman_proses.php" method="post" enctype="multipart/form-data">
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
                            <label for="jumlah" class="form-label">Jumlah Pinjaman <span name="limit"></span></label>
                            <input type="number" class="form-control" name="jumlah" id="jumlah">
                        </div>
                        <div class="mb-3">
                            <label for="selectBulan" class="form-label">Tempo Bulan</label>
                            <select class="form-select" name="selectBulan" id="selectBulan" required>
                                <option disabled>
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
                                <td class="text-center">Rp. <?= number_format($pinjam['jumlah_pinjam'], '0', '.', '.') ?></td>
                                <td class="text-center"><?= $pinjam['tgl_pinjam'] ?></td>
                                <td class="text-center">
                                    <?php if ($pinjam['status_pinjam'] == 'konfirmasi') { ?>
                                        <span class="border text-uppercase fw-bold border-2 border-success rounded text-success px-2 fs-6">Konfirmasi</span>
                                    <?php } else if ($pinjam['status_pinjam'] == 'pengembalian') { ?>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="me-1">
                                                <span class="border text-uppercase fw-bold border-2 border-warning rounded text-warning px-2 fs-6">pengembalian</span>
                                            </div>
                                            <form action="pinjaman_proses.php" method="POST">
                                                <input type="hidden" name="id_pinjam" value="<?= $pinjam['id_pinjam'] ?>">
                                                <input class="btn btn-sm btn-success" type="submit" name="selesai" value="selesai">
                                            </form>
                                        </div>
                                    <?php } else if ($pinjam['status_pinjam'] == 'tolak') { ?>
                                        <span class="border text-uppercase fw-bold border-2 border-danger rounded text-danger px-2 fs-6">Tolak</span>
                                    <?php } else if ($pinjam['status_pinjam'] == 'selesai') { ?>
                                        <span class="border text-uppercase fw-bold border-2 border-success rounded text-success px-2 fs-6">Selesai</span>
                                    <?php } else if ($pinjam['status_pinjam'] == 'pending') { ?>
                                        <form action="pinjaman_proses.php" method="POST">
                                            <input type="hidden" name="id_pinjam" value="<?= $pinjam['id_pinjam'] ?>">
                                            <input type="hidden" name="id_bunga" value="<?= $pinjam['id_bunga'] ?>">
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