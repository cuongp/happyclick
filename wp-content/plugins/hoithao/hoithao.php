<?php

/*
Plugin Name: Hội Thảo
Plugin URI: 
Description: 
Author: 
Version: 1.0.0
Author URI: 
License: GPLv2
*/
include( dirname( __FILE__ ) . '/widgets/widget-hoithao.php' );



add_action('init','hoithao_post_type');


function hoithao_post_type(){
    $labels = array(
		'name' => 'Hội thảo',
		'singular_name' => 'Hội thảo',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New item',
		'edit_item' => 'Edit item',
		'new_item' => 'New item',
		'view_item' => 'View item',
		'search_items' => 'Search item',
		'not_found' =>  'No item found',
		'not_found_in_trash' => 'No item in the trash',
		'parent_item_colon' => '',
	);
    register_post_type( 'hoithao', array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'exclude_from_search' => true,
		'query_var' => true,
		'rewrite' => array('slug'=>'hoithao'),
		'capability_type' => 'post',
		'has_archive' => true,
		'menu_position' => 10,
		'supports' => array('title', 'editor','thumbnail', ),
		'register_meta_box_cb' => 'hoithao_meta_boxes',
	) );
    
    
    $dglabels = array(
		'name' => __( 'Diễn giả' ),
		'singular_name' => __( 'Diễn giả' ),
		'search_items' =>  __( 'Search diễn giả'),
		'all_items' => __( 'All diễn giả' ),
		'edit_item' => __( 'Edit diễn giả' ),
		'update_item' => __( 'Update diễn giả' ),
		'add_new_item' => __( 'Add New diễn giả' ),
		'new_item_name' => __( 'New diễn giả' ),
		'choose_from_most_used'	=> __( 'Choose from the most used diễn giả' )
	); 	

	register_taxonomy('diengia',array('hoithao','khoahoc'),array(
		'hierarchical' => true,
		'labels' => $dglabels,
		'query_var' => true,
		'show_in_nav_menus' => false,
		'show_tagcloud' => false
	));
    
    $dglabels = array(
		'name' => __( 'Chủ đề' ),
		'singular_name' => __( 'Chủ đề' ),
		'search_items' =>  __( 'Search Chủ đề'),
		'all_items' => __( 'All Chủ đề' ),
		'edit_item' => __( 'Edit Chủ đề' ),
		'update_item' => __( 'Update Chủ đề' ),
		'add_new_item' => __( 'Add New Chủ đề' ),
		'new_item_name' => __( 'New Chủ đề' ),
		'choose_from_most_used'	=> __( 'Choose from the most used diễn giả' )
	); 	

	register_taxonomy('chude',array('hoithao','khoahoc'),array(
		'hierarchical' => true,
		'labels' => $dglabels,
		'query_var' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => false
	));
    
    
}

function khoahoc_meta_boxes() {
	add_meta_box( 'khoahoc_form', 'Details', 'khoahoc_form', 'khoahoc', 'normal', 'high' );
}
function hoithao_meta_boxes() {
	add_meta_box( 'hoithao_form', 'Details', 'hoithao_form', 'hoithao', 'normal', 'high' );
}
function hoithao_form(){
    $post_id = get_the_ID();
    $hoithao_data = get_post_meta($post_id,'_hoithao',true);
    
    $giatien = ( empty( $hoithao_data['giatien'] ) ) ? '' : $hoithao_data['giatien'];
    $thoigian = ( empty( $hoithao_data['thoigian'] ) ) ? '' : $hoithao_data['thoigian'];
    $diadiem = ( empty( $hoithao_data['diadiem'] ) ) ? '' : $hoithao_data['diadiem'];
    wp_nonce_field( 'hoithao', 'hoithao');
?>
<p>
		<label>Giá tiền (optional)</label><br />
		<input type="text" value="<?php echo $giatien; ?>" name="hoithao[giatien]" size="40" />
</p>
<p>
		<label>Thời gian (optional)</label><br />
		<input type="text" value="<?php echo $thoigian; ?>" name="hoithao[thoigian]" size="40" />
</p>
<p>
		<label>Địa điểm (optional)</label><br />
		<input type="text" value="<?php echo $diadiem; ?>" name="hoithao[diadiem]" size="40" />
</p>
<?php
}
function khoahoc_form(){

    $post_id = get_the_ID();
    $hoithao_data = get_post_meta($post_id,'_hoithao',true);
    
    $giatien = ( empty( $hoithao_data['giatien'] ) ) ? '' : $hoithao_data['giatien'];
    $thoigian = ( empty( $hoithao_data['thoigian'] ) ) ? '' : $hoithao_data['thoigian'];
    $diadiem = ( empty( $hoithao_data['diadiem'] ) ) ? '' : $hoithao_data['diadiem'];
    wp_nonce_field( 'hoithao', 'hoithao');
?>
<p>
		<label>Giá tiền (optional)</label><br />
		<input type="text" value="<?php echo $giatien; ?>" name="khoahoc[giatien]" size="40" />
</p>
<p>
		<label>Thời gian (optional)</label><br />
		<input type="text" value="<?php echo $thoigian; ?>" name="khoahoc[thoigian]" size="40" />
</p>
<p>
		<label>Địa điểm (optional)</label><br />
		<input type="text" value="<?php echo $diadiem; ?>" name="khoahoc[diadiem]" size="40" />
</p>
<?php
}
add_action( 'save_post', 'hoithao_save_post' );

