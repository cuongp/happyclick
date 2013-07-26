<?php

if(isset($_GET['act']))
	$act = $_GET['act'];
else
	$act = '';
$old_time = $_GET['code'];
$current_time = time()-$old_time;
$user_id = $_GET['user_id'];
if(isset($_GET['token']))
	$token = $_GET['token'];
else
	$token = 0;
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
		if($act=='khach-dang-ky')
			wp_redirect('/hcaccount/thanh-toan/?act=khach-dang-ky&user_id='.$user_id);
?>

<div class="box" style="width:500px;">
	<p>Email của bạn đã được xác thực. Hãy đăng nhập để bắt đầu sử dụng dịch vụ của Happy Click.</p>
	<?php echo $this['modules']->render('login-modal'); 
	
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
<?php
if(isset($_GET['act']) && $_GET['act'] =='doi-mat-khau'){
?>
<div class="box" style="width:500px;">
	<p>Chúc mừng bạn đã tạo mật khẩu mới thành công. Bạn đã có thể đăng nhập để tiếp tục
sử dụng dịch vụ của Happy Click</p>
	<?php echo $this['modules']->render('login-modal'); 
	
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