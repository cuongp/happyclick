<?php
/**
* /**
 * Template Name: Front Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
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

		<!-- begin main -->
		<?php if ($this['modules']->count('innertop + innerbottom + sidebar-a + sidebar-b') || $this['config']->get('system_output')) : ?>
		<div id="main" class="grib-box">
			<?php if ($this['modules']->count('sidebar-a')) : ?>
				<aside id="sidebar-a" class="grid-box"><?php echo $this['modules']->render('sidebar-a', array('layout'=>'stack')); ?></aside>
			<?php endif; ?>
				<?php if ($this['config']->get('system_output')) : ?>
					<div id="maininner" class="grid-box">
						<?php /* if ($this['modules']->count('breadcrumbs')) : ?>
							<section id="breadcrumbs"><?php echo $this['modules']->render('breadcrumbs'); ?></section>
						<?php endif;*/ ?>
						<?php echo $this['template']->render('content-thong-bao-dang-nhap'); ?>
					</div>
				<?php endif; ?>
		</div>
		<?php endif; ?>
		<!-- end main -->
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