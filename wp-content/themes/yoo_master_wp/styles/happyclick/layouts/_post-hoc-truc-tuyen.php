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
            <p class="delayed_msg">
                Bạn đã có thể bắt đầu đăng ký khóa học trực tuyến trong tháng 8/2013
            </p>
            <p class="register-links">
                
                <?php 
                $level_id       = 2; //Membership level "HappyClick"
                $link_class     = '';
                $is_membership  = current_user_on_level($level_id);
                // Tam thoi comment lai, 09/08 se mo tro lai
                $register_link  = get_bloginfo('url').'/thong-bao-dang-nhap/';
                if($is_membership){
                    $register_link  = 'javascript:void(0)';
                    $target         = '';
                    $link_class     = 'fancy iframe';
                    $webex_link     = get_post_custom_values('webex-link');
                    if($webex_link){
                        $register_link  = $webex_link[0];
                        $target         = 'target="_blank"';
                    }
                }
//                $register_link = 'javascript:void(0);';
                ?>
                <?php if(!$is_membership): ?>
                    <span class="course-link-wrapper"><a class="link-orange" href="<?php echo get_bloginfo('url'); ?>/category/thanh-vien/quyen-loi-thanh-vien/"><span>Trở thành thành viên</span></a></span>
                <?php endif; ?>
                <span class="course-link-wrapper"><a class="link-orange <?php echo $link_class; ?>" href="<?php echo $register_link; ?>" style="margin-right: 40px;" <?php echo $target; ?>><span>Đăng ký</span></a><span class="course-note">(Chỉ dành cho thành viên)</span></span>
            </p>
        </div>
    </header>
	<div class="content clearfix">
		<?php the_content(''); ?>
        <a class="course-readmore link-orange" href="<?php the_permalink(); ?>"><span>Xem chi tiết</span></a>
	</div>
</article>