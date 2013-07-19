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
	
} elseif (is_attachment()) {
	$content = 'attachment';
}
elseif (is_single()) {
    $id = get_the_ID();
    var_dump(get_the_category());
   
    
   	$content = 'single';
	if(get_post_type()=='sukien'){
        $content = 'single-sukien';   
    }/*
    if ($this["path"]->path("layouts:{$queried_object->post_type}.php")) {
		$content = $queried_object->post_type;
	}*/
    if(in_array('temp_layout', get_post_custom_keys())){
        $content = 'single-onecolumn';
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
    //var_dump(get_taxonomy('chude'));
    $content = '';
    if(get_query_var('chude'))
        $content = '_chude';
    elseif(get_query_var('hcaccount')){
    	$content = '_hcaccount';
    }else
    	$content = 'archive';
	if ($this["path"]->path("layouts:{$queried_object->taxonomy}.php")) {
		$content = $queried_object->taxonomy;
	}

} elseif (is_404()) {
	$content = '404';
}


echo $this->render(apply_filters('warp_content', $content));