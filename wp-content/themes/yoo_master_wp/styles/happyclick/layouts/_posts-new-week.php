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
    'order' => 'DESC'
);

$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) {
	$the_query->the_post();
    echo $this->render('_post-new-week');
} 
?>
<div class="next-week">
    <?php
    $my_postid      = 3707; //3698 on test - This is page id or post id
    $content_post   = get_post($my_postid);
    $content        = $content_post->post_content;
    $content        = apply_filters('the_content', $content);
    $content        = str_replace(']]>', ']]&gt;', $content);
    echo '<h3 class="text-orange">'.$content_post->post_title.'</h3>';
    echo $content;
    ?>
</div>