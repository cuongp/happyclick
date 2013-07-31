<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>">

<head>

<?php echo $this['template']->render('head'); ?>
</head>

<body id="page" class="page <?php echo $this['config']->get('body_classes'); ?>" data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>
<div style="position:fixed;top:0px;border:1px solid red;padding:10px;z-index:9999">
Bạn đang là thành viên dùng thử
</div>
	<?php if ($this['modules']->count('absolute')) : ?>
	<div id="absolute">
		<?php echo $this['modules']->render('absolute'); ?>
	</div>
	<?php endif; ?>
	
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
			<?php 
           
            if ($this['modules']->count('logo + headerbar-trial')) : ?>	
			<div id="headerbar" class="clearfix">
			
				<?php if ($this['modules']->count('logo')) : ?>	
				<a id="logo" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['modules']->render('logo'); ?></a>
				<?php endif; ?>
				
				<?php echo $this['modules']->render('headerbar-trial'); ?>
				<div class='user_info'>
				<h3 class="username">Chào <?php echo $current_user->last_name; ?> !</h3>
				<p>Mời bạn xem thử một số tiện ích<br/>
dành cho thành viên Happy Click</p>
				</div>

			</div>
			<?php 
				if ($this['modules']->count('top-a2')) : ?>
			<section id="top-a2" class="grid-block"><?php echo $this['modules']->render('top-a2', array('layout'=>$this['config']->get('top-a2'))); ?></section>
           <br/>
            <?php
            endif;
				?>
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

		
			<?php 
			
			if ($this['modules']->count('sidebar-trial')) : ?>
			<aside id="sidebar-trial" class="grid-box"><?php echo $this['modules']->render('sidebar-trial', array('layout'=>'stack')); ?></aside>
			<?php endif; ?>
