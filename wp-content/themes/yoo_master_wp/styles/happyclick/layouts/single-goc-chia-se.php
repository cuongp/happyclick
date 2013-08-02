<?php global $displayed_post_id;
	if($displayed_post_id != null) {
		$displayed_post_id = null;
	}
 ?>
 <?php
				$member_id = 2;
				$is_member = current_user_on_level($member_id);
				$trial_id = 1;
				$is_trial = current_user_on_level($trial_id);
				$permiss_trial = $is_trial && is_sticky();
			?>
<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
				<div id="item" class="first-post" data-permalink="<?php the_permalink(); ?>">
					<?php if($permiss_trial || $is_member):?> 
					<h1><?php the_title(); ?></h1>
					<div class="post-content-first">
						<?php the_content(); ?>
					</div>
					<?php  
					else: ?>
						<div style="float: left; margin: 15px 60px 30px;">
						<?php echo do_shortcode('[level-member]'); ?>
						</div>
					<?php endif; ?>
				</div>
				<div>
					<?php $displayed_post_id = get_the_ID(); ?>
					<?php echo $this->render('single-goc-chia-se-sub'); ?>
				</div>
		<?php endwhile; ?>
<?php endif; ?>
