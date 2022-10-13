<?php
require "../koneksi.php";
include "../layout/header.php";

$users = mysqli_query($koneksi, "SELECT * FROM tbl_user");

?>
<div class="container-fluid pt-3">
    <div class="card">
        <div class="card-header p-4 d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Users
            </span>
            <div class="">
                <a href="" class="btn btn-success">Tambah Data</a>
            </div>
        </div>
        <div class="card-body px-3 pt-3">
            <div class="d-flex justify-content-end">
                <div>
                    <input class="form-control mb-3 d-flex justify-content-end" type="text" placeholder="Cari Disini">
                </div>
            </div>
            <table class="table table-responsive table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tempat, Tanggal Lahir</th>
                        <th scope="col">No. Telepon</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($users as $user) {
                    ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $user['nama'] ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['tgl_lahir']; ?></td>
                            <td><?= $user['telp']; ?></td>
                            <td>Aksi</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <nav class="mt-3 d-flex justify-content-end" aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php include "../layout/footer.php" ?>