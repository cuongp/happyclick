
<?php
global $current_user;
$cid = $_GET['cid'];
$user_id = $_GET['user_id'];
$code = $_GET['code'];
$act = $_GET['act'];
$post = get_post($cid);
$data = get_post_meta( $post_id, '_sukien', true );
$flag ='';
$time = explode('|', $data['thoigian']);
if(count($time)>1){
  $date = $time[1];
  $hour = $time[0];
}else
{
  $date = $time[0];
  $hour = $time[0];
}
if(isset($_POST['action']) && $_POST['action']=='submit'){

	$db = $GLOBALS['wpdb'];

	if(isset($cid) && isset($user_id) && isset($code)){

	$query = $db->query('update '.$db->prefix.'user_sukien set payment_type="'.$_POST['payment'].'" where user_id="'.$user_id.'" and sukien_id="'.$cid.'"');
  $is_subs = current_user_has_subscription();
  if($is_subs)
    $giatien = number_format($data['giatien']-$data['giatien']*get_option('hpbasicmembership')/100,0,'.','.');
  else
    $giatien = number_format($data['giatien'],0,'.','.');
  if($query){
    if($current_user->ID>0){
      $email = $current_user->user_email;
      $name = $current_user->last_name;
    }
    else
    {
      $u = get_user_by('id',$user_id);
      $email=$u->user_email;
      $name = $u->last_name;
    }
		if($_POST['payment']==1){
          				$html = '<table width="600" cellpadding="0" cellspacing="0" bgcolor="#799d1f" style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 14px;">
          <tbody>
          <tr>
          <td align="center" valign="top"> </td>
          </tr>
          <tr>
          <td align="center" valign="top">
          <table width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="width: 600px; font-family: Arial, Helvetica, sans-serif;">
          <tbody>
          <tr>
            <td><a href="http://www.happyclick.com.vn"><img src="http://www.unity.com.vn/images/HC_Banner.png" align="center" width="598" height="130" /></a></td>
          </tr>
          <tr>
            <td height="323" valign="top" style="padding: 10px 10px 0px 10px; height=; color: #003399; font-size: 14px;"><p style="padding:10px">Chào '.$name.'<br />
                <br />
                Cảm ơn bạn đã đăng ký chương trình '.$post->post_title.'</p>
              <p  style="padding:10px">Thời gian: '.$time.'ngày '.$date.'<br />
                <br />
                Địa điểm:'.$data['diadiem'].'<br />
                <br />
                Phí tham dự:'.$giatien.'đ<br />
                <br />
                Hình thức thanh toán: Chuyển khoản qua ngân hàng</p>
              <blockquote>
                <p  style="padding:10px">Vui lòng chọn 1 trong 2 tài khoản sau:</p>
                <p style="padding:10px"><span style="font-weight: bold">Tài khoản 1</span>: CT CP Tư vấn &amp; Đào tạo Happy Click<br />
                  Số TK:   0071000779455<br />
                  Ngân hàng Ngoại Thương Việt Nam - CN Tp.HCM - PGD số 5<br />
                  8 Nguyễn Huệ, P. Bến Nghé, Quận 1, Tp.HCM</p>
                <p style="padding:10px"><span style="font-weight: bold">Tài khoản 2</span>: CT CP Tư vấn &amp; Đào tạo Happy Click<br />
                  Số TK:  060068584585<br />
                  Ngân hàng TMCP Sài Gòn Thương Tín - PGD Huỳnh Thúc Kháng<br />
                  2-4-6 Huỳnh Thúc Kháng, P. Bến Nghé, Quận 1, Tp.HCM</p>
              </blockquote>
              <p style="padding:10px"><strong>Mã đơn hàng:HC_'.$post->ID.$current_user->ID.'</strong><br />
                <br />
                Lưu ý:</p>
              <ul style="padding:10px">
                <li>Bạn vui lòng ghi nội dung chuyển khoản theo cú pháp:        </li></ul><blockquote>
                    <p>Thanh toán &lt;mã đơn hàng&gt; cho &lt;họ và tên học viên&gt;</p>
              </blockquote>
              <ul style="padding:10px">
                <li>Nếu chuyển khoản qua ATM, sau khi chuyển khoản, bạn vui lòng liên hệ với Happy Click qua số điện thoại (08) 7302 0168 – (08) 7303 0168 để xác nhận nội dung thanh toán.</li>
                <li>Vui lòng thanh toán phí tham dự trong vòng 3 ngày kể từ ngày đăng ký để giữ chỗ.</li>
                <li>Sau khi nhận được chuyển khoản của bạn, Happy Click sẽ email xác nhận bạn đã hoàn tất đăng ký.</li>
              </ul>
              <p style="padding:10px;background:red">Đây là email tự động gửi, vui lòng không trả lời vào email này.</p>
              <p style="padding:10px">Thân mến,<br />
                <br />
                <strong style="color: #68A400">Công ty Cổ phần Tư vấn và Đào tạo Happy Click</strong><br />
                <em>Hỗ trợ 24/7: (08) 7302 0168 – (08) 7303 0168</em><br />
                <em>Email: <span style="color: #3399FF; font-style: italic; font-weight: bold;"><a href="mailto:lienhe@happyclick.com.vn">lienhe@happyclick.com.vn</a></span></em></p>
              <p>&nbsp;</p></td>
          </tr>
          </tbody>
          </table>
          <table style="width: 600px;" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
            <tbody>
              <tr> </tr>
              </tbody>
          </table></td>
          </tr>
          <tr>
          <td align="center" valign="top"> </td>
          </tr>
          </tbody>
          </table>';
			}
			else{
            			$html='<table width="600" cellpadding="0" cellspacing="0" bgcolor="#799d1f" style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 14px;">
            <tbody>
            <tr>
            <td align="center" valign="top"> </td>
            </tr>
            <tr>
            <td align="center" valign="top">
            <table width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="width: 600px; font-family: Arial, Helvetica, sans-serif;">
            <tbody>
            <tr>
              <td><a href="http://www.happyclick.com.vn"><img src="http://www.unity.com.vn/images/HC_Banner.png" align="center" width="598" height="130" /></a></td>
            </tr>
            <tr>
              <td height="323" valign="top" style="padding: 10px 10px 0px 10px; height=; color: #003399; font-size: 14px;"><p style="padding:10px">Chào '.$name.'<br />
                <br />
                Cảm ơn bạn đã đăng ký chương trình '.$post->post_title.'</p>
                <p  style="padding:10px">Thời gian: '.$time.'ngày '.$date.'<br />
                <br />
                Địa điểm:'.$data['diadiem'].'<br />
                <br />
                Phí tham dự:'.$giatien.'đ<br />
                <br />
                  Hình thức thanh toán: Thanh toán trực tiếp tại Văn phòng Happy Click</p>
                <blockquote>
                  <p style="padding:10px">Địa chỉ: Văn phòng Happy Click, Tầng 6, Tòa nhà 116-118 Nguyễn Thị Minh Khai, Q.3, TpHCM.<br />
                    Thời gian làm việc: 8:00 – 12:00, 13:30 – 17:30, từ thứ Hai đến thứ Bảy.</p>
                  </blockquote>
                <p style="padding:10px"><strong>Mã đơn hàng:HC_'.$post->ID.$current_user->ID.'</strong></p>
                <p style="padding:10px">Vui lòng thanh toán phí tham dự trong vòng 3 ngày kể từ ngày đăng ký để giữ chỗ.<br />
                  <br />
                  <p style="background:red;padding:5px">Đây là email tự động gửi, vui lòng không trả lời vào email này.</p><br />
                  <br />
                  Thân mến,<br />
                  <br />
                  <strong style="color: #68A400">Công ty Cổ phần Tư vấn và Đào tạo Happy Click</strong><br />
                  <em>Hỗ trợ 24/7: (08) 7302 0168 – (08) 7303 0168</em><br />
                  <em>Email: <span style="color: #3399FF; font-style: italic; font-weight: bold;"><a href="mailto:lienhe@happyclick.com.vn">lienhe@happyclick.com.vn</a></span></em></p>
                <p>&nbsp;</p></td>
            </tr>
            </tbody>
            </table>
            <table style="width: 600px;" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
              <tbody>
                <tr> </tr>
                </tbody>
            </table></td>
            </tr>
            <tr>
            <td align="center" valign="top"> </td>
            </tr>
            </tbody>
            </table>';
}
		$headers[] = 'From: Happy Click <support@happyclick.vn>';
		$headers[] = 'Content-type: text/html';


		wp_mail($email,'Xác nhận đăng ký hội thảo/khóa học '.$post->post_title,$html,$headers);
		wp_redirect('/hcaccount/xac-nhan-thanh-toan/?cid='.$cid.'&type='.$_POST['payment']);
			exit;
	}else{
    $flag ='<h3 class="error">Thanh toán không thực hiện được, vui lòng liên hệ bộ phận hỗ trợ khách hàng để được giải quyết</h3>';
  }
	}
}

