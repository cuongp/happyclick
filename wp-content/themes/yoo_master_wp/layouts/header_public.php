<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>">

<head>

<?php echo $this['template']->render('head'); ?>
<script type="text/javascript">
	var hcaccount = "<?php echo get_query_var('hcaccount'); ?>";
	var site_url = "<?php echo get_site_url() ?>";
</script>
</head>

<body id="page" class="page <?php echo $this['config']->get('body_classes'); ?>" data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>
	<?php if ($this['modules']->count('absolute')) : ?>
	<div id="absolute">
		<?php echo $this['modules']->render('absolute'); ?>
		
	</div>
	<?php endif; ?>
	<?php
		if(isset($_GET) && $_GET['mod'] =='kich-hoat'){
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

			<?php 
            if(is_front_page() || $current_user->ID<1):
            if ($this['modules']->count('top-a')) : ?>
		<section id="top-a" class="grid-block"><?php echo $this['modules']->render('top-a', array('layout'=>$this['config']->get('top-a'))); ?></section>
		 <?php endif;
            if ($this['modules']->count('logo + headerbar')) : ?>	
			<div id="headerbar" class="clearfix">
			
				<?php if ($this['modules']->count('logo')) : ?>	
				<a id="logo" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['modules']->render('logo'); ?></a>
				<?php endif; ?>
				
				<?php 
					$is_member = current_user_is_member();
					$is_subs = current_user_has_subscription();
					if($is_subs && $is_member){
						echo $this['modules']->render('headerbar-trial'); 
					?>
						<div class='user_info'>
				<h3 class="username">Chào <?php echo $current_user->last_name; ?> !</h3>
				<p>Mời bạn bắt đầu hành trình<br/>
"thăng tiến mỗi ngày" với Happy Click</p>
				</div>
					<?php
					}elseif($is_member && !$is_subs){
						echo $this['modules']->render('headerbar-trial');
					?>
					<div class='user_info'>
				<h3 class="username">Chào <?php echo $current_user->last_name; ?> !</h3>
				<p>Mời bạn xem thử một số tiện ích<br/>
dành cho thành viên Happy Click</p>
				</div>
					<?php
					}else{
						 echo $this['modules']->render('headerbar');
					}
				?>
				
			</div>
			<?php 
            endif;
            endif; ?>

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
            if(!is_front_page() && $current_user->ID>0):
            if ($this['modules']->count('logo + headerbar')) : ?>	
			<div id="headerbar" class="clearfix">
			
				<?php if ($this['modules']->count('logo')) : ?>	
				<a id="logo" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['modules']->render('logo'); ?></a>
				<?php endif; ?>
				
				<?php 
					$is_member = current_user_is_member();
					$is_subs = current_user_has_subscription();
					if($is_subs && $is_member){
						echo $this['modules']->render('headerbar-trial'); 
					?>
						<div class='user_info'>
				<h3 class="username">Chào <?php echo $current_user->last_name; ?> !</h3>
				<p>Mời bạn bắt đầu hành trình<br/>
"thăng tiến mỗi ngày" với Happy Click</p>
				</div>
					<?php
					}elseif($is_member && !$is_subs){
						echo $this['modules']->render('headerbar-trial');
					?>
					<div class='user_info'>
				<h3 class="username">Chào <?php echo $current_user->last_name; ?> !</h3>
				<p>Mời bạn xem thử một số tiện ích<br/>
dành cho thành viên Happy Click</p>
				</div>
					<?php
					}else{
						 echo $this['modules']->render('headerbar');
					}
				?>
				
			</div>
			<?php 
            endif;

            if ($this['modules']->count('top-a2')) : ?>
			<section id="top-a2" class="grid-block"><?php echo $this['modules']->render('top-a2', array('layout'=>$this['config']->get('top-a2'))); ?></section>
            <?php
            endif;
            endif; ?>
			<?php if ($this['modules']->count('banner')) : ?>
			<div id="banner"><?php echo $this['modules']->render('banner'); ?></div>
			<?php endif; ?>
		
		</header>

		
		<?php if ($this['modules']->count('top-b')) : ?>
		<section id="top-b" class="grid-block"><?php echo $this['modules']->render('top-b', array('layout'=>$this['config']->get('top-b'))); ?></section>
		<?php endif; ?>
        <?php if ($this['modules']->count('breadcrumbs')) : ?>
				<section id="breadcrumbs"><?php echo $this['modules']->render('breadcrumbs'); ?></section>
				<?php endif; ?>