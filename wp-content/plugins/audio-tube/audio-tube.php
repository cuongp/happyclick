<?php
/**
 * Plugin Name: AudioTube - YouTube Audio Player
 * Plugin URI: http://plugins.brasofilo.com
 * Description: Hides the video area and show only the controls. Easy setup page with examples of the shortcode usage.
 * Version: 1.2
 * Stable Tag: 1.2
 * Author: Rodolfo Buaiz
 * Author URI: http://rodbuaiz.com/
 * Text Domain: atp
 * Domain Path: /languages
 * License: GPLv2 or later
 *
 * 
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */


// Main class: BL_Audio_Tube
require_once( 'inc/class-audio-tube.php' );

/**
 * Activation and installation procedures
 */
class BL_Audio_Tube_Init
{

    /**
     * Class constructor
     */
    public function __construct()
    {
        register_activation_hook( 
				__FILE__, 
				array( $this, 'on_activation' ) 
		);
		
        register_deactivation_hook( 
				__FILE__, 
				array( $this, 'on_uninstall' ) 
		);
		
		if( is_admin() )
			add_action(
					'plugins_loaded', 
					array( BL_Audio_Tube::get_instance(), 'plugin_setup' )
			);

		add_filter( 
				'plugin_action_links', 
				array($this, 'action_links'), 
				10, 2 
		);
		
		add_shortcode(
				'audiotube', 
				array( $this, 'shortcode' ) 
		);
    }


    /**
     * Activation hook.
     */
    public function on_activation()
    {
        $params = get_option( BL_Audio_Tube::$opt_name );
        if ( empty( $params ) )
        {
            update_option( 
                    BL_Audio_Tube::$opt_name, 
                    BL_Audio_Tube::$opt_defaults 
             );
        }
    }


    /**
     * Runs on uninstall. Removes all log data.
     */
    function on_uninstall()
    {
        delete_option( BL_Audio_Tube::$opt_name );
    }

	/**
	 * Add link to settings in Plugins list page
	 */
	function action_links( $links, $file ) {
		if ( $file == plugin_basename( dirname(__FILE__).'/audio-tube.php' ) ) {
			array_unshift(
				$links,
				sprintf( 
						'<a href="%s">%s</a>', 
						admin_url( 'tools.php?page=audio_tube' ),
						__('Settings') 
				)
			);
		}
		return $links;
	}

	/**
	 * Print user shortcode in content
	 * 
	 * @param array $atts
	 * @return string
	 */
	public function shortcode( $atts ) 
	{
		$devOptions = get_option( BL_Audio_Tube::$opt_name );

		extract( shortcode_atts( array(
			'bar'  => 'yes',
			'time' => 'yes',
			'tiny' => '',
			'auto' => '',
			'loop' => '',
			'theme' => '',
			'size' => 'small',
			'invisible' => '',
			'id'   => '',
			'start' => '',
			'end' => ''
		), $atts ) );

		if( !isset( $id ) || '' == $id ) 
			return;

		$yt_width = 225;
		$yt_height = 25;
		
		if( $invisible==='yes' ) 
		{
			$yt_height = 0;
			$yt_width = 0;
		} 
		elseif ($tiny==='yes')
		{
			$yt_width = 30;
		} 
		elseif ($bar==='no')
		{
			$yt_width = 62;
		} 
		elseif ($size==='large')
		{
			if($time==='no') 
				$yt_width = 224;
			else 
				$yt_width = 299;
		} 
		elseif ($size==='medium')
		{
			if($time==='no') 
				$yt_width = 187;
			else 
				$yt_width = 262;
		} 
		else
		{
			if($time==='no') 
				$yt_width = 150;
			else 
				$yt_width = 225;
		}

		$yt_auto = '';
		if($auto==='yes') 
			$yt_auto = '&autoplay=1';

		$yt_loop = '';
		if($loop==='yes') 
			$yt_loop = '&loop=1';

		$yt_js = '';
		if ($devOptions['javascript']) 
			$yt_js = '&enablejsapi=1';

		/* COOKIES DISABLED
		  $yt_cookie = 'youtube-nocookie';
		if ($devOptions['cookies']) */
			$yt_cookie = 'youtube';
		 

		$yt_theme = '';
		if ( $devOptions['theme'] ) 
			$yt_theme = '&theme=light';
		if ( '' != $theme ) 
			$yt_theme = '&theme='.$theme;
		
		$yt_start = ( '' != $start ) ? "&start=$start" : '';

		$noembed_image = plugins_url( '/', dirname( __FILE__ ) ) . "images/play-tub.png";
		$ritorna = <<<HTML
		<object width="{$yt_width}" height="{$yt_height}"><param name="movie" value="http://www.{$yt_cookie}.com/v/{$id}?version=2&hl=en{$yt_auto}{$yt_loop}{$yt_js}{$yt_theme}{$yt_start}"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.{$yt_cookie}.com/v/{$id}?version=2&hl=en{$yt_auto}{$yt_loop}{$yt_js}{$yt_theme}{$yt_start}" type="application/x-shockwave-flash" allowscriptaccess="always" width="{$yt_width}" height="{$yt_height}"><noembed><a href="http://www.youtube.com/watch?v={$id}?hl=en"><img src="{$noembed_image}" alt="Play" style="border:0px;" /></a></noembed></object>
HTML;

		return $ritorna;
	} 
}

new BL_Audio_Tube_Init();