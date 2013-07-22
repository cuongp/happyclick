<div id="system">

	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		
		<article class="item" data-permalink="<?php the_permalink(); ?>">			 
			<header>
				<h1 class="title"><?php the_title(); ?></h1>
			</header>

			<div class="content clearfix"><?php the_content(''); ?></div>
		</article>

		<?php endwhile; ?>
	<?php endif; ?>

</div>