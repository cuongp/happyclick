<div <?php echo(!empty($cssID) ? 'id="' . $cssID . '"' : ''); ?> class="rpwe-block">

			<ul class="rpwe-ul hoctructuyen">

				<?php 
					$i=1;
				$args = array(
				'numberposts' => -1,
				'cat' => $cat,
				'post_type' => $post_type,
				'orderby'         => 'post_date',
				'order'           => 'ASC'
				);
				$rpwewidget = get_posts($args);
				$news = null;
				foreach ($rpwewidget as $post) : 
					if(strtotime($post->post_date)>time()):
						$news[] = $post;
					endif;
				endforeach;
				foreach ($news as $post) :
					setup_postdata($post);
					if($i==1):
				
				?>
					<li class="rpwe-clearfix first">
						<?php if (has_post_thumbnail() && $thumb == true) { ?>

							<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'rpwe'), the_title_attribute('echo=0')); ?>" rel="bookmark">
								<?php
								if (current_theme_supports('get-the-image'))
									get_the_image(array('meta_key' => 'Thumbnail', 'height' => $thumb_height, 'width' => $thumb_width, 'image_class' => 'rpwe-alignleft', 'link_to_post' => false));
								else
									the_post_thumbnail(array($thumb_height, $thumb_width), array('class' => '', 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title())));
								?>
							</a>

						<?php } ?><div  style="margin-top:10px;">
<span class="rpwe-time"><p><?php echo date("d/m",get_the_time('U'));?></p><?php echo date("Y",get_the_time('U'));?> </span>
						<h3 class="rpwe-title" style="padding-top:20px;">
						<?php if ($date == true) { ?>
							
						<?php } ?>
							<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'rpwe'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h3></div>
						<div style="clear:both">
						<?php if ($excerpt == true) { ?>
							<div class="rpwe-summary"><?php echo rpwe_excerpt($length); ?></div>
						<?php } ?>
						
						</div>
					</li>
				<?php
				elseif($i<4):
				?>
			<li class="rpwe-clearfix">
			<table width="100%">
				<tr>
					<td width="70"><span class="rpwe-time"><p><?php echo date("d/m",get_the_time('U'));?></p><?php echo date("Y",get_the_time('U'));?> </span>
</td>
					<td><h3 class="rpwe-title" style="line-height:20px;">
						<?php if ($date == true) { ?>
							
						<?php } ?>
							<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'rpwe'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h3></td>
				</tr>

			</table>
						
					</li>
				
				<?php
				endif;
				
				$i++;
				endforeach;
				wp_reset_postdata(); 
				?>
					<h2 class="another">Xem các khóa đã tổ chức</h2>
				<?php
				$args = array(
				'numberposts' => -1,
				'cat' => $cat,
				'post_type' => $post_type,
				'orderby'         => 'post_date',
				'order'           => 'DESC'
				);
				$ps = get_posts($args);
				if(!empty($ps)):
					$old =null;
					$i = 0;
					foreach($ps as $p):
						
						if(time() > strtotime($p->post_date)):
						$old[] = $p;
					endif;
					endforeach;
				endif;
				if(!empty($old)):
					foreach ($old as $p) :
						setup_postdata($p);
				?>
				<li style="list-style-type: disc;font-weight:bold;margin-left:13px"><a href="<?php echo $p->guid; ?>" title="<?php echo $p->post_title; ?>" rel="bookmark"><?php echo $p->post_title; ?></a></li>
				<?php
					$i++;
					endforeach;
					endif;
				?>
			</ul>

		</div>