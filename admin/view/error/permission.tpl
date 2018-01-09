<?php echo $header ?>
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-red"> 400</h2>

            <div class="error-content">
                <h3><i class="fa fa-warning text-red"></i> Không có quyền truy cập</h3>
                <p>
                    Bạn không có quyền truy cập trang này
                    Bạn có thể <a href="<?php echo urlLink('common/dashboard'); ?>">quay lại dashboard</a> hoặc liên hệ với admin.
                </p>
            </div>
        </div>
    </section>
<?php echo $footer ?>