<?php 
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// init vars
//$colcount = is_front_page() ? $this['config']->get('multicolumns', 1) : 1;
//$count    = $this['system']->getPostCount();
//$rows     = ceil($count / $colcount);
//$columns  = array();
//$row      = 0;
//$column   = 0;
//$i        = 0;

//Khoa hoc sap dien ra
$args = array(
    'category_name' => 'khoa-hoc-truc-tuyen-sap-dien-ra',
    'post_status' => array( 'publish' ),
    'posts_per_page' => 1,
    'orderby' => 'date',
    'order' => 'ASC'
);

$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) {
	$the_query->the_post();
    echo $this->render('_post-hoc-truc-tuyen');
}

