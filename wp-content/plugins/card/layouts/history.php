<<<<<<< HEAD
<h1 class="title">Xuất File</h1>
<form method="post">
	<table width="100%">
		<tr>
			<td width="10%">Loại:</td>
			<td>
				<select name="ctype" id="ctype">
					<option value="all">Tất cả</option>
					<option value="1">Hôm nay</option>
					<option value="2">Tùy chọn</option>
				</select>
			</td>
		</tr>
		<tr id="customdate" style="display:none">
			<td colspan="2">Từ ngày : <input type="text" placeholder="YYYY-MM-DD" value="" name="from"> đến ngày : <input type="text" value="" name="to"  placeholder="YYYY-MM-DD"></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="hidden" name="action" value="export">
				<input type="submit" value="Xem">
			</td>
		</tr>
	</table>

</form>

<?php

$cards = HCcard::getHistory();
function outputCSV($data) {
    $outstream = fopen("php://output", "w");
    function __outputCSV(&$vals, $key, $filehandler) {
        fputcsv($filehandler, $vals); // add parameters if you want
    }
    array_walk($data, "__outputCSV", $outstream);
    fclose($outstream);
}
function encodeCSV($value, $key){
    $value = iconv('UTF-8', 'UTF-8', $value);
}
array_walk($values, 'encodeCSV');
if($_POST['action'] == 'export'){
	$date =date('Y-m-d',time());
	$start = 0;
	$end  = 0;

	if($_POST['ctype'] == 1)
	{
		$start = strtotime($date.' 00:00:00');
		$end = strtotime($date.' 23:59:59');
	}
	elseif($_POST['ctype'] == 2)
	{
		$start = strtotime($_POST['from'].' 00:00:00');
		$end = strtotime($_POST['to'].' 23:59:59');
	}
	$lists = HCcard::export_card($start,$end);
	$arrs = array(
			array('ID Card','Serial','Date import','Date expired','ID User',
					'Email User','Date Register','Date Use','Date expired',
					'First name','Last name','Address','Mobile')
		);
	if(!empty($lists)){
		foreach ($lists as $l) {
			$user = get_user_by('id',$l->user_id);
			$card = HCcard::get($l->card_id);
			$user_info = get_userdata($l->user_id);
			$arr = array(
				$l->card_id,$card->serial,date('d-m-Y',$card->created_at),
				date('d-m-Y',$card->expired),$l->user_id,$user->user_email,date('d-m-Y',$user_info->user_registered),date('d-m-Y',$l->created_at),
				'',$user->first_name,$user->last_name,$user_info->address,$user_info->mobile
				);
			array_push($arrs, $arr);
		}
	}
	$url_path = "/wp-content/uploads/exportcsv/export_".date('d_m_Y_H_i_s',time()).".csv";
	$fp = fopen(realpath($_SERVER["DOCUMENT_ROOT"]).$url_path, 'w') or die('Không thể tạo file vui lòng thử lại sau');
	foreach ($arrs as $arr2) {
		fputcsv($fp,$arr2);
	}
	fclose($fp);
	if(count($arrs)>1){
	$str = '<div id=""><table class=list width=100%>';
		foreach ($arrs as $arr) {
			$str.='<tr>';
			$str.='<td >'.$arr[0].'</td>';
			$str.='<td >'.$arr[1].'</td>';
			$str.='<td >'.$arr[2].'</td>';
			$str.='<td >'.$arr[3].'</td>';
			$str.='<td >'.$arr[4].'</td>';
			$str.='<td >'.$arr[5].'</td>';
			$str.='<td >'.$arr[6].'</td>';
			$str.='<td >'.$arr[7].'</td>';
			$str.='<td >'.$arr[8].'</td>';
			$str.='<td >'.$arr[9].'</td>';
			$str.='<td >'.$arr[10].'</td>';
			$str.='<td >'.$arr[11].'</td>';
			$str.='<td >'.$arr[12].'</td>';
			$str.='</tr>';
	}
	$str.='</table><p style="text-align:right"><a href="'.$url_path.'" title="Click phải chuột chọn save as" class="btn"><b>Download File CSV</b></a></p></div>';
	}else
	{
		$str = '<h2 style="text-align:center">Không tìm thấy dữ liệu</h2>';
	}
	echo $str;
}
?>

