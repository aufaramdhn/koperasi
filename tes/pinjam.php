<?php
include '../layout/header.php';
$id_bunga = 0;
$bulan = "";
$bunga = "";
$BulanQuery = $koneksi->query("SELECT * FROM tbl_bunga");
?>
<div class="container p-5">
    <div class="row">
        <div class="col-md-6">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="number" name="jumlah" id="jumlah">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Pilih Metode Pembayaran</th>
                            <td>
                                <select class="form-select" name="method" id="method">
                                    <?php $no = 1;
                                    foreach ($BulanQuery as $pay) {
                                        if ($payment == $pay['id_bunga']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                        <option value="<?= $pay['id_bunga'] ?>" <?= $selected ?>> <?= $pay['bulan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Bunga</th>
                            <td><span name="bunga" id="bunga" class="form-control"></span></td>
                        </tr>
                        <tr>
                            <th>Bulan</th>
                            <td><span name="bulan" id="bulan" class="form-control"></span></td>
                        </tr>
                    </thead>
                </table>
        </div>
        <div class="col-md-6">
            <table id="example" class="table table-striped table-bordered">
                <!-- <thead>
                    <tr>
                        <th>Pajak</th>
                        <td><span name="fee" id="fee" class="input"></span></td>
                    </tr> -->
                </thead>
                <tfoot>
                    <tr>
                        <th>Total Belanja</th>
                        <th><span id="total" class="input"></span></th>
                        <input type="hidden" name="total" id="total">
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <button class="btn btn-outline-success" name="konfirmasi">Konfirmasi Pesanan</button>
    </form>
</div>
<?php include '../layout/footer.php'; ?>
<script>
    $(document).ready(function() {
        $("#method").click(function() {
            $.ajax({
                url: 'bunga.php',
                type: 'post',
                data: {
                    id_bunga: $("#method").val()
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
                    let subtotal = jumlah - (bunga / 10) * jumlah
                    let total = (jumlah + subtotal)

                    $('#total').html(total)
                    document.querySelector('#total').value = total
                }
            });
        });
    });
</script>