
<?php


//wp_mail('minhcuong@siliconstraits.vn','Testing','Testing');

global $current_user;
$flag=false;
if(isset($_POST) && $_POST['action'] == 'submit'){
$db = $GLOBALS['wpdb'];


		$user_id = wp_create_user( $_POST['email'], $_POST['password'], $_POST['email'] ); 
		if($user_id>0){
			foreach ($_POST as $key=>$val) {
				if($key !='action')
					update_usermeta( $user_id, $key, $val);
				}
				update_usermeta($user_id,'first_name',$_POST['fullname']);
				$db->insert($db->prefix.'m_membership_relationships',
				array('user_id'=>$user_id
					,'sub_id'=>0
					,'level_id'=>1
					,'startdate'=>date("Y-m-d H:i:s")
					,'expirydate'=>NULL
					,'updateddate'=>date("Y-m-d H:i:s")
					,'order_instance'=>0
					,'usinggateway'=>'admin'
					));
				update_usermeta($user_id,'wp_membership_active','no');
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
  <td height="323" valign="top" style="padding: 10px 10px 0px 10px; height=; color: #003399; font-size: 14px;"1354><p>Chào '.$_POST['fullname'].'<br />
      <br />
      Cảm ơn bạn đã đăng ký xem thử một số tiện ích của Happy Click.<br />
      <br />
      Thông tin tài khoản đăng nhập bạn đã đăng ký:</p>
    <blockquote>
      <p>Tên đăng nhập: '.$_POST['email'].'<br />
        Mật khẩu: '.$_POST['password'].'</p>
    </blockquote>
    <p>Để hoàn tất quy trình đăng ký xem thử, vui lòng nhấn vào đường dẫn bên dưới để kích hoạt tài khoản xem thử:<br />
    <a href="'.get_site_url().'/hcaccount/xac-thuc-email/?act=active&user_id='.$user_id.'&code='.time().'">Kích hoạt tài khoản xem thử</a></p>
    <p>Đường dẫn này sẽ chỉ có giá trị trong 12 giờ</p>
    <p>Ngay sau khi kích hoạt tài khoản, bạn đã có thể bắt đầu xem thử một số tiện ích. Happy Click hy vọng bạn sẽ được trải nghiệm những kiến thức bổ ích, nội dung thiết thực.</p>
    <p>Đây là email tự động gửi, vui lòng không trả lời vào email này.<br />
      <br />
      Thân mến,<br />
      <br />
      <strong style="color: #68A400">Công ty Cổ phần Tư vấn và Đào tạo Happy Click</strong><br />
      <em>Hỗ trợ 24/7: (08) 7302 0168 – (08) 7303 0168</em><br />
      <em>Email: <span style="color: #3399FF; font-style: italic; font-weight: bold;"><a href="mailto:lienhe@happyclick.com.vn">lienhe@happyclick.com.vn</a></span></em> </p>
    <p><br />
</p></td>
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
			wpMandrill::mail($_POST['email'],'Xác nhận email',$html);	
			wp_redirect('/hcaccount/xac-nhan-email/');
			exit;
			}
			
			
	wp_reset_query();
	
}

$gender = get_usermeta( $current_user->ID, 'gender');

?>
<?php 
			if ($this['modules']->count('top-a2')) : ?>
			<section id="top-a2" class="grid-block"><?php echo $this['modules']->render('top-a2', array('layout'=>$this['config']->get('top-a2'))); ?></section>
            <?php
            endif;
				?>
<?php if($current_user->ID < 1): ?>
<div class="box" style="width:730px">
<p>Đăng nhập nếu bạn đã có tài khoản dùng thử</p>
<div style="float:right"><?php echo $this['modules']->render('login-modal'); ?></div>
<div style="clear:both"></div>
</div>
<?php endif; ?>
<div class="box" style="width:730px">

<form id="form" class="form_profile" method="post">
		<?php 
