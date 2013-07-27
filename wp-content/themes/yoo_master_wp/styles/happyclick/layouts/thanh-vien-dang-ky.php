<?php
global $current_user;
$is_member = current_user_is_member();
	$is_subs = current_user_has_subscription();
	
$cid = $_GET['cid'];
if($current_user->ID > 0){
	$db = $GLOBALS['wpdb'];
	$db->insert($db->prefix.'user_sukien',
				array('user_id'=>$current_user->ID 
					,'sukien_id'=>$_GET['cid']
					,'created_at'=>time()
					,'payment_status'=>0
					));
	wp_redirect('/hcaccount/thanh-toan/?act=thanh-vien-dang-ky&user_id='.$current_user->ID.'&cid='.$cid.'&code='.time());
}
?>

<?php if($current_user->ID < 1): ?>
<div class="box" style="width:730px">
<p>Nếu bạn là thành viên của Happy Click, vui lòng đăng nhập</p>
<div ><?php echo $this['modules']->render('login-modal'); ?></div>
</div>
<?php endif; ?>
<div class="box" style="width:730px">
<p>Nếu bạn đã đăng ký xem thử hoặc chưa có tài khoản của Happy Click, bạn có thể trở thành
thành viên để được ưu đãi phí tham dự hội thảo và khóa học của Happy Click</p>
<p class="cat-post-title1" style="text-align:right" >
<a href="/category/thanh-vien/quyen-loi-thanh-vien/"  style="height:30px;width:200px;float:right;"></a>
</p>
<div class="clear"></div>
</div>
<table width=100% style="margin:0 auto;width:780px">
	<tr>
		<td align="right"><a href="<?php echo get_site_url() ?>" class="returnhome">Trở về trang chủ</a></td>
	</tr>
</table>