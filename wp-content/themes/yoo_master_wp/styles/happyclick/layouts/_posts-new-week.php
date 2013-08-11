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
$member_id     = 2; 
$is_member     = current_user_on_level($member_id);
//Neu khong phai la member thi hien thi bai sticky len dau tien
if (!$is_member){
    $args['post__in'] = get_option( 'sticky_posts' );
}

$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) {
	$the_query->the_post();
    echo $this->render('_post-new-week');
    $current_postID = get_the_ID();
} 
?>
<div class="next-week past-weeks">
    <h3 class="pass-weeks-title text-orange">Các chương trình đã qua</h3>
    <table>
        <tbody>
            <?php
            $args = array(
                'category_name' => 'khoi-dong-tuan-moi',
                'post_status' => array( 'publish' ),
                'post__not_in' => array($current_postID),
                'posts_per_page' => 10,
                'orderby' => 'date',
                'order' => 'DESC'
            );
            $the_query = new WP_Query( $args );
            while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    echo '<tr><td width="110">'.get_the_date('d/m/Y').'</td><td><a href="'. get_post_permalink() .'">'. strip_tags(get_the_title()) .'</a></td></tr>';
            } ?>
        </tbody>
    </table>
</div>
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