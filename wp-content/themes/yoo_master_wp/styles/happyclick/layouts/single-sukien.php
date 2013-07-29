
<div id="system" class="box2">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post();
		$post_id = get_the_ID(); 
		$data = get_post_meta( $post_id, '_sukien', true );
		$term = get_the_terms($post_id, 'chude');

		foreach ($term as $key => $value) {
			$id = $value->term_id;
		}
		if($id < 35){
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
				<li><a href="/hcaccount/thanh-vien-dang-ky/?cid=<?php echo $post_id; ?>" class="dk1"><span><?php echo number_format($data['giatien']-$data['giatien']*get_option('hpbasicmembership')/100,0,'.','.') ?>đ</span></a></li>

				<li><a href="/hcaccount/khach-dang-ky/?cid=<?php echo $post_id; ?>"  class="dk2"><span><?php echo number_format($data['giatien'],0,'.','.');?>đ</span></a></li>

				<li><a href="/category/thanh-vien/quyen-loi-thanh-vien/"  class="dk3"><span>Trở thành thành viên</span></a></li>
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

		<?php 
			}else
			{
		?>
			<article class="item" style="padding:20px 10px" data-permalink="<?php the_permalink(); ?>">
			<header>
		
				<h1 class="title"><?php the_title(); ?></h1>
			</header>
			<div class="content clearfix" >
			<?php the_content(''); ?>
			<p>Thời gian: <?php echo $data['thoigian']; ?></p>
			<ul class="rg">
				<li><a href="/hcaccount/thanh-vien-dang-ky/?cid=<?php echo $post_id; ?>" class="dk4"><span><?php echo number_format($data['giatien']-$data['giatien']*get_option('hpbasicmembership')/100,0,'.','.') ?>đ</span></a></li>

				<li><a href="/hcaccount/khach-dang-ky/?cid=<?php echo $post_id; ?>"  class="dk5"><span><?php echo number_format($data['giatien'],0,'.','.');?>đ</span></a></li>

				<li><a href="" onclick="" class="dk6"><span>Trở thành thành viên</span></a></li>
			</ul>
			</div>
			
		</article>
		<?php
			}
		endwhile; ?>
	<?php endif; ?>

</div>