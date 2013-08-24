
<div class="box" style="width:550px">
<?php
$flag = '';
if(isset($_POST) && $_POST['action'] == 'submit')
{
	global $current_user;

	if(!email_exists($_POST['email'])){
		$flag = '<h3 class="error">Email không tồn tại trong hệ thống.</h3>';
	}else
	{
		$expdate = date("d-m-Y H:i",strtotime('+24 hour'));
		$db = $GLOBALS['wpdb'];
		$user = get_user_by('email',$_POST['email']);
		$key = md5($user->ID . time().rand());
		$db->update($db->prefix.'users',array('user_activation_key'=>$key),array('ID'=>$user->ID));
		update_usermeta($user_id,'wp_membership_active','yes');
		$html = '<table width="600" cellpadding="0" cellspacing="0" bgcolor="#799d1f" style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 14px;">
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
  <td height="323" valign="top" style="padding: 10px 10px 0px 10px; height=; color: #003399; font-size: 14px;"><p style="padding:10px">Chào '.$user->last_name.'<br />
      <br />
      Happy Click vừa nhận được yêu cầu thiết lập mật khẩu mới của bạn dùng để đăng nhập vào trang web <a href="http://www.happyclick.com.vn">www.happyclick.com.vn</a> cho tài khoản email '.$_POST['email'].' Vui lòng nhấn vào đường dẫn bên dưới để thực hiện thiết lập mật khẩu mới cho tài khoản của bạn:<br /><br />
      <a href="'.get_site_url().'/hcaccount/doi-mat-khau/?act=rp&user_id='.$user->ID.'&key='.$key.'">Click vào đây để lấy lại mật khẩu</a><br />
      <br />
      Đường dẫn này sẽ chỉ có giá trị đến '.$expdate.'<br />
      <br />
      Nếu bạn không phải là người gửi yêu cầu thiết lập mật khẩu mới, vui lòng bỏ qua email này.<br />
      <br />
      <p style="background:red;padding:5px">Đây là email tự động gửi, vui lòng không trả lời vào email này.</p><br />
      <br />
      Thân mến,<br />
      <br />
      <strong style="color: #68A400">Công ty Cổ phần Tư vấn và Đào tạo Happy Click</strong><br />
      <em>Hỗ trợ 24/7: (08) 7302 0168 – (08) 7303 0168</em><br />
      <em>Email: <span style="color: #3399FF; font-style: italic; font-weight: bold;"><a href="mailto:lienhe@happyclick.com.vn">lienhe@happyclick.com.vn</a></span></em></p>
    <p>&nbsp;</p></td>
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
		$headers[] ='Content-type: text/html';

		wp_mail($_POST['email'],'Thiết lập mật khẩu mới',$html,$headers);
		wp_redirect('/hcaccount/xac-nhan-email/?act=quen-mat-khau');
		exit;
	}
}
?>
		<form id="form" method="post" class="form_profile">
		<?php echo $flag; ?>
		<p>Vui lòng nhập email mà bạn dùng để đăng nhập vào ô bên dưới</p><br/>
		<table width="100%" class="form_doipass">

			<tr>
				<td  width="20%" style="padding-right:30px"  align="right">Email</td>
				<td width="50%" ><input class="email" name="email"  type="email"required/><span>*</span></td>
			</tr>
			<tr>

				<td colspan="2" align="center"><input type="hidden" name="action" value="submit"><input type="submit" value="" class="submit_final" /></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><a style="font-size:!4px" href="<?php echo get_site_url(); ?>" class="returnhome">Trở về trang chủ</a></td>

			</tr>
		</table>
		</form>
	</div>
