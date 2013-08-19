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

$cat_id = get_query_var('cat');

$args = array(
    'cat' => $cat_id,
    'post_status' => array( 'publish' ),
    'posts_per_page' => 21,
    'orderby' => 'date',
    'order' => 'DESC'
);
$i = 1;
$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) {
	$the_query->the_post();
    echo $this->render('_post-hinh-anh');
    if($i++ % 3 == 0){
        echo '<hr style="width:100%; border:none; margin:5px 0; padding: 0;" />';
    }
}
