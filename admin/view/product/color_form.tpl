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
                <div class="col-sm-12">
                    <div class="box box-default">
                        <div class="box-header">
                            <h3 class="box-title">Tổng quan</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-12" for="input-name">Tên màu</label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" id="input-name" value="<?php echo $name; ?>" class="form-control" placeholder="Tên nhóm"/>
                                    <?php if ($error_name) { ?>
                                        <p class="text-danger"><?php echo $error_name; ?></p>
                                    <?php } ?>
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
<?php echo $footer ?>