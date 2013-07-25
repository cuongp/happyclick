<?php
$old_time = $_GET['code'];
$current_time = time()-$old_time;
$user_id = $_GET['user_id'];
$token = $_GET['token'];

if(isset($_GET['level_id']))
	$level_id = $_GET['level_id'];
else
	$level_id = 0;

if($current_time>12*3600*1000){
?>

<div class="box" style="width:500px;">
	<p>Quá thời gian kích hoạt tài khoản</p>
	
<table width="100%">
	<tr>
				<td colspan="2" align="right"><a href="/index.php" class="returnhome">Trở về trang chủ</a></td>

			</tr>
		</table>
</div>
<?php	
}else{
		update_usermeta($user_id,'wp_membership_active','yes');
	
?>

<div class="box" style="width:500px;">
	<p>Email của bạn đã được xác thực. Hãy đăng nhập để bắt đầu sử dụng dịch vụ của Happy Click.</p>
	<?php echo $this['modules']->render('login-modal'); 
	//	var_dump($_COOKIE['hc_welcome']);
	?>

<table width="100%">
	<tr>
				<td colspan="2" align="right"><a href="/index.php" class="returnhome">Trở về trang chủ</a></td>

			</tr>
		</table>
</div>
<?php
}
?>