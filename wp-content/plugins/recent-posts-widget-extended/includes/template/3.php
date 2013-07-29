<div <?php echo(!empty($cssID) ? 'id="' . $cssID . '"' : ''); ?> class="rpwe-block">

			<ul class="rpwe-ul hoctructuyen">

				<?php 
					$i=1;
				foreach ($rpwewidget as $post) : setup_postdata($post); 
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
				elseif($i==4):
				?>
				<h2 class="another">Xem các khóa đã tổ chức</h2>
				<li style="list-style-type: disc;font-weight:bold;margin-left:13px"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'rpwe'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></li>
				<?php
				else:
				?>
				<li style="list-style-type: disc;font-weight:bold;margin-left:13px"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'rpwe'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></li>
				
				<?php
				endif; 
				$i++;
				endforeach;
				wp_reset_postdata(); ?>

			</ul>

		</div>