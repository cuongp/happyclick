<?php
global $current_user;
$user_id= $current_user->ID;
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
	update_usermeta( $user_id, 'first_name', $_POST['hcfirst_name']);
	update_usermeta( $user_id, 'last_name', $_POST['hclast_name']);
	update_usermeta( $user_id, 'mobile', $_POST['hcmobile']);
	update_usermeta( $user_id, 'position', $_POST['hcposition']);
	update_usermeta( $user_id, 'companyphone', $_POST['hcompanyphone']);
	update_usermeta( $user_id, 'gender', $_POST['hcgender']);
	update_usermeta( $user_id, 'company', $_POST['hccompany']);
	update_usermeta( $user_id, 'birthday', $_POST['hcbirthday']);
	update_usermeta( $user_id, 'objectuser', $_POST['hcobjectuser']);
	update_usermeta( $user_id, 'mayjor', $_POST['hcmayjor']);
	update_usermeta( $user_id, 'city', $_POST['hccity']);
	update_usermeta( $user_id, 'address', $_POST['hcaddress']);
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
				<td  class="box4"><input required type="text" id="first_name" name="hcfirst_name" placeholder="Vui lòng gõ tiếng Việt có dấu" value="<?php echo get_usermeta( $current_user->ID, 'first_name'); ?>" /><span>*</span></td>				
			</tr>
			<tr>
				<td class="box3" width="45%"  align="right">Tên</td>
				<td  class="box4"><input required type="text" id="last_name" name="hclast_name" placeholder="Vui lòng gõ tiếng Việt có dấu" value="<?php echo get_usermeta( $current_user->ID, 'last_name'); ?>" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3"  align="right">Giới tính</td>
				<td  class="box4"><input type="radio" name="hcgender" value="0" <?php if($gender==0) echo 'checked=checked'; else echo ''; ?> /> Nam <input type="radio" name="hcgender" value="1" <?php if($gender==1) echo 'checked=checked'; else echo ''; ?> /> Nữ</td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Ngày sinh</td>
				<td  class="box4"><input type="text" id="birthday" name="hcbirthday" value="<?php echo get_usermeta( $current_user->ID, 'birthday'); ?>" placeholder="Ngày/tháng/năm" required/><span>*</span></td>				
			</tr>
			<tr>
			<?php
				if($current_user->ID > 0)
					$disable = 'disabled="disabled"';
				else
					$disable = '';
			?>
				<td width="45%"  class="box3" align="right"><p style="font-size:12px">Email<br/><em style="font-weight:normal">Email này bạn đã dùng để đăng nhập,<br/> Nếu cần thay đổi vui lòng liên hệ với Happy Click.
				<br/><strong>Hỗ trợ 24/7: (08) 7302 0168 - (08) 7303 0168</strong></em></p></td>
				<td  class="box4"><input required class="email" <?php echo $disable ?> type="email" name="hcemail" id="email" value="<?php echo $current_user->user_email ?>" /><span>*</span></td>				
			</tr>
		
			
			<tr>
				<td width="45%"  class="box3" align="right">Điện thoại di động</td>
				<td  class="box4"><input type="text" name="hcmobile" id="mobile" required value="<?php echo get_usermeta( $current_user->ID, 'mobile'); ?>"  /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Điện thoại công ty</td>
				<td  class="box4"><input type="text" name="hccompanyphone" value="<?php echo get_usermeta( $current_user->ID, 'companyphone'); ?>" /></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Chức vụ</td>
				<td  class="box4"><input type="text" name="hcposition" value="<?php echo get_usermeta( $current_user->ID, 'position'); ?>" /></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Công ty</td>
				<td  class="box4"><input type="text" name="hccompany" value="<?php echo get_usermeta( $current_user->ID, 'company'); ?>" /></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Đối tượng</td>
				<td  class="box4">
					<select id="objectuser" name="hcobjectuser"   required=""><option value="">Chưa chọn</option>
						<?php
							if(!empty($doituong)){
								foreach ($doituong as $dt) {
									if(get_usermeta( $current_user->ID, 'objectuser')==$dt->term_id){
										$selected = 'selected=selected';
									}else
										$selected = '';
							?>
								<option <?php echo $selected; ?> value="<?php echo $dt->term_id ?>"><?php echo $dt->name; ?></option>
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
					<select id="mayjor" name="hcmayjor"><option>Chưa chọn</option>
						<?php
							if(!empty($nganhnghe)){
								foreach ($nganhnghe as $dt) {
									if(get_usermeta( $current_user->ID, 'mayjor')==$dt->term_id){
										$selected = 'selected=selected';
									}else
										$selected = '';
							?>
								<option <?php echo $selected; ?> value="<?php echo $dt->term_id ?>"><?php echo $dt->name; ?></option>
							<?php
								}
							}
						?>
					</select>
</td>	</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Địa chỉ<br/><em style="font-weight:normal">Nhận thẻ và hóa đơn</em></td>
				<td  class="box4"><input type="text" name="hcaddress" id="address" required value="<?php echo get_usermeta( $current_user->ID, 'address'); ?>"  /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Tỉnh/Thành phố</td>
				<td  class="box4">
					<select id="city" name="hccity"  required=""><option value="">Chưa chọn</option>
						<?php
							if(!empty($cities)){
								foreach ($cities as $dt) {
									if(get_usermeta( $current_user->ID, 'city')==$dt->term_id){
										$selected = 'selected=selected';
									}else
										$selected = '';
							?>
								<option <?php echo $selected; ?> value="<?php echo $dt->term_id ?>"><?php echo $dt->name; ?></option>
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
				<td colspan="2" align="right"><a href="/index.php" class="returnhome">Trở về trang chủ</a></td>

			</tr>
		</table>
		</form>

</div>