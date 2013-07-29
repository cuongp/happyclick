<?php /*global $displayed_post_id;
	if($displayed_post_id != null) {
		$displayed_post_id = null;
	} */
 ?>
<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
				<div id="item" class="item courses first-post-radio" data-permalink="<?php the_permalink(); ?>" >
				<h1 class="post-h1-radio"><?php _e('Happy Click Radio - '); ?><?php the_title(); ?></h1>
					<?php the_content(); ?>
			</div>
			<?php
			echo $this->render('single-happy-click-radio-sub'); ?>
		<?php endwhile; ?>
<?php endif; ?>
