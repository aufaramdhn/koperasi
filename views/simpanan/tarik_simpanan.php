<?php

$active = "simpanan";
$title = "Simpanan | Koperasi";
include "../../layout/header.php";


$id_simpanan = $_SESSION['id_user'];

$tbl_user = $koneksi->query("SELECT * FROM tbl_user Where id_user = '$id_simpanan'");
$tbl_simpanan_u = $koneksi->query("SELECT * FROM tbl_simpan JOIN tbl_user ON tbl_simpan.id_user = tbl_user.id_user Where tbl_simpan.id_user = '$id_simpanan'");
$data_u = mysqli_fetch_array($tbl_user);
$cek = mysqli_num_rows($tbl_simpanan_u);
?>

<div class="py-3 container-fluid">
    <div class="card">
        <div class="p-4 card-header d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Penarikan Simpanan
            </span>
            <form method="POST">
                <a href="simpanan_user.php" class="btn btn-danger">Kembali</a>
            </form>
        </div>
        <div class="card-body">
            <form action="simpanan_proses.php" method="POST" enctype="multipart/form-data">
                <div class="container">
                    <div class="mb-3">
                        <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama-lengkap" value="<?= $_SESSION['nama'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah-pinjaman" class="form-label">Jumlah Penarikan Sinjaman</label>
                        <input type="number" min="0" max="10000000" class="form-control" name="jumlah" id="jumlah-pinjaman">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button id="btn-tambah" type="submit" class="btn btn-primary" name="bUser">Sinjam</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<?php include "../../layout/footer.php" ?>