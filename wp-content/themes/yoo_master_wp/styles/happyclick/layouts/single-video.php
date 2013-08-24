<div id="system" class="onecolumn single">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post();
            $categories = get_the_category();
            $current_category = $categories[0];
            $parent_id = $current_category->category_parent;
            $parent_cat = get_category($parent_id);
        ?>
            <div class="content-box1">
            <?php if($current_category->cat_ID>=189):
            ?>
            <h3 class="content-box-title">Hành trang nghề nghiệp</h3>
        <?php else:?>
                <h3 class="content-box-title">Học qua Video</h3>
                <?php endif; ?>
                <div class="content-box-inside">
                    <div class="remove_link video-category-title"><?php echo get_the_category_list(); ?></div>
                    <article id="item-<?php the_ID(); ?>" class="item courses" data-permalink="<?php the_permalink(); ?>">
                        <div class="content clearfix hoc-qua-video">
                            <?php
                            $member_id      = 2; //Membership level "HappyClick"
                            $trial_id       = 1; //Trial level
                            $is_membership  = current_user_on_level($member_id);
                            $is_trial       = current_user_on_level($trial_id);
                            $is_trialview   = is_sticky() && $is_trial;

                            if($is_membership || $is_trialview):

                            $youtubeVideo = get_post_custom_values('youtube-video');
                            $youtubeVideo_link = $youtubeVideo[0];
                            ?>
                                <iframe width="760" height="427" src="<?php echo $youtubeVideo_link; ?>?autoplay=1&amp;version=3&amp;rel=0&amp;ps=docs&amp;color=white&amp;theme=light&amp;showinfo=0&amp;hl=en_US" frameborder="0" allowfullscreen style="border: 1px solid #ddd; box-shadow: 0px 2px 25px #aaa;" ></iframe>
                            <?php else: ?>
                                <div class="iframe_fake">
                                    <?php
                                    echo apply_filters('the_content','[level-member][/level-member]');
                                    ?>
                                </div>
                                <?php
                            endif; ?>
                        </div>
                        <h4 class="video_title"><?php the_title(); ?></h4>
                        <p style="width: 100%;text-align: center;font-size: 13px;font-weight: normal;color: red;">Trang web được hỗ trợ tốt nhất trên trình duyệt Google Chrome</p>
                        <br />
                        <?php
                            $categories = get_the_category();
                            $current_category = $categories[0];

                            $args = array(
                                'cat' => $current_category->cat_ID,
                                'post_status' => array( 'publish' ),
                                'posts_per_page' => 50,
                                'orderby' => 'date',
                                'order' => 'ASC',
                                'show_count' => 1
                            );
                        ?>
                        <div class="video-category" style="border:none;">
                            <?php
                            echo '<div class=" jcarousel-skin-tango">
                                    <div class="jcarousel-container jcarousel-container-horizontal" >
                                        <div class="jcarousel-clip jcarousel-clip-horizontal">
                                            <ul id="mycarousel_videos" class="jcarousel-list jcarousel-list-horizontal">';
                                                $the_query = new WP_Query( $args );
                                                while ( $the_query->have_posts() ) {
                                                    $the_query->the_post();
                                                    echo $this->render('_post-hoc-qua-video');
                                                }
                            echo '          </ul>
                                        </div>
                                        <div class="jcarousel-prev jcarousel-prev-horizontal" style="display: block;"></div>
                                        <div class="jcarousel-next jcarousel-next-horizontal" style="display: block;"></div>
                                    </div>
                                </div>';
                            ?>
                            <script type="text/javascript" language="javascript">
                                (function($) {
                                    /* Jquery carousel script */
                                    $(document).ready(function() {
                                        jQuery('#mycarousel_videos').jcarousel({
                                            scroll: 1
                                        });
                                    });
                                })(jQuery);
                            </script>
                        </div>
                        <div class="back-videos">
                        <?php if(empty($parent_cat)): ?>
                            <a href="<?php echo get_bloginfo('url') ?>/category/<?php echo $current_category->slug; ?>">Các chương trình <?php echo $current_category->name ?> khác</a>
                        <?php
                        else:
                        ?>
                            <a href="<?php echo get_bloginfo('url') ?>/category/<?php echo $parent_cat->slug; ?>">Các chương trình <?php echo $parent_cat->name ?> khác</a>
                        <?php
                        endif; ?>
                        </div>
                    </article>
                </div>
            </div>

		<?php endwhile; ?>
	<?php endif; ?>

</div>