<?php 
global $current_user; 
$is_subs = current_user_has_subscription();
if(!$is_subs){
	wp_redirect('/index.php');
}
function get_exprydate($user_id){
	$db = $GLOBALS['wpdb'];
        $post = $db->get_row('select * from '.$db->prefix.'m_membership_relationships where user_id="'.$user_id.'"');
        return !empty($post)? $post :null;
}
?>

<div class="box">
	<table width="100%">
		<tr>
			<td width="45%">
				<p><a class="profile" href="/hcaccount/profile/"><span>Thông tin cá nhân</span></a></p>
				<p><a class="changepassword" href="/hcaccount/doi-mat-khau/"><span>Đổi mật khẩu</span></a></p>
			
			</td>
			<td valign="top" align="center">
				<h1 class="info"><span>Chào  <?php echo $current_user->last_name;  ?></span></h1>
				<p style="font-size:20px;text-align:center">Bạn đang sử dụng thẻ Happy Click<br/> Thời hạn sử dụng: đến hết ngày <span style="color:red">
<?php 
$p = get_exprydate($current_user->ID);
?>
				<?php echo date('d/m/Y',strtotime($p->expirydate)); ?></span></p>
				<p style="text-align:center"><br/><br/><a href="/hcaccount/thanh-vien-gia-han/" class="renew"><span>Gia hạn</span></a></p>
				<p style="text-align:right"><br/><br/><br/><br/><br/><a href="/index.php" class="returnhome">Trở về trang chủ</a></p>

			</td>
		</tr>
	</table>
</div>