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
                                <label class="col-sm-12" for="input-name">Tên danh mục</label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" id="input-name" value="<?php echo $name; ?>" class="form-control" placeholder="Tên nhóm"/>
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
                                <label class="col-sm-12" for="input-parent">Danh mục cha</label>
                                <div class="col-sm-12">
                                    <select name="parent_id" id="input-parent" class="form-control">
                                        <option value="0">-- Không --</option>
                                        <?php foreach ($categories as $category) { ?>
                                            <?php if ($category['category_id'] == $parent_id) { ?>
                                                <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12" for="input-image">Ảnh đại diện</label>
                                <div class="col-sm-12">
                                    <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail img-bordered">
                                        <img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $no_image; ?>"/>
                                    </a>
                                    <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
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
<?php echo $footer ?>