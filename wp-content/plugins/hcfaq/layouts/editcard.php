<?php
$card = HCfaq::get($_GET['cardid']);
?>
<h1 class="title">Cập nhật</h1>
<form id="form" method="post" action="?page=hcfaq&options=list">
        <div class="form">

			<input type="hidden" value="<?php echo $card->id; ?>" name="id" id="widget_id" />
			<input type="hidden" value="editcard" name="action" />
			
            <div id="items">
            	<label>Question</label><br/><input type="text" name="question" value="<?php echo $card->question; ?>">
            </div>
            <div id="items">
            	<label>Answer</label><br/><textarea name="answer" style="width:100%;height:150px;"><?php echo $card->answer; ?></textarea>
            </div>         
             <div id="items">
            	<label>Tình trạng</label><br/>
            	<select name="valid">
            		<option value="0" <?php echo $card->valid=='0'?'selected=selected':''; ?>>Đang chờ duyệt</option>
            		<option value="1" <?php echo $card->valid=='1'?'selected=selected':''; ?>>Đã duyệt</option>
            	</select>
            </div>

			<p class="actions">
				<input type="submit" value="Cập nhật" class="button-primary action save"/>
	            
				<span></span>
			</p>

        </div>
        
	</form>
