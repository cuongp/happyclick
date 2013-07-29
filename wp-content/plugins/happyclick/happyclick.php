<?php

/*
Plugin Name: Happy Click
Plugin URI: http://tgmtech.vn
Description: 
Author: TGMTECH
Version: 1.0.0
Author URI: http://tgmtech.vn
License: GPLv2
*/


include (dirname(__file__) . '/widgets/widget-sukien.php');

//include (dirname(__file__) . '/widgets/widget-sukien.php');

add_action('admin_menu','add_membership_custom_options');

if(is_admin()){
    add_action('admin_menu','_init_menu_sukien');
    function _init_menu_sukien(){
            add_menu_page('Đăng ký sự kiện', 'Đăng ký sự kiện', 10, 'hcsukien', '_adminViewSukien',plugins_url('card/images/icon.png'));
    }

    function _adminViewSukien(){
    ?>
    <h1 class="title">Danh sách thành viên đăng ký</h1>
<table class="list" width="100%">
            <thead>
                <th class="shortcode">ID</th>
                <th class="shortcode">USER</th>
                <th class="modified">Ngày đăng ký</th>
                <th class="modified">Ngày thanh toán</th>
                <th class="modified">Loại hình thanh toán</th>
                <th class="modified">Tình trạng thanh toán</th>
                <th class="actions"></th>
            </thead>
            <tbody>
            <?php
            $db = $GLOBALS['wpdb'];
            $posts = $db->get_results('select * from '.$db->prefix.'user_sukien');
            if(!empty($posts)){
                foreach ($posts as $post) {
                    $user = get_user_by('id',$post->user_id);
                  
                    //get_usermeta($post->user_id,'first_name');
                ?>
                <tr>
                <td class="shortcode" ><?php echo $post->id ?>                    </td>
                <td class="shortcode"><?php echo $user->user_login; ?></td>
                <td class="modified"><?php  echo  $post->created_at ?></td>
                <td class="modified"><?php  if($post->payment_at>0) echo $post->payment_at;
                else echo 'Chưa thanh toán';
                 ?>       </td>
                <td class="modified"><?php  if($post->payment_type==0) echo 'Thanh toán trực tiếp tại văn phòng';
                else echo 'Thanh toán chuyển khoản';
                 ?></td>
                <td class="modified"><?php  if($post->payment_status==0) echo 'Chưa thanh toán'; else echo 'Đã thanh toán'; ?> </td>
                <td class="actions"><a href="#">Edit</a><a href="#">Delete</a></td>
                </tr>
                <?php
                }
            }
            ?>
            </tbody>
    </table>  
    <?php
                 
    }
}

function add_membership_custom_options(){
    add_options_page('HappyClick Membership Options', 'HappyClick Membership Options', 'manage_options', 'functions','membershiphp_custom_options');
}
    function membershiphp_custom_options(){
    ?>
    
<div class="wrap">  
        <h2>Discount for HappyClick Membership</h2>  
        <form method="post" action="options.php">  
            <?php wp_nonce_field('update-options') ?> 
            <p><strong>Discount Membership:</strong><br />  
                <input type="text" name="hpbasicmembership" size="15" value="<?php echo get_option('hpbasicmembership'); ?>" />%  
            </p>
            <p><strong>Post Per Page:</strong><br />  
                <input type="text" name="page_chude" size="15" value="<?php echo get_option('page_chude'); ?>" />%  
            </p>
            <p><input type="submit" name="Submit" value="Submit" /></p>  
            <input type="hidden" name="action" value="update" />  
            <input type="hidden" name="page_options" value="hpbasicmembership,page_chude" />
        </form></div>
               
    <?php
    }  
add_action('init', 'sukien_post_type');
function sukien_post_type()
{
    $labels = array(
        'name' => 'Sự kiện',
        'singular_name' => 'Sự kiện',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New item',
        'edit_item' => 'Edit item',
        'new_item' => 'New item',
        'view_item' => 'View item',
        'search_items' => 'Search item',
        'not_found' => 'No item found',
        'not_found_in_trash' => 'No item in the trash',
        'parent_item_colon' => '',
        );
    register_post_type('sukien', array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => false,
        'query_var' => true,
        'rewrite' => array('slug' => 'sukien'),
        'capability_type' => 'post',
        'has_archive' => true,
        'menu_position' => 10,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            ),
        'register_meta_box_cb' => 'sukien_meta_boxes',
        ));

