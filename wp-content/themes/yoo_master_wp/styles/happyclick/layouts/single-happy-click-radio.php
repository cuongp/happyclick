<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
				<div id="item" class="item courses first-post-radio" data-permalink="<?php the_permalink(); ?>" >
				<h1><?php _e('Happy Click Radio - '); ?><?php the_title(); ?></h1>
					<?php if(has_post_thumbnail()): ?>
						<?php $width = '295'; $height = '195'; ?>
						<?php the_post_thumbnail(array($width,$height),array('class'=>'size-auto')); ?>
					<?php endif; ?>
				<?php if(in_array('URL Audio',get_post_custom_keys())) { ?>
					<div class="media"><a href="<?php echo get_post_meta(get_the_ID(), 'URL Audio', true); ?>"></a></div>
				<?php } ?>
				<div class="post-content-first-radio">
					<?php the_content(); ?>
				</div>
			</div>
			<?php echo $this->render('single-happy-click-radio-sub'); ?>
		<?php endwhile; ?>
<?php endif; ?>
