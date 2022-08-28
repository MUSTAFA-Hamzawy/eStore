<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->pageTitle; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= BACK_ASSETS ?>plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= BACK_ASSETS ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= BACK_ASSETS ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= BACK_ASSETS ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= BACK_ASSETS ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= BACK_ASSETS ?>plugins/toastr/toastr.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= BACK_ASSETS ?>dist/css/adminlte.min.css">
    <style>
        .image{
            width: 50%;
            margin: auto;
            margin-top: 50px;
        }
        .image img{
            width: 100%;
            border-radius: 50%;
        }
        .user-info .username{
            display: block;
            color: #33ff00;
            font-size: 20px;
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= ROOT_LINK . 'user' ?>" class="nav-link">Users</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= ROOT_LINK . 'userGroups' ?>" class="nav-link">Groups</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= ROOT_LINK . 'privileges' ?>" class="nav-link">Privileges</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= ROOT_LINK . 'category' ?>" class="nav-link">Categories</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= ROOT_LINK . 'supplier' ?>" class="nav-link">Suppliers</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= ROOT_LINK . 'client' ?>" class="nav-link">Clients</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= ROOT_LINK . 'product' ?>" class="nav-link">Products</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->