<?php 
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// init vars
$colcount = is_front_page() ? $this['config']->get('multicolumns', 1) : 1;
$count    = $this['system']->getPostCount();
$rows     = ceil($count / $colcount);
$columns  = array();
$row      = 0;
$column   = 0;
$i        = 0;

// create columns
while (have_posts()) {
	the_post();

	if ($this['config']->get('multicolumns_order', 1) == 0) {
		// order down
		if ($row >= $rows) {
			$column++;
			$row  = 0;
			$rows = ceil(($count - $i) / ($colcount - $column));
		}
		$row++;
	} else {
		// order across
		$column = $i % $colcount;
	}

	if (!isset($columns[$column])) {
		$columns[$column] = '';
	}

	$columns[$column] .= $this->render('_post_thanh_vien');
	$i++;
}

// render columns
if ($count = count($columns)) {
	echo '<div class="items items-col-'.$count.' grid-block">';
	for ($i = 0; $i < $count; $i++) {
		echo '<div class="grid-box width'.intval(100 / $count).'">'.$columns[$i].'</div>';
	}
	echo '<div style="clear:both"></div></div>';
}