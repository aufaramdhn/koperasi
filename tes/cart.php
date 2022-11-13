<?php
session_start();
include '../componen/config.php';

$id_method = 0;
$payment = "";
$fee = "";
$rek = "";
$query = $config->query("SELECT * FROM method");

if (empty($_SESSION['transaksi']) or !isset($_SESSION['transaksi'])) {
    echo "<script>alert('Pesanan kosong, Silahkan Pesan dahulu');</script>";
    echo "<script>location= '../public_user/index.php'</script>";
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include '../componen/meta.php'; ?>
        <title>Cart</title>
    </head>

    <body>
        <?php include '../componen/nav.php'; ?>
        <div class="container p-5">
            <h3><i class="bi bi-cart me-3"></i>PESANAN ANDA</h3>
            <hr class="mb-3">
            <div class="card p-3 bg-light">
                <div class="table-responsive">
                    <a href="../public_user/index.php" class="btn btn-outline-warning mb-3"><i class="bi bi-cart-plus"></i>&nbsp;Tambah Pesanan</a>
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Materi</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Diskon</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Subharga</th>
                                <th scope="col" class="d-flex justify-content-center">Action</th>
                            </tr>
                        </thead>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <tbody>
                                <?php $nomor = 1; ?>
                                <?php $subtotal = 0; ?>
                                <?php foreach ($_SESSION["transaksi"] as $id_materi => $jumlah) : ?>
                                    <?php
                                    $ambil = mysqli_query($config, "SELECT * FROM materi WHERE id_materi = '$id_materi'");
                                    $pecah = $ambil->fetch_assoc();
                                    $subharga = $pecah["harga"] * $jumlah;
                                    $totaldiskon = $pecah["diskon"] * $jumlah;
                                    ?>
                                    <tr>
                                        <td><?= $nomor++; ?></td>
                                        <td><?= $pecah["nma"] ?></td>
                                        <td><img src="../upload/<?= $pecah['gambar'] ?>" alt="" width="100"></td>
                                        <td>Rp. <?= number_format($pecah["harga"], 0, ".", "."); ?></td>
                                        <td><?= $totaldiskon; ?>&nbsp;%</td>
                                        <td><?= $jumlah; ?></td>
                                        <?php if ($pecah['diskon'] > 0) { ?>
                                            <td>Rp. <?= number_format($subharga - ($pecah['diskon'] / 100) * $subharga, 0, ".", "."); ?></td>
                                        <?php } else { ?>
                                            <td>Rp. <?= number_format($subharga, 0, ".", "."); ?></td>
                                        <?php } ?>
                                        <td>
                                            <a href="hapus.php?id_materi=<?= $id_materi ?>" class="btn btn-danger d-flex justify-content-center"><i class="bi bi-trash"></i>&nbsp;Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $nomor++; ?>
                                    <?php if ($pecah['diskon'] > 0) { ?>
                                        <?php $subtotal += $subharga - ($pecah['diskon'] / 100) * $subharga; ?>
                                    <?php } else { ?>
                                        <?php $subtotal += $subharga; ?>
                                    <?php } ?>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="6">Subtotal Belanja</th>
                                    <th colspan="2">Rp. <?= number_format($subtotal, 0, ".", ".") ?></th>
                                </tr>
                            </tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Pilih Metode Pembayaran</th>
                                    <td>
                                        <select class="form-select" name="method" id="method">
                                            <?php $no = 1;
                                            foreach ($query as $pay) {
                                                if ($payment == $pay['id_method']) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            ?>
                                                <option value="<?= $pay['id_method'] ?>" <?= $selected ?>> <?= $pay['payment'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>No Rekening</th>
                                    <td><span name="rek" id="rek" class="form-control"></span></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Subtotal</th>
                                    <td>Rp. <?= number_format($subtotal, 0, ".", "."); ?></td>
                                </tr>
                                <tr>
                                    <th>Diskon</th>
                                    <td><?= $totaldiskon ?>&nbsp;&nbsp;%</td>
                                </tr>
                                <tr>
                                    <th>Pajak</th>
                                    <td><span name="fee" id="fee" class="input"></span></td>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Total Belanja</th>
                                    <th><span id="total1" class="input"></span></th>
                                    <input type="hidden" name="total" id="total">
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <button class="btn btn-outline-success" name="konfirmasi">Konfirmasi Pesanan</button>
                </form>
            </div>
            <?php
            if (isset($_POST['konfirmasi'])) {
                $id_user = $_SESSION['id_user'];
                $method = $_POST['method'];
                date_default_timezone_set("Asia/Jakarta");
                $tgl =  date("Y-m-d H:i:s");
                $total = $_POST['total'];


                $insert = mysqli_query($config, "INSERT INTO transaksii VALUES (NULL, '$id_user', '$id_materi', '$method', '$tgl', '$subtotal', '$total', 'pending')");

                $id_transaksi = $config->insert_id;

                foreach ($_SESSION["transaksi"] as $idmenu => $jumlah) {
                    $insert = mysqli_query($config, "INSERT INTO pembelian_materi VALUES (NULL, '$id_transaksi', '$jumlah')");
                }
                unset($_SESSION["transaksi"]);

                echo "<script>alert('Pemesanan segera diproses!');</script>";
                echo "<script>window.location= '../tes/struk.php?id_transaksi=$id_transaksi';</script>";
            }
            ?>
        </div>
        <script>
            $(document).ready(function() {
                $("#method").click(function() {
                    $.ajax({
                        url: 'fee.php',
                        type: 'post',
                        data: {
                            id_method: $("#method").val()
                        },
                        dataType: "JSON",
                        success: function(data) {
                            $(".form-group").show();
                            $("#fee").text(data.fee);
                            $("#rek").text(data.rek);
                            let subtotal = parseInt("<?= $subtotal ?>")
                            let fee = parseInt($('span[name="fee"]').html())
                            let total = (fee + subtotal)

                            $('#total1').html(total)
                            document.querySelector('#total').value = total
                        }
                    });
                });
            });
        </script>
    </body>

    </html>
<?php
}
?>