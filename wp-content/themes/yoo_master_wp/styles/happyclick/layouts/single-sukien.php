
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
			<h3>Chương trình hội thảo sẽ bắt đầu mở đăng ký từ ngày 10/08/2013</h3>
			<ul class="rg">
				<li><a href="/hcaccount/thanh-vien-dang-ky/?cid=<?php echo $post_id; ?>" class="dk1"><span><?php if(isset($data['giatien'])) echo number_format($data['giatien']-$data['giatien']*get_option('hpbasicmembership')/100,0,'.','.') ?>đ</span></a></li>
				<!--<li class="dk1"><span><?php if(isset($data['giatien'])) echo number_format($data['giatien']-$data['giatien']*get_option('hpbasicmembership')/100,0,'.','.') ?>đ</span>	</li>-->
						
				<li><a href="/dang-ky-su-kien-cho-khach/"  class="dk2"><span><?php if(isset($data['giatien'])) echo number_format($data['giatien'],0,'.','.');?>đ</span></a></li>
				<!--<li class="dk2"><span><?php if(isset($data['giatien'])) echo number_format($data['giatien'],0,'.','.');?>đ</span></li>-->


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
				global $current_user;
				$db = $GLOBALS['wpdb'];
				if($_POST['question']){
					$result_id = $db->insert($db->prefix.'qna'
								,array('user_id'	=>	$current_user->ID
										,'post_id'	=>	$_POST['post_id']
										,'question'	=>	$_POST['question']
										,'post_date'=>	time()
					));
					if($result_id){
						$flag = '<h3>Câu hỏi của bạn được gửi, Cám ơn bạn!</h3>';
						$html='<table width="600" cellpadding="0" cellspacing="0" bgcolor="#799d1f" style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 14px;">
            <tbody>
            <tr>
            <td align="center" valign="top"> </td>
            </tr>
            <tr>
            <td align="center" valign="top">
            <table width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="width: 600px; font-family: Arial, Helvetica, sans-serif;">
            <tbody>
            <tr>
              <td><a href="http://www.happyclick.com.vn"><img src="http://www.unity.com.vn/images/HC_Banner.png" align="center" width="598" height="130" /></a></td>
            </tr>
            <tr>
             <td>Bạn nhận đươc câu hỏi từ thành viên '.$current_user->last_name.'
             <br/>
             Câu hỏi : '.$_POST['question'].'
             </td>
            </tr>
            </tbody>
            </table>
            <table style="width: 600px;" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
              <tbody>
                <tr> </tr>
                </tbody>
            </table></td>
            </tr>
            <tr>
            <td align="center" valign="top"> </td>
            </tr>
            </tbody>
            </table>';
            
            $headers[] = 'From: Happy Click <support@happyclick.vn>';
			$headers[] = 'Content-type: text/html';
			wp_mail($email,'Bạn có câu hỏi từ '.$current_user->last_name,$html,$headers);
					}else
						$flag = '';
				}
		?>
			<article class="item" style="padding:20px 10px" data-permalink="<?php the_permalink(); ?>">
			<header>
		
				<h1 class="title"><?php the_title(); ?></h1>
			</header>
			<div class="clearfix" >
			<?php the_content(''); 
			$time = explode('|', $data['thoigian']);
			if(count($time)>1){
				$date = $time[1];
				$hour = $time[0];
			}else
			{
				$date = $time[0];
				$hour = $time[0];
			}
			echo $flag;
			?>
			<!--<p>Thời gian: <?php echo $hour; ?></p>
			<p>Ngày: <?php echo $date; ?></p>
			<table border="0" align="left">
<tbody>
<tr>
<td width="250"><a target="_blank" href="/hcaccount/thanh-vien-dang-ky/?cid=<?php echo $post_id; ?>"><img width="122" height="35" src="/wp-content/uploads/2013/07/dang-ky.png" alt="Đăng ký" class="alignnone size-full wp-image-2481"></a></td>
<td width="280"><a href="/category/thanh-vien/quyen-loi-thanh-vien/"><img src="/wp-content/uploads/2013/07/tro-thanh-thanh-vien.png" alt="Trở thành thành viên" class="alignnone size-full wp-image-2480"></a></td>
<td width="300"><a href="/huong-dan-tham-du"><img src="/wp-content/uploads/2013/07/huong-dan-tham-du-.png" alt="Hướng dẫn tham dự" class="alignnone size-full wp-image-2482"/></a></td>
</tr>
<tr>
<td width="250">(<em>Chỉ dành cho thành viên</em>)</td>
<td width="280"></td>
<td width="300"></td>
</tr>
</tbody>
</table>
<p>
<span style="color: #83b87a;">
<strong>Các câu hỏi đã được đặt:</strong>
</span>
</p>-->
		
			</div>
			
		</article>
		<?php
			}
		endwhile; ?>
	<?php endif; ?>

</div>