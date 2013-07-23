<div id="system" class="onecolumn single">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
            <div class="content-box1">
                <h3 class="content-box-title">Học qua Video</h3>
                <div class="content-box-inside">
                    <div class="remove_link video-category-title"><?php echo get_the_category_list(); ?></div>
                    <article id="item-<?php the_ID(); ?>" class="item courses" data-permalink="<?php the_permalink(); ?>">
                        <div class="content clearfix hoc-qua-video">
                            <?php 
                            $youtubeVideo = get_post_custom_values('youtube-video'); 
                            $youtubeVideo_link = $youtubeVideo[0];
                            ?>
                            <iframe width="560" height="414" src="<?php echo $youtubeVideo_link; ?>?showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="related-video">
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
                        </div>
                        <h4 class="video_title" style="font-weight:bold; text-align:center;"><?php the_title(); ?></h4>
                        <br />
                        <br />
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
                                        jQuery('#mycarousel_videos').jcarousel();
                                    });
                                })(jQuery);
                            </script>
                        </div>
                    </article>
                </div>
            </div>

		<?php endwhile; ?>
	<?php endif; ?>

</div>