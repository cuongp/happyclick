
<?php
if(isset($_POST['action']) && $_POST['action']=='editcard'){
	$update = HCfaq::update(array('question'	=>	$_POST['question'],
						'answer'		=>	$_POST['answer'],
						'valid'		=>	$_POST['valid']),array('id'=>$_POST['id']));
    if($update)
        echo "<h3>Cập nhật thành công</h3>";
    else
        echo '<div class="error">Không thể cập nhật...</div>';
}
if($_GET['action']=='delete' && isset($_GET['id'])){
	echo HCfaq::delete($_GET['id']);
}
if(isset($_GET['cardid']))
	include 'editcard.php';
	$page = 1;
if(isset($_GET['p']))
	$page = $_GET['p'];
$params['show'] = 25;
$params['start'] = ($page-1)*$params['show'];
if(isset($_GET['valid'])){
	$valid = $_GET['valid']=='all'?'':$_GET['valid'];
$total = HCfaq::countAllResult($valid);
$pages = ceil($total/$params['show']);
$cards = HCfaq::getAll($valid,$params);
}else
{
$total = HCfaq::countAllResult();
$pages = ceil($total/$params['show']);
$cards = HCfaq::getAll("","",$params);
}
?>

<h1 class="title">Danh sách câu hỏi</h1>
<!--<form method="post" id="search">
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
</form>-->
<table class="list">
			<thead>
				<th class="shortcode"><input type="checkbox" name="id[]" value="checkall" />ID</th>
				<th class="shortcode">Câu hỏi</th>
				<th class="modified">Người đặt câu hỏi</th>
				<th class="modified">Ngày hỏi</th>
				<th class="modified">Bài viết</th>
				<th class="modified">Trạng thái</th>
				<th class="actions"></th>
			</thead>
			<tbody>
			<?php
				if(!empty($cards)){	
					foreach ($cards as $card) {
					$user = get_user_by('id',$card->user_id);
					$post = get_post($card->post_id);
			?>
			<tr id="item-<?php echo $card->id; ?>">
				<td class="shortcode"><input type="checkbox" name="id[]" value="<?php echo $card->id; ?>" /><?php echo $card->id; ?></td>
				<td class="shortcode"><?php echo $card->question; ?></td>
				<td class="modified"><?php echo $user->user_email; ?></td>
				<td class="modified"><?php echo date('d-m-Y',$card->post_date); ?></td>
				<td colspan="modified"><?php echo $post->post_title; ?></td>
				<td class="modified"><?php echo $card->valid=='0'?'Đang chờ duyệt':'Đã duyệt'; ?></td>
				<td class="actions">
					<a class="action edit" href="?page=hcfaq&options=list&cardid=<?php echo $card->id;?>">Edit</a>
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