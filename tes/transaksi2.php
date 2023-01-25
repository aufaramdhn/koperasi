<?php
include 'config.php';

$date = date('y/m/d');
date_default_timezone_set("Asia/Jakarta");



// hapus data obat
if (isset($_POST['hapus5'])) {
    $query = mysqli_query($conn, "DELETE * FROM data_obat");
    if ($query) {
        header('location:farmasih.php');
    };
};

// memasukan data
if (isset($_GET['ilang'])) {
    $query =  mysqli_query($conn, "DELETE FROM `data_obat`");
    header('location:farmasih.php');
}

?>

<?php include 'navbar-farmasih.php'; ?>
<div class="content text-black">

    <div class="container-fluid" style="background-color: white;">
        <div class="row">
            <div class="col-md-12">
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                <?php
                $query = mysqli_query($conn, "SELECT *, DATE_FORMAT(tanggal_transaksi, '%e %M %Y') as tgl FROM `transaksi` ORDER BY id_transaksi DESC");

                $row_query = mysqli_fetch_array($query);
                $kembalian = $row_query['uang_bayar'] - $row_query['total_tagihan'];
                $dokter = 200000;

                ?>
                <!-- desain struk -->
                <div class="container">
                    <div class="d-flex justify-content-between">
                        <img src="images/logo.png" alt="" width="90pxpx" style="margin-bottom:10px;">
                        <center>
                            <h4 class="mt-4 ">RUMAH SAKIT PEDULI KITA</h4>
                            <span> Jl. Resident I Kav Perumahan, Curugmekar, Kec. Cileungsi, Jawa Barat 16113</span><br>
                            <span>fax. (123) 456789.
                            </span>
                        </center>
                        <br>
                    </div>
                </div>

                <div class="container" style="margin-top:20;">
                    <span style="">NO. RS : <?php echo $row_query['id_transaksi'] ?></span>
                    <span style="float:right;">KASIR : Fardan Septian</span><br>
                    <span style="">PASIEN : <?php echo $row_query['nama_pasien'] ?></span>
                    <span style="float:right;">Tanggal : <?php echo $row_query['tgl'] ?> </span>
                    <h2 class=" pb-4 border-bottom"></h2>





                    <h2 class="mt-4">TINDAKAN DAN LAYANAN MEDIS</h2>
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between">
                            <span class="mt-1">JENIS TAGIHAN :</span>
                            <span>BIAYA TAGIHAN</span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <span class="mt-1">BIAYA LAYANAN DOKTER</span>
                            <h2></h2>
                            <span>Rp. <?= number_format($dokter); ?></span>

                        </div>


                        <?php
                        $query = "SELECT * FROM data_obat;";
                        $sql = mysqli_query($conn, $query);
                        $tagihan = 0;
                        $obat = 0;

                        ?>

                        <?php while ($tampil = mysqli_fetch_assoc($sql)) {  ?>
                            <?php
                            $obat = 0;
                            $obat = $tampil['harga_obat'] * $tampil['quantity'] ?>
                            <div class="d-flex justify-content-between">
                                <span class="mt-1"><?= $tampil['nama_obat']; ?>
                                    x<?= $tampil['quantity']; ?></span>
                                <span>Rp. <?= number_format($obat); ?></span>
                            </div>
                        <?php $tagihan = $dokter += $tampil['harga_obat'] * $tampil['quantity'];
                        }; ?>

                        <!-- total tagihan -->
                        <h2 class=" pb-4 border-bottom"></h2>

                        <div class="d-flex justify-content-between ">
                            <span class="fs-5">Total Tagihan</span><br>
                            <h2></h2>
                            <b><span class="fs-5">Rp. <?= number_format($tagihan); ?></span></b>

                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="fs-5">Total Bayar</span><br>
                            <h2></h2>
                            <b><span class="fs-5">Rp. <?= number_format($row_query['uang_bayar']); ?></span></b>

                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fs-5">Uang Kembali</span><br>
                            <h2></h2>
                            <b><span class="fs-5">Rp. <?= number_format($kembalian); ?></span></b>
                        </div>



                        <span style="float:right;" class="fs-5 mt-4">Bogor, <?php echo $row_query['tgl'] ?> </span><br><br><br><br><br>
                        <b><span style="float:right;" class="fs-5 mt-4">Fardan Septian</span></b> <br>
                        <center>
                            <h2>** Terima Kasih **</h2>
                        </center>
                        <a href="" class="btn btn-success btn-fill pull-rightfloat-right ms-2 print" style="float:right ;" onclick="window.print()">CETAK STRUK</a>
                        <a href="transaksi2.php?ilang" button type="button" class="btn btn-danger mb-5 print">Kembali</a><br>
                    </div>
                </div>

        </div>
        </form>
    </div>
</div>



<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>


</body>

</html>