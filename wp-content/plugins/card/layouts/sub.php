<?php
$cards = HCcard::getAll();
if(isset($_POST) && $_POST['action']=='submit'){
	$db = $GLOBALS['wpdb'];
	$sql = "update ".$db->prefix."cards set sub_id='".$_POST['sub']."' where id >= ".$_POST['to']." and id<=".$_POST['from'];
	$db->query($sql);
}
if(isset($_POST) && $_POST['action']=='submit2'){
	$db = $GLOBALS['wpdb'];
	$sql = "update ".$db->prefix."cards set valid='".$_POST['sub']."' where id >= ".$_POST['to']." and id<=".$_POST['from'];
	$db->query($sql);
}
if(isset($_POST) && $_POST['action']=='submit3'){
	$db = $GLOBALS['wpdb'];
	$sql = "update ".$db->prefix."cards set status='".$_POST['sub']."' where id >= ".$_POST['to']." and id<=".$_POST['from'];
	$db->query($sql);
}
if(isset($_POST) && $_POST['action']=='submit4'){
	$db = $GLOBALS['wpdb'];

	$sql = "update ".$db->prefix."cards set expired='".strtotime($_POST['sub'])."' where id >= ".$_POST['to']." and id<=".$_POST['from'];
	$db->query($sql);
}
?>
<form enctype="multipart/form-data" method="post">
Serial từ<select name="to">
	<?php
		if(!empty($cards)):
			foreach($cards as $card):
	?>
			<option value="<?php echo $card->id ?>"><?php echo $card->serial ?></option>
	<?php
			endforeach;
		endif;
	?>
</select> đên <select name="from">
	<?php
		if(!empty($cards)):
			foreach($cards as $card):
	?>
			<option value="<?php echo $card->id ?>"><?php echo $card->serial ?></option>
	<?php
			endforeach;
		endif;
	?>

</select> Thuộc 
<select name="sub">
	<?php
	 $db = $GLOBALS['wpdb'];
	 $posts = $db->get_results('select * from '.$db->prefix.'m_subscriptions');
	 if(!empty($posts)):
	 	foreach ($posts as $post) {
	 ?>
	 	<option value="<?php echo $post->id; ?>"><?php echo $post->sub_name; ?></option>
	 <?php
	 	}
	 	endif;
	?>

</select>
<input type="hidden" name="action" value="submit">

<input class="button" type="submit" value="Submit">
</form>
<form enctype="multipart/form-data" method="post">
Serial từ<select name="to">
	<?php
		if(!empty($cards)):
			foreach($cards as $card):
	?>
			<option value="<?php echo $card->id ?>"><?php echo $card->serial ?></option>
	<?php
			endforeach;
		endif;
	?>
</select> đên <select name="from">
	<?php
		if(!empty($cards)):
			foreach($cards as $card):
	?>
			<option value="<?php echo $card->id ?>"><?php echo $card->serial ?></option>
	<?php
			endforeach;
		endif;
	?>

</select> Trạng thái 
<select name="sub">
	<option value="0">Chưa sử dụng</option>

	<option value="1">Đã sử dụng</option>

</select>
<input type="hidden" name="action" value="submit2">

<input class="button" type="submit" value="Submit">
</form>
<form enctype="multipart/form-data" method="post">
Serial từ<select name="to">
	<?php
		if(!empty($cards)):
			foreach($cards as $card):
	?>
			<option value="<?php echo $card->id ?>"><?php echo $card->serial ?></option>
	<?php
			endforeach;
		endif;
	?>
</select> đên <select name="from">
	<?php
		if(!empty($cards)):
			foreach($cards as $card):
	?>
			<option value="<?php echo $card->id ?>"><?php echo $card->serial ?></option>
	<?php
			endforeach;
		endif;
	?>

</select> Trạng thái 
<select name="sub">
	<option value="0">Chưa xuất kho</option>

	<option value="1">Đã xuất kho</option>

</select>
<input type="hidden" name="action" value="submit3">

<input class="button" type="submit" value="Submit">
</form>
<form enctype="multipart/form-data" method="post">
Serial từ<select name="to">
	<?php
		if(!empty($cards)):
			foreach($cards as $card):
	?>
			<option value="<?php echo $card->id ?>"><?php echo $card->serial ?></option>
	<?php
			endforeach;
		endif;
	?>
</select> đên <select name="from">
	<?php
		if(!empty($cards)):
			foreach($cards as $card):
	?>
			<option value="<?php echo $card->id ?>"><?php echo $card->serial ?></option>
	<?php
			endforeach;
		endif;
	?>

</select> Ngày hết hạn
<input type="text" name="sub"/> 

<input type="hidden" name="action" value="submit4">

<input class="button" type="submit" value="Submit">
</form>