flush_rewrite_rules();
}
add_action('init', 'hcfaq_post_type');
function hcfaq_post_type()
{
    $labels = array(
        'name' => 'HC FAQ',
        'singular_name' => 'HC FAQ',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New item',
        'edit_item' => 'Edit item',
        'new_item' => 'New item',
        'view_item' => 'View item',
        'search_items' => 'Search item',
        'not_found' => 'No item found',
        'not_found_in_trash' => 'No item in the trash',
        'parent_item_colon' => '',
        );
    register_post_type('hcfaq', array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => false,
        'query_var' => true,
        'rewrite' => array('slug' => 'hcfaq'),
        'capability_type' => 'post',
        'has_archive' => true,
        'menu_position' => 10,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            ),'register_meta_box_cb' => 'hcfaq_meta_boxes',
        ));

flush_rewrite_rules();
}

add_action('init', 'chude_taxonomy_type');
function chude_taxonomy_type()
{
    $labels = array(
        'name' => __('Chủ đề'),
        'singular_name' => __('Chủ đề'),
        'search_items' => __('Search Chủ đề'),
        'all_items' => __('All Chủ đề'),
        'edit_item' => __('Edit Chủ đề'),
        'update_item' => __('Update Chủ đề'),
        'add_new_item' => __('Add New Chủ đề'),
        'new_item_name' => __('New Chủ đề'),
        'choose_from_most_used' => __('Choose from the most used diễn giả'));
        register_taxonomy('chude', array('sukien'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'query_var' => 'chude',
        'rewrite' => array('slug' => 'chude'),
        'show_in_nav_menus' => true,
        'show_tagcloud' => false));
        flush_rewrite_rules();
}
add_action('init', 'diengia_taxonomy_type');
add_action('init', 'doituong_taxonomy_type');
add_action('init', 'nganhnghe_taxonomy_type');
add_action('init', 'city_taxonomy_type');
add_action('init', 'hcaccount_taxonomy_type');
function hcaccount_taxonomy_type()
{
    $labels = array(
        'name' => __('HC Account'),
        'singular_name' => __('HC Account'),
        'search_items' => __('Search Account'),
        'all_items' => __('All Account'),
        'edit_item' => __('Edit Account'),
        'update_item' => __('Update Account'),
        'add_new_item' => __('Add New Account'),
        'new_item_name' => __('New Account'),
        'choose_from_most_used' => __('Choose from the most used Account'));
    register_taxonomy('hcaccount', array('post'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'query_var' => 'hcaccount',
        'rewrite' => true,
        'show_in_nav_menus' => true));
        flush_rewrite_rules();
}


function diengia_taxonomy_type()
{
    $labels = array(
        'name' => __('Diễn giả'),
        'singular_name' => __('Diễn giả'),
        'search_items' => __('Search Diễn giả'),
        'all_items' => __('All Diễn giả'),
        'edit_item' => __('Edit Diễn giả'),
        'update_item' => __('Update Diễn giả'),
        'add_new_item' => __('Add New Diễn giả'),
        'new_item_name' => __('New Diễn giả'),
        'choose_from_most_used' => __('Choose from the most used diễn giả'));
    register_taxonomy('diengia', array('sukien'), array(
        'hierarchical' => false,
        'labels' => $labels,
        'query_var' => 'diengia',
        'rewrite' => true,
        'show_in_nav_menus' => true));
        flush_rewrite_rules();
}
function doituong_taxonomy_type()
{
    $labels = array(
        'name' => __('Đối tượng'),
        'singular_name' => __('Đối tượng'),
        'search_items' => __('Search Đối tượng'),
        'all_items' => __('All Đối tượng'),
        'edit_item' => __('Edit Đối tượng'),
        'update_item' => __('Update  Đối tượng'),
        'add_new_item' => __('Add New  Đối tượng'),
        'new_item_name' => __('New  Đối tượng'),
        'choose_from_most_used' => __('Choose from the most used  Đối tượng'));
    register_taxonomy('doituong', array('post'), array(
        'hierarchical' => false,
        'labels' => $labels,
        'query_var' => 'doituong',
        'rewrite' => true,
        'show_in_nav_menus' => true));
        flush_rewrite_rules();
}
function nganhnghe_taxonomy_type()
{
    $labels = array(
        'name' => __('Ngành nghề'),
        'singular_name' => __('Ngành nghề'),
        'search_items' => __('Search Ngành nghề'),
        'all_items' => __('All Ngành nghề'),
        'edit_item' => __('Edit Ngành nghề'),
        'update_item' => __('Update  Ngành nghề'),
        'add_new_item' => __('Add New  Ngành nghề'),
        'new_item_name' => __('New  Ngành nghề'),
        'choose_from_most_used' => __('Choose from the most used  Ngành nghề'));
    register_taxonomy('nganhnghe', array('post'), array(
        'hierarchical' => false,
        'labels' => $labels,
        'query_var' => 'nganhnghe',
        'rewrite' => true,
        'show_in_nav_menus' => true));
        flush_rewrite_rules();
}
function city_taxonomy_type()
{
    $labels = array(
        'name' => __('Thành phố'),
        'singular_name' => __('Thành phố'),
        'search_items' => __('Search Thành phố'),
        'all_items' => __('All Thành phố'),
        'edit_item' => __('Edit Thành phố'),
        'update_item' => __('Update Thành phố'),
        'add_new_item' => __('Add New Thành phố'),
        'new_item_name' => __('New Thành phố'),
        'choose_from_most_used' => __('Choose from the most used Thành phố'));
    register_taxonomy('city', array('post'), array(
        'hierarchical' => false,
        'labels' => $labels,
        'query_var' => 'city',
        'rewrite' => true,
        'show_in_nav_menus' => true));
        flush_rewrite_rules();
}

