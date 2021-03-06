<div id="system">
<?php if (have_posts()): ?>
		
		<!-- code -->
		<?php if (is_category( )) { 
			$cat = get_query_var('cat');
			$curr_cat = get_category ($cat);
		?>
		<div id="tabs">
			<ul>
			<?php if ($curr_cat->slug == "happy-click-radio"): ?>
				<li id="tab-radio" class="ui-tabs-active"><a href="<?php echo get_site_url().'/category/happy-click-radio'; ?>"><?php _e('Happy Click Radio','warp'); ?></a></li>
				<li id="tab-cs"><a href="<?php echo get_site_url().'/category/goc-chia-se'; ?>"><?php _e('Góc chia sẻ','warp'); ?></a></li>
				<li id="tab-kt"><a href="<?php echo get_site_url().'/category/goc-kien-thuc'; ?>"><?php _e('Góc kiến thức','warp'); ?></a></li>
			<?php elseif ($curr_cat->slug == "goc-chia-se"): ?>	
				<li id="tab-radio"><a href="<?php echo get_site_url().'/category/happy-click-radio'; ?>"><?php _e('Happy Click Radio','warp'); ?></a></li>
				<li id="tab-cs"  class="ui-tabs-active"><a href="<?php echo get_site_url().'/category/goc-chia-se'; ?>"><?php _e('Góc chia sẻ','warp'); ?></a></li>
				<li id="tab-kt"><a href="<?php echo get_site_url().'/category/goc-kien-thuc'; ?>"><?php _e('Góc kiến thức','warp'); ?></a></li>
			<?php elseif($curr_cat->slug == "goc-kien-thuc"): ?>
				<li id="tab-radio"><a href="<?php echo get_site_url().'/category/happy-click-radio'; ?>"><?php _e('Happy Click Radio','warp'); ?></a></li>
				<li id="tab-cs"><a href="<?php echo get_site_url().'/category/goc-chia-se'; ?>"><?php _e('Góc chia sẻ','warp'); ?></a></li>
				<li id="tab-kt"  class="ui-tabs-active"><a href="<?php echo get_site_url().'/category/goc-kien-thuc'; ?>"><?php _e('Góc kiến thức','warp'); ?></a></li>
			<?php elseif($curr_cat->slug == "download-tai-lieu"): ?>
				<li id="tab-radio"><a href="<?php echo get_site_url().'/category/happy-click-radio'; ?>"><?php _e('Happy Click Radio','warp'); ?></a></li>
				<li id="tab-cs"><a href="<?php echo get_site_url().'/category/goc-chia-se'; ?>"><?php _e('Góc chia sẻ','warp'); ?></a></li>
				<li id="tab-kt"  class="ui-tabs-active"><a href="<?php echo get_site_url().'/category/goc-kien-thuc'; ?>"><?php _e('Góc kiến thức','warp'); ?></a></li>
			<?php endif; ?>
			</ul>
			</div>
			<div class="posts-wrapper">
				<?php
				if($curr_cat->slug == "happy-click-radio") {
                    
                    //Alert cho trial user
                    $trial_id       = 1;
					$member_id       = 2;
                    $is_trial       = current_user_on_level($trial_id);
                    $is_member     = current_user_on_level($member_id);
                    if($is_trial && !$is_member):
                        echo '<div style="text-align:center"><span style="color:#F20000;">Bạn được nghe thử radio "Hạnh phúc chẳng vì lý do nào cả".</span></div>';
                    endif;
                    //End alert
					echo $this->render('_posts-happy-click-radio-first');                    
					echo $this->render('_posts-happy-click-radio');
				} else if($curr_cat->slug == "goc-chia-se") {
                    //Alert cho trial user
                     $trial_id       = 1;
					$member_id       = 2;
                    $is_trial       = current_user_on_level($trial_id);
                    $is_member     = current_user_on_level($member_id);
                    if($is_trial && !$is_member):
                        echo '<div style="text-align:center"><span style="color:#F20000;">Bạn được xem thử bài viết đầu tiên.</span></div>';
                    endif;
                    //End alert
					echo $this->render('_posts-goc-chia-se');
				} else if($curr_cat->slug == "goc-kien-thuc") {
					 $trial_id       = 1;
					$member_id       = 2;
                    $is_trial       = current_user_on_level($trial_id);
                    $is_member     = current_user_on_level($member_id);
					//Alert cho trial user
					 if($is_trial && !$is_member):
                        echo '<div style="text-align:center"><span style="color:#F20000;">Bạn được xem thử bài viết đầu tiên.</span></div>';
                    endif;
					//End alert
					echo $this->render('_posts-goc-kien-thuc');
				} else if($curr_cat->slug == "download-tai-lieu") {
					echo $this->render('_posts-download-tai-lieu');
				} ?>
			</div>
			<?php }	?>
	<?php else : ?>

		<?php if (is_category()) : ?>
			<h1 class="page-title"><?php printf(__("Sorry, but there aren't any posts in the %s category yet.", "warp"), single_cat_title('', false)); ?></h1>
		<?php elseif (is_date()) : ?>
			<h1 class="page-title"><?php _e("Sorry, but there aren't any posts with this date.", "warp"); ?></h1>
		<?php elseif (is_author()) : ?>
			<?php $userdata = get_userdatabylogin(get_query_var('author_name')); ?>
			<h1 class="page-title"><?php printf(__("Sorry, but there aren't any posts by %s yet.", "warp"), $userdata->display_name); ?></h1>
		<?php else : ?>
			<h1 class="page-title"><?php _e("No posts found.", "warp"); ?></h1>
		<?php endif; ?>
		
		<?php get_search_form(); ?>

	<?php endif; ?>
</div>