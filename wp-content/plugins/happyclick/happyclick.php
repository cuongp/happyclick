<?php

/*
Plugin Name: Happy Click
Plugin URI: http://tgmtech.vn
Description: 
Author: TGMTECH
Version: 1.0.0
Author URI: http://tgmtech.vn
License: GPLv2
*/


include (dirname(__file__) . '/widgets/widget-sukien.php');
add_action('admin_menu','add_membership_custom_options');

function add_membership_custom_options(){
    add_options_page('HappyClick Membership Options', 'HappyClick Membership Options', 'manage_options', 'functions','membershiphp_custom_options');
}
    function membershiphp_custom_options(){
    ?>
    
<div class="wrap">  
        <h2>Discount for HappyClick Membership</h2>  
        <form method="post" action="options.php">  
            <?php wp_nonce_field('update-options') ?> 
            <p><strong>Discount Membership:</strong><br />  
                <input type="text" name="hpbasicmembership" size="15" value="<?php echo get_option('hpbasicmembership'); ?>" />%  
            </p>
            <p><strong>Post Per Page:</strong><br />  
                <input type="text" name="page_chude" size="15" value="<?php echo get_option('page_chude'); ?>" />%  
            </p>
            <p><input type="submit" name="Submit" value="Submit" /></p>  
            <input type="hidden" name="action" value="update" />  
            <input type="hidden" name="page_options" value="hpbasicmembership,page_chude" />
               
    <?php
    }  
add_action('init', 'sukien_post_type');

function sukien_post_type()
{
    $labels = array(
        'name' => 'Sự kiện',
        'singular_name' => 'Sự kiện',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New item',
        'edit_item' => 'Edit item',
        'new_item' => 'New item',
        'view_item' => 'View item',
        'search_items' => 'Search item',
        'not_found' => 'No item found',
        'not_found_in_trash' => 'No item in the trash',
        'parent_item_colon' => '',
        );
    register_post_type('sukien', array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => false,
        'query_var' => true,
        'rewrite' => array('slug' => 'sukien'),
        'capability_type' => 'post',
        'has_archive' => true,
        'menu_position' => 10,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            ),
        'register_meta_box_cb' => 'sukien_meta_boxes',
        ));

flush_rewrite_rules();
}

add_action('init', 'chude_taxonomy_type');
function chude_taxonomy_type()
{
    $labels = array(
        'name' => __('Chủ đề'),
        'singular_name' => __('Chủ đề'),
        'search_items' => __('Search Chủ đề'),
        'all_items' => __('All Chủ đề'),
        'edit_item' => __('Edit Chủ đề'),
        'update_item' => __('Update Chủ đề'),
        'add_new_item' => __('Add New Chủ đề'),
        'new_item_name' => __('New Chủ đề'),
        'choose_from_most_used' => __('Choose from the most used diễn giả'));
        register_taxonomy('chude', array('sukien'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'query_var' => 'chude',
        'rewrite' => array('slug' => 'chude'),
        'show_in_nav_menus' => true,
        'show_tagcloud' => false));
        flush_rewrite_rules();
}
add_action('init', 'diengia_taxonomy_type');

function diengia_taxonomy_type()
{
    $labels = array(
        'name' => __('Diễn giả'),
        'singular_name' => __('Diễn giả'),
        'search_items' => __('Search Diễn giả'),
        'all_items' => __('All Diễn giả'),
        'edit_item' => __('Edit Diễn giả'),
        'update_item' => __('Update Diễn giả'),
        'add_new_item' => __('Add New Diễn giả'),
        'new_item_name' => __('New Diễn giả'),
        'choose_from_most_used' => __('Choose from the most used diễn giả'));
    register_taxonomy('diengia', array('sukien'), array(
        'hierarchical' => false,
        'labels' => $labels,
        'query_var' => 'diengia',
        'rewrite' => true,
        'show_in_nav_menus' => true));
        flush_rewrite_rules();
}

