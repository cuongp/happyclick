<?php
$cards = HCcard::getHistory();

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