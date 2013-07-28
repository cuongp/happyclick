<?php
!defined( 'ABSPATH' ) AND exit(
                ' Hi there! I\'m just a part of plugin, &iquest;what exactly are you looking for?'
);

// magicQuotes issue
// http://goo.gl/aOpxD and http://goo.gl/d97mu
if ( get_magic_quotes_gpc() ) 
	$_POST = stripslashes_deep($_POST);
	
	
if (isset($_POST['update_atp_settings'])) 
{ 
	foreach( self::$opt_defaults as $key => $value )
	{
		$this->plugin_options[$key] = (isset($_POST['atp_'.$key]) && $_POST['atp_'.$key]) ? 1 : 0;

	}

	update_option( self::$opt_name, $this->plugin_options );
	
	?>
	<div class="updated">
		<p>
			<strong><?php _e('Settings updated.', 'atp'); ?></strong>
		</p>
	</div>
	<?php
} 

?>
	
	<div class=wrap> 
		
		<div id="icon-options-bsf-atp" class="icon32">
			<a href="http://www.rodbuaiz.com">
				<img src="<?php echo $this->plugin_url; ?>images/logo.png" alt="rodbuaiz.com" title="rodbuaiz.com"/>
			</a>
		</div>
		
		<h2>AudioTube - YouTube Audio Player <em style="font-size:.5em;"><?php echo __('version','atp') . ' ' . self::$opt_version; ?></em></h2>
		
		<!--Main Settings-->	
		<div id="poststuff" class="metabox-holder"><?php 
		
		if ( current_user_can( 'add_users' ) ) 
		{ 
			?>
			<div class="meta-box-sortables ui-sortable">
				<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>"> 
				<div class="postbox resetoptions-box">
					<div class="handlediv" title="Click to toggle"><br /></div>
					<h3 class="hndle"><span><?php _e('Plugin Options','atp'); ?></span></h3>
					<div class="inside">

						<ul>
							<li>
								<label><input name="atp_theme" id="atp_theme" type="checkbox"<?php if ($this->plugin_options['theme']) echo ' checked="yes"'; ?> /> <?php _e('<strong>White theme</strong> (default is black)','atp'); ?></label>
							</li>
						</ul>
						<p class="desc">
						<img id="dark-red" src ="<?php echo $this->plugin_url; ?>images/atp-dark-red.png" alt="player example"/>
						<img id="light-red" src ="<?php echo $this->plugin_url; ?>images/atp-light-red.png" alt="player example"/></p>

						<ul>
							<li>
								<label><input name="atp_javascript" id="atp_javascript" type="checkbox"<?php if ($this->plugin_options['javascript']) echo ' checked="yes"'; ?> /> <?php _e('<strong>JavaScript API</strong>','atp'); ?></label><p class="desc"><?php _e('The JavaScript API allows users to control the YouTube chromeless or embedded video players via JavaScript. Calls can be made to play, pause, seek to a certain time in a video, set the volume, mute the player, and other useful functions. <a href="http://code.google.com/apis/youtube/js_api_reference.html">Documentation</a>.','atp'); ?></p>
							</li>

<?php 
// COOKIES DISABLED
/*
							<li>
								<label><input name="atp_cookies" id="atp_cookies" type="checkbox"<?php if ($this->plugin_options['cookies']) echo ' checked="yes"'; ?> /> <?php _e('<strong>Allow YouTube to collect cookies</strong>','atp'); ?></label><p class="desc"><?php _e('This mode restricts YouTube\'s ability to set cookies for a user who views a web page that contains a privacy-enhanced YouTube embed video player, but does not click on the video to begin playback. YouTube may still set cookies on the user\'s computer once the visitor clicks on the YouTube video player, but YouTube will not store personally-identifiable cookie information for playbacks of embedded videos using the privacy-enhanced mode.<a href="http://www.google.com/support/youtube/bin/answer.py?answer=171780">Documentation</a>.','atp'); ?></p>
							</li>
 */
 // END DISABLE COOKIES
?>
							<li>
								<label><input name="atp_editor" id="atp_editor" type="checkbox"<?php if ($this->plugin_options['editor']) echo ' checked="yes"'; ?> /> <?php _e('<strong>Allow editors, authors and colaborators to see this page</strong>','atp'); ?></label><p class="desc"><?php _e('Hiding this plugin options box.','atp'); ?></p>
							</li>
						</ul>
						<div class="submit update-button"><input type="submit" class="button-primary" name="update_atp_settings"
						value="<?php _e('Update settings', 'atp') ?>" /></div> 


					</div>
				</div><!-- post-box -->

			</form>

			</div><!--meta-box-sortables-->
		</div><!--poststuff-->
		<?php 		
	} // END if ( current_user_can( 'add_users' ) ?>

		<!--Shortcode Examples-->
		<div id="poststuff" class="metabox-holder">
		<div class="meta-box-sortables">
			<div class="postbox examples-box">
			<div class="handlediv" title="Click to toggle"><br /></div>
			<h3 class="hndle"><span><?php _e('Shortcode Examples','atp'); ?></span></h3>
			<div class="inside examples">
				<ul>
					<li>
						<?php _e('Basic use','atp'); ?>:<br />
						<code>[audiotube id="5TqqbaOcvP4"]</code><br />
						<img src ="<?php echo $this->plugin_url; ?>images/4-small-tc.png" alt="player example"/>
					</li>
					<li>
						<?php _e('No timer','atp'); ?>:<br />
						<code>[audiotube id="5TqqbaOcvP4" time="no"]</code><br />
						<img src ="<?php echo $this->plugin_url; ?>images/3-small-no-tc.png" alt="player example"/>
					</li>
					<li>
						<?php _e('No bar','atp'); ?>:<br />
						<code>[audiotube id="5TqqbaOcvP4" bar="no"]</code><br />
						<img src ="<?php echo $this->plugin_url; ?>images/2-no-bar.png" alt="player example"/>
					</li>
					<li>
						<?php _e('Tiny','atp'); ?>:<br />
						<code>[audiotube id="5TqqbaOcvP4" tiny="yes"]</code><br />
						<img src ="<?php echo $this->plugin_url; ?>images/1-tiny.png" alt="player example"/>
					</li>
					<li>
						<?php _e('Medium','atp'); ?>:<br />
						<code>[audiotube id="5TqqbaOcvP4" size="medium"]</code><br />
						<img src ="<?php echo $this->plugin_url; ?>images/6-medium-tc.png" alt="player example"/>
					</li>
					<li>
						<?php _e('Medium & no time','atp'); ?>:<br />
						<code>[audiotube id="5TqqbaOcvP4" size="medium" time="no"]</code><br />
						<img src ="<?php echo $this->plugin_url; ?>images/5-medium-no-tc.png" alt="player example"/>
					</li>
					<li>
						<?php _e('Large','atp'); ?>:<br />
						<code>[audiotube id="5TqqbaOcvP4" size="large"]</code><br />
						<img src ="<?php echo $this->plugin_url; ?>images/8-large-tc.png" alt="player example"/>
					</li>
					<li>
						<?php _e('Large & no time','atp'); ?>:<br />
						<code>[audiotube id="5TqqbaOcvP4" size="large" time="no"]</code><br />
						<img src ="<?php echo $this->plugin_url; ?>images/7-large-no-tc.png" alt="player example"/>
					</li>
				</ul>
			</div>
			</div><!-- post-box -->
			</div><!--meta-box-sortables-->
		</div><!-- post-stuff -->

		<!--Shortcode Examples-->
		<div id="poststuff" class="metabox-holder">
		<div class="meta-box-sortables">
			<div class="postbox reference-box">
			<div class="handlediv" title="Click to toggle"><br /></div>
			<h3 class="hndle"><span><?php _e('Shortcode Reference','atp'); ?></span></h3>
			<div class="inside shortcodes"><?php _e('<h4>Shortcode options</h4>','atp'); ?>
			<ul>
				<li>
					<div class="scode">id</div><div class="stext"><?php _e('Required! YouTube video ID, is the part marked in red:<br /> <code>www.youtube.com/watch?v=<strong><font color="red" size="3">5TqqbaOcvP4</font></strong>&feature=autoplay</code>','atp'); ?></div><br />
				</li>
				<li>
					<div class="scode">bar</div><div class="stext"><?php _e('Progress bar (yes or no, default = yes)','atp'); ?></div>
				</li>
				<li>
					<div class="scode">time</div><div class="stext"><?php _e('Timer  (yes or no, default = yes)','atp'); ?></div>
				</li>
				<li>
					<div class="scode">tiny</div><div class="stext"><?php _e('Minimal player, not compatible with Progress Bar (yes or no, default = no)','atp'); ?></div>
				</li>
				<li>
					<div class="scode">size</div><div class="stext"><?php _e('Extended sizes (small, medium or large, default = small)','atp'); ?></div>
				</li>
				<li>
					<div class="scode">invisible</div><div class="stext"><?php _e('Hidden player (yes or no, default = no)','atp'); ?></div>
				</li>
				<li>
					<div class="scode">auto</div><div class="stext"><?php _e('Autoplay (yes or no, default = no)','atp'); ?></div>
				</li>
				<li>
					<div class="scode">loop</div><div class="stext"><?php _e('Loop (yes or no, default = no)','atp'); ?></div>
				</li>
				<li>
					<div class="scode">theme</div><div class="stext"><?php _e('Player color, will override plugin options (dark or light, default = dark)','atp'); ?></div>
				</li>
				<li>
					<div class="scode">start</div><div class="stext"><?php _e('Start time in seconds','atp'); ?></div>
				</li>
			</ul>
		</div>
	</div><!-- post-box -->
	</div><!--meta-box-sortables-->
	</div><!-- post-stuff -->



	
		<p><?php
			_e('Porting of Navarr\'s <a href="http://tech.navarr.me/code/youtube-audio-player">YouTube Audio Player</a> to WordPress.<br /><em>"Turns any YouTube Video or Playlist URL into a small embedded Audio Player".</em>','atp'); ?>
		</p>
	</div><!-- end-wrap -->