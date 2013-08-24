<?php
$chude =get_query_var('chude');
if($chude=='phat-trien-nghe-nghiep' || $chude=='hoi-dap-voi-chuyen-gia'):
?>
<div id="system">
	<?php if (have_posts()) : ?>

		<?php if (is_category()) : ?>
			<?php /* <h1 class="page-title">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h1> */ ?>
		<?php elseif (is_tag()) : ?>
			<h1 class="page-title"><?php printf(__('Posts Tagged %s', 'warp'), '&#8216;'.single_tag_title('', false).'&#8217;'); ?></h1>
		<?php elseif (is_day()) : ?>
			<h1 class="page-title"><?php printf(__('Archive for %s', 'warp'), get_the_date()); ?></h1>
		<?php elseif (is_month()) : ?>
			<h1 class="page-title"><?php printf(__('Archive for %s', 'warp'), get_the_date('F, Y')); ?></h1>
		<?php elseif (is_year()) : ?>
			<h1 class="page-title"><?php printf(__('Archive for %s', 'warp'), get_the_date('Y')); ?></h1>
		<?php elseif (is_author()) : ?>
			<h1 class="page-title"><?php _e('Author Archive', 'warp'); ?></h1>
		<?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : ?>
			<h1 class="page-title"><?php _e('Blog Archives', 'warp'); ?></h1>
		<?php endif; ?>
		<?php
		$current_tax = get_query_var('chude');
		if($current_tax=='phat-trien-nghe-nghiep'):
		?>
		<div id="tabs">
			<ul>
				<li id="tab-radio" class="ui-tabs-active" style="text-indent:-95px !important" >
                    <div class="mystyle" ><a href="/chude/phat-trien-nghe-nghiep/">Hỏi đáp với chuyên viên tư vấn phát triển nghề nghiệp</a></div>
                    </li>
				<li id="tab-cs">
				<div class="mystyle"><a  style="margin-left:100px;" href="/category/hanh-trang-nghe-nghiep/">Hành trang nghề nghiệp</a></div>
				</li>
			</ul>
		</div>
		<?php
		endif;
		?>
            <div class="posts-wrapper" style="padding:20px 10px;position:relative; width:97%">
                <div class="content-box-inside">
                    <?php
                        $trial_id       = 1; //Trial level
                        $member_id      = 2; //Membership level "HappyClick"
                        $is_trial       = current_user_on_level($trial_id);
                        $is_membership  = current_user_on_level($member_id);
                        echo $this->render('_posts-sukien');
                    ?>
                </div>
            </div>

	<?php else : ?>

		<?php if (is_category()) : ?>
			<h1 class="page-title"><?php printf(__("Sorry, but there aren't any posts in the %s category yet.", "warp"), single_cat_title('', false)); ?></h1>
		<?php elseif (is_date()) : ?>
			<h1 class="page-title"><?php _e("Sorry, but there aren't any posts with this date.", "warp"); ?></h1>
		<?php elseif (is_author()) : ?>
			<?php $userdata = get_userdatabylogin(get_query_var('author_name')); ?>
			<h1 class="page-title"><?php printf(__("Sorry, but there aren't any posts by %s yet.", "warp"), $userdata->display_name); ?></h1>
		<?php else : ?>
			<h1 class="page-title"><?php _e("No posts found.", "warp"); ?></h1>
		<?php endif; ?>

		<?php get_search_form(); ?>

	<?php endif; ?>

</div>
<?php
else:
$args = array(
	'posts_per_page'  => -1,
	'offset'          => 0,
	'category'        => '',
	'orderby'         => 'meta_value',
	'meta_query'	  => array('key' => 'thoigian'),
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
$is_subs = current_user_has_subscription();

function catch_that_url($content){

$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<a.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
$first_img = $matches [1] [0];

// no image found display default image instead
if(empty($first_img)){
$first_img = "";
}
return $first_img;
}
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
	<div class="banner"><a href="<?php echo catch_that_url($posts_array[0]->post_content); ?>"><img src="<?php echo catch_that_image($posts_array[0]->post_content); ?>"/></a></div>
	<div class="bodycontent">
		<?php echo the_excerpt();?>
		<p style="text-align:right;float:right;"><a href="<?php echo $posts_array[0]->guid; ?>" class='viewmore'><span>Xem chi tiết</span></a></p>

		<div style="clear:both"></div>
	</div>
	<div style="clear:both">
			<ul class="rg">
				<li><a href="/hcaccount/thanh-vien-dang-ky/?cid=<?php echo $posts_array[0]->ID; ?>" class="dk1"><span><?php if(isset($data['giatien'])) echo number_format($data['giatien']-$data['giatien']*get_option('hpbasicmembership')/100,0,'.','.') ?>đ</span></a></li>
				<!--<li class="dk1"><span><?php if(isset($data['giatien'])) echo number_format($data['giatien']-$data['giatien']*get_option('hpbasicmembership')/100,0,'.','.') ?>đ</span></li>-->
				<li><a href="/dang-ky-su-kien-cho-khach/"  class="dk2"><span><?php if(isset($data['giatien'])) echo number_format($data['giatien'],0,'.','.');?>đ</span></a></li>


				<!--<li class="dk2"><span><?php if(isset($data['giatien'])) echo number_format($data['giatien'],0,'.','.');?>đ</span></li>-->
				<?php if(!$is_subs): ?><li><a href="/category/thanh-vien/quyen-loi-thanh-vien/"  class="dk3"><span>Trở thành thành viên</span></a></li><?php endif; ?>
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
			$time = explode('|', $data['thoigian']);
					if(count($time)>1){
						$date = $time[1];
						$hour = $time[0];
					}else
					{
						$date = $time[0];
						$hour = $time[0];
					}
					

			if($i>1){

				$terms = wp_get_post_terms( $p->ID, 'chude');
				if($terms[0]->slug=='hoi-thao' || $terms[0]->slug =='khoa-hoc'):

				if($i%2==0)
					$class='sub1';
				else
					$class = 'sub2';

								?>
				<div class="<?php echo $class; ?>">
					<div class="left" style="float:left;padding:10px;padding-bottom:0px;width:500px;">
								<p class="subject" style="font-size:14px;"><em><?php echo $terms[0]->name ?></em><span><?php echo $date ?></span></p>
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
			endif;
		}
			$i++;
			}
		}

	?>
</div>
<?php endif;?>