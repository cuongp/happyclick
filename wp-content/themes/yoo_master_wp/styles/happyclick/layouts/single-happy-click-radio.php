<?php /*global $displayed_post_id;
	if($displayed_post_id != null) {
		$displayed_post_id = null;
	} */
 ?>
<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
				<div id="item" class="item courses first-post-radio" data-permalink="<?php the_permalink(); ?>" >
				<h1 class="post-h1-radio"><?php _e('Happy Click Radio - '); ?><?php the_title(); ?></h1>
					<?php if(has_post_thumbnail()): ?>
						<?php $width = '295'; $height = '195'; ?>
						<?php the_post_thumbnail(array($width,$height),array('class'=>'wp-post-image')); ?>
					<?php endif; ?>
				<?php if(in_array('URL Audio',get_post_custom_keys())) { ?>
					<div class="media"><a href="<?php echo get_post_meta(get_the_ID(), 'URL Audio', true); ?>"></a></div>
				<?php } ?>
				<div class="post-content-first-radio">
					<?php the_content(); ?>
				</div>
			</div>
			<?php
			/*	$displayed_post_id = get_the_ID(); */
			echo $this->render('single-happy-click-radio-sub'); ?>
		<?php endwhile; ?>
<?php endif; ?>
