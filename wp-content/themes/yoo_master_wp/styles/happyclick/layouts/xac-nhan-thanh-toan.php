<?php
if(isset($_GET['cid']))
	$cid = $_GET['cid'];
else
	$cid = 0;
$post = get_post($cid);
$data = get_post_meta( $cid, '_sukien', true );

?>
<div class="box" style="width:730px">
	<div class="bodycontent">
	<h3>Xác nhận đăng ký</h3>
		<p>Bạn đã đăng ký khóa học/hôi thảo <b><?php echo $post->post_title; ?></b></p>
		<p>Thời gian :</p>
		<p>Địa điểm :</p>
		<p>Phí tham dự :</p>
		<p>Hình thức thanh toán : <b><?php echo $_GET['type']=='1' ? 'Thanh toán chuyển khoản' : 'Thanh toán trực tiếp tại văn phòng Happy Click</b><br/>Địa chỉ: Văn phòng Happy Click, Tầng 6, Tòa nhà 116-118 Nguyễn Thị Minh Khai, Q.3, TpHCM<br/>
Số điện thoại: (08) 7302 0168 – (08) 7303 0168<br/>
Thời gian làm việc: 8:00 – 12:00, 13:30 – 17:30 từ thứ Hai đến thứ Bảy
' ;?></p>
		<h4>Mã đơn hàng : </h4>
		<h3>Lưu ý:</h3>
		<ul>
		<?php if($_GET['type']==1):?>
			<li>Nếu bạn chuyển khoản qua ATM, sau khi chuyển khoản, bạn vui lòng liên hệ với Happy Click
qua số điện thoại (08) 7302 0168 – (08) 7303 0168 để xác nhận nội dung thanh toán
</li>
	<?php endif; ?>
			<li>Vui lòng thanh toán phí tham dự trong vòng 3 ngày kể từ ngày đăng ký để giữ chỗ
</li>

		</ul>
	</div>

</div>