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
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title"><?php echo $is_edit ? 'Chỉnh sửa tài khoản' : 'Thêm tài khoản' ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-12" for="input-name">Tên tài khoản</label>
                        <div class="col-sm-12">
                            <input type="text" name="name" value="<?php echo $name ?>" class="form-control" placeholder="Tên tài khoản"/>
                            <?php if ($error_name) { ?>
                                <p class="text-danger"><?php echo $error_name; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="box box-default collapsed-box">
                        <div class="box-header">
                            <h3 class="box-title">Tạo mật khẩu mới</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="col-sm-12">
                                <input type="text" name="password" class="form-control" placeholder="Mật khẩu ( > 2 kí tự )" pattern="(.{2,})|()"/>
                            </div>
                        </div>
                    </div>
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Trạng thái</h3>
                        </div>
                        <div class="box-body">
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
                <div class="col-sm-6">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Nhóm tài khoản</h3>
                        </div>
                        <div class="box-body">
                            <div class="well well-sm">
                                <?php foreach ($user_groups as $user_group) { ?>
                                    <div class="checkbox">
                                        <label>
                                            <?php if ($user_group['user_group_id'] == $user_group_id) { ?>
                                                <input type="radio" name="user_group_id" value="<?php echo $user_group['user_group_id']?>" checked="checked"> <?php echo $user_group['name'] ?>
                                            <?php } else { ?>
                                                <input type="radio" name="user_group_id" value="<?php echo $user_group['user_group_id']?>" > <?php echo $user_group['name'] ?>
                                            <?php } ?>
                                        </label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
<?php echo $footer ?>