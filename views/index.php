<?php include "../layout/header.php" ?>
<div class="container pt-5">
    <?php if ($_SESSION['level'] == 'admin') : ?>
        <div class="row">
            <div class="col-md-3 mb-sm-2">
                <div class="card bg-info text-white" style="width: 18rem;">
                    <div class="card-body  row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-user fs-1'></i>
                        </div>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo</h5>
                            <span class="fw-bold">Rp.0</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../products/index.php">View detail </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-sm-2">
                <div class="card bg-success text-white" style="width: 18rem;">
                    <div class="card-body  row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-wallet fs-1'></i>
                        </div>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo Simpanan</h5>
                            <span class="fw-bold">Rp.0</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../products/index.php">View detail </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-sm-2">
                <div class="card bg-warning text-white" style="width: 18rem;">
                    <div class="card-body row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-money-withdraw fs-1'></i>
                        </div>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo Pinjaman</h5>
                            <span class="fw-bold">Rp.0</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../orders/index.php">View detail </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white" style="width: 18rem;">
                    <div class="card-body row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-credit-card fs-1'></i>
                        </div>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">User</h5>
                            <span class="fw-bold">0</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../user/index.php">View detail </a>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="row">
            <div class="col-md-3 mb-sm-2">
                <div class="card bg-info text-white" style="width: 18rem;">
                    <div class="card-body  row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-user fs-1'></i>
                        </div>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo</h5>
                            <span class="fw-bold">Rp.0</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../products/index.php">View detail </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-sm-2">
                <div class="card bg-success text-white" style="width: 18rem;">
                    <div class="card-body  row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-wallet fs-1'></i>
                        </div>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo Simpanan</h5>
                            <span class="fw-bold">Rp.0</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../products/index.php">View detail </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-sm-2">
                <div class="card bg-warning text-white" style="width: 18rem;">
                    <div class="card-body row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-money-withdraw fs-1'></i>
                        </div>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Saldo Pinjaman</h5>
                            <span class="fw-bold">Rp.0</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../orders/index.php">View detail </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white" style="width: 18rem;">
                    <div class="card-body row d-flex align-items-center">
                        <div class="col-2 text-center">
                            <i class='bx bx-credit-card fs-1'></i>
                        </div>
                        <div class="col-10 d-flex flex-column align-items-end">
                            <h5 class="card-title fw-bold">Hutang</h5>
                            <span class="fw-bold">Rp.0</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="text-decoration-none text-light fw-bold fs-6" href="../user/index.php">View detail </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>
<?php include "../layout/footer.php" ?>