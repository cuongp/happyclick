<?php
if(isset($_GET['cid']))
	$cid = $_GET['cid'];
else
	$cid = 0;
$post = get_post($cid);
$data = get_post_meta( $cid, '_sukien', true );
$time = explode('|', $data['thoigian']);
if(count($time)>1){
	$date = $time[1];
	$hour = $time[0];
}else
{
	$date = $time[0];
	$hour = $time[0];
}
?>
<div class="box" style="width:730px">
	<div class="bodycontent">
	<h3>Xác nhận đăng ký</h3>
		<p>Bạn đã đăng ký khóa học/hôi thảo <b><?php echo $post->post_title; ?></b></p>
		<?php if($_GET['type']==2): ?>
			<p>Thời gian :<?php echo $hour; ?></p>
			<p>Ngày :<?php echo $date; ?></p>
			
		<?php else:?>
		<p>Thời gian :<?php echo $data['thoigian']; ?></p>
	<?php endif;?>
		<p>Địa điểm :<?php echo $data['diadiem']; ?></p>
		<p>Phí tham dự : <?php if($data['giatien']=='' || $data['giatien']==0) echo 'Miễn Phí'; else echo $data['giatien']; ?></p>
		<?php if($_GET['type']<2): ?>
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
		<?php endif; ?>
	</div>

</div>