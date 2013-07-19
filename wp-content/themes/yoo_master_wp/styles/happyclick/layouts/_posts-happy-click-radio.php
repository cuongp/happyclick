<?php

$args = array(
    'category_name' 	=> 'happy-click-radio',
    'post_status' 			=> array( 'publish' ),
	'type'						=> 'post',
	'taxonomy'             => 'category',
    'posts_per_page' 	=> 9,
    'orderby' 				=> 'date',
    'order' 					=> 'DESC'
);

global $post_count_radio;

if($post_count_radio != 0) {
	$post_count_radio = 0;
}

$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) {
	$the_query->the_post();
	$post_count_radio++;
    echo $this->render('_post-happy-click-radio');
}
