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
		
		<?php if ($this['modules']->count('innertop + innerbottom') || $this['config']->get('system_output')) : ?>
		<div id="main" class="grid-block">

			<div id="maininner" class="grid-box">

				<?php if ($this['modules']->count('innertop')) : ?>
				<section id="innertop" class="grid-block"><?php echo $this['modules']->render('innertop', array('layout'=>$this['config']->get('innertop'))); ?></section>
				<?php endif; ?>

				<?php /* if ($this['modules']->count('breadcrumbs')) : ?>
				<section id="breadcrumbs"><?php echo $this['modules']->render('breadcrumbs'); ?></section>
				<?php endif; */ ?>

				<?php if ($this['config']->get('system_output')) : ?>
                    <?php echo $this['template']->render('content-hoc-qua-video'); ?>
				<?php endif; ?>

				<?php if ($this['modules']->count('innerbottom')) : ?>
				<section id="innerbottom" class="grid-block"><?php echo $this['modules']->render('innerbottom', array('layout'=>$this['config']->get('innerbottom'))); ?></section>
				<?php endif; ?>

			</div>
			<!-- maininner end -->
			
			<?php
            // CHECK USER TO GET SIDEBAR
            $is_member = current_user_is_member();
            $is_subs = current_user_has_subscription();
            if($is_member && !$is_subs):
            ?>
                <?php if ($this['modules']->count('sidebar-trial')) : ?>
                <aside id="sidebar-trial" class="grid-box"><?php echo $this['modules']->render('sidebar-trial', array('layout'=>'stack')); ?></aside>
                <?php endif; ?>
			<?php elseif($is_member && $is_subs): ?>
                <?php if ($this['modules']->count('sidebar-membership')) : ?>
                <aside id="sidebar-membership" class="grid-box"><?php echo $this['modules']->render('sidebar-membership', array('layout'=>'stack')); ?></aside>
                <?php endif; ?>
            <?php else: ?>
                <?php if ($this['modules']->count('sidebar-b')) : ?>
                <aside id="sidebar-b" class="grid-box"><?php echo $this['modules']->render('sidebar-b', array('layout'=>'stack')); ?></aside>
                <?php endif; ?>
			<?php endif; 
            // END SIDEBAR
            ?>         

		</div>
		<?php endif; ?>
		<!-- main end -->

		<?php if ($this['modules']->count('bottom-a')) : ?>
		<section id="bottom-a" class="grid-block"><?php echo $this['modules']->render('bottom-a', array('layout'=>$this['config']->get('bottom-a'))); ?></section>
		<?php endif; ?>
		
		<?php if ($this['modules']->count('bottom-b')) : ?>
		<section id="bottom-b" class="grid-block"><?php echo $this['modules']->render('bottom-b', array('layout'=>$this['config']->get('bottom-b'))); ?></section>
		<?php endif; ?>
		
		<?php if ($this['modules']->count('footer + debug') || $this['config']->get('warp_branding') || $this['config']->get('totop_scroller')) : ?>
		<footer id="footer">

			<?php if ($this['config']->get('totop_scroller')) : ?>
			<a id="totop-scroller" href="#page"></a>
			<?php endif; ?>

			<?php
				echo $this['modules']->render('footer');
				$this->output('warp_branding');
				echo $this['modules']->render('debug');
			?>

		</footer>
		<?php endif; ?>

	</div>
	
	<?php echo $this->render('footer'); ?>
</body>
</html>