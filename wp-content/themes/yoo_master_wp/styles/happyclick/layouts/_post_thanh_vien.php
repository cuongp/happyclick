
<div style="float:left;margin-bottom:10px;min-height:150px" class="width50">
	<header style="min-height:100px">

		<?php if (has_post_thumbnail()) : ?>
		<?php
		$width = get_option('thumbnail_size_w'); //get the width of the thumbnail setting
		$height = get_option('thumbnail_size_h'); //get the height of the thumbnail setting
		?>
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(array(), array('class' => 'size-auto')); ?></a>
	<?php endif; ?>
	</header>

	
	<p style="text-align: center;display:block">
		<a href="<?php the_permalink() ?>" class="xemthu" title="<?php the_title_attribute(); ?>"><?php _e('<span>Xem thử</span>', 'warp'); ?></a>
	</p>
</div>