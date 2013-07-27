<?php
if(isset($_GET['cid']))
	$cid = $_GET['cid'];
else
	$cid = 0;
$post = get_post($cid);
$data = get_post_meta( $cid, '_sukien', true );

?>
<div class="box" style="width:730px">
	<div class="bodycontent">
	<h3>Xác nhận đăng ký</h3>
	<p>Bạn đã đăng ký khóa học/hôi thảo <?php echo $post->post_title; ?> </p>
	</div>

</div>