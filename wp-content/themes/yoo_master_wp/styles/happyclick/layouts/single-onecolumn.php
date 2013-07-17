<div id="system" class="onecolumn single">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
    
            <div class="content-box1">
                <h3 class="content-box-title">Khóa học trực tuyến</h3>
                <div class="content-box-inside">
                    <a href="#" class="how-to-join">&nbsp;</a> 

                    <article id="item-<?php the_ID(); ?>" class="item courses" data-permalink="<?php the_permalink(); ?>">
                        <header class="course-wrapper">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php
                                $width = '295'; //get the width of the thumbnail setting
                                $height = '195'; //get the height of the thumbnail setting
                                ?>
                                <div class="course-thumbnail"><?php the_post_thumbnail(array($width, $height), array('class' => 'size-auto')); ?></div>
                            <?php endif; ?>
                            <div class="item-global-info">
                                <h3 class="course-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
                                <p>Thời gian: <strong>19:00 - 20:30</strong><br/>
                                    <strong><?php echo get_the_date('d/m/Y') ?></strong>
                                </p>
                                <p>
                                    Giảng viên: <strong>Trần Đình Dũng</strong>
                                </p>
                                <p class="register-links">
                                    <span class="course-link-wrapper"><a class="link-orange" href="#"><span>Trở thành thành viên</span></a></span>
                                    <span class="course-link-wrapper"><a class="link-orange" href="#" style="margin-right: 40px;"><span>Đăng ký</span></a><span class="course-note">(Chỉ dành cho thành viên)</span></span>
                                </p>
                            </div>
                        </header>
                        <div class="content clearfix">
                            <?php the_content(''); ?>
                            <br/>
                            <br/>
                            <h3>Thông tin về giảng viên</h3>
                            <div class="avatar"><img src="http://dev.happyclick.vn/wp-content/themes/yoo_master_wp/styles/happyclick/images/mr.trandinhdung.jpg"/></div>
                            <div class="author_info">
                                <h3 class="text-orange">Trần Đình Dũng</h3>
                                <p>Giám đốc Điều hành Khuê Văn Academy<br />
                                Thạc Sỹ Xã hội học – Đại Học Kinh Tế Chính Trị London – (LSE) Anh Quốc <br />
                                Cử Nhân Kinh Tế – Đại học Kinh tế TP. HCM </p>
                                <p style="text-align:right;"><a href="#" class="black-arrow">Xem thêm về tác giả</a></p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

		<?php endwhile; ?>
	<?php endif; ?>

</div>