<h1 class="title">Lịch sử giao dịch</h1>
<form method="post" id="search">
<h4>Tìm kiếm</h4>
<label>Trạng thái:</label><select  id="status" name="status">
<option value="all">Tất cả</option>
	<option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == '0') echo 'selected="selected"'; else echo '';?> >Chưa sử dụng</option>
	<option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == '1') echo 'selected="selected"'; else echo '';?>>Đã sử dụng</option>
</select>
<label>Tình trạng:</label><select id="valid" name="valid">
<option value="all">Tất cả</option>
	<option value="0" <?php if(isset($_GET['valid']) && $_GET['valid'] == '0') echo 'selected="selected"'; else echo '';?>>Đang trong kho</option>
	<option value="1"  <?php if(isset($_GET['valid']) && $_GET['valid'] == '1') echo 'selected="selected"'; else echo '';?>>Đã xuất kho</option>
</select>
<input type="hidden" value="search" name="action">
<input value="Tìm kiếm" type="submit" id="submit">
</form>
<table class="list">
			<thead>
				<th class="shortcode"><input type="checkbox" name="id[]" value="checkall" />User ID</th>
				<th class="shortcode">Serial</th>
				<th class="modified">Code</th>
				<th class="modified">Plan</th>
				<th class="modified">Ngày tạo</th>
				<th class="modified">Ngày hết hạn</th>
				<th class="modified">Trạng thái</th>
				<th class="modified">Tình trạng</th>
				<th class="actions"></th>
			</thead>
			<tbody>
			<?php
				if(!empty($cards)){
					foreach ($cards as $card) {
					$datetime = new DateTime();
			?>
			<tr id="item-<?php echo $card->id; ?>">
				<td class="shortcode"><input type="checkbox" name="id[]" value="<?php echo $card->user_id; ?>" /><?php echo $card->user_id; ?></td>
				<td class="shortcode"><?php echo $card->serial; ?></td>
				<td class="modified"><?php echo $card->code; ?></td>
				<td class="modified"><?php echo HCcard::getSub($card->sub_id); ?></td>
				<td class="modified"><?php echo date('d/m/Y',$card->created_at); ?></td>
				<td class="modified"><?php echo date('d/m/Y',$card->expired); ?></td>
				<td class="modified"><?php echo $card->status=='0'?'Chưa sử dụng':'Đã sử dụng'; ?></td>
				<td class="modified"><?php echo $card->valid=='0'?'Đang trong kho':'Đã xuất kho'; ?></td>
				<td class="actions">
					<a class="action edit" href="?page=hccard&options=viewuser&userid=<?php echo $card->user_id;?>">View</a>
					<a class="action delete2" href="#"  data-id="<?php echo $card->id;?>">Delete</a>
				</td>
			</tr>
			<?php
					}
				}
			?>
			</tbody>
		</table>
		<div id="page">Trang:
			<?php
				if($pages>0){
					for ($i=1; $i<= $pages ;$i++){

						if(isset($_GET['status']) || isset($_GET['valid']))
							echo '<a style="padding:5px" href=?page=hccard&options=list&valid='.$_GET['valid'].'&status='.$_GET['status'].'&p='.$i.'>'.$i.'</a>';
						else
							echo '<a style="padding:5px" href=?page=hccard&options=list&p='.$i.'>'.$i.'</a>';
						if($i%45==0) echo '<br/>';
					}
				}
			?>

		</div>
=======
History
>>>>>>> 95889b79e1cdf833ccf2065d9f00a5997c3d26cd
