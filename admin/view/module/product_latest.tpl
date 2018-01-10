<?php echo $header ?>
    <section class="content">
        <div class="text-right tools">
            <button type="submit" form="form-user-group" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Lưu</button>
            <a href="<?php echo urlLink('extension/module'); ?>" class="btn btn-default"><i class="fa fa-backward"></i>&nbsp;Quay lại</a>
        </div>
        <form action="<?php echo urlLink('module/product_latest'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="form-user-group">
            <?php if ($error_warning) { ?>
                <div class="alert alert-danger"><?php echo $error_warning; ?></div>
            <?php } ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Tổng quan</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-12" for="input-width">Chiều rộng</label>
                                <div class="col-sm-12">
                                    <input type="text" name="product_latest_module[width]" id="input-width" value="<?php echo isset($module['width']) ? $module['width'] : '100'; ?>" class="form-control" placeholder="Chiều rộng"/>
                                    <?php if ($error_width) { ?>
                                        <p class="text-danger"><?php echo $error_width; ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12" for="input-height">Chiều cao</label>
                                <div class="col-sm-12">
                                    <input type="text" name="product_latest_module[height]" id="input-width" value="<?php echo isset($module['height']) ? $module['height'] : '100'; ?>" class="form-control" placeholder="Chiều cao"/>
                                    <?php if ($error_height) { ?>
                                        <p class="text-danger"><?php echo $error_height; ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="text-left">Bố cục</th>
                                            <th class="text-left">Vị trí</th>
                                            <th class="text-left">Sắp xếp</th>
                                            <th class="text-left">Trạng thái</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($layouts as $key => $layout) { ?>
                                            <tr>
                                                <td class="text-left"><?php echo $layout['name']; ?></td>
                                                <td class="text-left">
                                                    <select name="product_latest_module[layout][<?php echo $layout['code']; ?>][position]" class="form-control">
                                                        <?php foreach ($positions as $position) { ?>
                                                            <?php if (isset($module['layout']) && $position['code'] == $module['layout'][$layout['code']]['position']) { ?>
                                                                <option value="<?php echo $position['code']; ?>" selected="selected"><?php echo $position['name']; ?></option>
                                                            <?php } else { ?>
                                                                <option value="<?php echo $position['code']; ?>"><?php echo $position['name']; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td class="text-left">
                                                    <input type="text" name="product_latest_module[layout][<?php echo $layout['code']; ?>][sort_order]" value="<?php echo isset($module['layout']) ? $module['layout'][$layout['code']]['sort_order'] : '1' ?>" class="form-control"/>
                                                </td>
                                                <td class="text-left">
                                                    <select name="product_latest_module[layout][<?php echo $layout['code']; ?>][status]" class="form-control">
                                                        <?php if (isset($module['layout']) && $position['code'] == $module['layout'][$layout['code']]['position']) { ?>
                                                            <option value="1" selected="selected">Bật</option>
                                                            <option value="0">Tắt</option>
                                                        <?php } else { ?>
                                                            <option value="1">Bật</option>
                                                            <option value="0" selected="selected">Tắt</option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
<?php echo $footer ?>