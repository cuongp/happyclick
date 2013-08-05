<div id="system">
    <div class="archive-new-week">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		
		<article class="item" data-permalink="<?php the_permalink(); ?>">			 
			<header class="course-wrapper">
                <h3 class="course-title"><?php the_title() ?></h3>
            </header>

			<div class="content clearfix"><?php the_content(''); ?></div>
		</article>

		<?php endwhile; ?>
	<?php endif; ?>

    </div>
</div>