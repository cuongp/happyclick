<?php
/**
* @package   Master
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// load config
require_once(dirname(__FILE__).'/config.php');

add_filter('the_content', 'do_shortcode');


function remove_wplogin_page() {
    if (strpos(strtolower($_SERVER['REQUEST_URI']), '/wp-login.php') !== false && !current_user_can('administrator')) {
        wp_redirect(get_option('siteurl'));
    }
}
//add_action('init', 'remove_wplogin_page', 0);
