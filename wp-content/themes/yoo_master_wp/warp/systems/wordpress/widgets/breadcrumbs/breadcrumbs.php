<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

class Warp_Breadcrumbs extends WP_Widget {

	function Warp_Breadcrumbs() {
		$widget_ops = array('description' => 'Display your sites breadcrumb navigation');
		parent::WP_Widget(false, 'Warp - Breadcrumbs', $widget_ops);      
	}

	function widget($args, $instance) {  
		
		global $wp_query;
		
		extract($args);
		$is_member = current_user_is_member();
		$is_subs = current_user_has_subscription();
		$title = $instance['title'];
		$home_title = trim($instance['home_title']);
		
		if (empty($home_title)) {
			if($is_member && !$is_subs)
				$home_title = 'Trang chủ dành cho xem thử';
			elseif($is_member && $is_subs)
				$home_title = 'Trang chủ dành cho thành viên';
			else
				$home_title = 'Trang chủ';
		}
		
		echo $before_widget;

		if ($title) {
			echo $before_title . $title . $after_title;
		}
		
		if (!is_home() && !is_front_page()) {
			
			$output = '<div class="breadcrumbs">';
			
			$output .= 'Bạn đang ở đây: <a href="'.get_option('home').'">';
			$output .= $home_title;
			$output .= '</a>';

			if (is_single()) {
				$cats = get_the_category();
				$cat = $cats[0];
				if (is_object($cat)) {
					if ($cat->parent != 0) {
						$output .= get_category_parents($cat->term_id, true, " ");
					} else {
						$output .= '<a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a>';
					}
				}
			}

			if (is_category()) {
				
				$cat_obj = $wp_query->get_queried_object();
				
				$cats = explode("@@@", get_category_parents($cat_obj->term_id, TRUE, '@@@'));
				
				unset($cats[count($cats)-1]);
				
				$cats[count($cats)-1] = '<strong>'.strip_tags($cats[count($cats)-1]).'</strong>';
				$output .= implode("", $cats);
			} elseif (is_tag()) {
				$output .= '<strong>'.single_cat_title('',false).'</strong>';
			} elseif (is_date()) {
				$output .= '<strong>'.single_month_title(' ',false).'</strong>';
			} elseif (is_author()) {
				

				$user = !empty($wp_query->query_vars['author_name']) ? get_userdatabylogin($wp_query->query_vars['author']) : get_user_by("id", ((int) $_GET['author']));
				
				$output .= '<strong>'.$user->display_name.'</strong>';
			} elseif (is_search()) {
				$output .= '<strong>'.stripslashes(strip_tags(get_search_query())).'</strong>';
			} else if (is_tax()) {
				$taxonomy = get_taxonomy (get_query_var('taxonomy'));

				$term = get_query_var('term');
				$destname = get_term_by('slug',$term,$taxonomy->name);
				
				$output .= '<strong>'.$destname->name.'</strong>';
			} else {
				$output .= '<strong>'.get_the_title().'</strong>';
			}

			$output .= '</div>';
			
		} else {
			
			$output = '<div class="breadcrumbs"><strong>'._e('Bạn đang ở đây: ','warp').'</strong>';
			
			$output .= '<strong>'.$home_title.'</strong>';
			
			$output .= '</div>';

		}
		
		echo $output;

		echo $after_widget;

	}

	function update($new_instance, $old_instance) {                
		return $new_instance;
	}

	function form($instance) {        
		$title = esc_attr($instance['title']);
		$home_title = esc_attr($instance['home_title']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','warp'); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('home_title'); ?>"><?php _e('Home title:','warp'); ?></label>
			<input type="text" placeholder="Home" name="<?php echo $this->get_field_name('home_title'); ?>"  value="<?php echo $home_title; ?>" class="widefat" id="<?php echo $this->get_field_id('home_title'); ?>" />
		</p>
<?php
	}

} 

register_widget('Warp_Breadcrumbs');