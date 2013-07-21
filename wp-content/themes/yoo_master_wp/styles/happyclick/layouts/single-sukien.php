
<div id="system" class="box2">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post();
		$post_id = get_the_ID(); 
		$data = get_post_meta( $post_id, '_sukien', true );
		?>
		
		<article class="item" data-permalink="<?php the_permalink(); ?>">
		
			<?php if (has_post_thumbnail()) : ?>
				<?php
				$width = get_option('thumbnail_size_w'); //get the width of the thumbnail setting
				$height = get_option('thumbnail_size_h'); //get the height of the thumbnail setting
				?>
			<?php endif; ?>

			<!--<header>
		
				<h1 class="title"><?php the_title(); ?></h1>
	
				<p class="meta">
					<?php
						$date = '<time datetime="'.get_the_date('Y-m-d').'" pubdate>'.get_the_date().'</time>';
						printf(__('Written by %s on %s. Posted in %s', 'warp'), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>', $date, get_the_category_list(', '));
					?>
				</p>

			</header>-->

			<div class="content clearfix" >
			<?php the_content(''); ?>
<ul class="rg">
				<li><a href="<?php echo get_permalink() ?>" class="dk1"><span>Thành viên đăng ký</span></a><?php echo $data['giatien']*0.5 ?></li>

				<li><a href="<?php echo get_permalink() ?>"  class="dk2"><span>Khách đăng ký</span></a></li>

				<li><a href="<?php echo get_permalink() ?>"  class="dk3"><span>Trở thành thành viên</span></a></li>
			</ul>
			</div>

			<?php the_tags('<p class="taxonomy">'.__('Tags: ', 'warp'), ', ', '</p>'); ?>

			<?php edit_post_link(__('Edit this post.', 'warp'), '<p class="edit">','</p>'); ?>
			
			<?php if (pings_open()) : ?>
			<p class="trackback"><?php printf(__('<a href="%s">Trackback</a> from your site.', 'warp'), get_trackback_url()); ?></p>
			<?php endif; ?>

			<?php if (get_the_author_meta('description')) : ?>
			<section class="author-box clearfix">
		
				<?php echo get_avatar(get_the_author_meta('user_email')); ?>
				
				<h3 class="name"><?php the_author(); ?></h3>
				
				<div class="description"><?php the_author_meta('description'); ?></div>

			</section>
			<?php endif; ?>
			
			<?php comments_template(); ?>

		</article>

		<?php endwhile; ?>
	<?php endif; ?>

</div>