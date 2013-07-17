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
        <a class="course-readmore link-orange" href="<?php the_permalink(); ?>"><span>Xem chi tiết</span></a>
	</div>
</article>