<?php
$active = "pinjaman";
$title = "Print | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");

?>

<div class="pt-2 text-black content-print">
    <div class="container-fluid">
        <div class="row">
            <form method="POST" action="" enctype="multipart/form-data">
                <!-- desain struk -->
                <div class="container print">
                    <div class="d-flex justify-content-between">
                        <img src="../../assets/images/koperasi.png" alt="" width="90px" style="margin-bottom:10px;">
                        <center>
                            <h4 class="mt-4 ">KOPERASI SIMPAN PINJAM</h4>
                            <span> Jl. Resident I Kav Perumahan, Curugmekar, Kec. Cileungsi, Jawa Barat 16113</span><br>
                            <span>fax. (123) 456789.
                            </span>
                        </center>
                        <br>
                    </div>
                </div>
                <div class="container" style="margin-top:20;">
                    <span>No. Pinjaman : </span><br>
                    <span>Nama : Fardan </span>
                    <span style="float:right;">Tanggal : 22-2-2023</span>
                    <h2 class="pb-4 border-bottom"></h2>
                    <h2 class="mt-4">PINJAMAN</h2>
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between">
                            <span class="mt-1">JENIS TAGIHAN :</span>
                            <span>BIAYA TAGIHAN</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="mt-1">BIAYA LAYANAN DOKTER</span>
                            <h2></h2>
                            <span>Rp.50.000 </span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="mt-1">
                            </span>
                            <span>Rp.50.000 </span>
                        </div>
                        <!-- total tagihan -->
                        <h2 class="pb-4 border-bottom"></h2>
                        <div class="d-flex justify-content-between ">
                            <span class="fs-5">Total Tagihan</span><br>
                            <h2></h2>
                            <b><span class="fs-5">Rp.25.000 </span></b>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="fs-5">Total Bayar</span><br>
                            <h2></h2>
                            <b><span class="fs-5">Rp.25.000 </span></b>
                        </div>
                        <div class="mb-4 d-flex justify-content-between">
                            <span class="fs-5">Uang Kembali</span><br>
                            <h2></h2>
                            <b><span class="fs-5">Rp.25.000 </span></b>
                        </div>
                        <span style="float:right;" class="mt-4 fs-5">Bogor, </span><br><br><br><br><br>
                        <center>
                            <h2>** Terima Kasih **</h2>
                        </center>
                        <a href="" class="btn btn-success btn-fill pull-rightfloat-right ms-2 print" style="float:right ;" onclick="window.print()">CETAK STRUK</a>
                        <a href="transaksi2.php?ilang" button type="button" class="mb-5 btn btn-danger print">Kembali</a><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "../../layout/footer.php" ?>