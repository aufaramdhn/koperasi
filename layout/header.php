<?php
session_start();
include "../apps/koneksi.php";
include "../apps/config.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Koperasi</title>

    <link href="<?php echo $config; ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo $config; ?>admin/dashboard.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $config; ?>assets/style/sidebar.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <link rel="stylesheet" href="<?php echo $config; ?>assets/css/datatables.min.css">

    <script src="<?php echo $config; ?>assets/script/chart.js"></script>
</head>


<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        <div class="d-flex align-items-center">
            <span class="me-3">
                Welcome <?= $_SESSION['nama'] ?>
            </span>
            <div class="header_img">
                <img src="https://i.imgur.com/hczKIze.jpg" alt="">
            </div>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">Koperasi</span>
                </a>
                <div class="nav_list">
                    <?php if ($_SESSION['level'] == 'admin') : ?>
                        <a href="<?php echo $config; ?>views/index.php" class="nav_link <?= $active == 'dashboard' ? 'active' : '' ?>">
                            <i class='bx bx-grid-alt nav_icon'></i>
                            <span class="nav_name">Dashboard</span>
                        </a>
                        <a href="<?php echo $config; ?>views/user.php" class="nav_link <?= $active == 'user' ? 'active' : '' ?>">
                            <i class='bx bx-user nav_icon'></i>
                            <span class="nav_name">Users</span>
                        </a>
                        <a href="<?php echo $config; ?>views/simpanan_admin.php" class="nav_link <?= $active == 'simpanan' ? 'active' : '' ?>">
                            <i class='bx bx-wallet nav_icon'></i>
                            <span class="nav_name">Simpanan</span>
                        </a>
                        <a href="<?php echo $config; ?>views/pinjaman_admin.php" class="nav_link <?= $active == 'pinjaman' ? 'active' : '' ?>">
                            <i class='bx bx-money-withdraw nav_icon'></i>
                            <span class="nav_name">Pinjaman</span>
                        </a>
                        <a href="<?php echo $config; ?>views/pengembalian_admin.php" class="nav_link <?= $active == 'pengembalian' ? 'active' : '' ?>">
                            <i class='bx bx-money nav_icon'></i>
                            <span class="nav_name">Pengembalian</span>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo $config; ?>views/index.php" class="nav_link <?= $active == 'dashboard' ? 'active' : '' ?>">
                            <i class='bx bx-grid-alt nav_icon '></i>
                            <span class="nav_name">Dashboard</span>
                        </a>
                        <a href="<?php echo $config; ?>views/simpanan_user.php" class="nav_link <?= $active == 'simpanan' ? 'active' : '' ?>">
                            <i class='bx bx-wallet nav_icon'></i>
                            <span class="nav_name">Simpanan</span>
                        </a>
                        <a href="<?php echo $config; ?>views/pinjaman_user.php" class="nav_link <?= $active == 'pinjaman' ? 'active' : '' ?>">
                            <i class='bx bx-money-withdraw nav_icon'></i>
                            <span class="nav_name">Pinjaman</span>
                        </a>
                        <a href="<?php echo $config; ?>views/profile.php" class="nav_link <?= $active == 'profile' ? 'active' : '' ?>">
                            <i class='bx bx-user nav_icon'></i>
                            <span class="nav_name">Profil</span>
                        </a>
                    <?php endif ?>
                </div>
            </div>
            <a href="<?php echo $config; ?>views/logout.php" class="nav_link btn-logout">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">SignOut</span>
            </a>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="container-fluid">