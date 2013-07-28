
<h1><?php _e('Download tài liệu','warp'); ?></h1>
<?php

$arg = array(
	'category_name' 	=> 'download-tai-lieu',
    'post_status' 			=> array( 'publish' ),
	'type'						=> 'post',
	'taxonomy'             => 'category',
    'posts_per_page' 	=> 20,
    'orderby' 				=> 'date',
    'order' 					=> 'DESC'
);

$the_query = new WP_Query($arg);
while($the_query->have_posts()) {
	$the_query->the_post();
	echo $this->render('_post-download-tai-lieu');
}