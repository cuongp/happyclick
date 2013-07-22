<?php global $post_count_chia_se; ?>
<?php if($post_count_chia_se == 2): ?>
<div class="posts_sub">
		<p style="margin: 30px 60px 0; font-style:italic; font-size:16px;"><strong><?php _e('Các bài khác','warp'); ?></strong></p>
	<?php  endif; ?>
	<div id="item-<?php the_ID(); ?>" class="item courses post_sub" data-permalink="<?php the_permalink(); ?>" >
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="post-content-sub">
			<?php echo string_limit_words(get_the_excerpt(),10).'...'; ?>
			<a href="<?php the_permalink(); ?>"><?php _e('xem thêm','warp'); ?></a>
		</div>
	</div>
<?php if($post_count_chia_se == 15): ?>
</div>
<?php endif; 
