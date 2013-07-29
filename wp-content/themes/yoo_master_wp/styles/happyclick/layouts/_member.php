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
<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>">

<head>

<?php echo $this['template']->render('head'); ?>
</head>

<body id="page" class="page <?php echo $this['config']->get('body_classes'); ?>" data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>
<div style="position:fixed;top:50px;border:1px solid red;padding:10px;z-index:9999">
Bạn đang là thành viên chính thức
</div>
	<?php if ($this['modules']->count('absolute')) : ?>
	<div id="absolute">
		<?php echo $this['modules']->render('absolute'); ?>
	</div>
	<?php endif; ?>
	<?php
		if(isset($_GET) && $_GET['mod'] =='kich-hoat' || $_COOKIE['hc_welcome']=='1'){
			echo '<div style="background:rgba(0, 0, 0, 0.75);position:absolute;left:0;z-index:99999;display:block;width:100%;min-height:100%;height:100%;">
				<p class="popup_kichhoat">
				<span class="close"></span>
				</p>
			</div>';
			
		}

		?>
	<div class="wrapper clearfix">

		<header id="header">
            
		
			<?php if ($this['modules']->count('toolbar-l + toolbar-r') || $this['config']->get('date')) : ?>
			<div id="toolbar" class="clearfix">

				<?php if ($this['modules']->count('toolbar-l') || $this['config']->get('date')) : ?>
				<div class="float-left">
				
					<?php if ($this['config']->get('date')) : ?>
					<time datetime="<?php echo $this['config']->get('datetime'); ?>"><?php echo $this['config']->get('actual_date'); ?></time>
					<?php endif; ?>
				
					<?php echo $this['modules']->render('toolbar-l'); ?>
					
				</div>
				<?php endif; ?>
					
				<?php if ($this['modules']->count('toolbar-r')) : ?>
				<div class="float-right"><?php echo $this['modules']->render('toolbar-r'); ?></div>
				<?php endif; ?>
				
			</div>
			
			<?php endif; ?>
					

			
			<?php if ($this['modules']->count('menu + search')) : ?>
			<div id="menubar" class="clearfix">
				<div class="left_topnav"></div>
                <div class="right_topnav"></div>
				<?php if ($this['modules']->count('menu')) : ?>
				<nav id="menu"><?php echo $this['modules']->render('menu'); ?></nav>
				<?php endif; ?>

				<?php if ($this['modules']->count('search')) : ?>
				<div id="search"><?php echo $this['modules']->render('search'); ?></div>
				<?php endif; ?>
				
			</div>
			<?php endif; ?>
					<?php if ($this['modules']->count('banner')) : ?>
			<div id="banner"><?php echo $this['modules']->render('banner'); ?></div>
			<?php endif; ?>
			<?php 
          
            if ($this['modules']->count('logo + headerbar-trial')) : ?>	
			<div id="headerbar" class="clearfix">
			
				<?php if ($this['modules']->count('logo')) : ?>	
				<a id="logo" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['modules']->render('logo'); ?></a>
				<?php endif; ?>
				
				<?php echo $this['modules']->render('headerbar-trial'); ?>
				<div class='user_info'>
				<h3 class="username">Chào <?php echo $current_user->last_name; ?> !</h3>
				<p>Mời bạn bắt đầu hành trình<br/>
"thăng tiến mỗi ngày" với Happy Click</p>
				</div>
				
			</div>
			<?php 
        
            endif; ?>


 			<?php 
				if ($this['modules']->count('top-a2')) : ?>
			<section id="top-a2" class="grid-block"><?php echo $this['modules']->render('top-a2', array('layout'=>$this['config']->get('top-a2'))); ?></section>
           <br/>
            <?php
            endif;
				?>
			<?php if ($this['modules']->count('slider')) : ?>
		
			<section id="homeslider">
				<?php echo $this['modules']->render('slider', array('layout'=>'stack')); ?>
			</section>
			<div style="clear:both"></div><br/>
			<?php endif;?>
		
		</header>

		
	<section id="membership">
	<div class="grid-block">
		<div class="grid-box width33 grid-h">
			<?php echo $this['modules']->render('membership-1', array('layout'=>$this['config']->get('membership-1'))); ?>	
		</div>
		<div class="grid-box width33 grid-h">
			<?php echo $this['modules']->render('membership-2', array('layout'=>$this['config']->get('membership-2'))); ?>	
		</div>
		<div class="grid-box width33 grid-h">
			<?php echo $this['modules']->render('membership-3', array('layout'=>$this['config']->get('membership-3'))); ?>	
		</div>
	</div>
	</section>
				
		<?php if ($this['modules']->count('sidebar-membership')) : ?>
			<aside id="sidebar-trial" class="grid-box"><?php echo $this['modules']->render('sidebar-membership', array('layout'=>'stack')); ?></aside>
			<?php endif; ?>
			<?php if ($this['modules']->count('sidebar-membership-b')) : ?>
			<aside id="sidebar-b" class="grid-box"><?php echo $this['modules']->render('sidebar-membership-b', array('layout'=>'stack')); ?></aside>
			<?php endif; ?>

		<div id="main" class="grid-block">
		
			<div id="maininner" class="grid-box">
			<?php if ($this['modules']->count('innertop-membership')) : ?>
				<section id="innertop" class="grid-block"><?php echo $this['modules']->render('innertop', array('layout'=>$this['config']->get('innertop'))); ?></section>
				<?php endif; ?>
		<?php if ($this['config']->get('system_output')) : ?>
				<section id="content" class="grid-block"><?php echo $this['template']->render('content'); ?></section>
				<?php endif; ?>
				<?php if ($this['modules']->count('innerbottom-membership')) : ?>
				<section id="innerbottom" class="grid-block"><?php echo $this['modules']->render('innerbottom-membership', array('layout'=>$this['config']->get('innerbottom-membership'))); ?></section>
				<?php endif; ?>
			</div>


		</div>
		<?php if ($this['modules']->count('footer + debug') || $this['config']->get('warp_branding') || $this['config']->get('totop_scroller')) : ?>
		<?php if ($this['modules']->count('bottom-b')) : ?>
		
        <section id="bottom-b" class="grid-block"><?php echo $this['modules']->render('bottom-b', array('layout'=>$this['config']->get('bottom-b'))); ?></section>
		<?php endif; ?>
		<footer id="footer">

			
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