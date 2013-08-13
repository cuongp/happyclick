<?php
$user =  get_user_by('id',$_GET['userid']);
$data = get_user_meta($_GET['userid']);
$db = $GLOBALS['wpdb'];
$card = $db->get_row('select * from '.$db->prefix.'user_card where user_id='.$_GET['userid']);
?>
<table width=100% cellpadding="1" cellspacing="1">
	<tr>
		<td width="20%" style="padding:0 10px">Họ tên:</td>
		<td style="padding:10px"><?php echo $user->first_name.' '.$user->last_name ?></td>
	</tr>
	<tr>
		<td width="20%" style="padding:0 10px">Email:</td>
		<td style="padding:10px"><?php echo $user->user_email?></td>
	</tr>
	<tr>
		<td width="20%" style="padding:0 10px">Điện thoại di động</td>
		<td style="padding:10px"><?php echo $data[0]['mobile'];?></td>
	</tr>
	<tr>
		<td width="20%" style="padding:0 10px">Địa chỉ:</td>
		<td style="padding:10px"><?php echo $data[0]['address'] ?></td>
	</tr>
	<tr>
		<td width="20%" style="padding:0 10px">Công ty:</td>
		<td style="padding:10px"><?php echo $data[0]['company']; ?></td>
	</tr>
	<tr>
		<td colspan="2">
			<h3>Thông tin xuất hóa đơn</h3>
		</td>
	</tr>
	<tr>
		<td>Tên công ty:</td>
		<td style="padding:10px"><?php  echo $card->company_name!="" ?  $card->company_name : $data[0]['company']; ?></td>
	</tr>
	<tr>
		<td>Địa chỉ công ty:</td>
		<td style="padding:10px"><?php  echo $card->company_address!="" ?  $card->company_name : $data[0]['address']; ?></td>
	</tr>
	<tr>
		<td>Mã số thuế:</td>
		<td style="padding:10px"><?php  echo $card->tax_code; ?></td>
	</tr>
</table>