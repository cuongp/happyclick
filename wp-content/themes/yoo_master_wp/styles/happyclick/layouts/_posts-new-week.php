<?php 
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

$args = array(
    'category_name' => 'khoi-dong-tuan-moi',
    'post_status' => array( 'publish' ),
    'posts_per_page' => 1,
    'orderby' => 'date',
    'order' => 'ASC'
);

$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) {
	$the_query->the_post();
    echo $this->render('_post-new-week');
}