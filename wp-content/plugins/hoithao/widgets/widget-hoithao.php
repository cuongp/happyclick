<?php


class Hoithao_Widget extends WP_Widget{
    public function __construct(){
     parent::__construct(
	 		'hoithao_widget', // Base ID
			'Hội thảo', // Name
			array( 'description' => __( 'List of hội thảo', 'text_domain' ), ) // Args
		);   
    }
    
    public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
        echo $before_widget;
        
		if ( $title!='' ){
		echo '<h1 class="title">'.$title.'</h1>';
		}
			
		echo get_khoahoc_hoithao();
		echo $after_widget;
	}
    
    public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}
    public function form($instance){
        if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
        <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
  <?php
    } 
    
}

class Khoahoc_Widget extends WP_Widget{
    public function __construct(){
     parent::__construct(
	 		'khoahoc_widget', // Base ID
			'Khóa học', // Name
			array( 'description' => __( 'List of Khóa học', 'text_domain' ), ) // Args
		);   
    }
    
    public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
        echo $before_widget;
        
		if ( $title!='' ){
		echo '<h1 class="title">'.$title.'</h1>';
		}
			
		echo get_khoahoc_hoithao('khoahoc');
		echo $after_widget;
	}
    
    public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}
    public function form($instance){
        if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
        <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
  <?php
    } 
    
}


add_action( 'widgets_init', 'register_hoithao_widget' );
/**
 * Register widget
 *
 * This functions is attached to the 'widgets_init' action hook.
 */
function register_hoithao_widget() {
	register_widget( 'Hoithao_Widget' );
}


add_action( 'widgets_init', 'register_khoahoc_widget' );
/**
 * Register widget
 *
 * This functions is attached to the 'widgets_init' action hook.
 */
function register_khoahoc_widget() {
	register_widget( 'Khoahoc_Widget' );
}