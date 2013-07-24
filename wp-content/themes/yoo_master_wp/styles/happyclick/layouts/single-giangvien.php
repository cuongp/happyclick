<div id="system" class="box2 bodycontent" style="padding:10px">

	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		
		<article class="item" data-permalink="<?php the_permalink(); ?>">			 
			<div class="photogv">
<?php if (has_post_thumbnail()) : ?>
		<?php
		$width = get_option('thumbnail_size_w'); //get the width of the thumbnail setting
		$height = get_option('thumbnail_size_h'); //get the height of the thumbnail setting
		?>
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(array(), array('class' => 'size-auto')); ?></a>
	<?php endif; ?>
			</div>
			<header class="infogv">
				<h1 class="title"><?php the_title(); ?></h1>
				<?php the_excerpt() ?>
			</header>

			<div class="content clear"><?php the_content(''); ?></div>
		</article>

		<?php endwhile; ?>
	<?php endif; ?>

</div>