<?php
<<<<<<< HEAD
$warp = Warp::getInstance();

=======
/**

@package Master
@author YOOtheme http://www.yootheme.com
@copyright Copyright (C) YOOtheme GmbH
@license http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
// get warp
$warp = Warp::getInstance();
>>>>>>> 1eaaac5f442c9a62a6e3c67d240d9286abad0e38
$is_member = current_user_is_member();
	$is_subs = current_user_has_subscription();
	if($is_member && $is_subs){
		
		echo $warp['template']->render('_member');
	}else if($is_member && !$is_subs){
		echo $warp['template']->render('_trial');
	}else
<<<<<<< HEAD
		echo $warp['template']->render('template');

?>
=======
		echo $warp['template']->render('template');
>>>>>>> 1eaaac5f442c9a62a6e3c67d240d9286abad0e38
