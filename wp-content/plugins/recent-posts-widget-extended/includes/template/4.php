<div <?php echo(!empty($cssID) ? 'id="' . $cssID . '"' : ''); ?> class="rpwe-block">

			<ul class="rpwe-ul">

				<?php foreach ($rpwewidget as $post) : setup_postdata($post); ?>
					
					<li class="rpwe-clearfix rpwebox" style="border:1px solid #ccc;width:<?php echo $thumb_width ?>px;height:<?php echo $thumb_height;  ?>px">

							
							<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'rpwe'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a>
						
					</li>

				<?php endforeach;
				wp_reset_postdata(); ?>

			</ul>

		</div>