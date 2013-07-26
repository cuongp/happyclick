<div id="system">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

            <article class="item" data-permalink="<?php the_permalink(); ?>">
                <div class="content clearfix">  
                    <div style="text-align:center; padding: 5em 0;">
                        <div class="border-blue">
                            <p>Nếu bạn đã là thành viên của Happy Click, vui lòng đăng nhập</p>
                            <div style="float: right; width: 125px;"><?php echo $this['modules']->render('login-modal'); ?></div>
                        </div>
                        <p>&nbsp;</p>
                        <div class="border-blue">
                            <p>Nếu bạn đã đăng ký xem thử hoặc chưa có tài khoản của Happy Click, bạn có thể trở thành
                                thành viên để được tham dự Học trực tuyến</p>
                            <p><a class="link-orange" href="http://dev.happyclick.vn/category/thanh-vien/quyen-loi-thanh-vien/"><span>Trở thành thành viên</span></a></p>
                        </div>
                        <div class="back-home"><a href="<?php echo get_bloginfo('url'); ?>">Trở về trang chủ</a></div>
                    </div>
                </div> 
                
            </article>

        <?php endwhile; ?>
    <?php endif; ?>

</div>