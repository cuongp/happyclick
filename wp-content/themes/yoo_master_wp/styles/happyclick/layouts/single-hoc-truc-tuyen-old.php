<div id="system" class="single-hoc-truc-tuyen-old single">
	<?php if(have_posts()): ?>
		<?php while(have_posts()): the_post(); ?>
		
			<div class="content-box1">
				 <h3 class="content-box-title"><?php _e('KHÓA HỌC TRỰC TUYẾN ĐÃ TỔ CHỨC','warp'); ?></h3>
				 <div class="content-box-inside">
					<div class="content-img">
						<a href="#" class="how-to-join">&nbsp;</a> 
						<img src="http://dev.happyclick.vn/wp-content/uploads/2013/07/img-tree.png" />
					</div>
					<div class="content-box-video">
						<p><?php _e('Xem lại nội dung khóa học trực tuyến','warp'); ?></p>
						<img src="http://dev.happyclick.vn/wp-content/uploads/2013/07/img-video.png">
						<p><a href="#"><?php _e('Download tài liệu','warp'); ?></a></p>
					</div>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
					
				 </div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>