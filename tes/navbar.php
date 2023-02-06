<!-- <div class="sidebar close d-print-none">
        <div class="logo-details">
            <img src="<?php echo $config; ?>assets/images/koperasi.png" alt="" width="25px" height="25px">
            <span class="logo_name">Koperasi</span>
        </div>
        <ul class="nav-links">
        <?php if ($_SESSION['level'] == 'admin') : ?>
                <li class="<?= $active == 'dashboard' ? 'active' : '' ?>">
                    <a href="<?php echo $config; ?>views/dashboard/dashboard_admin.php">
                        <i class='bx bx-grid-alt'></i>
                        <span class="link_name">Dashboard</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="<?php echo $config; ?>views/dashboard/dashboard_admin.php">Dashboard</a></li>
                    </ul>
                </li>
                <li class="<?= $active == 'user' ? 'active' : '' ?>">
                    <a href="<?php echo $config; ?>views/user/user.php">
                        <i class='bx bx-user'></i>
                        <span class="link_name">User</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="<?php echo $config; ?>views/user/user.php">User</a></li>
                    </ul>
                </li>
                <li class="<?= $active == 'simpanan' ? 'active' : '' ?>">
                    <div class="iocn-link">
                        <a href="#">
                            <i class='bx bx-wallet'></i>
                            <span class="link_name">Simpanan</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Simpanan</a></li>
                        <li><a href="<?php echo $config; ?>views/simpanan/simpanan_admin.php">Tambah Simpanan</a></li>
                        <li><a href="<?php echo $config; ?>views/simpanan/tarik_simpanan_admin.php">Tarik Simpanan</a></li>
                    </ul>
                </li>
                <li class=" <?= $active == 'pinjaman' ? 'active' : '' ?>">
                    <a href="<?php echo $config; ?>views/pinjaman/pinjaman_admin.php">
                        <i class='bx bx-money-withdraw'></i>
                        <span class="link_name">Pinjaman</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="<?php echo $config; ?>views/pinjaman/pinjaman_admin.php">Pinjaman</a></li>
                    </ul>
                </li>
                <li class="<?= $active == 'pengembalian' ? 'active' : '' ?>">
                    <a href="<?php echo $config; ?>views/pengembalian/pengembalian_admin.php">
                        <i class='bx bx-money'></i>
                        <span class="link_name">Pengembalian</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="<?php echo $config; ?>views/pengembalian/pengembalian_admin.php">Pengembalian</a></li>
                    </ul>
                </li>
            <?php else : ?>
                <li class="<?= $active == 'dashboard' ? 'active' : '' ?>">
                    <a href="<?php echo $config; ?>views/dashboard/dashboard_user.php">
                        <i class='bx bx-grid-alt'></i>
                        <span class="link_name">Dashboard</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="<?php echo $config; ?>views/dashboard/dashboard_user.php">Dashboard</a></li>
                    </ul>
                </li>
                <li class="<?= $active == 'simpanan' ? 'active' : '' ?>">
                    <div class="iocn-link">
                        <a href="#">
                            <i class='bx bx-wallet'></i>
                            <span class="link_name">Simpanan</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Simpanan</a></li>
                        <li><a href="<?php echo $config; ?>views/simpanan/simpanan_user.php">Tambah Simpanan</a></li>
                        <li><a href="<?php echo $config; ?>views/simpanan/tarik_simpanan_user.php">Tarik Simpanan</a></li>
                    </ul>
                </li>
                <li class="<?= $active == 'pinjaman' ? 'active' : '' ?>">
                    <a href="<?php echo $config; ?>views/pinjaman/pinjaman_user.php">
                        <i class='bx bx-money-withdraw'></i>
                        <span class="link_name">Pinjaman</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="<?php echo $config; ?>views/pinjaman/pinjaman_user.php">Pinjaman</a></li>
                    </ul>
                </li>
                <li class="<?= $active == 'pengembalian' ? 'active' : '' ?>">
                    <a href="<?php echo $config; ?>views/pengembalian/pengembalian_user.php">
                        <i class='bx bx-money'></i>
                        <span class="link_name">Pengembalian</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="<?php echo $config; ?>views/pengembalian/pengembalian_user.php">Pengembalian</a></li>
                    </ul>
                </li>
                <li class="<?= $active == 'profile' ? 'active' : '' ?>">
                    <a href="<?php echo $config; ?>views/profile/profile.php">
                        <i class='bx bx-user'></i>
                        <span class="link_name">Profile</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="<?php echo $config; ?>views/profile/profile.php">Profile</a></li>
                    </ul>
                </li>
            <?php endif ?>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="https://gravatar.com/avatar/f57bddebd1edf91412d5d68702530099" alt="profileImg">
                    </div>
                    <div class="name-job">
                        <div class="profile_name">Dumitru Chirutac</div>
                        <div class="job">Web Desginer</div>
                    </div>
                    <a href="<?php echo $config; ?>auth/logout_proses.php" class="btn-logout">
                        <i class='bx bx-log-out'></i>
                    </a>
                </div>
            </li>
        </ul>
    </div> -->
<!-- <section class="home-section"> -->
<!-- Alert -->
<!-- <div class="home-content d-print-none">
            <i class='bx bx-menu'></i>
        </div> -->