function hoithao_save_post( $post_id ) {
	
	if ( ! empty( $_POST['hoithao'] ) ) {
		$hoithao_data['giatien'] = ( empty( $_POST['hoithao']['giatien'] ) ) ? '' : sanitize_text_field( $_POST['hoithao']['giatien'] );
        $hoithao_data['thoigian'] = ( empty( $_POST['hoithao']['thoigian'] ) ) ? '' : sanitize_text_field( $_POST['hoithao']['thoigian'] );
        $hoithao_data['diadiem'] = ( empty( $_POST['hoithao']['diadiem'] ) ) ? '' : sanitize_text_field( $_POST['hoithao']['diadiem'] );		
		update_post_meta( $post_id, '_hoithao', $hoithao_data );
	} else {
		delete_post_meta( $post_id, '_hoithao' );
	}
    if ( ! empty( $_POST['khoahoc'] ) ) {
		$khoahoc_data['giatien'] = ( empty( $_POST['khoahoc']['giatien'] ) ) ? '' : sanitize_text_field( $_POST['khoahoc']['giatien'] );
        $khoahoc_data['thoigian'] = ( empty( $_POST['khoahoc']['thoigian'] ) ) ? '' : sanitize_text_field( $_POST['khoahoc']['thoigian'] );
        $khoahoc_data['diadiem'] = ( empty( $_POST['khoahoc']['diadiem'] ) ) ? '' : sanitize_text_field( $_POST['khoahoc']['diadiem'] );		
		update_post_meta( $post_id, '_khoahoc', $khoahoc_data );
	} else {
		delete_post_meta( $post_id, '_khoahoc' );
	}
    
}

add_filter( 'manage_edit-hoithao_columns', 'hoithao_edit_columns' );
add_filter( 'manage_edit-khoahoc_columns', 'khoahoc_edit_columns' );
function hoithao_edit_columns( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Title',
		'hoithao-diengia' => 'Diễn giả',
		'hoithao-giatien' => 'Giá tiền',
		'hoithao-thoigian' => 'Thời gian',
		'hoithao-diadiem' => 'Địa điểm',
		'author' => 'Posted by',
		'date' => 'Date'
	);

	return $columns;
}
function khoahoc_edit_columns( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Title',
		'hoithao-diengia' => 'Diễn giả',
		'hoithao-giatien' => 'Giá tiền',
		'hoithao-thoigian' => 'Thời gian',
		'hoithao-diadiem' => 'Địa điểm',
		'author' => 'Posted by',
		'date' => 'Date'
	);

	return $columns;
}
add_action( 'manage_posts_custom_column', 'hoithao_columns', 10, 2 );

add_action( 'manage_posts_custom_column', 'khoahoc_columns', 10, 2 );
function khoahoc_columns( $column, $post_id ) {
	$hoithao_data = get_post_meta( $post_id, '_khoahoc', true );
    
	switch ( $column ) {
		case 'khoahoc-diengia':
           
			$_tax = 'diengia';
            $terms = get_the_terms( $post_id, $_tax);
            if(!empty($terms)){
                 $out = array();
            foreach ( $terms as $c )
                $out[] = "<a href='edit-tags.php?action=edit&taxonomy=$_tax&post_type=hoithao&tag_ID={$c->term_id}'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
            echo join( ', ', $out );    
            }       
            
			break;
		case 'khoahoc-thoigian':
			if ( ! empty( $hoithao_data['thoigian'] ) )
				echo $hoithao_data['thoigian'];
			break;
		case 'khoahoc-giatien':
			if ( ! empty( $hoithao_data['giatien'] ) )
				echo $hoithao_data['giatien'];
			break;
        case 'khoahoc-diadiem':
			if ( ! empty( $hoithao_data['diadiem'] ) )
				echo $hoithao_data['diadiem'];
			break;
	}
}

