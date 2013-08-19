<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

global $wp_query;

$queried_object = $wp_query->get_queried_object();

// output content from header/footer mode
if ($this->has('content')) {
	return $this->output('content');
}

$content = '';



if (is_home()) {
	$content = 'index';
	
} elseif (is_page()) {
	$content = 'page';
	
    echo '<!-- begin mark-post '; 
    $post_obj   = get_post();
    $post_name  = $post_obj->post_name;
    echo $post_name;
    echo ' end mark -->';
    
    if($post_name == 've-happy-click' || $post_name == 'ban-lanh-dao'){
		$content = 'page-ve-happy-click';
    }
    if($post_name == 'thong-bao-dang-nhap'){
        $content = 'page-thong-bao-dang-nhap';
    }
   
	
} elseif (is_attachment()) {
	$content = 'attachment';
}
elseif (is_single()) { 
    
   	$content = 'single';
	if(get_post_type()=='sukien'){
        $content = 'single-sukien';   
    }
	if(get_post_type()=='giangvien'){
        $content = 'single-giangvien';   
    }
	
	$kats   = get_the_category();
    $kat    = $kats[0]->category_nicename;
	if($kat == 'happy-click-radio' || $kat == 'goc-chia-se' || $kat == 'goc-kien-thuc' || $kat == 'download-tai-lieu') {
		$content = 'single-lam-giau-cuoc-song';
	}
    if($kat == 'khoi-dong-tuan-moi'){
        $content = 'single-khoi-dong-tuan-moi';
    }
	/*
    if ($this["path"]->path("layouts:{$queried_object->post_type}.php")) {
		$content = $queried_object->post_type;
	}*/
    if(in_array('temp_layout', get_post_custom_keys())){
        $content = 'single-onecolumn';
    }
	
	if(in_array('temp_layout_old', get_post_custom_keys())) {
		$content = 'single-hoc-truc-tuyen-old';
	}
	
	
    // Content view cho hoc qua video
    if(in_array('youtube-video', get_post_custom_keys())){
        $content = 'single-video';
    }

} elseif (is_search()) {
	$content = 'search';
} elseif (is_archive() && is_author()) {
	$content = 'author';
} 
elseif(is_archive() && is_post_type_archive('sukien')){
    $content = 'archive-sukien';
}

elseif (is_archive()) {
	//$content = 'archive';
    
    $cat_id = get_query_var('cat');

    $content = '';
    if($cat_id == 80){
    	$content = 'archive-thanh-vien';	
    }
   // elseif(get_post_type() == 'giangvien'){
   // 	$content = 'archive-giangvien';
   // }
    elseif(get_query_var('chude'))
        $content = '_chude';
    elseif(get_query_var('hcaccount')){
    	$content = '_hcaccount';
    }else
    	$content = 'archive';
	if ($this["path"]->path("layouts:{$queried_object->taxonomy}.php")) {
		$content = $queried_object->taxonomy;
	}
    
    $cat_obj    = get_category ($cat_id);
    switch($cat_obj->slug){
        case 'hinh-anh':
        case 'happy-click':
        case 'hinh-anh-khoa-hoc':
        case 'hinh-anh-hoi-thao':
            $content = 'archive-hinh-anh';
            break;
        case 'hoc-qua-video':
        case 'nghe-thuat-trinh-bay-hieu-qua':
        case 'chinh-phuc-dong-nghiep-bang-quan-ly-theo-tinh-huong':
        case 'gia-tri-ca-nhan':
        case 'mbti':
        case 'nghe-thuat-xay-dung-quan-he-ben-vung':
        case 'quan-ly-theo-muc-tieu-mbo':
        case 'vu-khi-cho-nha-quan-ly':
        case 'yeu-thuong-trong-ban-tay':
            $content = 'archive-hoc-qua-video';
            break;
        case 'hoc-truc-tuyen':
            $content = 'archive-hoc-truc-tuyen';
            break;
        case 'khoa-hoc-truc-tuyen-sap-dien-ra':
        case 'khoa-hoc-truc-tuyen-da-to-chuc':
            wp_redirect(get_site_url().'/hoc-truc-tuyen');
            break;
        case 'khoi-dong-tuan-moi':
            $content = 'archive-new-week';
            break;
        case 'hanh-trang-nghe-nghiep':
            $content = 'archive-hanh-trang-nghe-nghiep';
            break;
        case 'lam-giau-cuoc-song':
        case 've-happy-click':
        case 'happy-click-radio':
        case 'goc-chia-se':
        case 'goc-kien-thuc':
        case 'download-tai-lieu':
            $content = 'archive-lam-giau-cuoc-song';
            break;
        default:
            break;
    }

} elseif (is_404()) {
	$content = '404';
}


echo $this->render(apply_filters('warp_content', $content));