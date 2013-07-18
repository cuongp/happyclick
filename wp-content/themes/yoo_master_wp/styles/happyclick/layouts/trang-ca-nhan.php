<?php global $current_user; ?>
<div class="box">
	<table width="100%">
		<tr>
			<td width="45%">
				<p><a class="profile" href="/hcaccount/profile/"><span>Thông tin cá nhân</span></a></p>
				<p><a class="changepassword" href="/hcaccount/doi-mat-khau/"><span>Đổi mật khẩu</span></a></p>
			
			</td>
			<td valign="top" align="center">
				<h1 class="info"><span>Chào  <?php echo $current_user->user_nicename;  ?></span></h1>
				<p style="font-size:20px;text-align:center">Bạn đang sử dụng thẻ Happy Click<br/> Thời hạn sử dụng: đến hết ngày <span style="color:red">20/12/2014</span></p>
				<p style="text-align:right"><br/><br/><br/><br/><br/><a href="/index.php" class="returnhome">Trở về trang chủ</a></p>
			</td>
		</tr>

	</table>
</div>