<!DOCTYPE html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <script src="resources/assets/bower/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="resources/assets/bower/bootstrap/dist/css/bootstrap.min.css">
    <script src="resources/assets/bower/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="resources/assets/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="resources/assets/home/css/common.css">
    <script src="resources/assets/home/js/common.js"></script>
</head>
<body class="class">
<nav id="top">
    <div class="container">
        <div id="top-links" class="nav pull-right">
            <ul class="list-inline">
                <li>
                    <a href="<?php echo $contact; ?>"><i class="fa fa-phone"></i></a>
                    <span class="hidden-xs hidden-sm hidden-md"><?php echo $phone; ?></span>
                </li>
                <li>
                    <a href="<?php echo $shopping_cart; ?>" title="Giỏ hàng">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="hidden-xs hidden-sm hidden-md">Giỏ hàng</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $checkout; ?>" title="Thanh toán">
                        <i class="fa fa-share"></i>
                        <span class="hidden-xs hidden-sm hidden-md">Thanh toán</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div id="logo">
                    <?php if ($logo) { ?>
                        <a href="<?php echo $home; ?>">
                            <img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive"/>
                        </a>
                    <?php } else { ?>
                        <h1>
                            <a href="<?php echo $home; ?>"><?php echo $name; ?></a>
                        </h1>
                    <?php } ?>
                </div>
            </div>
            <!--            <div class="col-sm-5">{{ search }}</div>-->
            <!--            <div class="col-sm-3">{{ cart }}</div>-->
        </div>
    </div>
</header>
<?php if ($categories) { ?>
<div class="container">
    <nav id="menu" class="navbar">
        <div class="navbar-header"><span id="category" class="visible-xs">Danh mục</span>
            <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <?php foreach ($categories as $category) { ?>
                    <?php if ($category['children']) { ?>
                        <li class="dropdown"><a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?></a>
                            <div class="dropdown-menu">
                                <div class="dropdown-inner">
                                    <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
                                        <ul class="list-unstyled">
                                            <?php foreach ($children as $child) { ?>
                                                <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </div>
                                <a href="<?php echo $category['href']; ?>" class="see-all">Xem tất cả <?php echo $category['name']; ?></a> </div>
                        </li>
                    <?php } else { ?>
                        <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </nav>
</div>
<?php } ?>