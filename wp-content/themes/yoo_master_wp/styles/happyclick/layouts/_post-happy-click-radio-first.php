<div id="item-<?php the_ID(); ?>-first" class="item courses first-post" data-permalink="<?php the_permalink(); ?>" >
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<?php if(has_post_thumbnail()): ?>
			<?php $width = '295'; $height = '195'; ?>
			<?php the_post_thumbnail(array($width,$height),array('class'=>'size-auto')); ?>
		<?php endif; ?>
		<div class="media"></div>
		<div class="post-content-first">
		<?php the_content(); ?>
		</div>
</div>