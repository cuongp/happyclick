<?php global $post_count_radio; ?>
	<?php if($post_count_radio == 1): ?>
		<div class="posts_sub">
	<?php  endif; ?>
	<?php $class_margin = ((($post_count_radio%4) == 0)?'margin_right':''); ?>
	<?php $class_margin = ((($post_count_radio%4) == 1)?'clear_left':''); ?>
	<div id="item-<?php the_ID(); ?>" class="item courses post_sub <?php echo $class_margin; ?>" data-permalink="<?php the_permalink(); ?>" >
		<?php if(has_post_thumbnail()): ?>
			<?php $width = '180'; $height = '120'; ?>
			<a href="<?php the_permalink(); ?>" target="_blank"><?php the_post_thumbnail(array($width,$height),array('class'=>'size-auto')); ?></a>
		<?php endif; ?>
		<h3><a href="<?php the_permalink(); ?>" target="_blank">
		<?php
			if(strlen(get_the_title()) > 41 ) {
				echo string_limit_words(get_the_title(), 6).'...';
			} else {
				echo get_the_title();
			}
		?></a></h3>
		<div class="post-content-sub">
			<?php $excerpt = get_post_custom_values('Excerpt'); ?>
			<?php if($excerpt[0] != null) {
				echo $excerpt[0];
				} else {
					echo string_limit_words(get_the_content(), 16).'...';
				}
			?>
		</div>
	</div>
	<?php if($post_count_radio == 12): ?>
		</div>
		<?php endif; ?>
