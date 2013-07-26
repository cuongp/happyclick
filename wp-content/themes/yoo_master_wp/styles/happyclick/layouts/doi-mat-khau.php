
<?php if ($this['modules']->count('breadcrumbs')) : ?>
	<section id="breadcrumbs"><?php echo $this['modules']->render('breadcrumbs'); ?></section>
<?php endif; ?>
<div class="box" style="width:730px">
<?php
$flag = '';
if(isset($_POST) && $_POST['action'] == 'submit')
{
	global $current_user;
	if(!isset($_GET)){
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
	}elseif($_GET['act']=='rp'){
		if(isset($_GET['user_id']) && isset($_GET['user_id']) && isset($_GET['key'])){
			if($_POST['new_pass'] =='' || $_POST['confirm_pass'] ==''){
				$flag = '<h3 class="error">Bạn chưa nhập thông tin đầy đủ</h3>';
			}elseif($_POST['new_pass']!=$_POST['confirm_pass']){
				$flag= '<h3  class="error">Mật khẩu không giống nhau</h3>';
			}else{
				$user = 	('id',$_GET['user_id']);
				var_dump($user);
				var_dump($_GET['key'],$user->user_activation_key);
				exit;
				if($_GET['key'] == $user->user_activation_key){
					var_dump(wp_set_password($_POST['new_pass'],$user->ID));
					exit();
					if(wp_set_password($_POST['new_pass'],$user->ID)){
						wp_redirect('/hcaccount/xac-thuc-email/?act=doi-mat-khau');
					}
					
				}	
			}

			
		}else
			wp_redirect('');
	}
	
}
?>
		<form class="form_profile" id="form" method="post">
		<?php 
echo $flag; ?>		
		<table width="100%" class="form_doipass">
		<?php if(!isset($_GET['act'])): ?>
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
		<?php elseif($_GET['act']=='rp'): ?>
			<tr>
				<td colspan="2">
					<p><strong>TẠO MẬT KHẨU MỚI</strong></p>
					<p>(<span>*</span>) Thông tin bắt buộc</p><br/>
				</td>
			</tr>
		<?php endif; ?>
			<?php if(!isset($_GET)): ?>
			<tr>
				<td class="box3" width="45%"  align="right">Mật khẩu hiện tại</td>
				<td  class="box4"><input type="text" name="current_pass" /><span>*</span></td>				
			</tr>
			<?php endif; ?>
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
				<td colspan="2" align="right"><a href="<?php echo get_site_url(); ?>" class="returnhome">Trở về trang chủ</a></td>

			</tr>
		
		</table>
		</form>
	</div>
