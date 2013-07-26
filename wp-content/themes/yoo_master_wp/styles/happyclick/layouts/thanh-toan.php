
<?php
global $current_user;
$cid = $_GET['cid'];
?>
<div class="box" style="width:730px">
	
	<div class="bodycontent">
	<form method="post" id="form" action="/hcaccount/xac-nhan-thanh-toan/cid=<?php echo $cid; ?>">
		<h3>Chọn hình thức thanh toán</h3>
		<p><strong>Vui lòng chọn 1 trong 2 hình thức thanh toán sau:</strong></p>
		<p><input type="radio" name="payment" value="0"> Thanh toán trực tiếp tại văn phòng Happy Click<br/>
		Văn phòng HappyClick
		</p>
		<p><input type="radio" name="payment" value="1"> Chuyển khoản<br/>
		Văn phòng HappyClick
		</p>
		<table width="100%">
			<tr>
				<td><input type="hidden" name="action" value="submit"></td>
				<td align="center" class="update"><input type="submit" value=""  /></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><a href="/index.php" class="returnhome">Trở về trang chủ</a></td>

			</tr>

		</table>
		</form>
	</div>

</div>