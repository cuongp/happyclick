<?php 
	global $post_count_chia_se;
	
	if($post_count_chia_se != 0) {
		$post_count_chia_se = 0;
	}
	
	$arg = array(
			'category_name'			=> 'goc-chia-se',
			'post_status'					=> array('publish'),
			'type'								=> 'post',
			'taxonomy'						=> 'category',
			'posts_per_page'				=> 15,
			'orderby'						=> 'date',
			'order'							=> 'DESC'
	);
	
	$the_query = new WP_Query($arg);
	while($the_query->have_posts()) {
		$post_count_chia_se++ ;
		$the_query->the_post();
		if($post_count_chia_se == 1) {
			echo $this->render('_post-goc-chia-se-first');
		} else {
			echo $this->render('_post-goc-chia-se');
		}	
	}