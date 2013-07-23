
<article id="item-<?php the_ID(); ?>" class="item width50" style="float:left" data-permalink="<?php the_permalink(); ?>">

	
	<header>

		<?php if (has_post_thumbnail()) : ?>
		<?php
		$width = get_option('thumbnail_size_w'); //get the width of the thumbnail setting
		$height = get_option('thumbnail_size_h'); //get the height of the thumbnail setting
		?>
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(array(), array('class' => 'size-auto')); ?></a>
	<?php endif; ?>
	</header>

	
	<p>
		<a href="<?php the_permalink() ?>" class="xemthu" title="<?php the_title_attribute(); ?>"><?php _e('<span>Xem thử</span>', 'warp'); ?></a>
	</p>

	<?php edit_post_link(__('Edit this post.', 'warp'), '<p class="edit">','</p>'); ?>

</article>