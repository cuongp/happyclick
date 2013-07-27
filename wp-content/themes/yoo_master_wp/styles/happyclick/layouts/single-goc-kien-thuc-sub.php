<?php
 global $displayed_post_id;
$count = 0;
$arg = array(
			'category_name'		=> 'goc-kien-thuc',
			'post_status'				=> array('publish'),
			'type'						=> 'post',
			'post__not_in'		=> get_option('sticky_posts'),
			'taxonomy'				=> 'category',
			'orderby'					=> 'date',
			'order'						=> 'DESC',
);

$the_query = new WP_Query($arg);
while($the_query->have_posts()) {
	$the_query->the_post();
	if($displayed_post_id != get_the_ID()) {
		$count++;
		if($count == 1) { ?>
			<div class="posts_sub">
			<p style="margin: 60px 60px 0; font-style:italic; font-size:16px;"><strong><?php _e('Các bài khác','warp'); ?></strong></p>
		<?php } ?>
		<div id="item-<?php the_ID(); ?>" class="item courses post_sub" data-permalink="<?php the_permalink(); ?>" >
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="post-content-sub">
				<?php echo string_limit_words(get_the_excerpt(),15).'...'; ?>
				<a href="<?php the_permalink(); ?>"><?php _e('xem thêm','warp'); ?></a>
			</div>
		</div>
		<?php if($count == 6) { ?>
			</div>
			<?php break;
			}
		}
} ?>
