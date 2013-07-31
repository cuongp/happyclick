
<?php //<h1><?php _e('Download tài liệu','warp'); </h1> ?>
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

	$member_id      = 2; //Membership level "HappyClick"
    $trial_id       = 1; //Trial level
    $is_membership  = current_user_on_level($member_id);
    $is_trial       = current_user_on_level($trial_id);
if($is_membership):
	$the_query = new WP_Query($arg);
	while($the_query->have_posts()) {
		$the_query->the_post();
		echo $this->render('_post-download-tai-lieu');
	}
else: ?>
	<div class="download-notify">
	<?php echo do_shortcode('[level-member]'); ?>
	</div>
<?php endif;
	
	