function sukien_meta_boxes()
{
    add_meta_box('sukien_form', 'Details', 'sukien_form', 'sukien', 'normal', 'high');
}
function sukien_form()
{
    $post_id = get_the_ID();
    $sukien_data = get_post_meta($post_id, '_sukien', true);
    $video = (empty($sukien_data['video'])) ? '' : $sukien_data['video'];
    $giatien = (empty($sukien_data['giatien'])) ? '' : $sukien_data['giatien'];
    $thoigian = (empty($sukien_data['thoigian'])) ? '' : $sukien_data['thoigian'];
    $diadiem = (empty($sukien_data['diadiem'])) ? '' : $sukien_data['diadiem'];
    wp_nonce_field('sukien', 'sukien');
?>
<p>
        <label>Video (optional)</label><br />
        <input type="text" value="<?php echo $video; ?>" name="sukien[video]" size="80" />
</p>

<p>
		<label>Giá tiền (optional)</label><br />
		<input type="text" value="<?php echo $giatien; ?>" name="sukien[giatien]" size="40" />
</p>
<p>
		<label>Thời gian (optional)</label><br />
		<input type="text" value="<?php echo $thoigian; ?>" name="sukien[thoigian]" size="40" />
</p>
<p>
		<label>Địa điểm (optional)</label><br />
		<input type="text" value="<?php echo $diadiem; ?>" name="sukien[diadiem]" size="40" />
</p>
<?php
}
add_action('save_post', 'sukien_save_post');

function sukien_save_post($post_id)
{

    if (!empty($_POST['sukien'])) {
        $sukien_data['giatien'] = (empty($_POST['sukien']['giatien'])) ? '' :
            sanitize_text_field($_POST['sukien']['giatien']);
        
        $sukien_data['video'] = (empty($_POST['sukien']['video'])) ? '' :
            sanitize_text_field($_POST['sukien']['video']);
        $sukien_data['thoigian'] = (empty($_POST['sukien']['thoigian'])) ? '' :
            sanitize_text_field($_POST['sukien']['thoigian']);
        $sukien_data['diadiem'] = (empty($_POST['sukien']['diadiem'])) ? '' :
            sanitize_text_field($_POST['sukien']['diadiem']);
        update_post_meta($post_id, '_sukien', $sukien_data);
    } else {
        delete_post_meta($post_id, '_sukien');
    }
}

add_filter('manage_edit-sukien_columns', 'sukien_edit_columns');
function sukien_edit_columns($columns)
{
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'sukien-chude' => 'Chủ đề',
        'sukien-diengia' => 'Diễn giả',
        'sukien-giatien' => 'Giá tiền',
        'sukien-thoigian' => 'Thời gian',
        'sukien-diadiem' => 'Địa điểm',
        'author' => 'Posted by',
        'date' => 'Date');

    return $columns;
}
add_action('manage_posts_custom_column', 'sukien_columns', 10, 2);

function sukien_columns($column, $post_id)
{
    $sukien_data = get_post_meta($post_id, '_sukien', true);

    switch ($column) {
        case 'sukien-diengia':

            $_tax = 'diengia';
            $terms = get_the_terms($post_id, $_tax);
            if (!empty($terms)) {
                $out = array();
                foreach ($terms as $c)
                    $out[] = "<a href='edit-tags.php?action=edit&taxonomy=$_tax&post_type=sukien&tag_ID={$c->term_id}'> " .
                        esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category',
                        'display')) . "</a>";
                echo join(', ', $out);
            }

            break;
        case 'sukien-chude':

            $_tax = 'chude';
            $terms = get_the_terms($post_id, $_tax);
            if (!empty($terms)) {
                $out = array();
                foreach ($terms as $c)
                    $out[] = "<a href='edit-tags.php?action=edit&taxonomy=$_tax&post_type=sukien&tag_ID={$c->term_id}'> " .
                        esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category',
                        'display')) . "</a>";
                echo join(', ', $out);
            }

            break;
        case 'sukien-thoigian':
            if (!empty($sukien_data['thoigian']))
                echo $sukien_data['thoigian'];
            break;
        case 'sukien-giatien':
            if (!empty($sukien_data['giatien']))
                echo $sukien_data['giatien'];
            break;
        case 'sukien-diadiem':
            if (!empty($sukien_data['diadiem']))
                echo $sukien_data['diadiem'];
            break;
    }
}

