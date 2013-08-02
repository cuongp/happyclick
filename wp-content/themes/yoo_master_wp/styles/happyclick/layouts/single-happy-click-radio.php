<?php /*global $displayed_post_id;
	if($displayed_post_id != null) {
		$displayed_post_id = null;
	} */
 ?>
<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		<?php
				$member_id = 2;
				$is_member = current_user_on_level($member_id);
				$trial_id = 1;
				$is_trial = current_user_on_level($trial_id);
				$permiss_trial = $is_trial && is_sticky();
			?>
				<div id="item" class="item courses first-post-radio" data-permalink="<?php the_permalink(); ?>" >
				<?php if($permiss_trial || $is_member):?> 
				<h1 class="post-h1-radio"><?php _e('Happy Click Radio - '); ?><?php the_title(); ?></h1>
					<?php the_content(); ?>
				<?php  
					else: ?>
						<div style="float: left; margin: 15px 60px 30px;">
						<?php echo do_shortcode('[level-member]'); ?>
						</div>
				<?php endif; ?>
			</div>
			<?php
			echo $this->render('single-happy-click-radio-sub'); ?>
		<?php endwhile; ?>
<?php endif; ?>
