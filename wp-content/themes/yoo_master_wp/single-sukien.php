<?php
$warp = Warp::getInstance();

$is_member = current_user_is_member();
	$is_subs = current_user_has_subscription();
	if($is_member && $is_subs){
		
		echo $warp['template']->render('_member');
	}else if($is_member && !$is_subs){
		echo $warp['template']->render('_trial');
	}else
		echo $warp['template']->render('template');

?>
