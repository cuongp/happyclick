<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); 
			if(is_sticky(get_the_ID())) : ?>
				<div id="sticky-download"><a href="<?php echo get_post_meta( get_the_ID(), 'URL File Upload', 'true' ); ?>" target="_blank"><h3><?php the_title(); ?></h3></a>
				<div class="content-post-single" ><?php the_content(); ?></div></div>
			<?php else: ?>
				<div id="item" class="first-post" data-permalink="<?php the_permalink(); ?>">
					<h1><?php the_title(); ?></h1>
					<div class="post-content-first">
						<div class="img-thumb">
							<?php if(has_post_thumbnail()): ?>
								<?php $width=''; $height=''; ?>
								<?php the_post_thumbnail(array($width,$height),array('class'=>'size-auto')); ?>
							<?php endif; ?>
						</div>
						<div>
						<?php the_content(); ?>
						</div>
					</div>
				</div>
				<div>
					<?php echo $this->render('single-goc-kien-thuc-sub'); ?>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>
<?php endif; ?>
