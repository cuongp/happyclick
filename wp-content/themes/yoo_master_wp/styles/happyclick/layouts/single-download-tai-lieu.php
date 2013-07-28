<div id="item-<?php the_ID(); ?>" class="item courses post_sub" data-permalink="<?php the_permalink(); ?>" >
	<div id="sticky-download">
		<a class="link_icon" href="<?php echo get_post_meta( get_the_ID(), 'URL File Upload', 'true' ); ?>" target="_blank"><h3><?php the_title(); ?></h3></a>
		<div class="content-post-single" >
			<?php the_content(); ?>
		</div>
	</div>
</div>