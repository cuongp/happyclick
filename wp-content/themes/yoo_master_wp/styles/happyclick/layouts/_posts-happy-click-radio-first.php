<?php
$arg1 = array(  'category_name' 	=> 'happy-click-radio',
                    'post_status'       => array( 'publish' ),
                    'type'				=> 'post',
                    'taxonomy'          => 'category',
                    'posts_per_page'	=> 1,
                    'orderby' 			=> 'date',
                    'order' 			=> 'DESC'
    );

$member_id       = 2;
$is_member     = current_user_on_level($member_id);
if(!$is_member){
    //Neu la visitor hoac trial thi cho xem bai sticky
    $arg1['post__in'] = get_option( 'sticky_posts' ); 
}
$the_query1 = new WP_Query($arg1);
while($the_query1->have_posts() ) {
			$the_query1->the_post();
			echo $this->render('_post-happy-click-radio-first');
}