<?php
global $current_user;
$is_subs = current_user_has_subscription();
$flag = '';
if(!$is_subs){
	wp_redirect('/index.php');
}
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
		$p = $db->get_row('select expirydate from '.$db->prefix.'m_membership_relationships where user_id='.$current_user->ID);
		$card_info = get_card_info($card_id->id);		
		$sub_info = get_sub_info($card_info->sub_id);
		update_card($card_id->id);
		$level_period_unit = $sub_info->level_period_unit;
		$startdate = date("Y-m-d H:i:s");
		$ed = $p->expirydate;
		
		switch ($level_period_unit) 
		{
				case 'y':
					$enddate = date("Y-m-d H:i:s",strtotime($ed.'+'.$sub_info->level_period.' year'));
					break;
				case 'm':
					$enddate = date("Y-m-d H:i:s",strtotime($ed.'+'.$sub_info->level_period.' month'));
					break;
				case 'd':
					$enddate = date("Y-m-d H:i:s",strtotime($ed.'+'.$sub_info->level_period.' day'));
					break;
				default:
					$enddate = $startdate;
					break;
		}
		switch ($level_period_unit) 
		{
				case 'y':
					$enddate2 = date("d-m-Y",strtotime($ed.'+'.$sub_info->level_period.' year'));
					break;
				case 'm':
					$enddate2 = date("d-m-Y",strtotime($ed.'+'.$sub_info->level_period.' month'));
					break;
				case 'd':
					$enddate2 = date("d-m-Y",strtotime($ed.'+'.$sub_info->level_period.' day'));
					break;
				default:
					$enddate2 = $startdate;
					break;
		}
		$query = $db->update($db->prefix.'m_membership_relationships',array('expirydate'=>$enddate),array('user_id'=>$current_user->ID));
		
		if($query){
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
					  <td height="323" valign="top" style="padding: 10px 10px 0px 10px; height=; color: #003399; font-size: 14px;"><p style="padding:10px">Chào '.$current_user->last_name.'<br />
					      <br />
					      Chúc mừng bạn đã gia hạn thành công!<br />
					      <br />
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
					</table>';
			$headers[] = 'From: Happy Click <support@happyclick.vn>';
			$headers[] ='Content-type: text/html';
			
			wp_mail($hcemail,'Gia hạn thành viên Happy Click!',$html,$headers);
			}else{
				$flag='<h3 class="error">Gia hạn không thành công. Vui lòng liên hệ bộ phận hỗ trợ khách hàng để biết thêm thông tin</h3>';
			}
		}
	else{
		$flag ='<h3 class="error">Thẻ cào không đúng</h3>';
	}
}
?>
<div class="box" style="width:730px">

<form id="form" class="form_profile" method="post">

<?php echo $flag; ?>
<p>Gia hạn thời gian sử dụng cho thành viên.</p>
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
				<td><input type="hidden" name="action" value="submit"></td>
				<td align="center" class="update"><input type="submit" value=""  /></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><a href="" class="returnhome">Trở về trang chủ</a></td>

			</tr>
		</table>
		</form>

</div>