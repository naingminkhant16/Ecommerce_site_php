<?php
session_start();

require '../config/config.php';
require '../config/common.php';
require '../config/functions.php';

if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
  header("location: login.php?error=login");
}
if ($_SESSION['user_role'] != 1) {
  header("location: login.php?error=password");
}
$db = new DB();
?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Admin Panel | Code1 Shop</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jquery data table css  -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $_SESSION['user_name'] ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php
            //get acitve link
            $active_link_arr = explode('/', $_SERVER['PHP_SELF']);
            $active_link = end($active_link_arr);
            ?>
            <li class="nav-item">
              <a href="index.php" class="nav-link <?= ($active_link == "index.php") ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Products
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="category.php" class="nav-link <?= ($active_link == "category.php") ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-solid fa-list"></i>
                <p>
                  Categories
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="manageUsers.php" class="nav-link <?= ($active_link == "manageUsers.php") ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                  Manage Users
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="order_list.php" class="nav-link <?= ($active_link == "order_list.php") ? 'active' : ''; ?>">
                <i class="fa-solid fa-dolly nav-icon"></i>
                <p>
                  Orders
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview menu">
              <a href="" class="nav-link <?php
                                          $reportsLinks = ['weekly_report.php', 'monthly_report.php', "best_seller.php", "premium_cus.php"];
                                          echo (in_array($active_link, $reportsLinks)) ? 'active' : '';
                                          ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Reporting <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="weekly_report.php" class="nav-link">
                    <i class="nav-icon far  fa-circle nav-icon"></i>
                    <p>Weekly Sales</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="monthly_report.php" class="nav-link">
                    <i class="far  fa-circle nav-icon"></i>
                    <p>Monthly Sales</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="best_seller.php" class="nav-link">
                    <i class="far  fa-circle nav-icon"></i>
                    <p>Best Seller Items</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="premium_cus.php" class="nav-link">
                    <i class="far  fa-circle nav-icon"></i>
                    <p>Premium Customers</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link">
                <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">

      </div>
      <!-- /.content-header -->