add_action('init', 'giangvien_post_type');
function giangvien_post_type()
{
    $labels = array(
        'name' => 'Giảng viên',
        'singular_name' => 'Giảng viên',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New item',
        'edit_item' => 'Edit item',
        'new_item' => 'New item',
        'view_item' => 'View item',
        'search_items' => 'Search item',
        'not_found' => 'No item found',
        'not_found_in_trash' => 'No item in the trash',
        'parent_item_colon' => '',
        );
    register_post_type('giangvien', array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => false,
        'query_var' => true,
        'rewrite' => array('slug' => 'giangvien'),
        'capability_type' => 'post',
        'has_archive' => true,
        'menu_position' => 10,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            )
        ));

flush_rewrite_rules();
}



function sukien_meta_boxes()
{
    add_meta_box('sukien_form', 'Details', 'sukien_form', 'sukien', 'normal', 'high');
}
function hcfaq_meta_boxes()
{
    add_meta_box('hcfaq_form', 'Details', 'hcfaq_form', 'hcfaq', 'normal', 'high');
}

function hcfaq_form(){
    $post_id = get_the_ID();
    $hcfaq_data = get_post_meta($post_id, '_hcfaq', true);
    $pageid = (empty($hcfaq_data['pageid'])) ? '' : $hcfaq_data['pageid'];

?>
<p>
        <label>Câu hỏi của bài viết</label><br />
        <input type="text" value="<?php echo $pageid; ?>" name="hcfaq[pageid]" size="80" />
        
</p>
<?php
}
function sukien_form()
{
    $post_id = get_the_ID();
    $sukien_data = get_post_meta($post_id, '_sukien', true);
    
    $video = (empty($sukien_data['video'])) ? '' : $sukien_data['video'];
    $giatien = (empty($sukien_data['giatien'])) ? '' : $sukien_data['giatien'];
    $thoigian = (empty($sukien_data['thoigian'])) ? '' : $sukien_data['thoigian'];
    $diadiem = (empty($sukien_data['diadiem'])) ? '' : $sukien_data['diadiem'];
    $articleicon = (empty($sukien_data['articleicon'])) ? '' : $sukien_data['articleicon'];
    $slidericon = (empty($sukien_data['slidericon'])) ? '' : $sukien_data['slidericon'];
    $isslider = (empty($sukien_data['isslider'])) ? '' : $sukien_data['isslider'];
    wp_nonce_field('sukien', 'sukien');
?>
<p>
        <label>Video (optional)</label><br />
        <input type="text" value="<?php echo $video; ?>" name="sukien[video]" size="80" />
</p>
<p>
        <label>Slider Icon</label><br />
        <input type="text" value="<?php echo $slidericon; ?>" name="sukien[slidericon]" size="80" />
</p>
<p>
        <label>Is slider</label><br />
        <select name="sukien[isslider]">
            <option value="0" <?php if($isslider==0) echo 'selected="selected"'; else echo '' ?>>No</option>
            <option value="1" <?php if($isslider==1) echo 'selected="selected"'; else echo '' ?>>Yes</option>
        </select>
</p>
<p>
        <label>Article Icon</label><br />
        <input type="text" value="<?php echo $articleicon; ?>" name="sukien[articleicon]" size="80" />
</p>
<p>
		<label>Giá tiền (optional)</label><br />
		<input type="text" value="<?php echo $giatien; ?>" name="sukien[giatien]" size="40" />
</p>
<p>
		<label>Thời gian (optional)</label><br />
		<input type="text" value="<?php echo $thoigian; ?>" name="sukien[thoigian]" size="40" />
</p>
<p>
		<label>Địa điểm (optional)</label><br />
		<input type="text" value="<?php echo $diadiem; ?>" name="sukien[diadiem]" size="40" />
</p>
<?php
}
add_action('save_post', 'hcfaq_save_post');

