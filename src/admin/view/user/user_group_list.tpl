<?php echo $header ?>
    <section class="content">
        <div class="text-right tools">
            <a href="<?php echo $add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Thêm</a>
            <button type="button" onclick="confirm('Bạn có chắc xóa không ?') ? $('#form-user-group').submit() : '';" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Xóa</button>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="form-user-group">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Danh sách nhóm tài khoản</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">
                                <input type="checkbox" onclick="$('input[name^=\'selected\']').prop('checked', this.checked)" />
                            </th>
                            <th class="text-left">Tên nhóm</th>
                            <th class="text-right">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user_groups as $user_group) {?>
                                <tr>
                                    <td class="text-center" style="width: 1px">
                                        <input type="checkbox" name="selected[]" value="<?php echo $user_group['user_group_id'] ?>" />
                                    </td>
                                    <td><?php echo $user_group['name'] ?></td>
                                    <td class="text-right">
                                        <a href="<?php echo $user_group['edit'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Sửa </a>
                                    </td>
                                </tr>
                            <?php }?>
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