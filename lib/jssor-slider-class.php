<?php	
/**
 *@desc The core integration with WordPress.
 *	
 */
	
class JssorSliderPlugin {	

	/**
	 *singelton instance
	 */	
	private	static	$__instance;
	
	/**
	 * static entry/initialize singleton instance	
	 */		
	public static function run() {
	
		JssorSliderPlugin::getInstance();
		
	}
	
	/**
	 * get singelton instance
	 */	
	public static function getInstance() {
	
		if( self::$__instance == null ) {
			self::$__instance = new	self();
		}
		return	self::$__instance;
		
	}
	
	/**
	 * Constructor
	 */
	public function __construct() {
	
		$this->setup_actions();
		$this->setup_shortcode();
		$this->register_ajax_calls();
		
	}
	
	
	/**
	 *Register the [jssorslider] shortcode.
	 */
	private	function setup_shortcode() {
	
		add_shortcode( 'jssorslider', array( $this, 'register_shortcode' ) );
		
	}
	
	
	/**
	 * Hook Jssor Slider into WordPress
	 */
	private	function setup_actions() {
		
		add_action( 'admin_menu', array( $this, 'create_global_menus_for_js_slider' ) );
		add_action( 'media_buttons_context', array( $this, 'insert_jssorslider_button' ) );
		add_action( 'admin_footer', array( $this, 'jssorslider_admin_footer') );
		
	}
	
	
	/**
	 *Add the menu page
	 */
	public function	 create_global_menus_for_js_slider() {
		
		$menu = array();
		$menu['main_page'] = add_menu_page( 'Jssor Slider', __('Jssor Slider', jssor_slider), 'manage_options', 'jssor_slider', '', JSSOR_SL_PLUGIN_URL	.'/assets/images/icon.png' );
		$menu['sub_page'] = add_submenu_page( 'jssor_slider', 'Dashboard', __('Dashboard', jssor_slider), 'manage_options', 'jssor_slider', array( $this, 'jssor_slider' ) );
		$menu['edit_page'] = add_submenu_page( '', '', '', 'read', 'save_slider', array($this, 'save_slider' ) );
		$menu['prev1_page'] = add_submenu_page( '', 'Slide Preview', 'Slide Preview', 'read', 'slide_preview', array( $this, 'slide_preview' ) );
		$menu['prev2_page'] = add_submenu_page( '', 'Caption Preview', 'Caption Preview', 'read', 'caption_preview', array( $this, 'caption_preview' ) );
		
		foreach($menu as $key => $value) {
			if ( $key == 'prev1_page' ) {
				/* Load script only on this page. */
				add_action( 'load-'.$value, array( $this, 'load_prev1_js' ) );
			} else if ( $key == 'prev2_page' ) {
				/* Load script  only on this page. */
				add_action( 'load-'.$value, array( $this, 'load_prev2_js' ) );
			}
			/* Load the rest of the scripts on all of our admin pages only. */
			add_action( 'load-'.$value, array( $this, 'load_admin_scripts' ) );
		}
		
	}
	
	public function	load_prev1_js() {
		
		/* Too early to enqueue script,register against the proper action */	
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_prev1_js') );
		
	}
	
	public function	load_prev2_js() {
		
		/* Too early to	enqueue	script,register	against	the proper action */	
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_prev2_js' ) );
	}
	
	public function	load_admin_scripts() {
		
		/* Too early to enqueue	script,register	against	the proper action */
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_css_calls' ) );
	}
	
	/**
	 * Functions for replacing table names
	 */
	public static function jssor_sliders() {
		
		global $wpdb;
		return	$wpdb->prefix . 'jssor_sliders';
		
	}

	public static function jssor_slides() {
		
		global	$wpdb;
		return	$wpdb->prefix . 'jssor_slides';
		
	}
	
	/**
	 * Functions for creating admin menus
	 */
	public function	jssor_slider() {
		
		include_once JSSOR_SLIDER_PATH . '/views/dashboard.php';
		
	}
	
	public function save_slider() {
		
		include_once JSSOR_SLIDER_PATH . '/views/edit-slider.php';
		
	}
	
	public function slide_preview() {
		
		include_once JSSOR_SLIDER_PATH . '/views/slide_preview.php';
		
	}	
	
	public function caption_preview() {
		
		include_once JSSOR_SLIDER_PATH . '/views/caption_preview.php';
		
	}
	
	
	/**
	 * Execute on plugin activate
	 */
	public static function plugin_install_script() {
		
		include_once JSSOR_SLIDER_PATH . '/lib/install-script.php';
		
	}
	
	/**
	 * Execute on plugin uninstall
	 */
	public static function plugin_uninstall_script() {
		
		include_once JSSOR_SLIDER_PATH . '/lib/uninstall-script.php';
		
	}
	
