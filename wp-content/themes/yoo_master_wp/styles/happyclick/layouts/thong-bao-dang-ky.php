<?php
global $current_user;
$cid = $_GET['cid'];
$post = get_post($cid);
		$data = get_post_meta( $post->ID, '_sukien', true );
?>

<div class="box" style="width:730px">
	<div class="bodycontent">
	<h3>Thông báo đăng ký</h3>
	<p>Bạn đã đăng ký sự kiện <b><?php echo $post->post_title; ?></b> này rồi.</p>
	<p>Mã đơn hàng : HC_<?php echo $post->ID.$current_user->ID; ?></p>
	</div>
</div>