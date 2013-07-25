<?php
$args = array(
    'category_name' 	=> 'happy-click-radio',
    'post_status' 			=> array( 'publish' ),
	'type'						=> 'post',
	'taxonomy'             => 'category',
    'posts_per_page' 	=> 12,
    'orderby' 				=> 'date',
    'order' 					=> 'DESC'
);

$post_count_radio;

if($post_count_radio != 0) {
	$post_count_radio = 0;
}


$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) {
	$the_query->the_post();
	$post_count_radio++;
	if($post_count_radio == 1): ?>
		<div class="posts_sub_radio">
	<?php  endif; ?>
	<?php $class_margin = ((($post_count_radio%4) == 0)?'margin_right':''); ?>
	<div id="item-<?php the_ID(); ?>" class="post_sub_radio <?php echo $class_margin; ?>" data-permalink="<?php the_permalink(); ?>" >
		<?php if(has_post_thumbnail()): ?>
			<?php $width = '180'; $height = '120'; ?>
			<a href="<?php the_permalink(); ?>" target="_blank"><?php the_post_thumbnail(array($width,$height),array('class'=>'size-auto')); ?></a>
		<?php endif; ?>
		<h3><a href="<?php the_permalink(); ?>" target="_blank"><?php echo string_limit_words(get_the_title(), 5).'...'; ?></a></h3>
		<div class="post-content-sub-radio">
			<?php echo string_limit_words(get_the_content(),8).'...'; ?>
		</div>
	</div>
	<?php if($post_count_radio == 12): ?>
		</div>
	<?php endif;?>
<?php } ?>