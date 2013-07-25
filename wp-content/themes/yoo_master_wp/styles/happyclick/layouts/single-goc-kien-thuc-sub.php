<?php
global $id_filter;
$count = 0;
$arg = array(
			'category_name'		=> 'goc-kien-thuc',
			'post_status'				=> array('publish'),
			'type'						=> 'post',
			'taxonomy'				=> 'category',
			'posts_per_page'		=> 12,
			'orderby'					=> 'date',
			'order'						=> 'DESC',
);

$the_query = new WP_Query($arg);
while($the_query->have_posts()) {
	$the_query->the_post();
	$count++;
	if($count == 1) { ?>
		<div class="posts_sub">
		<p style="margin: 30px 60px 0; font-style:italic; font-size:16px;"><strong><?php _e('Các bài khác','warp'); ?></strong></p>
	<?php } ?>
	<div id="item-<?php the_ID(); ?>" class="item courses post_sub" data-permalink="<?php the_permalink(); ?>" >
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="post-content-sub">
			<?php echo string_limit_words(get_the_excerpt(),10).'...'; ?>
			<a href="<?php the_permalink(); ?>"><?php _e('xem thêm','warp'); ?></a>
		</div>
	</div>
	<?php if($count == 12) { ?>
		</div>
	<?php } 
} ?>
