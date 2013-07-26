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
	$content = 'page-thong-bao-dang-nhap';
	
} elseif (is_attachment()) {
	$content = 'attachment';
}
elseif (is_search()) {
	$content = 'search';
} elseif (is_archive() && is_author()) {
	$content = 'author';
} elseif (is_archive()) {
    $content = 'archive-new-week';
} elseif (is_404()) {
	$content = '404';
}


echo $this->render(apply_filters('warp_content', $content));