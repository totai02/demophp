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
                <div class="row">
                    <?php if ($column_left && $column_right) { ?>
                        <?php $class = 'col-sm-6'; ?>
                    <?php } elseif ($column_left || $column_right) { ?>
                        <?php $class = 'col-sm-6'; ?>
                    <?php } else { ?>
                        <?php $class = 'col-sm-8'; ?>
                    <?php } ?>
                    <div class="<?php echo $class; ?>">
                        <?php if ($thumb || $images) { ?>
                            <ul class="thumbnails">
                                <?php if ($thumb) { ?>
                                    <li><a class="thumbnail" href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>"/></a></li>
                                <?php } ?>
                                <?php if ($images) { ?>
                                    <?php foreach ($images as $image) { ?>
                                        <li class="image-additional"><a class="thumbnail" href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>"> <img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>"/></a></li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-description" data-toggle="tab">Mô tả</a></li>
                            <?php if ($attributes) { ?>
                                <li><a href="#tab-specification" data-toggle="tab">Thuộc tính</a></li>
                            <?php } ?>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-description"><?php echo $description; ?></div>
                            <?php if ($attributes) { ?>
                                <div class="tab-pane" id="tab-specification">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <?php foreach ($attributes as $attribute) { ?>
                                            <tr>
                                                <td><?php echo $attribute['name']; ?></td>
                                                <td><?php echo $attribute['description']; ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if ($column_left && $column_right) { ?>
                        <?php $class = 'col-sm-6'; ?>
                    <?php } elseif ($column_left || $column_right) { ?>
                        <?php $class = 'col-sm-6'; ?>
                    <?php } else { ?>
                        <?php $class = 'col-sm-4'; ?>
                    <?php } ?>
                    <div class="<?php echo $class; ?>">
                        <h1><?php echo $heading_title; ?></h1>
                        <?php if ($price) { ?>
                            <ul class="list-unstyled">
                                <?php if (!$sale) { ?>
                                    <li>
                                        <h2><?php echo $price; ?></h2>
                                    </li>
                                <?php } else { ?>
                                    <li><span style="text-decoration: line-through;"><?php echo $price; ?></span></li>
                                    <li>
                                        <h2><?php echo $sale; ?></h2>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                        <hr/>
                        <?php if ($colors) { ?>
                            <p>Màu sản phẩm</p>
                            <ul class="">
                                <?php foreach ($colors as $color) { ?>
                                    <li><?php echo $color['name']; ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                        <hr/>
                        <div class="form-group">
                            <label class="control-label" for="input-quantity">Số lượng</label>
                            <input type="text" name="quantity" value="<?php echo $minimum; ?>" size="2" id="input-quantity" class="form-control"/>
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>"/>
                            <br/>
                            <button type="button" id="button-cart" data-loading-text="loading..." class="btn btn-primary btn-lg btn-block">Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>
                <?php if ($tags) { ?>
                    <p>Tag
                        <?php for ($i = 0; $i < count($tags); $i++) { ?>
                            <?php if ($i < (count($tags) - 1)) { ?>
                                <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
                            <?php } else { ?>
                                <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
                            <?php } ?>
                        <?php } ?>
                    </p>
                <?php } ?>
                <?php echo $content_bottom; ?>
            </div>
            <?php echo $column_right; ?>
        </div>
    </div>
    <script type="text/javascript"><!--
        $('#button-cart').on('click', function () {
            $.ajax({
                url: 'index.php?route=checkout/cart/add',
                type: 'post',
                data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
                dataType: 'json',
                beforeSend: function () {
                    $('#button-cart').button('loading');
                },
                complete: function () {
                    $('#button-cart').button('reset');
                },
                success: function (json) {
                    $('.alert, .text-danger').remove();
                    $('.form-group').removeClass('has-error');

                    if (json['error']) {
                        if (json['error']['option']) {
                            for (i in json['error']['option']) {
                                var element = $('#input-option' + i.replace('_', '-'));

                                if (element.parent().hasClass('input-group')) {
                                    element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                                } else {
                                    element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                                }
                            }
                        }

                        if (json['error']['recurring']) {
                            $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
                        }

                        // Highlight any found errors
                        $('.text-danger').parent().addClass('has-error');
                    }

                    if (json['success']) {
                        $('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                        $('#cart-total').html(json['total']);

                        $('html, body').animate({scrollTop: 0}, 'slow');

                        $('#cart > ul').load('index.php?route=common/cart/info ul li');
                    }
                }
            });
        });
        //--></script>
    <script type="text/javascript"><!--
        $(document).ready(function () {
            $('.thumbnails').magnificPopup({
                type: 'image',
                delegate: 'a',
                gallery: {
                    enabled: true
                }
            });
        });
        //--></script>
<?php echo $footer; ?>