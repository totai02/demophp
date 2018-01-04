<?php echo $header ?>
    <section class="content">
        <div class="text-right tools">
            <button type="submit" form="form-user-group" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Lưu</button>
            <a href="<?php echo urlLink('user/user_group_list') ?>" class="btn btn-default"><i class="fa fa-backward"></i>&nbsp;Quay lại</a>
        </div>
        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="form-user-group">
            <?php if ($error_warning) { ?>
                <div class="alert alert-danger"><?php echo $error_warning; ?></div>
            <?php } ?>
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title"><?php echo $is_edit ? 'Chỉnh sửa nhóm tài khoản' : 'Thêm nhóm tài khoản' ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-12" for="input-name">Tên nhóm</label>
                        <div class="col-sm-12">
                            <input type="text" name="name" value="<?php echo $name ?>" class="form-control" placeholder="Tên nhóm"/>
                            <?php if ($error_name) { ?>
                                <p class="text-danger"><?php echo $error_name; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Quyền truy cập</h3>
                        </div>
                        <div class="box-body">
                            <div class="well well-sm">
                                <?php foreach ($routes as $route) { ?>
                                    <div class="checkbox">
                                        <label>
                                            <?php if (isset($permission['access']) && in_array($route, $permission['access'])) { ?>
                                                <input type="checkbox" name="permission[access][]" value="<?php echo $route ?>" checked="checked"> <?php echo $route ?>
                                            <?php } else { ?>
                                                <input type="checkbox" name="permission[access][]" value="<?php echo $route ?>"> <?php echo $route ?>
                                            <?php } ?>
                                        </label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Quyền thay đổi</h3>
                        </div>
                        <div class="box-body">
                            <div class="well well-sm">
                                <?php foreach ($routes as $route) { ?>
                                    <div class="checkbox">
                                        <label>
                                            <?php if (isset($permission['modify']) && in_array($route, $permission['modify'])) { ?>
                                                <input type="checkbox" name="permission[modify][]" value="<?php echo $route ?>" checked="checked"> <?php echo $route ?>
                                            <?php } else { ?>
                                                <input type="checkbox" name="permission[modify][]" value="<?php echo $route ?>"> <?php echo $route ?>
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