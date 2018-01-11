<?php echo $header ?>
    <section class="content">
        <div class="text-right tools">
            <button type="submit" form="form-setting" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Lưu</button>
        </div>
        <form action="<?php echo urlLink('setting/setting') ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="form-setting">
            <div class="row">
                <div class="col-sm-6">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Thông tin trang</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-12" for="input-name">Tên Shop</label>
                                <div class="col-sm-12">
                                    <input type="text" name="config_name" value="<?php echo $config_name ?>" class="form-control" id="input-name" placeholder="Tên" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12" for="input-owner">Chủ shop</label>
                                <div class="col-sm-12">
                                    <input type="text" name="config_owner" value="<?php echo $config_owner ?>" class="form-control" id="input-owner" placeholder="Tên" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box box-success collapsed-box">
                        <div class="box-header">
                            <h3 class="box-title">Cấu hính kích thước ảnh</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <!--<div class="form-group">
                                <label class="col-sm-12" for="exampleInputEmail1">Email address</label>
                                <div class="col-sm-12">
                                    <input type="text" name="config_demo[]" class="form-control" id="exampleInputEmail1" placeholder="Email">
                                    <input type="text" name="config_demo[]" class="form-control" id="exampleInputEmail1" placeholder="Email">
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </section>
<?php echo $footer ?>