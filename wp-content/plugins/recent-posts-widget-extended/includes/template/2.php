<div <?php echo(!empty($cssID) ? 'id="' . $cssID . '"' : ''); ?> class="rpwe-block">

				<?php foreach ($rpwewidget as $post) : setup_postdata($post); ?>

						<?php if (has_post_thumbnail() && $thumb == true) { ?>

							<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'rpwe'), the_title_attribute('echo=0')); ?>" rel="bookmark">
								<?php
								if (current_theme_supports('get-the-image'))
									get_the_image(array('meta_key' => 'Thumbnail', 'height' => $thumb_height, 'width' => $thumb_width, 'image_class' => 'rpwe-alignleft', 'link_to_post' => false));
								else
									the_post_thumbnail(array($thumb_height, $thumb_width), array('class' => 'rpwe-alignleft', 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title())));
								?>
							</a>

						<?php } ?>

						<h3 class="rpwe-title">
							<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'rpwe'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h3>
						<?php 
						get_the_content();
						?>

				<?php endforeach;
				wp_reset_postdata(); ?>

			</ul>

		</div>