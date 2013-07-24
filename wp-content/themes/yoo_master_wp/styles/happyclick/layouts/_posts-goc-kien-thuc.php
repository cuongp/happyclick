<?php
$arg_1 = array(
	'category_name' 	=> 'goc-kien-thuc',
    'post_status' 			=> array( 'publish' ),
	'type'						=> 'post',
	'taxonomy'             => 'category',
	'post__in'  => get_option( 'sticky_posts' ),
    'posts_per_page' 	=> 1,
    'orderby' 				=> 'date',
    'order' 					=> 'DESC'
);

$the_query_1 = new WP_Query($arg_1);
while($the_query_1->have_posts()) {
	$the_query_1->the_post(); ?>
	<div id="download_here"><a href="<?php echo the_permalink(); ?>" target="_blank"><?php _e('Mời các bạn tải tài liệu học tại đây','warp'); ?></div>

<?php }

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