<div id="system">
	<?php if (have_posts()) : ?>

	<h1 style="font-size:24px">Quyền lợi thành viên <a href="http://dev.happyclick.vn/wp-content/uploads/pdf/HC_Membership_Flyer.pdf" target="_blank" style="color: red;font-size: 14px;">   (Xem chi tiết quyền lợi thành viên)</a></h1>
        
		<?php 
    
                echo $this->render('_posts_thanh_vien'); ?>
		
		<?php echo $this->render("_pagination", array("type"=>"posts")); ?>
		
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
