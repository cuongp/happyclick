<?php 
	global $post_count_chia_se;
	
	//check visitor, member, trial
	
	$trial_id = 1;
	$is_trial = current_user_on_level($trial_id);
	$is_trialview   = is_sticky() && $is_trial;
	$member_id = 2;
	$is_member = current_user_on_level($member_id);
	
	if($is_trialview || $is_member ):	
		if($post_count_chia_se != 0) {
			$post_count_chia_se = 0;
		}

		$arg = array(
				'category_name'			=> 'goc-chia-se',
				'post_status'					=> array('publish'),
				'type'								=> 'post',
				'taxonomy'						=> 'category',
				'posts_per_page'				=> 10,
				'orderby'						=> 'date',
				'order'							=> 'DESC'
		);

		$the_query = new WP_Query($arg);
		while($the_query->have_posts()) {
			$post_count_chia_se++ ;
			$the_query->the_post();
			echo $this->render('_post-goc-chia-se');
		}
	else:
        do_shortcode('[level-member]');
	endif;	
	