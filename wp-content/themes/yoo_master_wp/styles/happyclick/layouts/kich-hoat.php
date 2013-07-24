<?php
global $current_user;
$flag='';
function check_card($code,$serial){
	 $db = $GLOBALS['wpdb'];
        $post = $db->get_row('select id from '.$db->prefix.'cards where serial="'.$serial.'" and code= "'.$code.'" and valid=1 and status=0');
        return !empty($post)? $post :null;
}
function update_card($card_id){
	$db = $GLOBALS['wpdb'];
	return $db->update($db->prefix.'cards',array('status'=>1),array('id'=>$card_id));
}

function get_card_info($card_id){
	$db = $GLOBALS['wpdb'];
	$cardTable = $db->prefix.'cards';

	$card = $db->get_row('select id,sub_id from '.$cardTable.' where id = '.$card_id);
	
	return !empty($card)?$card :null;
}
function get_sub_info($sub_id){
	$db = $GLOBALS['wpdb'];
	$subTable = $db->prefix.'m_subscriptions_levels';
	$sub = $db->get_row('select * from '.$subTable.' where sub_id = "'.$sub_id.'"');	
	return !empty($sub)?$sub :null;	
}

if(isset($_POST) && $_POST['action'] == 'submit'){
	$db = $GLOBALS['wpdb'];
	$card_id = check_card($_POST['code'],$_POST['serial']); 

	if($card_id){
		if($current_user->ID > 0){
			$user_id = $current_user->ID;
		}
		else{
			
			$user_id = wp_create_user( $_POST['email'], $_POST['password'], $_POST['email']); 	
		}
		
		if($user_id>0){
			
			//$member = new M_Membership($user_id);
		
			foreach ($_POST as $key=>$val) {
				if($key !='action')
					update_usermeta( $user_id, $key, $val);
				}
			
//			update_card($card_id);		//exit();
			$card_info = get_card_info($card_id->id);
			
			$sub_info = get_sub_info($card_info->sub_id);

			$startdate = date("Y-m-d H:i:s");
			//$enddate = date("Y-m-d H:i:s",strtotime('+'.$sub_info->level_period.' month'));
			
			$level_period_unit = $sub_info->level_period_unit;
			switch ($level_period_unit) {
				case 'y':
					$enddate = date("Y-m-d H:i:s",strtotime('+'.$sub_info->level_period.' year'));
					break;
				case 'm':
					$enddate = date("Y-m-d H:i:s",strtotime('+'.$sub_info->level_period.' month'));
					break;
				case 'd':
					$enddate = date("Y-m-d H:i:s",strtotime('+'.$sub_info->level_period.' day'));
					break;
				default:
					$enddate = $startdate;
					break;
			}
			
			$resuld_id = $db->insert($db->prefix.'m_membership_relationships',
				array('user_id'		=>$user_id
					,'sub_id'=>$card_info->sub_id
					,'level_id'=>$sub_info->level_id
					,'startdate'=>$startdate
					,'expirydate' =>$enddate
					,'updateddate'=>$startdate
					,'order_instance'=>1
					,'usinggateway'=>'card'
					));
			
			update_usermeta($user_id,'wp_membership_active','no');
			
			$key = md5($user_id. $_POST['password'] . time());
			update_user_meta($user->ID, '_membership_key', $key);

			//update_usermeta($user_id,'_membership_key','no');
			//update_usermeta($user_id,'wp_membership_active','no');
			
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
      Chúc mừng bạn đã trở thành thành viên của Happy Click!<br />
      <br />
      Thông tin tài khoản đăng nhập bạn đã đăng ký:</p>
    <blockquote>
      <p>Tên đăng nhập: '.$_POST['email'].'<br />
        Mật khẩu:'.$_POST['password'].'</p>
      </blockquote>
    <p>Số sê-ri của thẻ cào: '.$_POST['serial'].'</p>
    <p>Thời hạn sử dụng: đến hết ngày '.$enddate.'<br />
      <br />
      Vui lòng nhấn vào đường dẫn bên dưới để kích hoạt tài khoản cho thành viên:<br />
      <a href='.get_site_url().'/hcaccount/xac-thuc-email/?act=active&token='.$key.'&sub_id='.$sub_info->sub_id.'&level_id='.$sub_info->level_id.'&user_id='.$user_id.'&code='.time().'>Kích hoạt thành viên</a><br />
      <br />
      Đường dẫn này sẽ chỉ có giá trị đến &lt;giờ, ngày, tháng, năm&gt;<br />
      <br />
      Ngay sau khi kích hoạt tài khoản, bạn đã có thể bắt đầu hành trình <span style="font-weight: bold; font-style: italic;">&ldquo;thăng tiến mỗi ngày&rdquo;</span> với Happy Click.<br />
      <br />
      Đây là email tự động gửi, vui lòng không trả lời vào email này.<br />
      <br />
      Thân mến,<br />
      <br />
      <strong style="color: #68A400">Công ty Cổ phần Tư vấn và Đào tạo Happy Click</strong><br />
      <em>Hỗ trợ 24/7: (08) 7302 0168 – (08) 7303 0168</em><br />
      <em>Email: <span style="color: #3399FF; font-style: italic; font-weight: bold;"><a href="mailto:lienhe@happyclick.com.vn">lienhe@happyclick.com.vn</a></span></em>    </p>
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
//if (!isset($_COOKIE['hc_welcome'])) {
  //      			setcookie('hc_welcome', '1', strtotime('+1 day'));
    //			}
			wpMandrill::mail($_POST['email'],'Kích hoạt thành viên',$html);
			if($current_user->ID > 0)
				wp_redirect('/index.php?mod=kich-hoat');
			else{
				 
				wp_redirect('/hcaccount/xac-nhan-email/');
			}
			exit;			
			}
		}
	else
	{
		$flag ='<h3 class="error">Thẻ cào không đúng</h3>';
	}
	wp_reset_query();
	
}

$gender = get_usermeta( $current_user->ID, 'gender');

?>
<?php if($current_user->ID < 1): ?>
<div class="box" style="width:730px">
<p>Bạn đã xem thử và có tài khoản với Happy Click, vui lòng đăng nhập để kích hoạt.</p>
<div style="float:right"><?php echo $this['modules']->render('login-modal'); ?></div>
<div style="clear:both"></div>
</div>
<?php endif; ?>
<div class="box" style="width:730px">

<form id="form" class="form_profile" method="post">

<p>Kích hoạt cho thành viên mới, chưa có tài khoản. Vui lòng nhập thông tin để tạo tài khoản.</p>
		<table width="100%" class="form_doipass">
			<tr>
				<td colspan="2">
					
					<p>(<span>*</span>) Thông tin bắt buộc</p><br/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<p><strong>THÔNG TIN THẺ CÀO</strong></p><br/>
				</td>

			</tr>
<tr>
				<td class="box3" width="45%"  align="right">Mã thẻ cào</td>
				<td  class="box4"><input type="text" id="code" name="code" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3"  align="right">Số sê-ri</td>
				<td  class="box4"><input type="text" id="serial" name="serial" /><span>*</span></td>				
			</tr>
			<!--<tr>
				<td width="45%"  class="box3" align="right">Mã kiểm tra</td>
				<td  class="box4"><input type="text" id="birthday" name="birthday" value="<?php echo get_usermeta( $current_user->ID, 'birthday'); ?>" placeholder="Ngày/tháng/năm" /><span>*</span></td>				
			</tr>-->
			<tr>
				<td colspan="2"><br/>
				<p><strong>THÔNG TIN CÁ NHÂN</strong></p><br/>	
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