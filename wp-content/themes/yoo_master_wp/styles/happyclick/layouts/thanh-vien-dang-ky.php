<?php
global $current_user;
?>

<?php if($current_user->ID < 1): ?>
<div class="box" style="width:730px">
<p>Đăng nhập nếu bạn đã có tài khoản dùng thử</p>
<div ><?php echo $this['modules']->render('login-modal'); ?></div>
</div>
<?php endif; ?>
<div class="box" style="width:730px">
<p>Nếu bạn đã đăng ký xem thử hoặc chưa có tài khoản của Happy Click, bạn có thể trở thành<br/>
thành viên để được ưu đãi phí tham dự hội thảo và khóa học của Happy Click</p>
<p class="cat-post-title1" >
<a href="/category/thanh-vien/quyen-loi-thanh-vien/"></a>
</p>
</div>