//echo $flag;
?>
		<table width="100%" class="form_doipass">
			
			<tr>
				<td colspan="2"><br/>
				<p><strong>THÔNG TIN CÁ NHÂN</strong></p><br/>	
				</td>

			</tr>			<tr>
				<td colspan="2">
					
					<p>(<span>*</span>) Thông tin bắt buộc</p><br/>
				</td>
			</tr>

			<tr>
				<td class="box3" width="45%"  align="right">Họ và tên</td>
				<td  class="box4"><input type="text" id="fullname" name="fullname" placeholder="Vui lòng gõ tiếng Việt có dấu" value="<?php echo get_usermeta( $current_user->ID, 'fullname'); ?>" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3"  align="right">Giới tính</td>
				<td  class="box4"><input type="radio" name="gender" value="0" <?php if($gender==0) echo 'checked=checked'; else echo ''; ?> /> Nam <input type="radio" name="gender" value="1" <?php if($gender==1) echo 'checked=checked'; else echo ''; ?> /> Nữ</td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Ngày sinh</td>
				<td  class="box4"><input type="text" id="birthday" name="birthday" value="<?php echo get_usermeta( $current_user->ID, 'birthday'); ?>" placeholder="Ngày/tháng/năm" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Email <br/> <em style="font-weight:normal">Email này bạn đã dùng để đăng nhập, nếu cần thay đổi vui lòng liên hệ với Happy Click.<br/><strong>Hỗ trợ 24/7: (08) 7302 0168 - (08) 7303 0168</strong></em></td>
				<td  class="box4"><input type="text" name="email" id="email" value="<?php echo $current_user->user_email ?>" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Email<br/><em>Email cá nhân hoặc email thường sử dụng</em></td>
				<td  class="box4"><input id="subemail" type="text" name="subemail"  value="<?php echo get_usermeta( $current_user->ID, 'subemail'); ?>" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Mật khẩu</td>
				<td  class="box4"><input type="password" name="password" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Xác nhận mật khẩu</td>
				<td  class="box4"><input type="password" name="confirm_pass" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Điện thoại di động</td>
				<td  class="box4"><input type="text" name="mobile" id="mobile" value="<?php echo get_usermeta( $current_user->ID, 'mobile'); ?>"  /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Điện thoại công ty</td>
				<td  class="box4"><input type="text" name="companyphone" value="<?php echo get_usermeta( $current_user->ID, 'companyphone'); ?>" /></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Chức vụ</td>
				<td  class="box4"><input type="text" name="position" value="<?php echo get_usermeta( $current_user->ID, 'position'); ?>" /></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Công ty</td>
				<td  class="box4"><input type="text" name="company" value="<?php echo get_usermeta( $current_user->ID, 'company'); ?>" /></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Đối tượng</td>
				<td  class="box4"><input type="text" name="objectuser" id="objectuser" value="<?php echo get_usermeta( $current_user->ID, 'objectuser'); ?>" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Ngành nghề</td>
				<td  class="box4"><input type="text" name="mayjor" value="<?php echo get_usermeta( $current_user->ID, 'mayjor'); ?>"  /></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Địa chỉ<br/><em style="font-weight:normal">Nhận thẻ và hóa đơn</em></td>
				<td  class="box4"><input type="text" name="address" id="address" value="<?php echo get_usermeta( $current_user->ID, 'address'); ?>"  /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Tỉnh/Thành phố</td>
				<td  class="box4"><input type="text" name="city" id="city" value="<?php echo get_usermeta( $current_user->ID, 'city'); ?>"  /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right"></td>
				<td  class="box4">
				<input type="checkbox" name="dk" value="1" id="agree"/> Tôi đã đọc và đồng ý với <a href="">điều khoản sử dụng</a> trên đây
				</td>				
			</tr>
			<tr>
				<td><input type="hidden" name="action" value="submit"></td>
				<td align="center" class="update"><input type="submit" value=""  /></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><a href="" class="returnhome">Trở về trang chủ</a></td>

			</tr>
		</table>
		</form>

</div>