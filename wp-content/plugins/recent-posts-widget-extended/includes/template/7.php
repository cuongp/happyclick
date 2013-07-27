
<div style="position:relative">		
			<ul id="slider">

				<?php foreach ($rpwewidget as $post) : setup_postdata($post); 
				$sukien_data = get_post_meta($post->ID, '_sukien', true);
$terms = wp_get_post_terms( $post->ID, 'chude');
				?>
					
					<li>

						<?php if (has_post_thumbnail() && $thumb == true) { ?>

							<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'rpwe'), the_title_attribute('echo=0')); ?>" rel="bookmark">
								<?php
								if (current_theme_supports('get-the-image'))
									get_the_image(array('meta_key' => 'Thumbnail', 'height' => $thumb_height, 'width' => $thumb_width, 'image_class' => 'rpwe-alignleft', 'link_to_post' => false));
								else
									the_post_thumbnail(array($thumb_height, $thumb_width), array('class' => 'rpwe-alignleft', 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title())));
								?>
							</a>
							<?php echo $terms[0]->name; ?>:<br/><strong><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'rpwe'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php $title = explode(' ', get_the_title());
								$t = '';
								for($i = 0;$i<7;$i++){
									$t=$t.' '.$title[$i];
								}
								echo $t.'...';
							 ?></a></strong>

						<?php } ?>

						
						

					</li>

				<?php endforeach;
				wp_reset_postdata(); ?>

			</ul>
			<div style="clear:both"></div>
    <a class="prev" id="foo1_prev" href="#"><span>prev</span></a>

    <a class="next" id="foo1_next" href="#"><span>next</span></a>
</div>