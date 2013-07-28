<div id="item-<?php the_ID(); ?>-first" class="item courses first-post" data-permalink="<?php the_permalink(); ?>" >
		<h1><?php _e('Happy Click Radio - '); ?><?php the_title(); ?></h1>
		<?php if(has_post_thumbnail()): ?>
			<?php $width = '295'; $height = '195'; ?>
			<?php the_post_thumbnail(array($width,$height),array('class'=>'size-auto')); ?>
		<?php endif; ?>
		
		<?php   if(in_array('URL Audio',get_post_custom_keys())) { ?>
		<div class="media"><?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'URL Audio', true)); ?></div>
		<?php }   ?>
		<div class="post-content-first">
		<?php the_content(); ?>
		</div>
</div>