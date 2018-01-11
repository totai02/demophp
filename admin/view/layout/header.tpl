<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $heading_title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="resources/assets/bower/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="resources/assets/bower/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="resources/assets/bower/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="resources/assets/bower/admin-lte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="resources/assets/bower/admin-lte/dist/css/skins/_all-skins.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="resources/assets/bower/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="resources/assets/bower/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="resources/assets/bower/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="resources/assets/admin/css/common.css">

    <!-- jQuery 3 -->
    <script src="resources/assets/bower/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="resources/assets/bower/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Sparkline -->
    <script src="resources/assets/bower/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- daterangepicker -->
    <script src="resources/assets/bower/moment/min/moment.min.js"></script>
    <script src="resources/assets/bower/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="resources/assets/bower/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="resources/assets/bower/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="resources/assets/bower/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="resources/assets/bower/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="resources/assets/bower/admin-lte/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="resources/assets/bower/admin-lte/dist/js/demo.js"></script>
    <script src="resources/assets/admin/js/ckfinder/ckfinder.js"></script>
    <script>
        var dir_sub = '<?php echo DIR_SUB; ?>';
        var root_url = '<?php echo HTTP_ROOT; ?>';
    </script>
    <script src="resources/assets/admin/js/common.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="resources/assets/bower/admin-lte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo $username; ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" id="menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <?php foreach ($menu_items as $id => $item) { ?>
                    <?php if (isset($item['children'])) { ?>
                        <li class="treeview" id="m_<?php echo $item['id']; ?>">
                            <a href="<?php echo $item['href']; ?>">
                                <i class="fa <?php echo $item['icon']; ?>"></i> <span><?php echo $item['text']; ?></span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php foreach ($item['children'] as $child) { ?>
                                    <?php if (isset($child['children'])) { ?>
                                        <li class="treeview">
                                            <a href="<?php echo $child['href']; ?>">
                                                <i class="fa fa-circle-o"></i> <?php echo $child['text']; ?>
                                                <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                                            </a>
                                            <ul class="treeview-menu">
                                                <?php foreach ($child['children'] as $grandChild) { ?>
                                                    <li>
                                                        <a href="<?php echo $grandChild['href']; ?>">
                                                            <i class="fa fa-circle-o"></i> <?php echo $grandChild['text']; ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } else { ?>
                                        <li>
                                            <a href="<?php echo $child['href']; ?>">
                                                <i class="fa fa-circle-o"></i> <?php echo $child['text']; ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li id="m_<?php echo $item['id']; ?>">
                            <a href="<?php echo $item['href']; ?>">
                                <i class="fa <?php echo $item['icon']; ?>"></i> <span><?php echo $item['text']; ?></span>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
                <li class="header">LABELS</li>
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo urlLink('common/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <?php if ($breadcrumb['url']) { ?>
                        <li href="<?php $breadcrumb['url'] ?>"><?php echo $breadcrumb['name'] ?></li>
                    <?php } else { ?>
                        <li class="active"><?php echo $breadcrumb['name'] ?></li>
                    <?php } ?>
                <?php } ?>
            </ol>
            <br/>
            <?php if (isset($flash)) { ?>
                <div class="alert alert-<?php echo $flash['level'] ?>">
                    <i class="fa fa-check"></i>&nbsp;<?php echo $flash['message'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
        </section>