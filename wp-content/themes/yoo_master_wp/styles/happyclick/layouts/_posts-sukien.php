<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/
$is_subs = current_user_has_subscription();
$args = array(
                'posts_per_page' => 1,
                'post_type' => 'sukien',
                'no_found_rows' => true,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'chude',
                        'field' => 'slug',
                        'terms' => get_query_var('chude')
                    )
                ),
                'order' => 'DESC');

    $trial_id       = 1; //Trial level
    $is_trial       = current_user_on_level($trial_id);
    $the_query = new WP_Query( $args );
    while ( $the_query->have_posts() ):

        $the_query->the_post();
          $post_id = get_the_ID();
          $data = get_post_meta( $post_id, '_sukien', true );
    global $current_user;
                $db = $GLOBALS['wpdb'];
                if($_POST['question']){
                    $result_id = $db->insert($db->prefix.'qna'
                                ,array('user_id'    =>  $current_user->ID
                                        ,'post_id'  =>  $_POST['post_id']
                                        ,'question' =>  $_POST['question']
                                        ,'post_date'=>  time()
                    ));
                    if($result_id){
                        $flag = '<h3>Câu hỏi của bạn được gửi, Cám ơn bạn!</h3>';
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
             <td>Bạn nhận đươc câu hỏi từ thành viên '.$current_user->last_name.'
             <br/>
             Câu hỏi : '.$_POST['question'].'
             </td>
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

            $headers[] = 'From: Happy Click <support@happyclick.vn>';
            $headers[] = 'Content-type: text/html';
            wp_mail($email,'Bạn có câu hỏi từ '.$current_user->last_name,$html,$headers);
                    }else
                        $flag = '';
                }
    ?>
<article class="item" style="padding:20px 10px;position:relative" data-permalink="<?php the_permalink(); ?>">
            <div class="clearfix" >
            <?php
            $current_tax =get_query_var('chude');
            if($current_tax!='phat-trien-nghe-nghiep'):
            ?>
            <header>
                <h1 class='title'>Hỏi đáp với chuyên gia</h1>
            </header>
            <?php
            endif;
            ?>
            <?php the_content('');
            $time = explode('|', $data['thoigian']);
            if(count($time)>1){
                $date = $time[1];
                $hour = $time[0];
            }else
            {
                $date = $time[0];
                $hour = $time[0];
            }
            echo $flag;
            ?>
            <!--<p>Thời gian: <?php echo $hour; ?></p>
            <p>Ngày: <?php echo $date; ?></p>-->
            <?php if($current_user->ID<1 || !$is_subs): ?>
      <table border="0" align="left">
        <tbody>
        <tr>
          <td width="250"><img width="122" height="35" src="/wp-content/uploads/2013/07/dang-ky.png" alt="Đăng ký" class="alignnone size-full wp-image-2481"></td>
          <td width="280"><a href="/category/thanh-vien/quyen-loi-thanh-vien/" ><img src="/wp-content/uploads/2013/07/tro-thanh-thanh-vien.png" alt="Trở thành thành viên" class="alignnone size-full wp-image-2480"></a></td>
          <td width="300"><a href="/wp-content/uploads/2013/07/Webinar_Guide.pdf" target="_blank"><img src="/wp-content/uploads/2013/07/huong-dan-tham-du-.png" alt="Hướng dẫn tham dự" class="alignnone size-full wp-image-2482"/></a></td>
        </tr>
        <tr>
        <td width="250">(<em>Chỉ dành cho thành viên</em>)</td>
        <td width="300"></td>
        </tr>
        </tbody>
      </table>

      <?php else : ?>
              <table border="0" align="left">
                <tbody>
                <tr>
                  <td width="250"><a href="<?php echo $data['articleicon']; ?>" target="_blank"><img width="122" height="35" src="/wp-content/uploads/2013/07/dang-ky.png" alt="Đăng ký" class="alignnone size-full wp-image-2481"></a></td>
                  <td width="300"><a href="/wp-content/uploads/2013/07/Webinar_Guide.pdf" target="_blank"><img src="/wp-content/uploads/2013/07/huong-dan-tham-du-.png" alt="Hướng dẫn tham dự" class="alignnone size-full wp-image-2482"/></a></td>
                </tr>
                </tbody>
              </table>

      <?php endif; ?>




    </div>
    <div style="position:relative;margin:0 auto;width:400px">
        <div id="modal" style="padding:0 10px;top:-500px;
    -webkit-border-radius:5px;
    -moz-border-radius:5px;
    border-radius:5px;
    border: 1px solid #eaeaea;
    -webkit-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.75);
    -moz-box-shadow:    0px 0px 5px rgba(0, 0, 0, 0.75);
    box-shadow:         0px 0px 5px rgba(0, 0, 0, 0.75);padding:10px;text-align:center;position: absolute;width:400px;background:#FFF;display:none;border:1px solid #ccc;">
                Cám ơn bạn đã đặt câu hỏi.
            </div>
    </div>
<?php echo do_shortcode("[FAQ_LIST pageid='".$post_id."']");?>
        </article>
    <?php
    endwhile;
    ?>