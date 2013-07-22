<?php
global $current_user;
$flag='';
if(isset($_POST) && $_POST['action'] == 'submit'){
	

	foreach ($_POST as $key=>$val) {
		
		if($key !='action')
			update_usermeta( $current_user->ID, $key, $val);
	}
	wp_reset_query();
	$flag = '<h3 class="success">Cập nhập thông tin cá nhân thành công</h3>';
}

$gender = get_usermeta( $current_user->ID, 'gender');

?>
<div class="box" style="width:730px">
<p>Đăng nhập nếu bạn đã có tài khoản dùng thử</p>
<div style="float:right"><?php echo $this['modules']->render('login-modal'); ?></div>
<div style="clear:both"></div>
</div>
<div class="box" style="width:730px">

<form id="form" class="form_profile" method="post">
		<?php 
//echo $flag;
?>
		<table width="100%" class="form_doipass">
			
			<tr>
				<td colspan="2"><br/>
				<p><strong>THÔNG TIN CÁ NHÂN</strong></p><br/>	
				</td>

			</tr>			<tr>
				<td colspan="2">
					
					<p>(<span>*</span>) Thông tin bắt buộc</p><br/>
				</td>
			</tr>

			<tr>
				<td class="box3" width="45%"  align="right">Họ và tên</td>
				<td  class="box4"><input type="text" id="fullname" name="fullname" placeholder="Vui lòng gõ tiếng Việt có dấu" value="<?php echo get_usermeta( $current_user->ID, 'fullname'); ?>" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3"  align="right">Giới tính</td>
				<td  class="box4"><input type="radio" name="gender" value="0" <?php if($gender==0) echo 'checked=checked'; else echo ''; ?> /> Nam <input type="radio" name="gender" value="1" <?php if($gender==1) echo 'checked=checked'; else echo ''; ?> /> Nữ</td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Ngày sinh</td>
				<td  class="box4"><input type="text" id="birthday" name="birthday" value="<?php echo get_usermeta( $current_user->ID, 'birthday'); ?>" placeholder="Ngày/tháng/năm" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Email <br/> <em style="font-weight:normal">Email này bạn đã dùng để đăng nhập, nếu cần thay đổi vui lòng liên hệ với Happy Click.<br/><strong>Hỗ trợ 24/7: (08) 7302 0168 - (08) 7303 0168</strong></em></td>
				<td  class="box4"><input type="text" name="email" disabled="disabled" id="email" value="<?php echo $current_user->user_email ?>" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Email<br/><em>Email cá nhân hoặc email thường sử dụng</em></td>
				<td  class="box4"><input id="subemail" type="text" name="subemail"  value="<?php echo get_usermeta( $current_user->ID, 'subemail'); ?>" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Mật khẩu</td>
				<td  class="box4"><input type="text" name="password" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Xác nhận mật khẩu</td>
				<td  class="box4"><input type="text" name="confirm_pass" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Điện thoại di động</td>
				<td  class="box4"><input type="text" name="mobile" id="mobile" value="<?php echo get_usermeta( $current_user->ID, 'mobile'); ?>"  /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Điện thoại công ty</td>
				<td  class="box4"><input type="text" name="companyphone" value="<?php echo get_usermeta( $current_user->ID, 'companyphone'); ?>" /></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Chức vụ</td>
				<td  class="box4"><input type="text" name="position" value="<?php echo get_usermeta( $current_user->ID, 'position'); ?>" /></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Công ty</td>
				<td  class="box4"><input type="text" name="company" value="<?php echo get_usermeta( $current_user->ID, 'company'); ?>" /></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Đối tượng</td>
				<td  class="box4"><input type="text" name="objectuser" id="objectuser" value="<?php echo get_usermeta( $current_user->ID, 'objectuser'); ?>" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Ngành nghề</td>
				<td  class="box4"><input type="text" name="mayjor" value="<?php echo get_usermeta( $current_user->ID, 'mayjor'); ?>"  /></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Địa chỉ<br/><em style="font-weight:normal">Nhận thẻ và hóa đơn</em></td>
				<td  class="box4"><input type="text" name="address" id="address" value="<?php echo get_usermeta( $current_user->ID, 'address'); ?>"  /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Tỉnh/Thành phố</td>
				<td  class="box4"><input type="text" name="city" id="city" value="<?php echo get_usermeta( $current_user->ID, 'city'); ?>"  /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right"></td>
				<td  class="box4">
				<input type="checkbox" name="dk" value="1" id="agree"/> Tôi đã đọc và đồng ý với <a href="">điều khoản sử dụng</a> trên đây
				</td>				
			</tr>
			<tr>
				<td><input type="hidden" name="action" value="submit"></td>
				<td align="center" class="update"><input type="submit" value=""  /></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><a href="" class="returnhome">Trở về trang chủ</a></td>

			</tr>
		</table>
		</form>

</div>