<?php
global $current_user;
$flag='';
 $args = array(
    'orderby'       => 'name', 
    'order'         => 'ASC',
    'hide_empty'    => false, 
    'exclude'       => array(), 
    'exclude_tree'  => array(), 
    'include'       => array(),
    'number'        => '', 
    'fields'        => 'all', 
    'slug'          => '', 
    'parent'        => '',
    'hierarchical'  => true, 
    'child_of'      => 0, 
    'get'           => '', 
    'name__like'    => '',
    'pad_counts'    => false, 
    'offset'        => '', 
    'search'        => '', 
    'cache_domain'  => 'core'
); 	
$cities = get_terms('city',$args);
$nganhnghe =get_terms('nganhnghe',$args);
$doituong = get_terms('doituong',$args);
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

<form id="form" class="form_profile" method="post">
<?php echo $flag; ?>
		<table width="100%" class="form_profile">
			
			
			<tr>
				<td colspan="2"><br/>
				<p><strong>THÔNG TIN CÁ NHÂN</strong></p><br/>	
				</td>

			</tr><tr>
				<td colspan="2">
					
					<p>(<span>*</span>) Thông tin bắt buộc</p><br/>
				</td>
			</tr>
			<tr>
				<td class="box3" width="45%"  align="right">Họ</td>
				<td  class="box4"><input required type="text" id="first_name" name="first_name" placeholder="Vui lòng gõ tiếng Việt có dấu" value="<?php echo get_usermeta( $current_user->ID, 'first_name'); ?>" /><span>*</span></td>				
			</tr>
			<tr>
				<td class="box3" width="45%"  align="right">Tên</td>
				<td  class="box4"><input required type="text" id="last_name" name="last_name" placeholder="Vui lòng gõ tiếng Việt có dấu" value="<?php echo get_usermeta( $current_user->ID, 'last_name'); ?>" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3"  align="right">Giới tính</td>
				<td  class="box4"><input type="radio" name="gender" value="0" <?php if($gender==0) echo 'checked=checked'; else echo ''; ?> /> Nam <input type="radio" name="gender" value="1" <?php if($gender==1) echo 'checked=checked'; else echo ''; ?> /> Nữ</td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Ngày sinh</td>
				<td  class="box4"><input type="text" id="birthday" name="birthday" value="<?php echo get_usermeta( $current_user->ID, 'birthday'); ?>" placeholder="Ngày/tháng/năm" required/><span>*</span></td>				
			</tr>
			<tr>
			<?php
				if($current_user->ID > 0)
					$disable = 'disabled="disabled"';
				else
					$disable = '';
			?>
				<td width="45%"  class="box3" align="right">Email <br/> <em style="font-weight:normal">Email cá nhân hoặc email thường sử dụng.<br/><strong>Hỗ trợ 24/7: (08) 7302 0168 - (08) 7303 0168</strong></em></td>
				<td  class="box4"><input required class="email" <?php echo $disable ?> type="email" name="email" id="email" value="<?php echo $current_user->user_email ?>" /><span>*</span></td>				
			</tr>
		
			
			<tr>
				<td width="45%"  class="box3" align="right">Điện thoại di động</td>
				<td  class="box4"><input type="text" name="mobile" id="mobile" required value="<?php echo get_usermeta( $current_user->ID, 'mobile'); ?>"  /><span>*</span></td>				
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
				<td  class="box4">
					<select id="objectuser" name="objectuser"  validate="required:true">
						<option>Chưa chọn</option>
					
						<?php
							if(!empty($doituong)){
								foreach ($doituong as $dt) {
									if(get_usermeta( $current_user->ID, 'objectuser')==$dt->ID){
										$selected = 'selected=selected';
									}else
										$selected = '';
							?>
								<option <?php echo $selected; ?> value="<?php echo $dt->ID ?>"><?php echo $dt->name; ?></option>
							<?php
								}
							}
						?>
					</select>

<span>*</span></td>				
			</tr>

			<tr>
				<td width="45%"  class="box3" align="right">Ngành nghề</td>
				<td  class="box4">
					<select id="mayjor" name="mayjor"><option>Chưa chọn</option>
						<?php
							if(!empty($nganhnghe)){
								foreach ($nganhnghe as $dt) {
									if(get_usermeta( $current_user->ID, 'mayjor')==$dt->ID){
										$selected = 'selected=selected';
									}else
										$selected = '';
							?>
								<option <?php echo $selected; ?> value="<?php echo $dt->ID ?>"><?php echo $dt->name; ?></option>
							<?php
								}
							}
						?>
					</select>
</td>	</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Địa chỉ<br/><em style="font-weight:normal">Nhận thẻ và hóa đơn</em></td>
				<td  class="box4"><input type="text" name="address" id="address" required value="<?php echo get_usermeta( $current_user->ID, 'address'); ?>"  /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Tỉnh/Thành phố</td>
				<td  class="box4">
					<select id="city" name="city"  validate="required:true"><option>Chưa chọn</option>
						<?php
							if(!empty($cities)){
								foreach ($cities as $dt) {
									if(get_usermeta( $current_user->ID, 'city')==$dt->ID){
										$selected = 'selected=selected';
									}else
										$selected = '';
							?>
								<option <?php echo $selected; ?> value="<?php echo $dt->ID ?>"><?php echo $dt->name; ?></option>
							<?php
								}
							}
						?>
					</select>

<span>*</span></td>	
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