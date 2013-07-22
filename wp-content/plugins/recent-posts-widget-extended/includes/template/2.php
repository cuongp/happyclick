<div <?php echo(!empty($cssID) ? 'id="' . $cssID . '"' : ''); ?> class="rpwe-block" style="margin-top:15px">

				<?php foreach ($rpwewidget as $post) : setup_postdata($post); ?>

			

						<h3 class="rpwe-title" style="margin-top:10px">
							<a  style="font-size:18px;color:#87af23" href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'rpwe'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h3>
						<?php 
					echo	get_the_content();
						?>

				<?php endforeach;
				wp_reset_postdata(); ?>

			</ul>

		</div>