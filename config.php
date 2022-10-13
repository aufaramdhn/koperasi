<?php

$page = (isset($_GET['page'])) ? $_GET['page'] : '';

switch ($page) {
    case 'simpanan':
        include "admin/simpanan.php";
        break;

    case 'pinjaman':
        include "admin/pinjaman.php";
        break;

    case 'user':
        include "admin/user.php";
        break;

    case 'logout':
        include "admin/logout.php";
        break;

    default:
        include "admin/index.php";
        break;
}
