<?php
/**
Plugin Name: Spotify Master
Plugin URI: http://wordpress.techgasp.com/spotify-master/
Version: 2.0
Author: TechGasp
Author URI: http://wordpress.techgasp.com
Text Domain: spotify-master
Description: Spotify Master allows you to display in your wordpress website musics, playlists and albums of the cool and "booming" music network Spotify.
License: GPL2 or later
*/
/*  Copyright 2013 TechGasp  (email : info@techgasp.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if(!class_exists('techgasp_spotifymaster')) :

// DEFINE PLUGIN ID
define('TECHGASP_SPOTIFYMASTER_ID', 'spotify-master-options');

// DEFINE PLUGIN NICK
define('TECHGASP_SPOTIFYMASTER_NICK', 'Spotify Master');

require_once('techgasp-spotifymaster-widget.php');

    class techgasp_spotifymaster
    {
		/** function/method
		* Usage: return absolute file path
		* Arg(1): string
		* Return: string
		*/
		public static function file_path($file)
		{
			return ABSPATH.'wp-content/plugins/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)).$file;
		}
		/** function/method
		* Usage: hooking the plugin options/settings
		* Arg(0): null
		* Return: void
		*/
		public static function techgasp_spotifymaster_register()
		{
			register_setting(TECHGASP_SPOTIFYMASTER_ID.'_options', 'tsm_quote');
		}
		/** function/method
		* Usage: hooking (registering) the plugin menu
		* Arg(0): null
		* Return: void
		*/
		public static function menu()
		{
			// Create menu tab
			add_options_page(TECHGASP_SPOTIFYMASTER_NICK.' Plugin Options', TECHGASP_SPOTIFYMASTER_NICK, 'manage_options', TECHGASP_SPOTIFYMASTER_ID.'_options', array('techgasp_spotifymaster', 'options_page'));
			add_filter( 'plugin_action_links', array('techgasp_spotifymaster', 'techgasp_spotifymaster_link'), 10, 2 );
		}
		/** function/method
		* Usage: show options/settings form page
		* Arg(0): null
		* Return: void
		*/
		public static function options_page()
		{
			if (!current_user_can('manage_options'))
			{
				wp_die( __('You do not have sufficient permissions to access this page.') );
			}
			$plugin_id = TECHGASP_SPOTIFYMASTER_ID;
			// display options page
			include(self::file_path('techgasp-spotifymaster-admin.php'));
		}
		/** function/method
                * Usage: show options/settings form page
                * Arg(0): null
                * Return: void
                */
		 public static function techgasp_spotifymaster_widget()
                {
                        // display widget page
                        include(self::file_path('techgasp-spotifymaster-widget.php'));
                }
		/** function/method
		* Usage: filtering the content
		* Arg(1): string
		* Return: string
		*/
		public static function content_with_quote($content)
		{
			$quote = '<p><blockquote>' . get_option('tsm_quote') . '</blockquote></p>';
			return $content . $quote;
		}
		
		// Add settings link on plugin page
		public function techgasp_spotifymaster_link($links, $file) {
		static $this_plugin;
		if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
		if ($file == $this_plugin){
		$settings_link = '<a href="' . admin_url( 'options-general.php?page='.TECHGASP_SPOTIFYMASTER_ID).'_options' . '">' . __( 'Settings' ) . '</a>';
		array_unshift($links, $settings_link);
		}
		return $links;
		}
	}
		if ( is_admin() )
		{
		add_action('admin_init', array('techgasp_spotifymaster', 'techgasp_spotifymaster_register'));
		add_action('admin_menu', array('techgasp_spotifymaster', 'menu'));
		}
		add_filter('the_content', array('techgasp_spotifymaster', 'content_with_quote'));
endif;
?>