function hoithao_columns( $column, $post_id ) {
	$hoithao_data = get_post_meta( $post_id, '_hoithao', true );
    
	switch ( $column ) {
		case 'hoithao-diengia':
           
			$_tax = 'diengia';
            $terms = get_the_terms( $post_id, $_tax);
            if(!empty($terms)){
                 $out = array();
            foreach ( $terms as $c )
                $out[] = "<a href='edit-tags.php?action=edit&taxonomy=$_tax&post_type=hoithao&tag_ID={$c->term_id}'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
            echo join( ', ', $out );    
            }       
            
			break;
		case 'hoithao-thoigian':
			if ( ! empty( $hoithao_data['thoigian'] ) )
				echo $hoithao_data['thoigian'];
			break;
		case 'hoithao-giatien':
			if ( ! empty( $hoithao_data['giatien'] ) )
				echo $hoithao_data['giatien'];
			break;
        case 'hoithao-diadiem':
			if ( ! empty( $hoithao_data['diadiem'] ) )
				echo $hoithao_data['diadiem'];
			break;
	}
}

function get_khoahoc_hoithao($post_type = 'hoithao',$posts_per_page = -1, $orderby = 'none', $subject_id = null ) {
	
   
    $taxonomies= get_terms('chude');
    $str = '';
	if(!empty($taxonomies)){
	   foreach($taxonomies as $taxonomy){
	       $str.= "<h3 class='module-title'><a href='/chude/".$taxonomy->slug."'>{$taxonomy->name}</a></h3>";
            $term = get_term_by('name', '', 'chude');   
                       var_dump($term);
                       $args = array(
            		'posts_per_page' => (int) $posts_per_page,
            		'post_type' => $post_type,
            		'orderby' => $orderby,
            		'no_found_rows' => true,
                    'taxonomy' => $taxonomy->slug,
                    'term'=>'hoi-thao',

            	);
            if ( $subject_id )
		          $args['post__in'] = array( $subject_id );
            
            $query = new WP_Query( $args);
            if ( $query->have_posts() ) {
            
            while ( $query->have_posts() ) : $query->the_post();
			$post_id = get_the_ID();
			$data = get_post_meta( $post_id, '_'.$post_type, true );
            $terms = get_the_terms( $post_id, 'diengia');
            $diengia='';
            if(!empty($terms)){
                 $out = array();
            foreach ( $terms as $c )
                $out[] = esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display'));
            $diengia = join( ', ', $out );    
            }
            $thumbnail = get_the_post_thumbnail($post_id);
            
            if(empty($thumbnail))
                $thumbnail = '<img src="/wp-content/uploads/no-image.jpg" alt='.get_the_title().' />';
            
			//$diengia = ( empty( $data['diengia'] ) ) ? '' : $data['dien'];
            $giatien = ( empty( $data['giatien'] ) ) ? '' : $data['giatien'];
            $thoigian =( empty( $data['thoigian'] ) ) ? '' : $data['thoigian'];
            $diadiem = ( empty( $data['diadiem'] ) ) ? '' : $data['diadiem'];
            $str.='<div class="cat-post-list">';
            $str.='<div class="cat-post-title"><a href="'.get_permalink($post_id).'">'.get_the_title().'</a></div>';
            $str.="<div class='cat-post-images'><span class='vdarrow'></span>{$thumbnail}</div>";
            $str.="<div class='cat-post-title3'>Di?n gi? : {$diengia}</div>";
            $str.="<div class='cat-post-title3' style='margin-bottom:10px'>Th?i gian : {$thoigian}</div>";
            $str.='<div>Khách : '.number_format($giatien,0,'.','.').' d?ng</div>';
            $str.='<div>Thành viên : '.number_format($giatien,0,'.','.').' d?ng</div>';
            $str.='<div class="cat-post-title2"><a href="'.get_permalink($post_id).'">Xem chi ti?t</a></div>';
            $str.='<div class="cat-post-title2"><a href="#">Tr? thành thành viên</a></div>';
            $str.='</div>';
		endwhile;
	}
        }
    }
		wp_reset_postdata();

	return $str;
}


?>