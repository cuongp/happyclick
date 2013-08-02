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

//Cac khoa hoc truc tuyen tiep theo
$args = array(
    'category_name' => 'khoa-hoc-truc-tuyen-sap-dien-ra',
    'post_status' => array( 'publish' ),
    'posts_per_page' => 6,
    'orderby' => 'date',
    'order' => 'ASC'
);

$the_query = new WP_Query( $args );
$i=1;
while ( $the_query->have_posts() ) {
    $the_query->the_post();
    if($i++ > 1){ //Bo qua khoa hoc dau tien da duoc hien thi ben tren
        $divClass = ($i%2 == 0) ? 'blue-style' : '';
        echo '<div class="'.$divClass.'">'.$this->render('_post-hoc-truc-tuyen-sub').'</div>';
    }
}


//  Cac khoa hoc truc tuyen da to chuc  ==========================

//echo '<h3 class="course-old-title">Xem lại các khóa đã tổ chức</h3>';
//echo '<p class="course-old-sub-title">(chỉ dành cho thành viên)</p>';
$args = array(
    'category_name' => 'khoa-hoc-truc-tuyen-da-to-chuc',
    'post_status' => array( 'publish' ),
    'posts_per_page' => 10,
    'orderby' => 'date',
    'order' => 'DESC'    
);

$the_query = new WP_Query( $args );

//echo '<div class=" jcarousel-skin-tango">
//        <div class="jcarousel-container jcarousel-container-horizontal" >
//            <div class="jcarousel-clip jcarousel-clip-horizontal">
//                <ul id="mycarousel" class="jcarousel-list jcarousel-list-horizontal">';
//                    while ( $the_query->have_posts() ) {
//                        $the_query->the_post();
//                        echo $this->render('_post-hoc-truc-tuyen-old');
//                    }
//echo '          </ul>
//            </div>
//            <div class="jcarousel-prev jcarousel-prev-horizontal" style="display: block;"></div>
//            <div class="jcarousel-next jcarousel-next-horizontal" style="display: block;"></div>
//        </div>
//    </div>';
 