<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); 
			if(is_sticky(get_the_ID())) : ?>
				<div id="sticky-download"><a href="<?php echo get_post_meta( get_the_ID(), 'URL File Upload', 'true' ); ?>" target="_blank"><h3><?php the_title(); ?></h3></a>
				<div class="content-post-single" ><?php the_content(); ?></div></div>
			<?php else: ?>
				
			<?php endif; ?>
		<?php endwhile; ?>
<?php endif; ?>
