<?php
//Load Shortcode Framework

//Hook Widget
add_action( 'widgets_init', 'techgasp_spotifymaster_widget' );
//Register Widget
function techgasp_spotifymaster_widget() {
register_widget( 'techgasp_spotifymaster_widget' );
}

class techgasp_spotifymaster_widget extends WP_Widget {
	function techgasp_spotifymaster_widget() {
	$widget_ops = array( 'classname' => 'Spotify Master', 'description' => __('Spotify Master allows you to display in your wordpress website musics, playlists and albums of the cool and "booming" music network Spotify. ', 'Spotify Master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'techgasp_spotifymaster_widget' );
	$this->WP_Widget( 'techgasp_spotifymaster_widget', __('Spotify Master', 'spotify master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		//Our variables from the widget settings.
		$name = "Spotify Master";
		$title = isset( $instance['title'] ) ? $instance['title'] :false;
		$spotifyspacer ="'";
		$show_spotifybutton = isset( $instance['show_spotifybutton'] ) ? $instance['show_spotifybutton'] :false;
		$spotifybutton_page = $instance['spotifybutton_page'];
		echo $before_widget;
		
	// Display the widget title
		if ( $title )
		echo $before_title . $name . $after_title;
	//Display Spotify Profile Button
		if ( $show_spotifybutton )
		echo '<a href="'.$spotifybutton_page.'" target="_blank"><img src="../wp-content/plugins/spotify-master/techgasp-spotify-button.png"></a>';
	echo $after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_spotifybutton'] = $new_instance['show_spotifybutton'];
		$instance['spotifybutton_page'] = $new_instance['spotifybutton_page'];
		return $instance;
	}
	function form( $instance ) {
	//Set up some default widget settings.
	$defaults = array( 'name' => __('Spotify Master', 'spotify master'), 'title' => true, 'show_spotifybutton' => false, 'spotifybutton_page' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<b>Check the buttons to be displayed:</b>
	<p>
	<input type="checkbox" <?php checked( (bool) $instance['title'], true ); ?> id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><b><?php _e('Display Widget Title', 'spotify master'); ?></b></label></br>
	</p>
	<hr>
	<p>
	<input type="checkbox" <?php checked( (bool) $instance['show_spotifybutton'], true ); ?> id="<?php echo $this->get_field_id( 'show_spotifybutton' ); ?>" name="<?php echo $this->get_field_name( 'show_spotifybutton' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_spotifybutton' ); ?>"><b><?php _e('Spotify Profile Button', 'spotify master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'spotifybutton_page' ); ?>"><?php _e('insert your Spotify Profile Link:', 'spotify master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'spotifybutton_page' ); ?>" name="<?php echo $this->get_field_name( 'spotifybutton_page' ); ?>" value="<?php echo $instance['spotifybutton_page']; ?>" style="width:auto;" />
	</p>
	<hr>
	<p><b>Spotify Master Advanced Version Contains:</b> Display or hide Widget Title - Display or hide Spotify Profile Button - Display or hide Spotify Player (Single Musics, Playlists, Albums) - Full control over player width and height - Shortcode Framework. Publish widget inside pages and posts.</p>
	<p><a class="button-primary" href="http://wordpress.techgasp.com/spotify-master/" target="_blank" title="Spotify Master Advanced Version">Spotify Master Advanced Version</a></p>
	<?php
	}
 }
?>