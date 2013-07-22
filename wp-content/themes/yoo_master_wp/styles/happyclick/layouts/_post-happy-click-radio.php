<?php global $post_count_radio; ?>
	<?php if($post_count_radio == 1): ?>
		<div class="posts_sub">
	<?php  endif; ?>
	<div id="item-<?php the_ID(); ?>" class="item courses post_sub" data-permalink="<?php the_permalink(); ?>" >
		<?php if(has_post_thumbnail()): ?>
			<?php $width = '180'; $height = '120'; ?>
			<?php the_post_thumbnail(array($width,$height),array('class'=>'size-auto')); ?>
		<?php endif; ?>
		<h3><a href="<?php the_permalink(); ?>"><?php echo string_limit_words(get_the_title(), 5).'...'; ?></a></h3>
		<div class="post-content-sub">
			<?php echo string_limit_words(get_the_content(),8).'...'; ?>
		</div>
	</div>
	<?php if($post_count_radio == 8): ?>
		</div>
		<?php endif; ?>