function hcfaq_save_post($post_id)
{

    if (!empty($_POST['hcfaq'])) {

        $hcfaq_data['hcfaq'] = (empty($_POST['hcfaq']['pageid'])) ? '' :
            sanitize_text_field($_POST['hcfaq']['pageid']);
        
    } else {
        delete_post_meta($post_id, '_hcfaq');
    }
}

add_action('save_post', 'sukien_save_post');

function sukien_save_post($post_id)
{

    if (!empty($_POST['sukien'])) {
        $sukien_data['giatien'] = (empty($_POST['sukien']['giatien'])) ? '' :
            sanitize_text_field($_POST['sukien']['giatien']);
        $sukien_data['video'] = (empty($_POST['sukien']['video'])) ? '' :
            $_POST['sukien']['video'];
        $sukien_data['articleicon'] = (empty($_POST['sukien']['articleicon'])) ? '' :
            $_POST['sukien']['articleicon'];
        $sukien_data['slidericon'] = (empty($_POST['sukien']['slidericon'])) ? '' :
         $_POST['sukien']['slidericon'];
         $sukien_data['isslider'] = (empty($_POST['sukien']['isslider'])) ? '' :
         $_POST['sukien']['isslider'];
        $sukien_data['thoigian'] = (empty($_POST['sukien']['thoigian'])) ? '' :
            sanitize_text_field($_POST['sukien']['thoigian']);
        $sukien_data['diadiem'] = (empty($_POST['sukien']['diadiem'])) ? '' :
            sanitize_text_field($_POST['sukien']['diadiem']);
        update_post_meta($post_id, '_sukien', $sukien_data);
        
    } else {
        delete_post_meta($post_id, '_sukien');
    }
}

add_filter('manage_edit-sukien_columns', 'sukien_edit_columns');
function sukien_edit_columns($columns)
{
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'sukien-chude' => 'Chủ đề',
        'sukien-diengia' => 'Diễn giả',
        'sukien-giatien' => 'Giá tiền',
        'sukien-thoigian' => 'Thời gian',
        'sukien-diadiem' => 'Địa điểm',
        'sukien-articleicon'=>'Article Icon',
        'sukien-slidericon'=>'Slide Icon',
        'author' => 'Posted by',
        'date' => 'Date');

    return $columns;
}
add_filter('manage_edit-hcfaq_columns', 'hcfaq_edit_columns');
function hcfaq_edit_columns($columns)
{
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'hcfaq-pageid' => 'Bài viết',
        
        'date' => 'Date');

    return $columns;
}
add_action('manage_posts_custom_column', 'hcfaq_columns', 10, 2);

function hcfaq_columns($column, $post_id)
{
    $hcfaq_data = get_post_meta($post_id, '_hcfaq', true);

    switch ($column) {
        case 'hcfaq-pageid':
            if (!empty($hcfaq_data['pageid']))
                echo $hcfaq_data['pageid'];
            break;
    }
}
add_action('manage_posts_custom_column', 'sukien_columns', 10, 2);

