<div id="system">
<?php if (have_posts()): ?>
		<?php if (is_category()) : ?>
			<?php /* <h1 class="page-title">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h1> */ ?>
		<?php elseif (is_tag()) : ?>
			<h1 class="page-title"><?php printf(__('Posts Tagged %s', 'warp'), '&#8216;'.single_tag_title('', false).'&#8217;'); ?></h1>
		<?php elseif (is_day()) : ?>
			<h1 class="page-title"><?php printf(__('Archive for %s', 'warp'), get_the_date()); ?></h1>
		<?php elseif (is_month()) : ?>
			<h1 class="page-title"><?php printf(__('Archive for %s', 'warp'), get_the_date('F, Y')); ?></h1>
		<?php elseif (is_year()) : ?>
			<h1 class="page-title"><?php printf(__('Archive for %s', 'warp'), get_the_date('Y')); ?></h1>
		<?php elseif (is_author()) : ?>
			<h1 class="page-title"><?php _e('Author Archive', 'warp'); ?></h1>
		<?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : ?>
			<h1 class="page-title"><?php _e('Blog Archives', 'warp'); ?></h1>
		<?php endif; ?>
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
			<?php endif; ?>
			</ul>
			</div>
			<div class="posts-wrapper">
				<?php
				if($curr_cat->slug == "happy-click-radio") {
					echo $this->render('_posts-happy-click-radio-first');
					echo $this->render('_posts-happy-click-radio');
				} else if($curr_cat->slug == "goc-chia-se") {
					echo $this->render('_posts-goc-chia-se');
				} else if($curr_cat->slug == "goc-kien-thuc") {
					echo $this->render('_posts-goc-kien-thuc');
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