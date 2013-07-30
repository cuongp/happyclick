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
                <p>
                  <a href="/phat-trien-nghe-nghiep/">
                    <img class="alignnone size-full wp-image-2758" alt="phat trien nghe nghiep" src="/wp-content/uploads/2013/07/phat-trien-nghe-nghiep.png" width="322" height="48"></a>
                  <a href="http://dev.happyclick.vn/category/hanh-trang-nghe-nghiep/">
                    <img class="alignnone size-full wp-image-2757" alt="Hành trang nghề nghiệp" src="/wp-content/uploads/2013/07/hanh-trang-nghe-nghiep.png" width="268" height="44"></a>
                </p>
                <div class="content-box-inside">
                    <?php
                    
                        echo '<div style="text-align:center">'.apply_filters('the_content', get_category(get_query_var('cat'))->description).'</div>';
                        echo $this->render('_posts-hanh-trang-nghe-nghiep'); 

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