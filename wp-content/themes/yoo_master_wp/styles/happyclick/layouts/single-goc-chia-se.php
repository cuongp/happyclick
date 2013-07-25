<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
				<div id="item" class="first-post" data-permalink="<?php the_permalink(); ?>">
					<h1><?php the_title(); ?></h1>
					<div class="post-content-first">
						<?php the_content(); ?>
					</div>
				</div>
				<div>
					<?php echo $this->render('single-goc-chia-se-sub'); ?>
				</div>
		<?php endwhile; ?>
<?php endif; ?>
