<div id="download_here"><a href="#" target="_blank"><?php _e('Mời các bạn tải tài liệu học tại đây','warp'); ?></div>
<?php

$arg = array(
	'category_name' 	=> 'goc-kien-thuc',
    'post_status' 			=> array( 'publish' ),
	'type'						=> 'post',
	'taxonomy'             => 'category',
    'posts_per_page' 	=> 10,
    'orderby' 				=> 'date',
    'order' 					=> 'DESC'
);

$the_query = new WP_Query($arg);
while($the_query->have_posts()) {
	$the_query -> the_post();
	echo $this->render('_post-goc-kien-thuc');	
}