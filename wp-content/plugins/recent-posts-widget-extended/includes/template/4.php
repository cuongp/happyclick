<div <?php echo(!empty($cssID) ? 'id="' . $cssID . '"' : ''); ?> class="rpwe-block">

			<ul class="rpwe-ul">

				<?php foreach ($rpwewidget as $post) : setup_postdata($post); ?>
					
					<li class="rpwe-clearfix rpwebox" style="border:1px solid #ccc;width:<?php echo $thumb_width ?>px;height:<?php echo $thumb_height;  ?>px">

							
							<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'rpwe'), the_title_attribute('echo=0')); ?>" rel="bookmark">
<?php
								if (current_theme_supports('get-the-image'))
									get_the_image(array('meta_key' => 'Thumbnail', 'height' => $thumb_height, 'width' => $thumb_width, 'image_class' => 'rpwe-alignleft', 'link_to_post' => false));
								else
									the_post_thumbnail(array($thumb_height, $thumb_width), array('class' => '', 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title())));
								?>
							</a>
						
					</li>

				<?php endforeach;
				wp_reset_postdata(); ?>

			</ul>

		</div>