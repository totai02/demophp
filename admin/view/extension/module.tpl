<?php echo $header ?>
    <section class="content">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Danh sách mô-đun</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 85px;">Trạng thái</th>
                        <th class="text-left">Tên mô-đun</th>
                        <th class="text-right">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($extensions as $extension) { ?>
                        <tr>
                            <td class="text-center">
                                <i class="fa fa-dot-circle-o <?php echo $extension['installed'] ? 'text-success' : 'text-danger'; ?>"></i>
                            </td>
                            <td><?php echo $extension['name'] ?></td>
                            <td class="text-right">
                                <?php if ($extension['installed']) { ?>
                                    <a href="<?php echo $extension['edit']; ?>" data-toggle="tooltip" title="Sửa" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Sửa</a>
                                    <a onclick="confirm('Bạn có chắc không') ? location.href='<?php echo $extension['uninstall']; ?>' : false;" data-toggle="tooltip" title="Gỡ cài đặt" class="btn btn-danger btn-sm"><i class="fa fa-minus-circle"></i> Gỡ cài đặt</a>
                                <?php } else { ?>
                                    <a href="<?php echo $extension['install']; ?>" data-toggle="tooltip" title="Gỡ cài đặt" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Cài đặt</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php echo $footer ?>