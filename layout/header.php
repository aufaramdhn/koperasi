<?php
session_start();
include "../../apps/koneksi.php";
include "../../apps/config.php";
$id_user = $_SESSION['id_user'];
$queryUser = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE id_user = '$id_user'");
$user = mysqli_fetch_array($queryUser);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title><?= $title ?></title>
    <link href="<?php echo $config; ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $config; ?>assets/styles/sidebar2.css">
    <link rel="stylesheet" href="<?php echo $config; ?>assets/styles/datatables.min.css">
    <link rel="stylesheet" href="<?php echo $config; ?>assets/boxicons/css/boxicons.css">
    <script src="<?php echo $config; ?>assets/script/chart.js"></script>
    <script src="<?php echo $config; ?>assets/boxicons/dist/boxicons.js"></script>
    <style>
        @media print {

            .header,
            .print {
                display: none;
            }
        }

        .view_more:hover {
            transform: scale(1.05);
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>


<body id="body-pd">

    <!-- <header class="header" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        <div class="d-flex align-items-center">
            <span class="me-3">
                Welcome <?= $user['nama'] ?>
            </span>
            <div class="header_img">
                <?php if (empty($data['img'])) { ?>
                    <img src="<?php echo $config; ?>assets/profile/person-circle.svg" alt="">
                <?php } else { ?>
                    <img src="<?php echo $config; ?>assets/profile/<?= $user['img'] ?>" alt="">
                <?php } ?>
            </div>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <img src="<?php echo $config; ?>assets/images/koperasi.png" alt="" width="25px" height="25px">
                    <span class="nav_logo-name">Koperasi</span>
                </a>
                <div class="nav_list">
                    <?php if ($_SESSION['level'] == 'admin') : ?>
                        <a href="<?php echo $config; ?>views/dashboard/dashboard_admin.php" class="nav_link <?= $active == 'dashboard' ? 'active' : '' ?>">
                            <i class='bx bx-grid-alt nav_icon'></i>
                            <span class="nav_name">Dashboard</span>
                        </a>
                        <a href="<?php echo $config; ?>views/user/user.php" class="nav_link <?= $active == 'user' ? 'active' : '' ?>">
                            <i class='bx bx-user nav_icon'></i>
                            <span class="nav_name">Users</span>
                        </a>
                        <a href="<?php echo $config; ?>views/simpanan/simpanan_admin.php" class="nav_link <?= $active == 'simpanan' ? 'active' : '' ?>">
                            <i class='bx bx-wallet nav_icon'></i>
                            <span class="nav_name">Simpanan</span>
                        </a>
                        <a href="<?php echo $config; ?>views/pinjaman/pinjaman_admin.php" class="nav_link <?= $active == 'pinjaman' ? 'active' : '' ?>">
                            <i class='bx bx-money-withdraw nav_icon'></i>
                            <span class="nav_name">Pinjaman</span>
                        </a>
                        <a href="<?php echo $config; ?>views/pengembalian/pengembalian_admin.php" class="nav_link <?= $active == 'pengembalian' ? 'active' : '' ?>">
                            <i class='bx bx-money nav_icon'></i>
                            <span class="nav_name">Pengembalian</span>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo $config; ?>views/dashboard/dashboard_user.php" class="nav_link <?= $active == 'dashboard' ? 'active' : '' ?>">
                            <i class='bx bx-grid-alt nav_icon '></i>
                            <span class="nav_name">Dashboard</span>
                        </a>
                        <a href="<?php echo $config; ?>views/simpanan/simpanan_user.php" class="nav_link <?= $active == 'simpanan' ? 'active' : '' ?>">
                            <i class='bx bx-wallet nav_icon'></i>
                            <span class="nav_name">Simpanan</span>
                        </a>
                        <a href="<?php echo $config; ?>views/pinjaman/pinjaman_user.php" class="nav_link <?= $active == 'pinjaman' ? 'active' : '' ?>">
                            <i class='bx bx-money-withdraw nav_icon'></i>
                            <span class="nav_name">Pinjaman</span>
                        </a>
                        <a href="<?php echo $config; ?>views/pengembalian/pengembalian_user.php" class="nav_link <?= $active == 'pengembalian' ? 'active' : '' ?>">
                            <i class='bx bx-money nav_icon'></i>
                            <span class="nav_name">Pengembalian</span>
                        </a>
                        <a href="<?php echo $config; ?>views/profile/profile.php" class="nav_link <?= $active == 'profile' ? 'active' : '' ?>">
                            <i class='bx bx-user nav_icon'></i>
                            <span class="nav_name">Profil</span>
                        </a>
                    <?php endif ?>
                </div>
            </div>
            <a href="<?php echo $config; ?>auth/logout_proses.php" class="nav_link btn-logout">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">SignOut</span>
            </a>
        </nav>
    </div>
    Container Main start
    <div class="container-fluid"> -->

    <div class="sidebar close">
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
    </div>
    <section class="home-section">
        <!-- Alert -->
        <?php if (isset($_SESSION['info'])) : ?>
            <div class="info-data" data-infodata="<?php echo $_SESSION['info']; ?>"></div>
        <?php
            unset($_SESSION['info']);
        endif;
        ?>
        <div class="home-content">
            <i class='bx bx-menu'></i>
        </div>