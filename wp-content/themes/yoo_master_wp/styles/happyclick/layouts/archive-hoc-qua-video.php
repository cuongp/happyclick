<div id="system">
	<?php if (have_posts()) : ?>

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
        
            <div class="content-box1 equaledge">
                <h3 class="content-box-title">
                    <?php
                        $cat_name = get_category(get_query_var('cat'))->name;
                        echo $cat_name;
                    ?>
                </h3>
                <div class="content-box-inside">
                    <?php
                        $trial_id       = 1; //Trial level
                        $is_trial       = current_user_on_level($trial_id);
                        echo '<div style="text-align:center">'.apply_filters('the_content', get_category(get_query_var('cat'))->description);
                        echo ($is_trial) ? '<br /><span style="color:#F20000;">Bạn được xem thử video đầu tiên của mỗi chủ đề</span>' : '';
                        echo '</div>';
                        echo $this->render('_posts-hoc-qua-video'); 

                    ?>
                </div>
            </div>
		
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