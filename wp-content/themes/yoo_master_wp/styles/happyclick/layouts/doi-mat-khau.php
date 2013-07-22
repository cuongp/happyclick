<?php if ($this['modules']->count('top-a2')) : ?>
	<section id="top-a2" class="grid-block"><?php echo $this['modules']->render('top-a2', array('layout'=>$this['config']->get('top-a2'))); ?></section>
<?php endif ;?>
<?php if ($this['modules']->count('breadcrumbs')) : ?>
	<section id="breadcrumbs"><?php echo $this['modules']->render('breadcrumbs'); ?></section>
<?php endif; ?>
<div class="box" style="width:730px">
<?php
$flag = '';
if(isset($_POST) && $_POST['action'] == 'submit')
{
	global $current_user;
	
	if($_POST['current_pass'] =='' || $_POST['new_pass'] =='' || $_POST['confirm_pass'] ==''){
		$flag = '<h3 class="error">Bạn chưa nhập thông tin đầy đủ</h3>';
	}elseif($_POST['new_pass']!=$_POST['confirm_pass']){
		$flag= '<h3  class="error">Mật khẩu không giống nhau</h3>';
	}
	if ( $current_user && wp_check_password( $_POST['current_pass'], $current_user->data->user_pass, $current_user->ID) )
   	{
   		wp_set_password($_POST['new_pass'],$current_user->ID);
   		$flag= '<h3 class="success">Thay đổi mật khẩu thành công</h3>';
   	}
	else
   	{
   		$flag ='<h3  class="error">Mật khẩu hiện tại không đúng</h3>';
   	}
}
echo $flag;
?>
		<form id="form" method="post">
		
		<table width="100%" class="form_doipass">
			<tr>
				<td colspan="2">
					<p><strong>THAY ĐỔI MẬT KHẨU</strong></p>
					<p>(<span>*</span>) Thông tin bắt buộc</p><br/>
				</td>
			</tr>
			<tr>
				<td class="box3" width="45%"  align="right">Mật khẩu hiện tại</td>
				<td  class="box4"><input type="text" name="current_pass" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3"  align="right">Mật khẩu mới</td>
				<td  class="box4"><input type="text" name="new_pass" /><span>*</span></td>				
			</tr>
			<tr>
				<td width="45%"  class="box3" align="right">Xác nhận mật khẩu mới</td>
				<td  class="box4"><input type="text" name="confirm_pass" /><span>*</span></td>				
			</tr>
			<tr>
				<td><input type="hidden" name="action" value="submit"></td>
				<td align="center"><input type="submit" value="" class="submit_final" /></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><a href="" class="returnhome">Trở về trang chủ</a></td>

			</tr>
		</table>
		</form>
	</div>
