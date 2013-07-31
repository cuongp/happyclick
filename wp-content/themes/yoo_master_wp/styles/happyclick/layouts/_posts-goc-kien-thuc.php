<div id="download_here">
    <a href="<?php echo get_site_url().'/category/download-tai-lieu'; ?>" target="_blank">
        <?php _e('Mời các bạn tải tài liệu học tại đây','warp'); ?>
    </a>
</div>
<?php
    $trial_id       = 1;
    $is_trial       = current_user_on_level($trial_id);
    if($is_trial):
        echo '<div style="text-align:center"><span style="color:#F20000;">Bạn được xem thử bài viết đầu tiên.</span></div>';
    endif;
    ?>
<?php 

$arg = array(
	'category_name' 	=> 'goc-kien-thuc',
    'post_status' 			=> array( 'publish' ),
	'type'						=> 'post',
	'taxonomy'             => 'category',
	'post__not_in'  => get_option( 'sticky_posts' ),
    'posts_per_page' 	=> 10,
    'orderby' 				=> 'date',
    'order' 					=> 'DESC'
);

$the_query = new WP_Query($arg);

while($the_query->have_posts()) {
	$the_query -> the_post();
	
	echo $this->render('_post-goc-kien-thuc');	
}