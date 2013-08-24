<li class="jcarousel-item jcarousel-item-horizontal video-item">
    <?php
    //Da rao noi dung trong trang single, bo phan rao link, tao link binh thuong de lam SEO
//    $member_id      = 2; //Membership level "HappyClick"
    $trial_id       = 1; //Trial level
//    $is_membership  = current_user_on_level($member_id);
    $is_trial       = current_user_on_level($trial_id);

    $sticky = (is_sticky() && $is_trial) ? 'sticky_video' : '';

//    $video_link     = get_bloginfo('url').'/thong-bao-dang-nhap';
//    if($is_membership || $sticky!=''){
        $video_link = get_permalink();
//    }
    ?>
    <a href="<?php echo $video_link; ?>" class="iframe">
        <span class="sticky_span <?php echo $sticky; ?>">&nbsp;</span>
        <div class="course-video-thumb">
            <?php if (has_post_thumbnail()) : ?>
                <?php
                $width = '185'; //get the width of the thumbnail setting
                $height = '105'; //get the height of the thumbnail setting
                ?>
                <?php the_post_thumbnail(array($width, $height), array('class' => 'size-auto')); ?>
            <?php endif; ?>
        </div>
    </a>
    <a href="<?php echo $video_link; ?>"><?php the_title() ?></a>
</li>