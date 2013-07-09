<?php

/*
Plugin Name: Card System
Plugin URI: http://tgmtech.vn
Description: 
Author: TGMTECH
Version: 1.0.0
Author URI: http://tgmtech.vn
License: GPLv2
*/

require_once(dirname(__FILE__).'/classes/data.php');
require_once(dirname(__FILE__).'/helpers/system.php');

require_once (dirname(__FILE__).'/classes/PHPExcel/IOFactory.php');

if(is_admin()){
    
    add_action('admin_init', 'editor_admin_init');
        add_action('admin_menu','_init_menu');
        add_action('admin_head', '_adminHead');
        add_action('admin_footer', '_adminFooter');
    function _init_menu(){
            add_menu_page('Card System', 'Card System', 10, 'hccard', '_adminView',plugins_url('card/images/icon.png'));
    }
    
        function editor_admin_init() {
            wp_enqueue_script('word-count');
            wp_enqueue_script('post');
            wp_enqueue_script('editor');
            wp_enqueue_script('media-upload');
        }
    function _adminView(){
        if($_GET['task'])
            CardSystem::render('task');
        else
            CardSystem::render('home');
                 
    }
    function _adminHead() {
            CardSystem::addFile('css','card:css/admin.css');
            CardSystem::addFile('css','card:css/ie.css');
            CardSystem::addFile('css','card:css/systems.css');            
    }
    function _adminFooter(){
        CardSystem::addFile('js','card:js/global.js');
    }
    
}    