<div id="system">
	<?php 
		$cat = get_the_category()[0]->category_nicename;
	?>
	<div id="tabs">
			<ul>
			<?php if ($cat == "happy-click-radio"): ?>
				<li id="tab-radio" class="ui-tabs-active"><a href="<?php echo get_site_url().'/category/happy-click-radio'; ?>"><?php _e('Happy Click Radio','warp'); ?></a></li>
				<li id="tab-cs"><a href="<?php echo get_site_url().'/category/goc-chia-se'; ?>"><?php _e('Góc chia sẻ','warp'); ?></a></li>
				<li id="tab-kt"><a href="<?php echo get_site_url().'/category/goc-kien-thuc'; ?>"><?php _e('Góc kiến thức','warp'); ?></a></li>
			<?php elseif ($cat == "goc-chia-se"): ?>
				<li id="tab-radio"><a href="<?php echo get_site_url().'/category/happy-click-radio'; ?>"><?php _e('Happy Click Radio','warp'); ?></a></li>
				<li id="tab-cs" class="ui-tabs-active"><a href="<?php echo get_site_url().'/category/goc-chia-se'; ?>"><?php _e('Góc chia sẻ','warp'); ?></a></li>
				<li id="tab-kt"><a href="<?php echo get_site_url().'/category/goc-kien-thuc'; ?>"><?php _e('Góc kiến thức','warp'); ?></a></li>
			<?php elseif ($cat == "goc-kien-thuc"): ?>
				<li id="tab-radio"><a href="<?php echo get_site_url().'/category/happy-click-radio'; ?>"><?php _e('Happy Click Radio','warp'); ?></a></li>
				<li id="tab-cs"><a href="<?php echo get_site_url().'/category/goc-chia-se'; ?>"><?php _e('Góc chia sẻ','warp'); ?></a></li>
				<li id="tab-kt" class="ui-tabs-active"><a href="<?php echo get_site_url().'/category/goc-kien-thuc'; ?>"><?php _e('Góc kiến thức','warp'); ?></a></li>
			<?php endif; ?>
			</ul>
	</div>
	<div class="posts-wrapper single-lam-giau-cuoc-song" >
		<?php
		if($cat == "happy-click-radio") { ?>
			<div class='radio'>
				<?php echo $this->render('single-happy-click-radio'); ?>
			</div>
		<?php } else if($cat == "goc-chia-se") { ?>
			<div class='chia-se'>
			<?php echo $this->render('single-goc-chia-se'); ?>
			</div>
		<?php } else if($cat == "goc-kien-thuc") { ?>
			<div>
			<?php echo $this->render('single-goc-kien-thuc'); ?>
			</div>
		<?php } ?>
	</div>
</div>