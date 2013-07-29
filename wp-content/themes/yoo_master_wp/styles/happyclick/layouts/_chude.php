<div id="system">
<?php 
$args = array(
	'posts_per_page'  => -1,
	'offset'          => 0,
	'category'        => '',
	'orderby'         => 'post_date',
	'order'           => 'ASC',
	'include'         => '',
	'exclude'         => '',
	'meta_key'        => '',
	'meta_value'      => '',
	'post_type'       => 'sukien',
	'post_mime_type'  => '',
	'post_parent'     => '',
	'post_status'     => 'publish',
	'suppress_filters' => true ); 
function catch_that_image($content){

$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
$first_img = $matches [1] [0];

// no image found display default image instead
if(empty($first_img)){
$first_img = "/images/default.jpg";
}
return $first_img;
}
	$posts_array = get_posts( $args );
	$i=1;
	if(!empty($posts_array)){
		if($i==1){
			setup_postdata($posts_array[0]);
			 $post_id = get_the_ID();
			$data = get_post_meta( $posts_array[0]->ID, '_sukien', true );
			
		}
            
	?>
	<div class="box2">
	<div class="banner"><img src="<?php echo catch_that_image($posts_array[0]->post_content); ?>"/></div>
	<div class="bodycontent">
		<?php echo the_excerpt();?>
		<p style="text-align:right;float:right;"><a href="<?php echo $posts_array[0]->guid; ?>" class='viewmore'><span>Xem chi tiết</span></a></p>
		
		<div style="clear:both"></div>
	</div>
	<div style="clear:both">
			<ul class="rg">
				<li><a href="/hcaccount/thanh-vien-dang-ky/?cid=<?php echo $posts_array[0]->ID; ?>" class="dk1"><span><?php echo $data['giatien']-$data['giatien']*get_option('hpbasicmembership')/100 ?>đ</span></a></li>

				<li><a href="/hcaccount/khach-dang-ky/?cid=<?php echo $posts_array[0]->ID; ?>"  class="dk2"><span><?php echo $data['giatien'];?>đ</span></a></li>

				<li><a href="/category/thanh-vien/quyen-loi-thanh-vien/"  class="dk3"><span>Trở thành thành viên</span></a></li>
			</ul>
		</div>
		<div style="clear:both"></div>
	</div>
	<div class="box2" style="clear:both;margin-top:15px;padding:10px;padding-top:0px;">
	<h3 style="margin-top:10px;"><em>Các hội thảo vào khóa học tiếp theo</em></h3>
	<?php

		foreach($posts_array as $p){
			setup_postdata($p);
			// $post_id = get_the_ID();
			$data = get_post_meta( $p->ID, '_sukien', true );
			
			if($i>1){
				$terms = wp_get_post_terms( $p->ID, 'chude');
				if($i%2==0)
					$class='sub1';
				else
					$class = 'sub2';

								?>
				<div class="<?php echo $class; ?>">
					<div class="left" style="float:left;padding:10px;padding-bottom:0px;width:500px;">
								<p class="subject" style="font-size:14px;"><em><?php echo $terms[0]->name ?></em><span><?php echo $data['thoigian'] ?></span></p>
								<h2 class="sukien-title"><?php echo $p->post_title; ?></h2>
								<p style="text-align:right"><a style="font-size:12px" href="<?php echo $p->guid; ?>" class="returnhome">Xem chi tiết</a></p>
							</div>

							<div class="right" style="float:right;width:300px;padding-bottom:0px">
								<a href="<?php echo $p->guid; ?>"><img src="<?php echo $data['articleicon']; ?>" width="300" height="135" /></a>
							<div style="clear:both"></div>
						
							</div>
							<div style="clear:both"></div>
						
					
				</div>
		<?php
		}
			$i++;
			}
		}
	
	?>
</div>
</div>
