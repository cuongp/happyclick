<?php

global $current_user;

$flag='';
 $args = array(
    'orderby'       => 'name', 
    'order'         => 'ASC',
    'hide_empty'    => false, 
    'exclude'       => array(), 
    'exclude_tree'  => array(), 
    'include'       => array(),
    'number'        => '', 
    'fields'        => 'all', 
    'slug'          => '', 
    'parent'         => '',
    'hierarchical'  => true, 
    'child_of'      => 0, 
    'get'           => '', 
    'name__like'    => '',
    'pad_counts'    => false, 
    'offset'        => '', 
    'search'        => '', 
    'cache_domain'  => 'core'
); 	
$cities = get_terms('city',$args);
$nganhnghe =get_terms('nganhnghe',$args);
$doituong = get_terms('doituong',$args);
function check_card($code,$serial){
	 $db = $GLOBALS['wpdb'];
        $post = $db->get_row('select id from '.$db->prefix.'cards where serial="'.$serial.'" and code= "'.md5($code).'" and valid=1 and status=0');
        return !empty($post)? $post :null;
}
function update_card($card_id){
	$db = $GLOBALS['wpdb'];
	return $db->update($db->prefix.'cards',array('status'=>1),array('id'=>$card_id));
}
function insert_user_data($data){
	$db = $GLOBALS['wpdb'];
	return $db->insert($db->prefix.'user_card',$data);
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
	$card_id = check_card($_POST['hccode'],$_POST['hcserial']); 
	if($card_id>0){
		if($current_user->ID > 0){
			$user_id = $current_user->ID;
		}
		else{
			
			$user_id = wp_create_user( $_POST['hcemail'], $_POST['hcpassword'], $_POST['hcemail']); 	
		}
		
		if(!is_array($user_id->errors) && $user_id>0){
			
				update_usermeta( $user_id, 'first_name', $_POST['hcfirst_name']);
				update_usermeta( $user_id, 'last_name', $_POST['hclast_name']);
				update_usermeta( $user_id, 'mobile', $_POST['hcmobile']);
				update_usermeta( $user_id, 'position', $_POST['hcposition']);
				update_usermeta( $user_id, 'companyphone', $_POST['hcompanyphone']);
				update_usermeta( $user_id, 'gender', $_POST['hcgender']);
				update_usermeta( $user_id, 'company', $_POST['hccompany']);
				update_usermeta( $user_id, 'birthday', $_POST['hcbirthday']);
				update_usermeta( $user_id, 'objectuser', $_POST['hcobjectuser']);
				update_usermeta( $user_id, 'mayjor', $_POST['hcmayjor']);
				update_usermeta( $user_id, 'city', $_POST['hccity']);
				update_usermeta( $user_id, 'address', $_POST['hcaddress']);

			
			$card_info = get_card_info($card_id->id);		
			$sub_info = get_sub_info($card_info->sub_id);
			$startdate = date("Y-m-d H:i:s");		
			update_card($card_id->id);
			$level_period_unit = $sub_info->level_period_unit;
			switch ($level_period_unit) {
				case 'y':
					$enddate = date("Y-m-d",strtotime('+'.$sub_info->level_period.' year'));
					break;
				case 'm':
					$enddate = date("Y-m-d",strtotime('+'.$sub_info->level_period.' month'));
					break;
				case 'd':
					$enddate = date("Y-m-d",strtotime('+'.$sub_info->level_period.' day'));
					break;
				default:
					$enddate = $startdate;
					break;
			}
			switch ($level_period_unit) {
				case 'y':
					$enddate2 = date("d-m-Y",strtotime('+'.$sub_info->level_period.' year'));
					break;
				case 'm':
					$enddate2 = date("d-m-Y",strtotime('+'.$sub_info->level_period.' month'));
					break;
				case 'd':
					$enddate2 = date("d-m-Y",strtotime('+'.$sub_info->level_period.' day'));
					break;
				default:
					$enddate2 = $startdate;
					break;
			}
			$expdate = date("d-m-Y",strtotime('+24 hour'));

			$db->query("delete from ".$db->prefix.'m_membership_relationships where user_id="'.$user_id.'"');
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
			insert_user_data(array('user_id'=>$user_id,'card_id'=>$card_id->id,'created_at'=>time()));
			$key = md5($user_id. $_POST['hcpassword'] . time());
			$db->update($db->prefix.'users',array('user_activation_key'=>$key),array('ID'=>$user->ID));
			update_user_meta($user->ID, '_membership_key', $key);
			
			if($current_user->ID > 0){
				update_usermeta($user_id,'wp_membership_active','yes');
				$hcemail = $current_user->user_email;
			}
			else
				$hcemail = $_POST['hcemail'];

			if($current_user->ID > 0){
			
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
					  <td height="323" valign="top" style="padding: 10px 10px 0px 10px; height=; color: #003399; font-size: 14px;"><p style="padding:10px">Chào '.$_POST['hclast_name'].'<br />
					      <br />
					      Chúc mừng bạn đã trở thành thành viên của Happy Click!<br />
					      <br />
					      Thông tin tài khoản đăng nhập bạn đã đăng ký:</p>
					    <blockquote>
					      <p style="padding:10px">Tên đăng nhập: '.$hcemail.'<br />
					        Mật khẩu:'.$_POST['hcpassword'].'</p>
					      </blockquote>
					    <p style="padding:10px">Số sê-ri của thẻ cào: '.$_POST['hcserial'].'</p>
					    <p style="padding:10px">Thời hạn sử dụng: đến hết ngày '.$enddate2.'<br />
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
					</table>';}
			else
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
					  <td height="323" valign="top" style="padding: 10px 10px 0px 10px; height=; color: #003399; font-size: 14px;"><p style="padding:10px">Chào '.$_POST['hclast_name'].'<br />
					      <br />
					      Chúc mừng bạn đã trở thành thành viên của Happy Click!<br />
					      <br />
					      Thông tin tài khoản đăng nhập bạn đã đăng ký:</p>
					    <blockquote>
					      <p style="padding:10px">Tên đăng nhập: '.$hcemail.'<br />
					        Mật khẩu:'.$_POST['hcpassword'].'</p>
					      </blockquote>
					    <p style="padding:10px">Số sê-ri của thẻ cào: '.$_POST['hcserial'].'</p>
					    <p style="padding:10px">Thời hạn sử dụng: đến hết ngày '.$enddate2.'<br />
					      <br />
					      <br />
					      Vui lòng nhấn vào đường dẫn bên dưới để kích hoạt tài khoản cho thành viên:<br />
					      <a href='.get_site_url().'/hcaccount/xac-thuc-email/?act=active&token='.$key.'&sub_id='.$sub_info->sub_id.'&level_id='.$sub_info->level_id.'&user_id='.$user_id.'&code='.time().'>Kích hoạt thành viên</a><br />
					      <br />
					      Đường dẫn này sẽ chỉ có giá trị đến '.$expdate.'<br />
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

			//wpMandrill::mail($_POST['email'],'Kích hoạt thành viên',$html);
			$headers[] = 'From: Happy Click <support@happyclick.vn>';
			$headers[] ='Content-type: text/html';
			
			wp_mail($hcemail,'Chào mừng thành viên mới của Happy Click!',$html,$headers);
			
			if($current_user->ID > 0){
				wp_redirect('/index.php?mod=kich-hoat');
				exit;
			}
			else
			{
				wp_redirect('/hcaccount/xac-nhan-email/');
				exit;
			}
						
		}
		else
		{
			$flag ='<h3 class="error">Email đã được sử dụng, vui lòng sử dụng email khác để đăng ký</h3>';
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

<?php echo $flag; ?>
<p>Kích hoạt cho thành viên mới, chưa có tài khoản. Vui lòng nhập thông tin để tạo tài khoản.</p>
		<table width="100%" class="form_profile">
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
				<td  class="box4"><input type="text" id="code" name="hccode" required /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3"  align="right">Số sê-ri</td>
				<td  class="box4"><input type="text" id="serial" name="hcserial" required /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Mã kiểm tra</td>
				<td  class="box4"><a href="<?php echo $_SERVER['PHP_SELF']; ?>" id="refreshimg" title="Click to refresh image"><img src="/wp-content/themes/<?php echo get_template() ?>/js/images/image.php?<?php echo time(); ?>" width="132" height="46" alt="Captcha image" /></a><input type="text" maxlength="6" name="hccaptcha" id="captcha" /><span>*</span></td>				
			</tr>
			<tr>
				<td colspan="2"><br/>
				<p><strong>THÔNG TIN CÁ NHÂN</strong></p><br/>	
				</td>

			</tr>
			<tr>
				<td class="box3" width="45%"  align="right">Họ</td>
				<td  class="box4"><input required type="text" id="first_name" name="hcfirst_name" placeholder="Vui lòng gõ tiếng Việt có dấu" value="<?php echo $current_user->first_name; ?>" /><span>*</span></td>				
			</tr>
			<tr>
				<td class="box3" width="45%"  align="right">Tên</td>
				<td  class="box4"><input required type="text" id="last_name" name="hclast_name" placeholder="Vui lòng gõ tiếng Việt có dấu" value="<?php echo $current_user->last_name; ?>" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3"  align="right">Giới tính</td>
				<td  class="box4"><input type="radio" name="hcgender" value="0" <?php if($gender==0) echo 'checked=checked'; else echo ''; ?> /> Nam <input type="radio" name="hcgender" value="1" <?php if($gender==1) echo 'checked=checked'; else echo ''; ?> /> Nữ</td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Ngày sinh</td>
				<td  class="box4"><input type="text" id="birthday" name="hcbirthday" value="<?php echo get_usermeta( $current_user->ID, 'birthday'); ?>" placeholder="Ngày/tháng/năm" required/><span>*</span></td>				
			</tr>
			<tr>
			<?php
				if($current_user->ID > 0)
					$disable = 'disabled="disabled"';
				else
					$disable = '';
			?>
				<td width="45%"  class="box3" align="right">Email <br/> <em style="font-weight:normal">
				<?php if($current_user<1): ?>
				Email cá nhân hoặc email thường sử dụng.
			<?php else: ?>
				<p style="font-size:12px">Email này bạn đã dùng để đăng nhập,<br/> Nếu cần thay đổi vui lòng liên hệ với Happy Click.<br/>
				<strong><em>
				Hỗ trợ 24/7: (08) 7302 0168 - (08) 7303 0168</em></strong></p></td>
			<?php endif; ?>	
			<td  class="box4"><input required class="email" <?php echo $disable ?> type="email" name="hcemail" id="email" value="<?php echo $current_user->user_email ?>" /><span>*</span></td>				
			</tr>
			<?php if($current_user->ID < 1): ?>
			<tr>
				<td width="45%"  class="box3" align="right">Mật khẩu</td>
				<td  class="box4"><input type="password" name="hcpassword" required /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Xác nhận mật khẩu</td>
				<td  class="box4"><input type="password" name="hcconfirm_pass" required /><span>*</span></td>				
			</tr>
		<?php endif;?>
			<tr>
				<td width="45%"  class="box3" align="right">Điện thoại di động</td>
				<td  class="box4"><input type="text" name="hcmobile" id="mobile" required value="<?php echo get_usermeta( $current_user->ID, 'mobile'); ?>"  /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Điện thoại công ty</td>
				<td  class="box4"><input type="text" name="hccompanyphone" value="<?php echo get_usermeta( $current_user->ID, 'companyphone'); ?>" /></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Chức vụ</td>
				<td  class="box4"><input type="text" name="hcposition" value="<?php echo get_usermeta( $current_user->ID, 'position'); ?>" /></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Công ty</td>
				<td  class="box4"><input type="text" name="hccompany" value="<?php echo get_usermeta( $current_user->ID, 'company'); ?>" /></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Đối tượng</td>
				<td  class="box4">
					<select id="objectuser" name="hcobjectuser"  validate="required:true">
						<option>Chưa chọn</option>
					
						<?php
							if(!empty($doituong)){
								foreach ($doituong as $dt) {
									if(get_usermeta( $current_user->ID, 'objectuser')==$dt->term_id){
										$selected = 'selected=selected';
									}else
										$selected = '';
							?>
								<option <?php echo $selected; ?> value="<?php echo $dt->term_id ?>"><?php echo $dt->name; ?></option>
							<?php
								}
							}
						?>
					</select>

<span>*</span></td>				
			</tr>

			<tr>
				<td width="45%"  class="box3" align="right">Ngành nghề</td>
				<td  class="box4">
					<select id="mayjor" name="hcmayjor"><option>Chưa chọn</option>
						<?php
							if(!empty($nganhnghe)){
								foreach ($nganhnghe as $dt) {
									if(get_usermeta( $current_user->ID, 'mayjor')==$dt->term_id){
										$selected = 'selected=selected';
									}else
										$selected = '';
							?>
								<option <?php echo $selected; ?> value="<?php echo $dt->term_id ?>"><?php echo $dt->name; ?></option>
							<?php
								}
							}
						?>
					</select>
</td>	</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Địa chỉ<br/><em style="font-weight:normal">Nhận thẻ và hóa đơn</em></td>
				<td  class="box4"><input type="text" name="hcaddress" id="address" required value="<?php echo get_usermeta( $current_user->ID, 'address'); ?>"  /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Tỉnh/Thành phố</td>
				<td  class="box4">
					<select id="city" name="hccity"  validate="required:true"><option>Chưa chọn</option>
						<?php
							if(!empty($cities)){
								foreach ($cities as $dt) {

									if(get_usermeta( $current_user->ID, 'city')==$dt->term_id){
										$selected = 'selected=selected';
									}else
										$selected = '';
							?>
								<option <?php echo $selected; ?> value="<?php echo $dt->term_id ?>"><?php echo $dt->name;?></option>
							<?php
								}
							}
						?>
					</select>

<span>*</span></td>	
				</tr>
			<tr>
				<td width="45%"  class="box3" align="right"></td>
				<td  class="box4">
				<input type="checkbox" name="hcdk" value="1" id="agree" required/> Tôi đã đọc và đồng ý với <a href="/dieu-khoan-su-dung/">điều khoản sử dụng</a> trên đây
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