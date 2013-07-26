<div class="box" style="width:500px;">
<?php 
if(isset($_GET['act'])){
	switch ($_GET['act']) {
		case 'khach-dang-ky':
			echo '<p>Happy Click đã gửi email cho bạn, vui lòng kiểm tra email và làm theo hướng dẫn để tiếp tục đăng ký.
</p>';
			break;
		case 'quen-mat-khau':
			echo '<p>Happy Click đã gửi email cho bạn vào email mà bạn đã đăng ký. Vui lòng làm theo hướng dẫn trong email để lấy lại mật khẩu.</p>';
	}
}else{
echo'<p>Happy Click đã gửi email cho bạn, vui lòng kiểm tra email và làm theo hướng dẫn trước khi bắt đầu dùng thử dịch vụ của Happy Click.</p>';
}
?>
<h3 style="color: #e58a35;">Lưu ý:</h3>
<ul>
<li style="padding-left: 10px;">- Nếu không tìm thấy email của Happy Click trong hộp thư đến, bạn có thể kiểm tra lại trong hộp thư rác.</li>
<li style="padding-left: 10px;">- Nếu vẫn không tìm thấy email, vui lòng thực hiện lại.</li>
</ul>

<span style="text-align:right"> <a class="returnhome" href="<?php echo get_site_url(); ?>">Trở về trang chủ </a></span>


</div>