?>
<div class="box" style="width:730px">
	<?php echo $flag; ?>
	<div class="bodycontent">
	<h3>Chọn hình thức thanh toán</h3>
	<form method="post" id="form">

		<p><strong>Vui lòng chọn 1 trong 2 hình thức thanh toán sau:</strong></p><br/>
		<p><input type="radio" name="payment" value="3"><b> Thanh toán trực tiếp tại văn phòng Happy Click<br/></b>
		<ul>
			<li>Văn phòng Happy Click, Tầng 6, Tòa nhà 116-118 Nguyễn Thị Minh Khai, Q.3, TpHCM</li>
<li>Điện thoại: (08) 7302 0168 – (08) 7303 0168</li>
<li>Thời gian làm việc: 8:00 – 12:00, 13:30 – 17:30 từ thứ Hai đến thứ Bảy</li>
		</ul>
		</p>
		<p><input type="radio" name="payment" value="1"><b>Chuyển khoản (vui lòng chọn 1 trong 2 tài khoản sau)</b><br/>
			<ul>
				<li>Tài khoản 1: CT CP Tư vấn & Đào tạo Happy Click
					<ul>
						<li>Số TK:   0071000779455</li>
<li>Ngân hàng Ngoại Thương Việt Nam - CN Tp.HCM - PGD số 5</li>
<li>8 Nguyễn Huệ, P. Bến Nghé, Quận 1, Tp.HCM</li>

					</ul>
				</li>
				<li>Tài khoản 2: CT CP Tư vấn & Đào tạo Happy Click
					<ul>
						<li>Số TK:  060068584585</li>
<li>Ngân hàng TMCP Sài Gòn Thương Tín - PGD Huỳnh Thúc Kháng</li>
<li>2-4-6 Huỳnh Thúc Kháng, P. Bến Nghé, Quận 1, Tp.HCM</li>
					</ul>
				</li>
			</ul>
		</p>
		<h3>Lưu ý:</h3>
		<li style="padding:10px 0">Nếu chuyển khoản qua ngân hàng, bạn vui lòng ghi nội dung chuyển khoản theo cú pháp:<br/>
<b>Thanh toán < mã đơn hàng > cho < họ và tên học viên ></b><br/></li>

<li  style="padding:10px 0">Nếu chuyển khoản qua ATM, sau khi chuyển khoản, bạn vui lòng liên hệ với Happy Click qua số điện thoại (08) 7302 0168 – (08) 7303 0168 để xác nhận nội dung thanh toán<br/></li>

<li  style="padding:10px 0">Sau khi nhận được chuyển khoản của bạn, Happy Click sẽ email xác nhận  bạn đã hoàn tất đăng ký<br/></li>
		<table width="100%">
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

</div>