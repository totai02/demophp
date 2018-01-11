<?php echo $header; ?>
    <div class="container">
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
        </ul>
        <div class="row"><?php echo $column_left; ?>
            <?php if ($column_left && $column_right) { ?>
                <?php $class = 'col-sm-6'; ?>
            <?php } elseif ($column_left || $column_right) { ?>
                <?php $class = 'col-sm-9'; ?>
            <?php } else { ?>
                <?php $class = 'col-sm-12'; ?>
            <?php } ?>
            <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
                <h2><?php echo $heading_title; ?></h2>
                <?php if ($description) { ?>
                    <div class="row">
                        <?php if ($description) { ?>
                            <div class="col-sm-10"><?php echo $description; ?></div>
                        <?php } ?>
                    </div>
                    <hr>
                <?php } ?>
                <?php if ($categories) { ?>
                    <h3>Danh mục con</h3>
                    <?php if (count($categories) <= 5) { ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <ul>
                                    <?php foreach ($categories as $category) { ?>
                                        <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <?php foreach (array_chunk($categories, ceil(count($categories) / 4)) as $categories) { ?>
                                <div class="col-sm-3">
                                    <ul>
                                        <?php foreach ($categories as $category) { ?>
                                            <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                <?php if ($products) { ?>
                    <div class="row">
                        <?php foreach ($products as $product) { ?>
                            <div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="product-thumb">
                                    <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
                                    <div>
                                        <div class="caption">
                                            <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                                            <p><?php echo $product['description']; ?></p>
                                            <?php if ($product['price']) { ?>
                                                <p class="price">
                                                    <?php if (!$product['sale']) { ?>
                                                        <?php echo $product['price']; ?>
                                                    <?php } else { ?>
                                                        <span class="price-new"><?php echo $product['sale']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                                                    <?php } ?>
                                                </p>
                                            <?php } ?>
                                        </div>
                                        <div class="button-group">
                                            <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Thêm vào giỏ</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                    </div>
                <?php } ?>
                <?php if (!$categories && !$products) { ?>
                    <p>Không có sản phẩm</p>
                    <div class="buttons">
                        <div class="pull-right"><a href="<?php echo urlLink('common/home'); ?>" class="btn btn-primary">Trang chủ</a></div>
                    </div>
                <?php } ?>
                <?php echo $content_bottom; ?></div>
            <?php echo $column_right; ?></div>
    </div>
<?php echo $footer; ?>