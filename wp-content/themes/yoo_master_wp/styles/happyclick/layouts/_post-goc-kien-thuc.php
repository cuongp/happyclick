<div id="item-<?php the_ID(); ?>" class="item courses item-posts-chia-se" data-permalink="<?php the_permalink(); ?>">
	<?php if(has_post_thumbnail()) : ?>
		<?php $width='240'; $height=''; ?>
		<?php echo the_post_thumbnail(array($width,$height), array('class'=>'img_posts_chia_se')); ?>
	<?php endif; ?>
		<div class="posts-content">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div><?php $excerpt = get_post_custom_values('Excerpt'); ?>
			<?php if($excerpt[0] != null) {
					echo $excerpt[0];
				}
			?>
			</div>
		</div>
</div>