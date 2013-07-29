<?php
/**
* @package   Master
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// get template configuration
include($this['path']->path('layouts:template.config.php'));
global $current_user;

?>
 

		<?php //LOAD HEADER
        
        $warp = Warp::getInstance();
        
        $is_member = current_user_is_member();
        $is_subs = current_user_has_subscription();
        
        if($is_member && $is_subs){
            echo $warp['template']->render('header_member');
        }else if($is_member && !$is_subs){
            echo $warp['template']->render('header_trial');
        }else
            echo $warp['template']->render('header_public');
        
        ?>		
        <?php
		if($is_member && $is_subs){
            echo $warp['template']->render('content_before_member');
        }else if($is_member && !$is_subs){
            echo $warp['template']->render('content_before_member');
        }else
            echo $warp['template']->render('content_before_public');
        
        ?>	



				<?php if ($this['config']->get('system_output')) : ?>
                    <?php echo $this['template']->render('content-hinh-anh'); ?>
				<?php endif; ?>




        <?php
		if($is_member && $is_subs){
            echo $warp['template']->render('content_after_member');
        }else if($is_member && !$is_subs){
            echo $warp['template']->render('content_after_member');
        }else
            echo $warp['template']->render('content_after_public');
        
        ?>	