<?php
global $current_user;
?>
<div style="float:left;margin-bottom:10px;min-height:150px" class="width50">
	<header style="min-height:100px">

		<?php if (has_post_thumbnail()) : ?>
		<?php
		$width = 400; //get the width of the thumbnail setting
		$height = 110; //get the height of the thumbnail setting
		?>
		<?php the_post_thumbnail(array($width,$height), array()); ?>
	<?php endif; ?>
	</header>

	<table width="100%">
		<tr>
			<td align="center">
				<?php
		if($current_user->ID >0):
		?>
		<a href="<?php the_permalink() ?>" class="xemthu" title="<?php the_title_attribute(); ?>"><?php _e('<span>Xem thử</span>', 'warp'); ?></a>
		<?php
		else:
		?>

		<a href="/hcaccount/xem-thu/" class="xemthu" title="<?php the_title_attribute(); ?>"><?php _e('<span>Xem thử</span>', 'warp'); ?></a>
		
		<?php
		endif;
		?>
			</td>
		</tr>

	</table>
	
</div>