function sukien_columns($column, $post_id)
{
    $sukien_data = get_post_meta($post_id, '_sukien', true);

    switch ($column) {
        case 'sukien-diengia':

            $_tax = 'diengia';
            $terms = get_the_terms($post_id, $_tax);
            if (!empty($terms)) {
                $out = array();
                foreach ($terms as $c)
                    $out[] = "<a href='edit-tags.php?action=edit&taxonomy=$_tax&post_type=sukien&tag_ID={$c->term_id}'> " .
                        esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category',
                        'display')) . "</a>";
                echo join(', ', $out);
            }

            break;
        case 'sukien-chude':

            $_tax = 'chude';
            $terms = get_the_terms($post_id, $_tax);
            if (!empty($terms)) {
                $out = array();
                foreach ($terms as $c)
                    $out[] = "<a href='edit-tags.php?action=edit&taxonomy=$_tax&post_type=sukien&tag_ID={$c->term_id}'> " .
                        esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category',
                        'display')) . "</a>";
                echo join(', ', $out);
            }

            break;
        case 'sukien-thoigian':
            if (!empty($sukien_data['thoigian']))
                echo $sukien_data['thoigian'];
            break;
        case 'sukien-giatien':
            if (!empty($sukien_data['giatien']))
                echo $sukien_data['giatien'];
            break;
        case 'sukien-diadiem':
            if (!empty($sukien_data['diadiem']))
                echo $sukien_data['diadiem'];
            break;
        case 'sukien-slidericon':
            if (!empty($sukien_data['slidericon']))
                echo '<img src="'.$sukien_data['slidericon'].'" width=50 height=50 />';
            break;
        case 'sukien-articleicon':
            if (!empty($sukien_data['articleicon']))
                echo '<img src="'.$sukien_data['articleicon'].'" width=50 height=50 />';
            break;
    }
}
function get_feautre_cat($cat_id){
    $db = $GLOBALS['wpdb'];
    $sql ="select field_value,field_name from ".$db->prefix."ccf_Value where term_id = '".$cat_id."'";
   
    $result =$db->get_row($sql);
    return $result;
}
function get_chude($post_type = 'sukien', $posts_per_page = -1, $orderby =
    'none', $subject_id = null)
{
    $count =4;
    echo '<div class="items items-col-'.$count.' grid-block">';
    //$taxonomies = get_terms('chude');
    $taxonomies = get_categories('taxonomy=chude');
    
    $i=0;
    if (!empty($taxonomies)) {
        foreach ($taxonomies as $taxonomy) {
            $margin = 0;
            $feature = get_feautre_cat($taxonomy->term_id);
            if($feature->field_name=='Feature' && $feature->field_value==1){

                if($taxonomy->slug=='hoi-thao')
                    $margin=26;
                echo '<div class="clearfix '.$taxonomy->slug.'"><h3 class="module-title" style="padding:0px;margin:0px;margin-bottom:'.$margin.'px;border-bottom:1px solid #ccc"><a href="/chude/' . $taxonomy->slug . '">' . $taxonomy->
                name . '</a></h3>';
            $args = array(
                'posts_per_page' => 4,
                'post_type' => 'sukien',
                'no_found_rows' => true,
                'tax_query' => array(
    array(
      'taxonomy' => 'chude',
      'field' => 'slug',
      'terms' => $taxonomy->slug
    )
  ),
               
                'order' => 'DESC');
            $query = new WP_Query($args);
            if($query->have_posts()){
                while ( $query->have_posts() ) : $query->the_post();
                if($i%2==0){
            $class='old';
            if($i>1)
                $hr= '<hr class="hr" />';
        }
        else{
            $class= 'even';
            $hr='';
        }
            
       
                $post_id = get_the_ID();
			$data = get_post_meta( $post_id, '_'.$post_type, true );
            
            $terms = get_the_terms( $post_id, 'diengia');
            $diengia='';
            if(!empty($terms)){
                 $out = array();
            foreach ( $terms as $c )
                $out[] = esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display'));
            $diengia = join( ', ', $out );

            }
            $thumbnail = get_the_post_thumbnail($post_id);
            if(empty($thumbnail))
                $thumbnail = '<img src="/wp-content/uploads/no-image.jpg" alt='.get_the_title().' />';
            $giatien = ( empty( $data['giatien'] ) ) ? 'Vui lòng liên hệ' : number_format($data['giatien'] , 0, '.', '.').' đ';
            $giatienthanhvien = ( empty( $data['giatien'] ) ) ? 'Vui lòng liên hệ' : number_format($data['giatien'] - $data['giatien']*(get_option('hpbasicmembership')/100),0,'.','.').' đ';
            $thoigian =( empty( $data['thoigian'] ) ) ? '' : $data['thoigian'];
            $diadiem = ( empty( $data['diadiem'] ) ) ? '' : $data['diadiem'];
            if($taxonomy->slug=='hoi-thao')
                $count = 2;
            elseif($taxonomy->slug=='khoa-hoc')
                $count =1;
            
?>
<div style="margin-bottom:10px;" class="item2 grid-box width<?php echo intval(100 / $count);?>">                
<?php if($taxonomy->slug=='hoi-thao'): 

?>
<article style="margin-top:7px;margin-bottom:7px"  id="item-<?php the_ID(); ?>" class="chude_item item item<?php echo $class; ?>" data-permalink="<?php the_permalink(); ?>">

	<div class="content clearfix">
   <?php 
                echo $thumbnail;
            ?>
    <!--<p>
        
	   <span class="title" ><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></span>
    
    </p>-->
    <table width="100%">
        <!--<tr>
            <td class="image" width="120">
            <?php 
                echo $thumbnail;
            ?>
    </td>
            <td>
                <h3>
                    <?php echo $thoigian; ?>
                </h3>
                <?php echo 'Diễn giả: '.$diengia; ?><br/>
                Phí tham dự:<br/>
                <table width=100%>
                    <tr><td>Khách:</td><td><?php echo $giatien; ?></td></tr>
                    <tr><td>Thành viên:</td><td><?php echo $giatienthanhvien; ?></td></tr>
                </table>
            </td>

        </tr>-->
        <tr> <?php
              global $current_user;
              
                    $url = get_permalink();
              
              ?>
        <td width="120"><p class="cat-post-title2"><a href="<?php echo $url; ?>"><span style="display:none">Xem chi tiết</span></a></p>
        </td>
        <td>
              <p class="cat-post-title1">

              <a href="/category/thanh-vien/quyen-loi-thanh-vien/"><span  style="display:none">Trở thành thành viên</span></a></p>
            </td>
        </tr>
    </table>
    
    </div>

  
    

	<?php //edit_post_link(__('Edit this post.', 'warp'), '<p class="edit">','</p>'); ?>

</article>
<?php elseif($taxonomy->slug=='khoa-hoc'): ?>
<article style="padding-bottom:18px;padding-top:18px" id="item-<?php the_ID(); ?>" class="chude_item item" data-permalink="<?php the_permalink(); ?>">

    <table width="100%">
        <tr>
            <td style="height:143px;"><?php 
        echo $thumbnail;
    ?></td>
          <!--   <td>
           <p>
        
       <span class="title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></span>
    
    </p>
                <h3>
                    <?php echo $thoigian; ?>
                </h3>
                <?php echo 'Giảng viên: '.$diengia; ?><br/>
                
            </td>-->
            <td style="border-left:1px solid #ccc;padding:0 30px;padding-left:50px;margin-top:10px">
                <b>Phí tham dự:</b><br/>
                <table width=100%>
        <tr><td><b>Khách:</b></td><td><b><?php echo $giatien; ?></b></td></tr>
        <tr><td width="95"><b>Thành viên:</b></td><td><b><?php echo $giatienthanhvien; ?></b></td></tr>
    </table>
               <p class="cat-post-title2"><a href="<?php echo get_permalink(); ?>"><span style="display:none">Xem chi tiết</span></a></p> 
                <p class="cat-post-title1"><a href="/category/thanh-vien/quyen-loi-thanh-vien/"><span  style="display:none">Trở thành thành viên</span></a></p>
            </td>
        </tr>
          
    
        
    </table>
    
    
  
    

    <?php //edit_post_link(__('Edit this post.', 'warp'), '<p class="edit">','</p>'); ?>

</article>
<?php endif; ?>

</div>
<?php
$i++;
endwhile;
            }
            echo '</div><br/>';
        }
        }
    }
   echo '</div>';
}

function form_faq($atts){
       extract(shortcode_atts(array(
      'pageid' => get_the_ID()
      ,'disable'=>'0'
      ,'msg'=>''), $atts));
       if($disable<1)
            return '<h3 class="error">'.$msg.'</h3>';
       return '<form method="post" id="form" class="form_profile"><textarea name="question" id="question" requited></textarea><br/><input type="hidden" name="'.$pageid.'"/><input type="submit" class="wpcf7-form-control wpcf7-submit btn_send" value="" id="sendfaq"/></form>';
}
add_shortcode('Form_FAQ', 'form_faq');
function giangvien_banner($atts) {
   extract(shortcode_atts(array(
      'image' => ''
      ,'giangvienid'=>0
   ), $atts));
   $gv = get_post($giangvienid);
   
return '<div class="banner"><a title="'.$gv->post_title.'" href="'.$gv->guid.'"><img alt="'.$gv->post_title.'" src="'.$image.'" /></a></div>';
}
add_shortcode('bannergiangvien', 'giangvien_banner');
function loadModule($atts) {

   extract(shortcode_atts(array(
      'name' => ''
   ), $atts));

return '<div class="box" style="width:730px">'.$this['modules']->render($name).'</div>';
}
add_shortcode('loadModule','loadModule');
?>