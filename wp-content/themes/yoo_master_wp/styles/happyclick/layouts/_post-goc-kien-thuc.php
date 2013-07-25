<div id="item-<?php the_ID(); ?>" class="item courses" data-permalink="<?php the_permalink(); ?>">
	<?php if(has_post_thumbnail()) : ?>
		<?php $width='180'; $height=''; ?>
		<?php echo the_post_thumbnail(array($width,$height), ''); ?>
	<?php endif; ?>
		<div class="posts-content">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p><?php echo string_limit_words(get_the_content(),40).'...'; ?></p>
		</div>
</div>