<?php echo $header ?>
    <section class="content">
        <div class="text-right tools">
            <button type="submit" form="form-user-group" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Lưu</button>
            <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-backward"></i>&nbsp;Quay lại</a>
        </div>
        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="form-user-group">
            <?php if ($error_warning) { ?>
                <div class="alert alert-danger"><?php echo $error_warning; ?></div>
            <?php } ?>
            <div class="row">
                <div class="col-sm-8">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Tổng quan</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-12" for="input-name">Tên</label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" id="input-name" value="<?php echo $name; ?>" class="form-control" placeholder="Tên"/>
                                    <?php if ($error_name) { ?>
                                        <p class="text-danger"><?php echo $error_name; ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12" for="input-description">Mô tả</label>
                                <div class="col-sm-12">
                                    <textarea name="description" id="input-description" class="form-control" placeholder="Mô tả"><?php echo $description; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12" for="input-tag">Tag</label>
                                <div class="col-sm-12">
                                    <textarea name="tag" id="input-tag" class="form-control" placeholder="Tag cách nhau bởi dấu ,(phẩy)"><?php echo $tag; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Hình ảnh</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-12 text-center" for="input-image">Ảnh đại diện</label>
                                <div class="col-sm-12 text-center">
                                    <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail img-bordered">
                                        <img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $no_image; ?>"/>
                                    </a>
                                    <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image"/>
                                </div>
                            </div>
                            <hr/>
                            <div class="row __image">
                                <?php $image_row = 0; ?>
                                <?php foreach ($product_images as $product_image) { ?>
                                    <div class="col-sm-2 text-center" style="margin-bottom: 20px;">
                                        <a href="" id="thumb-image-<?php echo $image_row ?>" data-toggle="image" class="img-thumbnail img-bordered" style="display: inline-block;width: 100px;height: 100px;">
                                            <img src="<?php echo $product_image['thumb']; ?>" class="img-responsive" alt="" title="" data-placeholder="<?php echo $no_image; ?>"/>
                                        </a>
                                        <input type="hidden" name="product_image[<?php echo $image_row ?>]" value="<?php echo $product_image['image']; ?>" id="input-image-<?php echo $image_row ?>"/>
                                        <hr/>
                                        <button type="button" onclick="$(this).parent().remove();" class="btn btn-danger btn-sm btn-block"><i class="fa fa-trash"></i>&nbsp;Xóa</button>
                                    </div>
                                    <?php $image_row++; ?>
                                <?php } ?>
                                <div class="col-sm-2 text-center" style="margin-bottom: 20px;">
                                    <a href="javascript:;" onclick="addImage();" class="img-thumbnail img-bordered text-center" style="display: inline-block;width: 100px;height: 100px;">
                                        <i class="fa fa-plus fa-4x" style="margin-top: 18px;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Thuộc tính sản phẩm</h3>
                        </div>
                        <div class="box-body">
                            <table class="table __attribute">
                                <thead>
                                <tr>
                                    <th>Thuộc tính</th>
                                    <th>Mô tả</th>
                                    <th>Sắp xếp</th>
                                    <th class="text-right">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $attribute_row = 0; ?>
                                <?php foreach ($product_attributes as $product_attribute) { ?>
                                    <tr>
                                        <td>
                                            <select name="product_attribute[<?php echo $attribute_row; ?>][attribute_id]" class="form-control">
                                                <?php foreach ($attributes as $attribute) { ?>
                                                    <?php if ($attribute['attribute_id'] == $product_attribute['attribute_id']) { ?>
                                                        <option value="<?php echo $attribute['attribute_id']; ?>" selected="selected"><?php echo $attribute['name'] ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo $attribute['attribute_id']; ?>"><?php echo $attribute['name'] ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <textarea name="product_attribute[<?php echo $attribute_row; ?>][description]" rows="3" class="form-control"><?php echo $product_attribute['description'] ?></textarea>
                                        </td>
                                        <td>
                                            <input type="text" name="product_attribute[<?php echo $attribute_row; ?>][sort_order]" value="<?php echo $product_attribute['sort_order'] ?>" class="form-control"/>
                                        </td>
                                        <td class="text-right">
                                            <button type="button" onclick="$(this).parent().parent().remove();" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Xóa</button>
                                        </td>
                                    </tr>
                                    <?php $attribute_row++; ?>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="text-center" colspan="4">
                                        <button type="button" class="btn btn-primary" onclick="addAttribute()"><i class="fa fa-plus"></i>&nbsp;Thêm thuộc tính</button>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Khuyến mại</h3>
                        </div>
                        <div class="box-body">
                            <table class="table __sale">
                                <thead>
                                <tr>
                                    <th>Giá</th>
                                    <th>Từ ngày</th>
                                    <th>Đến ngày</th>
                                    <th class="text-right">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sale_row = 0; ?>
                                <?php foreach ($product_sales as $product_sale) { ?>
                                    <tr>
                                        <td>
                                            <input type="text" name="product_sale[<?php echo $sale_row; ?>][price]" value="<?php echo $product_sale['price'] ?>" class="form-control"/>
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="text" name="product_sale[<?php echo $sale_row; ?>][from_at]" value="<?php echo $product_sale['from_at'] ?>" class="form-control date"/>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="text" name="product_sale[<?php echo $sale_row; ?>][to_at]" value="<?php echo $product_sale['to_at'] ?>" class="form-control date"/>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <button type="button" onclick="$(this).parent().parent().remove();" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Xóa</button>
                                        </td>
                                    </tr>
                                    <?php $sale_row++; ?>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="text-center" colspan="4">
                                        <button type="button" class="btn btn-primary" onclick="addSale()"><i class="fa fa-plus"></i>&nbsp;Thêm khuyến mại</button>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Liên kết</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-12" for="input-price">Giá</label>
                                <div class="col-sm-12">
                                    <input type="text" name="price" id="input-price" value="<?php echo $price; ?>" class="form-control" placeholder="Giá"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12" for="input-parent">Danh mục</label>
                                <div class="col-sm-12">
                                    <div class="well well-sm">
                                        <?php foreach ($categories as $category) { ?>
                                            <div class="checkbox">
                                                <label>
                                                    <?php if (in_array($category['category_id'], $product_category)) { ?>
                                                        <input type="checkbox" name="product_category[]" value="<?php echo $category['category_id']; ?>" checked="checked"/>&nbsp;<?php echo $category['name']; ?>
                                                    <?php } else { ?>
                                                        <input type="checkbox" name="product_category[]" value="<?php echo $category['category_id']; ?>"/>&nbsp;<?php echo $category['name']; ?>
                                                    <?php } ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12" for="input-color">Màu sản phẩm</label>
                                <div class="col-sm-12">
                                    <div class="well well-sm">
                                        <?php foreach ($colors as $color) { ?>
                                            <div class="checkbox">
                                                <label>
                                                    <?php if (in_array($color['color_id'], $product_color)) { ?>
                                                        <input type="checkbox" name="product_color[]" value="<?php echo $color['color_id']; ?>" checked="checked"/>&nbsp;<?php echo $color['name']; ?>
                                                    <?php } else { ?>
                                                        <input type="checkbox" name="product_color[]" value="<?php echo $color['color_id']; ?>"/>&nbsp;<?php echo $color['name']; ?>
                                                    <?php } ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Xuất bản</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-12" for="input-status">Trạng thái</label>
                                <div class="col-sm-12">
                                    <select name="status" class="form-control" id="input-status">
                                        <?php if ($status) { ?>
                                            <option value="1" selected="selected">Bật</option>
                                            <option value="0">Tắt</option>
                                        <?php } else { ?>
                                            <option value="1">Bật</option>
                                            <option value="0" selected="selected">Tắt</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <script src="<?php echo assets_url('bower/ckeditor/ckeditor.js') ?>"></script>
    <script>
        CKEDITOR.replace('input-description');
    </script>
    <script>
        // image
        var image_row = parseInt('<?php echo $image_row; ?>');

        function addImage() {
            var html = '';

            html += '<div class="col-sm-2 text-center" style="margin-bottom: 20px;">';
            html += '<a href="" id="thumb-image-' + image_row + '" data-toggle="image" class="img-thumbnail img-bordered" style="display: inline-block;width: 100px;height: 100px;">';
            html += '<img src="<?php echo $no_image; ?>" class="img-responsive" alt="" title="" data-placeholder="<?php echo $no_image; ?>"/>';
            html += '</a>';
            html += '<input type="hidden" name="product_image[' + image_row + ']" value="" id="input-image-' + image_row + '"/>';
            html += '<hr /><button type="button" onclick="$(this).parent().remove();" class="btn btn-danger btn-sm btn-block"><i class="fa fa-trash"></i>&nbsp;Xóa</button>';
            html += '</div>';

            $('.__image').prepend(html);

            image_row++;
        }

        // attribute
        var attribute_row = parseInt('<?php echo $attribute_row; ?>');

        function addAttribute() {
            var html = '';

            html += '<tr>';
            html += '    <td>';
            html += '        <select name="product_attribute[' + attribute_row + '][attribute_id]" class="form-control">';
            <?php foreach ($attributes as $attribute) { ?>
            html += '                    <option value="<?php echo $attribute['attribute_id']; ?>"><?php echo $attribute['name'] ?></option>';
            <?php } ?>
            html += '        </select>';
            html += '    </td>';
            html += '    <td>';
            html += '        <textarea name="product_attribute[' + attribute_row + '][description]" rows="3" class="form-control"></textarea>';
            html += '    </td>';
            html += '    <td>';
            html += '        <input type="text" name="product_attribute[' + attribute_row + '][sort_order]" value="" class="form-control" />';
            html += '    </td>';
            html += '    <td class="text-right">';
            html += '        <button type="button" onclick="$(this).parent().parent().remove();" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Xóa</button>';
            html += '    </td>';
            html += '</tr>';

            $('.__attribute tbody').append(html);

            attribute_row++;
        }

        // sale
        var sale_row = parseInt('<?php echo $sale_row; ?>');

        function addSale() {
            var html = '';

            html += '<tr>';
            html += '<td>';
            html += '    <input type="text" name="product_sale[' + sale_row + '][price]" value="" class="form-control"/>';
            html += '</td>';
            html += '<td>';
            html += '    <div class="input-group date">';
            html += '        <span class="input-group-addon">';
            html += '            <i class="fa fa-calendar"></i>';
            html += '        </span>';
            html += '        <input type="text" name="product_sale[' + sale_row + '][from_at]" value="" class="form-control date"/>';
            html += '    </div>';
            html += '</td>';
            html += '<td>';
            html += '    <div class="input-group date">';
            html += '        <span class="input-group-addon">';
            html += '            <i class="fa fa-calendar"></i>';
            html += '        </span>';
            html += '        <input type="text" name="product_sale[' + sale_row + '][to_at]" value="" class="form-control date"/>';
            html += '    </div>';
            html += '</td>';
            html += '<td class="text-right">';
            html += '    <button type="button" onclick="$(this).parent().parent().remove();" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Xóa</button>';
            html += '</td>';
            html += '</tr>';

            $('.__sale tbody').append(html);

            $('.date').datepicker({
                autoclose: true
            });

            sale_row++;
        }
    </script>

    <script>
        $('.date').datepicker({
            autoclose: true
        });
    </script>
<?php echo $footer ?>