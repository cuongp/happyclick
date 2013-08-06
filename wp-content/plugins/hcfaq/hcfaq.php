<?php

/*
Plugin Name: HC FAQ
Plugin URI: http://tgmtech.vn
Description: 
Author: TGMTECH
Version: 1.0.0
Author URI: http://tgmtech.vn
License: GPLv2
*/

require_once(dirname(__FILE__).'/classes/data.php');
require_once(dirname(__FILE__).'/helpers/system.php');
if(is_admin()){
    
    add_action('admin_init', 'editor_admin_init2');
        add_action('admin_menu','_init_menu2');
        add_action('admin_head', '_adminHead2');
        add_action('admin_footer', '_adminFooter2');
    function _init_menu2(){
            add_menu_page('FAQ System', 'FAQ System', 10, 'hcfaq', '_adminView2',plugins_url(''));
    }
    
        function editor_admin_init2() {
            wp_enqueue_script('word-count');
            wp_enqueue_script('post');
            wp_enqueue_script('editor');
            wp_enqueue_script('media-upload');
        }
    function _adminView2(){
            FAQSystem::render('home');
    }
    function _adminHead2() {
            FAQSystem::addFile('css','hcfaq:css/admin.css');
            FAQSystem::addFile('css','hcfaq:css/ie.css');
            FAQSystem::addFile('css','hcfaq:css/systems.css');            
    }
    function _adminFooter2(){
        FAQSystem::addFile('js','hcfaq:js/global.js');
    }
    
}    