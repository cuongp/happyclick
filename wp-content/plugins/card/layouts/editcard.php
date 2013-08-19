<?php
$card = HCcard::get($_GET['cardid']);
<<<<<<< HEAD
echo $card->expired;
echo date('Y-m-d H:i:s', $card->expired); 
=======

>>>>>>> 95889b79e1cdf833ccf2065d9f00a5997c3d26cd
?>
<h1 class="title">Cập nhật</h1>
<form id="form" method="post" action="?page=hccard&options=list">
        <div class="form">

			<input type="hidden" value="<?php echo $card->id; ?>" name="id" id="widget_id" />
			<input type="hidden" value="editcard" name="action" />
			
            <div id="items">
            	<label>Serial</label><br/><input type="text" name="serial" value="<?php echo $card->serial; ?>">
            </div>
            <div id="items">
            	<label>Code</label><br/><input type="text" name="code" value="<?php echo $card->code; ?>">
            </div>
            <div id="items">
            	<label>Ngày hết hạn</label><br/><input placeholder="dd/mm/YYYY" type="text" name="expired" value="<?php echo date('d/m/Y',$card->expired); ?>">
            </div>
            <div id="items">
            	<label>Trạng thái</label><br/>
            	<select name="status">
            		<option value="0" <?php echo $card->status=='0'?'selected=selected':''; ?>>Chưa sử dụng</option>
            		<option value="1" <?php echo $card->status=='1'?'selected=selected':''; ?>>Đã sử dụng</option>
            	</select>
            </div>
             <div id="items">
            	<label>Tình trạng</label><br/>
            	<select name="valid">
            		<option value="0" <?php echo $card->valid=='0'?'selected=selected':''; ?>>Đang trong kho</option>
            		<option value="1" <?php echo $card->valid=='1'?'selected=selected':''; ?>>Đã xuất kho</option>
            	</select>
            </div>

			<p class="actions">
				<input type="submit" value="Cập nhật" class="button-primary action save"/>
	            
				<span></span>
			</p>

        </div>
        
	</form>
