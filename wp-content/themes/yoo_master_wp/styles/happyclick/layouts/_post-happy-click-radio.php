<?php global $post_count_radio; ?>
<?php if($post_count_radio == 1): ?>
	<div id="item-<?php the_ID(); ?>" class="item courses" data-permalink="<?php the_permalink(); ?>" >
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><hr />
		<?php if(has_post_thumbnail()): ?>
			<?php $width = '300'; $height = '200'; ?>
			<div class="course-thumbnail"><?php the_post_thumbnail(array($width,$height),array('class'=>'size-auto')); ?></div>
		<?php endif; ?>
		<div class="media"></div>	
		<?php get_the_excerpt(); ?>
	</div>
<?php elseif($post_count_radio > 1): ?>
	<div id="item-<?php the_ID(); ?>" class="item courses post_sub" data-permalink="<?php the_permalink(); ?>" >
		<?php if(has_post_thumbnail()): ?>
			<?php $width = ''; $height = ''; ?>
			<div class="course-thumbnail"><?php the_post_thumbnail(array($width,$height),array('class'=>'size-auto')); ?></div>
		<?php endif; ?>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><hr />	
		<?php get_the_excerpt(); ?>
	</div>
<?php endif; ?>