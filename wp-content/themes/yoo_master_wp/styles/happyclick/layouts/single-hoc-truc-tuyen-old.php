<div id="system" class="single-hoc-truc-tuyen-old single">
	<?php if(have_posts()): ?>
		<?php while(have_posts()): the_post(); ?>
		
			<div class="content-box1">
				 <h3 class="content-box-title"><?php _e('KHÓA HỌC TRỰC TUYẾN ĐÃ TỔ CHỨC','warp'); ?></h3>
				 <div class="content-box-inside">
					<div class="content-img">
						<a href="<?php echo get_bloginfo('url'); ?>/wp-content/uploads/2013/07/Webinar_Guide.pdf" class="how-to-join" target="_blank">&nbsp;</a> 
						<?php if(has_post_thumbnail()): ?>
						<?php $width = '218'; $height = ''; ?>
							<?php the_post_thumbnail(array($width,$height),array('class'=>'size-auto')); ?>
						<?php endif; ?>
					</div>
                     <?php 
                     $level_id = 2; //Membership level "HappyClick"
                     $is_membership = current_user_on_level($level_id);
                     if($is_membership):
                     ?>
                        <div class="content-box-video">
                            <p><?php _e('Xem lại nội dung khóa học trực tuyến','warp'); ?></p>
                             <?php 
                                $youtubeVideo = get_post_custom_values('hoc_truc_tuyen_old_youtube_video'); 
                                $youtubeVideo_link = $youtubeVideo[0];
                                $links = get_post_custom_values('hoc_truc_tuyen_old_tai_lieu');
                                $link = $links[0];
                                ?>
                                <iframe width="510" height="321" src="<?php echo $youtubeVideo_link; ?>?autoplay=0&amp;version=3&amp;rel=0&amp;ps=docs&amp;color=white&amp;theme=light&amp;showinfo=0&amp;hl=en_US" type="application/x-shockwave-flash" frameborder="0" allowfullscreen style="float:right;" ></iframe>
                            <?php /* <p><a href="<?php echo $link; ?>"><?php _e('Download tài liệu','warp'); ?></a></p> */?>
                            <p style="width: 94%;text-align: center;font-size: 13px;font-weight: normal;color: red;">Trang web được hỗ trợ tốt nhất trên trình duyệt Google Chrome</p>
                        </div>
                     <?php endif; ?>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
					
				 </div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>