<?php
/**

@package Master
@author YOOtheme http://www.yootheme.com
@copyright Copyright (C) YOOtheme GmbH
@license http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
// get warp


$warp = Warp::getInstance();

echo $warp['template']->render('template');