<?php  global $displayed_post_id; 
		if($displayed_post_id != null) {
			$displayed_post_id = null;
		}
?>
<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
				<div id="item" class="first-post" data-permalink="<?php the_permalink(); ?>">
					<h1><?php the_title(); ?></h1>
					<div class="post-content-first">
						<?php the_content(); ?>
					</div>
				</div>
				<div>
					 <?php $displayed_post_id = get_the_ID(); ?>
					<?php echo $this->render('single-goc-kien-thuc-sub'); ?>
				</div>
		<?php endwhile; ?>
<?php endif; ?>
