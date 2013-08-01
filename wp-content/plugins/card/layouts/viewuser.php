<?php
$user =  get_user_by('id',$_GET['userid']);
$data = get_user_meta($_GET['userid']);
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
		<td width="20%" style="padding:0 10px">Thành phố:</td>
		<td style="padding:10px"><?php echo $user->first_name.' '.$user->last_name ?></td>	
	</tr>

	<tr>
		<td width="20%" style="padding:0 10px">Công ty:</td>
		<td style="padding:10px"><?php echo $data['company']; ?></td>	
	</tr>

</table>