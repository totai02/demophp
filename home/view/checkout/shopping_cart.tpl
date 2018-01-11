<?php echo $header; ?><?php echo $content_maintop; ?>
    <div class="container">
        <div class="row">
            <?php echo $column_left; ?>
            <?php if ($column_left && $column_right) { ?>
                <?php $class = 'col-sm-6'; ?>
            <?php } elseif ($column_left || $column_right) { ?>
                <?php $class = 'col-sm-9'; ?>
            <?php } else { ?>
                <?php $class = 'col-sm-12'; ?>
            <?php } ?>
            <div id="content" class="<?php echo $class; ?>">
                <?php echo $content_top; ?>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td class="text-center">Hình ảnh</td>
                        <td class="text-left">Tên</td>
                        <td class="text-left">Giá</td>
                        <td class="text-left">Số lượng</td>
                        <td class="text-right">Hành động</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($products) { ?>
                        <?php foreach ($products as $product) { ?>
                            <tr>
                                <td class="text-center">
                                    <?php if ($product['thumb']) { ?>
                                        <img src="<?php echo $product['thumb']; ?>"/>
                                    <?php } ?>
                                </td>
                                <td class="text-left"><?php echo $product['name']; ?></td>
                                <td class="text-left"><?php echo $product['price']; ?></td>
                                <td class="text-left"><?php echo $product['quantity']; ?></td>
                                <td class="text-right">
                                    <button type="button" onclick="cart.remove('<?php echo $product['key']; ?>');$(this).parents('tr').remove();" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xóa</button>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="5" class="text-center">Không có sản phẩm trong giỏ hàng</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="5" class="text-center">
                            <a href="<?php echo urlLink('checkout/checkout'); ?>" class="btn btn-primary">Thanh toán</a>
                        </td>
                    </tr>
                    </tfoot>
                </table>
                <?php echo $content_bottom; ?>
            </div>
            <?php echo $column_right; ?>
        </div>
    </div>
<?php echo $content_mainbottom; ?><?php echo $footer; ?>