<div id="system">
	<?php if (have_posts()) : ?>
		<?php $curr_page = get_query_var('pagename'); ?>
		
		<div id="tabs">
			<ul>
			<?php if ($curr_page == "ve-happy-click"): ?>
				<li id="tab-radio" class="ui-tabs-active"><a href="<?php echo get_site_url().'/ve-happy-click'; ?>"><?php _e('Về Happy Click','warp'); ?></a></li>
				<li id="tab-cs"><a href="<?php echo get_site_url().'/ban-lanh-dao'; ?>"><?php _e('Ban lãnh đạo','warp'); ?></a></li>
			<?php elseif ($curr_page == "ban-lanh-dao"): ?>	
				<li id="tab-radio"><a href="<?php echo get_site_url().'/ve-happy-click'; ?>"><?php _e('Về Happy Click','warp'); ?></a></li>
				<li id="tab-cs" class="ui-tabs-active"><a href="<?php echo get_site_url().'/ban-lanh-dao'; ?>"><?php _e('Ban lãnh đạo','warp'); ?></a></li>
			<?php endif; ?>
			</ul>
			</div>
		<?php while (have_posts()) : the_post(); ?>
			<div class="posts-wrapper">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>

</div>