<?php echo $header ?>
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>

            <div class="error-content">
                <h3><i class="fa fa-warning text-yellow"></i> Lỗi! Không tìm thấy trang.</h3>
                <p>
                    Chúng tôi không tìm thấy trang bạn truy cập
                    Bạn có thể <a href="<?php echo urlLink('common/dashboard'); ?>">quay lại dashboard</a> hoặc liên hệ với admin.
                </p>
            </div>
        </div>
    </section>
<?php echo $footer ?>