<?php 
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

$category_per_page  = 6; //So category hien thi tren 1 page
$current_page       = 1; //Set trang dang xem
if(isset($_GET['page']) && $_GET['page']!='' )
    $current_page   = $_GET['page'];

$category_id        = 44; //ID cua category hoc qua video

$args = array(
	'type'                     => 'post',
	'child_of'                 => $category_id,
	'orderby'                  => 'id',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 0,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false );

$categories = get_categories( $args );
$total_records      = count($categories);
$number_of_pages    = ceil($total_records/$category_per_page);

$i=0;
//Hien thi danh sach cac category
foreach ($categories as $key=>$category){
    $i++;
    if($key<($current_page * $category_per_page - $category_per_page) )
        continue;
    $args = array(
        'cat' => $category->cat_ID,
        'post_status' => array( 'publish' ),
        'posts_per_page' => 50,
        'orderby' => 'date',
        'order' => 'ASC',
        'show_count' => 1
    );
    //Category chua co du lieu => bo qua
    if($category->count == 0 ) continue;
    ?>
    <div class="video-category">
        <h3><?php echo $category->name.' ('.$category->count.')'; ?></h3>
        <p><?php echo $category->description ?></p>
        <?php
        echo '<div class=" jcarousel-skin-tango">
                <div class="jcarousel-container jcarousel-container-horizontal" >
                    <div class="jcarousel-clip jcarousel-clip-horizontal">
                        <ul id="mycarousel_'.$i.'" class="jcarousel-list jcarousel-list-horizontal">';
                            $the_query = new WP_Query( $args );
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                echo $this->render('_post-hoc-qua-video');
                            }
        echo '          </ul>
                    </div>
                    <div class="jcarousel-prev jcarousel-prev-horizontal" style="display: block;"></div>
                    <div class="jcarousel-next jcarousel-next-horizontal" style="display: block;"></div>
                </div>
            </div>';
        ?>
        <script type="text/javascript" language="javascript">
            (function($) {
                /* Jquery carousel script */
                $(document).ready(function() {
                    jQuery('#mycarousel_<?php echo $i ?>').jcarousel();
                });
            })(jQuery);
        </script>
    </div>
    <?php
    if($i>($current_page * $category_per_page - 1))
        break;
} // end foreach
?>
<div class="video-pagination">    
    <span>Trang</span>
    <?php        
        while($number_of_pages>0){
            if($number_of_pages != $current_page){
                echo '<a href="?page='.$number_of_pages.'">'.$number_of_pages--.'</a>';
            }else{
                echo '<a class="active" href="javascript:void(0);">'.$number_of_pages--.'</a>';
            }
        }
    ?>
</div>

<div class="video-upcomming">
    <?php 
        $post_id = 2075;
        $video_upcomming = get_post($post_id);
    ?>
    <h3 class="text-orange"><?php echo $video_upcomming->post_title; ?></h3>
    <div>
        <?php echo $video_upcomming->post_content; ?>
    </div>
</div>
<?php

/*
 * object(stdClass)[414]
      public 'term_id' => &string '47' (length=2)
      public 'name' => &string 'Nghệ thuật trình bày hiệu quả' (length=39)
      public 'slug' => &string 'nghe-thuat-trinh-bay-hieu-qua' (length=29)
      public 'term_group' => string '0' (length=1)
      public 'term_taxonomy_id' => string '51' (length=2)
      public 'taxonomy' => string 'category' (length=8)
      public 'description' => &string 'Những bí quyết đơn giản giúp bạn tự tin, duyên dáng khi trình bày và dẫn dắt người nghe theo từng cung bậc cảm xúc' (length=147)
      public 'parent' => &string '44' (length=2)
      public 'count' => &string '0' (length=1)
      public 'cat_ID' => &string '47' (length=2)
      public 'category_count' => &string '0' (length=1)
      public 'category_description' => &string 'Những bí quyết đơn giản giúp bạn tự tin, duyên dáng khi trình bày và dẫn dắt người nghe theo từng cung bậc cảm xúc' (length=147)
      public 'cat_name' => &string 'Nghệ thuật trình bày hiệu quả' (length=39)
      public 'category_nicename' => &string 'nghe-thuat-trinh-bay-hieu-qua' (length=29)
      public 'category_parent' => &string '44' (length=2)
 */
?>