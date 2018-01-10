<script>
    function getUrl() {
        var filters = <?php echo json_encode($filters);?>;
        var url = '<?php echo $pre_search ?>';
        var urls = [];
        for (var key in filters) {
            if ($('#input_' + key)[0].checked) {
                urls.push(key);
            }
        }
        if (urls.toString() != '') {
            url += "&" + "search=" + urls.toString();
            url += "&" + "key=" + $('#txtSearch')[0].value;
        }
        window.location.href = url;
    }
</script>
<?php echo $header ?>
<section class="content">
    <div class="text-right tools">
        <a href="<?php echo $add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Thêm</a>
        <button type="button" onclick="confirm('Bạn có chắc xóa không ?') ? $('#form-product').submit() : '';" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Xóa</button>
    </div>
    <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="form-product">
        <div class="box box-success">
            <div class="box-header">
                <div class="col-sm-6">
                    <div class="vertical">
                        <h2 class="box-title"><strong>Danh sách danh mục</strong></h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input-group margin">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Lọc
                                <span class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu list-group">

                                <?php foreach ($filters as $key => $value) { ?>
                                    <li class="list-group-item">
                                        <div>
                                            <input type="checkbox" name="filters[<?php echo $key ?>]" id="input_<?php echo $key; ?>" checked="true">&nbsp;&nbsp;<?php echo $value ?>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- /btn-group -->
                        <input type="text" class="form-control" id="txtSearch" value="<?php if (!empty($search_key)) echo $search_key; else echo "";?>">
                        <span class="input-group-btn">
                                <a href="javascript:getUrl()" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;Tìm kiếm</a>
                            </span>
                    </div>
                </div>

            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">
                            <input type="checkbox" onclick="$('input[name^=\'selected\']').prop('checked', this.checked)"/>
                        </th>
                        <th class="text-left">Tên danh mục</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-right">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product) { ?>
                        <tr>
                            <td class="text-center" style="width: 1px">
                                <input type="checkbox" name="selected[]" value="<?php echo $product['product_id'] ?>"/>
                            </td>
                            <td><?php echo $product['name'] ?></td>
                            <td class="text-center">
                                <?php if ($product['status']) { ?>
                                    <i class="fa fa-check-circle text-success"></i>
                                <?php } else { ?>
                                    <i class="fa fa-minus-circle text-danger"></i>
                                <?php } ?>
                            </td>
                            <td class="text-right">
                                <a href="<?php echo $product['edit'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Sửa </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-6"><?php echo $pagination; ?></div>
                </div>
            </div>
        </div>
    </form>
</section>
<?php echo $footer ?>