	/**
	 * Register admin JavaScript
	 */
	public function	register_admin_scripts() {
		
		wp_enqueue_script( 'jquery-ui-core', array( 'jquery' ) );
		wp_enqueue_script( 'jquery-ui-sortable', array( 'jquery', 'jquery-ui-core' ) );
		wp_enqueue_script( 'jquery.dataTables.min.js', JSSOR_SL_PLUGIN_URL . '/assets/js/jquery.dataTables.min.js', array( 'jquery' ), JSSORSLIDER_VERSION);
		wp_enqueue_script( 'jquery.validate.min.js', JSSOR_SL_PLUGIN_URL . '/assets/js/jquery.validate.min.js', array( 'jquery' ), JSSORSLIDER_VERSION);
		wp_enqueue_script( 'plupload.full.min.js', JSSOR_SL_PLUGIN_URL . '/assets/js/plupload.full.min.js', array( 'jquery' ), JSSORSLIDER_VERSION);
		wp_enqueue_script( 'jquery.plupload.queue.js', JSSOR_SL_PLUGIN_URL . '/assets/js/jquery.plupload.queue.js', array( 'jquery' ), JSSORSLIDER_VERSION);
		wp_enqueue_script( 'bootstrap.js', JSSOR_SL_PLUGIN_URL . '/assets/js/bootstrap.js', array( 'jquery' ), JSSORSLIDER_VERSION);
		wp_enqueue_script( 'tipsy.js', JSSOR_SL_PLUGIN_URL . '/assets/js/jquery.tipsy.js', array( 'jquery' ), JSSORSLIDER_VERSION);
		
	}
	
	/**
	 * Register admin JavaScript for prev1_page
	 */
	public function	enqueue_prev1_js() {
		
		wp_enqueue_script( 'jssor.transition1.js', JSSOR_SL_PLUGIN_URL . '/assets/js/slideshow-transition.min.js' );
		
	}
	
	/**
	 * Register admin JavaScript for prev2_page
	 */
	public function	enqueue_prev2_js() {
	
		wp_enqueue_script( 'jssor.transition2.js', JSSOR_SL_PLUGIN_URL . '/assets/js/caption-transition.min.js' );
		
	}
	
	/**
	 * Register frontend script for slider
	 */
	public function frontend_scripts() {
		
		wp_enqueue_script( 'jssor.core.js', JSSOR_SL_PLUGIN_URL . '/assets/js/jssor.slider.mini.js', array( 'jquery' ), JSSORSLIDER_VERSION);
		
	}
	
	/**
	 * Register admin styles
	 */
	public function admin_css_calls() {

		wp_enqueue_style( 'jquery.plupload.queue.css', JSSOR_SL_PLUGIN_URL . '/assets/css/jquery.plupload.queue.css' );
		wp_enqueue_style( 'stylesheet.css', JSSOR_SL_PLUGIN_URL . '/assets/css/stylesheet.css' );
		wp_enqueue_style( 'font-awesome.css', JSSOR_SL_PLUGIN_URL . '/assets/css/font-awesome/css/font-awesome.css' );
		wp_enqueue_style( 'system-message.css',	JSSOR_SL_PLUGIN_URL . '/assets/css/system-message.css' );
		wp_enqueue_style( 'tipsy.css', JSSOR_SL_PLUGIN_URL . '/assets/css/tipsy.css' );
		
	}
	
	/**
	 * Register ajax based function to be called on action type
	 */
	public function register_ajax_calls() {
		
		if ( isset( $_REQUEST['action'] ) ) {
			switch ( $_REQUEST['action'] ) {
				case 'add_new_slider_library' :
					add_action( 'admin_init', 'jssor_slider_library' );
					function jssor_slider_library() {
						
						include_once JSSOR_SLIDER_PATH . '/lib/add-new-slider-class.php';
					}
					break;
				case 'upload_library' :
					add_action( 'admin_init', 'upload_library' );
					function upload_library() {
						
						include_once JSSOR_SLIDER_PATH . '/lib/upload.php';
					}
					break;
			}
		}	
	}
	
	/**
	 * Append the 'Add Slider' button to selected admin pages
	 */
	public function	insert_jssorslider_button( $context ) {

		global	$pagenow;
		
		/* Only run in post/page creation and edit screens */
		if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) ) {
			
			$context .= '<a	href="#TB_inline?width=500&height=600&inlineId=choose-jssor-slider"		
			class="button thickbox" title="' . __( "Add Slider using Jssor Slider", jssor_slider ) . '">
			<span style="background: url( ' . JSSOR_SL_PLUGIN_URL . '/assets/images/icon.png ) no-repeat top left;
			display:inline-block;height:16px;margin:0 2px 0 0;vertical-align:sub;width:16px"></span> Add Slider </a>';
		}				
		return	$context;	
		
	}

	/**
	 * Append the 'Choose Jssor Slider' thickbox content to the bottom of selected admin pages
	 */
	public function	jssorslider_admin_footer() {
		
		global	$pagenow;

		/* Only	run in	post/page creation and edit screens */
		if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) ) {
			
			require_once JSSOR_SLIDER_PATH . '/front_views/jssor-slider-shortcode.php';
		}
	}

	
	/**
	 * Shortcode used to display slideshow
	 */
	public function	register_shortcode( $atts ) {
		
		if ( !isset( $atts['id'] ) ) {
			return	false;
		}
		
		$slider_id = $atts['id'];
		
		$this->frontend_scripts();
		
		return	self::extract_shortcode( $slider_id );
	}
	
	/*
	 * @return string HTML output of the shortcode
	 */
	public static function extract_shortcode( $slider_id ) {
	
		ob_start();
		global	$wpdb;
		
		require	JSSOR_SLIDER_PATH . '/lib/settings.php';
		
		require_once JSSOR_SLIDER_PATH . '/front_views/jssorslider.helper.class.php';
	
		include	JSSOR_SLIDER_PATH . '/front_views/slide_show.php';
	
		$jssor_slider_output = ob_get_clean();
		wp_reset_query();
		return	$jssor_slider_output;
	
	}
}			
?>
