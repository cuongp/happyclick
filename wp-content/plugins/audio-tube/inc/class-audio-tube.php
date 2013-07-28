<?php

/**
 * Class initialized in __construct of main plugin file
 * 
 * Class based on Plugin Class Demo, by toscho
 * https://gist.github.com/3804204
 */
class BL_Audio_Tube
{
    /**
     * Plugin instance.
     * @see get_instance()
     * @type object
     */
    protected static $instance = NULL;

    /**
     * URL to this plugin's directory.
     * @type string
     */
    public $plugin_url = '';

    /**
     * Path to this plugin's directory.
     * @type string
     */
    public $plugin_path = '';
    
     /**
     * Options name.
     * @type string
     */
    public static $opt_name    = 'AudioTubePlayerOptions';
	
	/**
	 * Plugin version
	 * @var string
	 */
	public static $opt_version = '1.2';
	
	/**
	 * Plugin defaults
	 * @var array 
	 */
	public static $opt_defaults = array(
				'javascript' => 0,
				//'cookies' => 0,
				'theme' => 0,
				'color' => 0,
				'editor' => 0
				);

    /**
     * Options internal holder
     * @type array 
     */
    public $plugin_options      = array();

	
    /**
     * Access this plugin’s working instance
     *
     * @wp-hook plugins_loaded
     * @since   2012.09.13
     * @return  object of this class
     */
    public static function get_instance()
    {
        NULL === self::$instance and self::$instance = new self;

        return self::$instance;
    }


    /**
     * Used for regular plugin work.
     *
     * @wp-hook plugins_loaded
     * @since   2012.09.10
     * @return  void
     */
    public function plugin_setup()
    {
		$description_for_readme = __( "Hides the video area and show only the controls. Easy setup page with examples of the shortcode usage.", 'atp' );
        $opts = get_option( self::$opt_name );
		if( $opts )
			$this->plugin_options = $opts;
		else
			$this->plugin_options = self::$opt_defaults;
		
        $this->plugin_url  = plugins_url( '/', dirname( __FILE__ ) );
        $this->plugin_path = plugin_dir_path( dirname( __FILE__ ) );
		add_action( 'admin_menu', array( $this, 'atp_menu' ) ) ;
		$this->load_language( 'atp' );

     }


    /**
     * Constructor. Intentionally left empty and public.
     *
     * @see plugin_setup()
     * @since 2012.09.12
     */
    public function __construct()
    {
        
    }

	/**
	 * Make menu and call scripts
	 */
	function atp_menu()
	{
		$role = ( $this->plugin_options['editor'] ) ? 'edit_posts' : 'add_users';
		$pluginpage = add_management_page(
				'AudioTube', 
				'AudioTube', 
				$role, 
				'audio_tube', 
				array( $this,'admin_page' )
		);
		add_action( 
				"admin_print_scripts-$pluginpage", 
				array( $this, 'admin_scripts' )
		);
	}
	
	/**
	 * Load CSS and JS
	 */
	public function admin_scripts() 
	{
		wp_enqueue_script( 
				'wpse-19907', 
				$this->plugin_url.'/js/audio-tube.js', 
				array(), 
				false, 
				true 
		);
        wp_enqueue_style( 
				'wpse-19907', 
				$this->plugin_url.'/css/audio-tube.css'
			);
	}

	/**
	 * Plugins settings page render
	 */
	public function admin_page() 
	{ 
	
		include ('page-admin.php');
	}

	
    /**
     * Loads translation file.
     *
     * Accessible to other classes to load different language files (admin and
     * front-end for example).
     *
     * @wp-hook init
     * @param   string $domain
     * @since   2012.09.11
     * @return  void
     */
    public function load_language( $domain )
    {
        $locale = apply_filters( 'plugin_locale', get_locale(), $domain );

 		$mo_name = $domain . '-' . $locale . '.mo';
		$mo_path = WP_LANG_DIR . '/plugins/audio-tube/' . $mo_name;
		load_textdomain( $domain, $mo_path );

        load_plugin_textdomain(
                $domain, FALSE, 'audio-tube/languages'
        );
    }


}