<div style="position:relative">		
			<ul id="slider" style="left:-20px">
				<?php foreach ($rpwewidget as $post) : setup_postdata($post); 
				$sukien_data = get_post_meta($post->ID, '_sukien', true);
				$terms = wp_get_post_terms( $post->ID, 'chude');
				if($sukien_data['isslider']==1):
				?>
					
					<li>

						<?php if (has_post_thumbnail() && $thumb == true) { ?>

							<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'rpwe'), the_title_attribute('echo=0')); ?>" rel="bookmark">
								
								<img class="rpwe-alignleft" src="<?php echo $sukien_data['slidericon'] ?>" />
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
				<?php 
					endif;
				endforeach;
				wp_reset_postdata(); ?>

			</ul>
			<div style="clear:both"></div>
    <a class="prev" id="foo1_prev" href="#"><span>prev</span></a>
    <a class="next" id="foo1_next" href="#"><span>next</span></a>
</div>