<div id="system">

<?php



$paged = 1;
if ( get_query_var('paged') ) $paged = get_query_var('paged') ;    
if ( get_query_var('page') ) $paged = get_query_var('page');  

$taxonomies = get_terms('chude');
if (!empty($taxonomies)) {
    echo '<ul class="chude_taxonomy">';
    foreach ($taxonomies as $taxonomy) {
        if (get_query_var('chude') == $taxonomy->slug)
            $active = 'active';
        else
            $active = '';
?>

    <li class="<?php echo $active; ?>"><a href="/chude/<?php echo $taxonomy->
slug ?>"><?php echo
$taxonomy->name ?></a></li>

<?php
    }
    echo '</ul>';
}
?>
<div class="chude_taxonomies">
<?php
$args = array(
    'posts_per_page' => 2,
    'post_type' => 'sukien',
    'no_found_rows' => true,
    'areas' => get_query_var('chude'),
    'order' => 'DESC');
    global $query_string;  
    $offset      = get_option('page_chude') * ( $paged - 1) ;
    query_posts($query_string . '&areas='.get_query_var('chude').'&post_type=sukien&showposts='.get_option('page_chude').'&paged=' . $paged.'&offset='.$offset);  
//$query = new WP_Query($args);

if (have_posts()) {
    $count = 0;
    while (have_posts()):
    $count++;
        the_post();
        $post_id = get_the_ID();
        $data = get_post_meta($post_id, '_sukien', true);
        $terms = get_the_terms($post_id, 'diengia');
                
        $diengia = '';
        if (!empty($terms)) {
            $out = array();
            foreach ($terms as $c)
                $out[] = esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category',
                    'display'));
            $diengia = join(', ', $out);
        }
        $thumbnail = get_the_post_thumbnail($post_id);
?>
<article id="item-<?php the_ID(); ?>" class="item" data-permalink="<?php the_permalink(); ?>">

	<header>

		<h1 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
		
		<p class="meta">
			<?php 
			echo $data['thoigian'];
			?>
		</p>
		
	</header>

	<div class="content clearfix">
	   <p class="ct_img clearfix"><?php echo $thumbnail; ?>
        <b>Nội dung</b> <br />
        	<?php 
			echo strip_tags(get_the_excerpt());
			?>
		
       </p>
       <table width=100%>
        <tr>
            <td><a href="#" class="registed">Đăng ký (Thành viên)<br /><?php echo $data['giatien'] ?>đ</a></td>
            <td><a href="#" class="registed">Đăng ký (Không thành viên)<br /><?php echo $data['giatien'] ?>đ</a></td>
            <td><a  href="<?php the_permalink() ?>"  class="registed" title="<?php the_title_attribute(); ?>">Xem chi tiết<br /></a></td>
        </tr>
       </table>
       <p style="text-align: right;"><a href="/register">Trở thành thành viên</a></p>
	</div>

	<p class="links">
		<?php if(comments_open()) comments_popup_link(__('No Comments', 'warp'), __('1 Comment', 'warp'), __('% Comments', 'warp'), "", ""); ?>
	</p>

	<?php edit_post_link(__('Edit this post.', 'warp'), '<p class="edit">','</p>'); ?>

</article>
<hr />
<?php
    endwhile;
?>
<?php
wp_reset_query();
echo $this->render("_pagination", array("type"=>"posts"));
}

 else {
?>
    		<?php if (is_category()): ?>
			<h1 class="page-title"><?php printf(__("Sorry, but there aren't any posts in the %s category yet.",
"warp"), single_cat_title('', false)); ?></h1>
		<?php elseif (is_date()): ?>
			<h1 class="page-title"><?php _e("Sorry, but there aren't any posts with this date.",
"warp"); ?></h1>
		<?php elseif (is_author()): ?>
			<?php $userdata = get_userdatabylogin(get_query_var('author_name')); ?>
			<h1 class="page-title"><?php printf(__("Sorry, but there aren't any posts by %s yet.",
"warp"), $userdata->display_name); ?></h1>
		<?php else: ?>
			<h1 class="page-title"><?php _e("No posts found.", "warp"); ?></h1>
		<?php endif; ?>
		
		<?php get_search_form(); ?>
    <?php
    }
?>
	</div>

</div>