function get_chude($post_type = 'sukien', $posts_per_page = -1, $orderby =
    'none', $subject_id = null)
{
    $count =4;
    echo '<div class="items items-col-'.$count.' grid-block">';
    //$taxonomies = get_terms('chude');
    $taxonomies = get_categories('taxonomy=chude');
    $i=0;
    if (!empty($taxonomies)) {
        foreach ($taxonomies as $taxonomy) {
            $margin = 0;
                if($taxonomy->slug=='hoi-thao')
                    $margin=26;
                echo '<div class="clearfix '.$taxonomy->slug.'"><h3 class="module-title" style="padding:0px;margin:0px;margin-bottom:'.$margin.'px;border-bottom:1px solid #ccc"><a href="/chude/' . $taxonomy->slug . '">' . $taxonomy->
                name . '</a></h3>';
            $args = array(
                'posts_per_page' => 4,
                'post_type' => 'sukien',
                'no_found_rows' => true,
                'tax_query' => array(
    array(
      'taxonomy' => 'chude',
      'field' => 'slug',
      'terms' => $taxonomy->slug
    )
  ),
               
                'order' => 'DESC');
            $query = new WP_Query($args);
            if($query->have_posts()){
                while ( $query->have_posts() ) : $query->the_post();
                if($i%2==0){
            $class='old';
            if($i>1)
                $hr= '<hr class="hr" />';
        }
        else{
            $class= 'even';
            $hr='';
        }
            
       
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
            $giatien = ( empty( $data['giatien'] ) ) ? 'Vui lòng liên hệ' : number_format($data['giatien'],0,'.','').' đ';
            $giatienthanhvien = ( empty( $data['giatien'] ) ) ? 'Vui lòng liên hệ' : number_format($data['giatien'] - $data['giatien']*(get_option('hpbasicmembership')/100),0,'.','').' đ';
            $thoigian =( empty( $data['thoigian'] ) ) ? '' : $data['thoigian'];
            $diadiem = ( empty( $data['diadiem'] ) ) ? '' : $data['diadiem'];
            if($taxonomy->slug=='hoi-thao')
                $count = 2;
            elseif($taxonomy->slug=='khoa-hoc')
                $count =1;
            
?>
<div style="margin-bottom:10px;" class="item2 grid-box width<?php echo intval(100 / $count);?>">                
<?php if($taxonomy->slug=='hoi-thao'): 

?>
<article style="margin-top:7px;margin-bottom:7px"  id="item-<?php the_ID(); ?>" class="chude_item item item<?php echo $class; ?>" data-permalink="<?php the_permalink(); ?>">

	<div class="content clearfix">
   <?php 
                echo $thumbnail;
            ?>
    <!--<p>
        
	   <span class="title" ><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></span>
    
    </p>-->
    <table width="100%">
        <!--<tr>
            <td class="image" width="120">
            <?php 
                echo $thumbnail;
            ?>
    </td>
            <td>
                <h3>
                    <?php echo $thoigian; ?>
                </h3>
                <?php echo 'Diễn giả: '.$diengia; ?><br/>
                Phí tham dự:<br/>
                <table width=100%>
                    <tr><td>Khách:</td><td><?php echo $giatien; ?></td></tr>
                    <tr><td>Thành viên:</td><td><?php echo $giatienthanhvien; ?></td></tr>
                </table>
            </td>

        </tr>-->
        <tr>
        <td width="120"><p class="cat-post-title2"><a href="<?php echo get_permalink(); ?>"><span style="display:none">Xem chi tiết</span></a></p>
        </td>
        <td>
              <p class="cat-post-title1"><a href="<?php echo get_permalink(); ?>"><span  style="display:none">Trở thành thành viên</span></a></p>
            </td>
        </tr>
    </table>
    
    </div>

  
    

	<?php //edit_post_link(__('Edit this post.', 'warp'), '<p class="edit">','</p>'); ?>

</article>
<?php elseif($taxonomy->slug=='khoa-hoc'): ?>
<article style="padding-bottom:18px;padding-top:18px" id="item-<?php the_ID(); ?>" class="chude_item item" data-permalink="<?php the_permalink(); ?>">

    <table width="100%">
        <tr>
            <td style="height:143px;"><?php 
        echo $thumbnail;
    ?></td>
          <!--   <td>
           <p>
        
       <span class="title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></span>
    
    </p>
                <h3>
                    <?php echo $thoigian; ?>
                </h3>
                <?php echo 'Giảng viên: '.$diengia; ?><br/>
                
            </td>-->
            <td style="border-left:1px solid #ccc;padding:0 40px;padding-left:50px;margin-top:10px">
                <b>Phí tham dự:</b><br/>
                <table width=100%>
        <tr><td><b>Khách:</b></td><td><b><?php echo $giatien; ?></b></td></tr>
        <tr><td><b>Thành viên:</b></td><td><b><?php echo $giatienthanhvien; ?></b></td></tr>
    </table>
               <p class="cat-post-title2"><a href="<?php echo get_permalink(); ?>"><span style="display:none">Xem chi tiết</span></a></p> 
                <p class="cat-post-title1"><a href="<?php echo get_permalink(); ?>"><span  style="display:none">Trở thành thành viên</span></a></p>
            </td>
        </tr>
          
    
        
    </table>
    
    
  
    

    <?php //edit_post_link(__('Edit this post.', 'warp'), '<p class="edit">','</p>'); ?>

</article>
<?php endif; ?>

</div>
<?php
$i++;
endwhile;
            }
            echo '</div><br/>';
        }
    }
   echo '</div>';
}
    
?>