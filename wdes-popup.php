<?php

/**
 * Plugin Name: WDES Responsive Popup
 * Plugin URI: https://www.anthonycarbon.com/
 * Description: <strong>WDES Responsive Popup</strong> is a desktop, mobile, browser, and user/developer friendly. This plugin is design for your window popup content for your WordPress website. You can create a customizable popup window using shortcodes for your dashboard editor (post, page, widgets, and more) and a ready function for your custom templates. Commonly used in login, registration or signup, contact form, and more. You can add unlimited popups with their own configurations (<a href="https://www.anthonycarbon.com/wdes-responsive-popup-documentation/#page-settings">page settings</a>). It has different type of animations, window styles, close icon styles, can manage background image/color, font size, text color and many other options. You can manage your popup via cookie to expired by hours, days, months, or years and can be applied only in Home, Pages, Posts, Archives, or all pages. For more information, please check the plugin <a href="https://www.anthonycarbon.com/wdes-responsive-popup-documentation/">documentation</a> and <a href="https://demo.anthonycarbon.com/wdes-responsive-popup-examples/">examples</a>.
 * Version: 1.3.5
 * Author: <a href="https://www.anthonycarbon.com/">Anthony Carbon</a>
 * Author URI: https://www.anthonycarbon.com/
 * Donate link: https://www.paypal.me/anthonypagaycarbon
 * Tags: popup, modal, lightbox, cookie, responsive popup, window popup, anthonycarbon.com
 * Requires at least: 4.4
 * Tested up to: 5.3.2
 * Stable tag: 1.3.5
 * 
 * Text Domain: wdes-rp
 * Domain Path: /i18n/languages/
 *
 * @package WDES Responsive Popup
 * @category Core
 * @author Anthony Carbon
 */
 
if ( !defined('ABSPATH') ){ exit; }

if ( ! class_exists( 'WDES_Responsive_Popup' ) ) :

class WDES_Responsive_Popup {
	public $title_args;
	public $content_args;
	public function __construct() {
		$this->title_args = array(
			'content-id' => '',
			'id' => '',
			'title' => '',
			'title-id' => '',
			'class' => '',
			'attr' => '',
			'echo' => true
		);
		$this->content_args = array(
	 		'id' => '',
		 	'class' => '',
		 	'content' => '',
			'content-id' => '',
			'echo' => true
		);
		$this->define_constants();
		$this->register();
		$this->includes();
		$this->init_hooks();
		do_action( 'wdes_responsive_popup_loaded' );
	}
	private function define_constants() {
		$this->define( 'WDES_POPUP', 'wdes-rp' );
		$this->define( 'WDES_POPUP_NAME', 'WDES Responsive Popup' );
		$this->define( 'WDES_POPUP_BN', plugin_basename( __FILE__ ) );
		$this->define( 'WDES_POPUP_URL', plugin_dir_url(__FILE__) );
		$this->define( 'WDES_POPUP_IMG_URL', WDES_POPUP_URL . 'assets/images' );
		$this->define( 'WDES_POPUP_JS_URL', WDES_POPUP_URL . 'assets/js' );
		$this->define( 'WDES_POPUP_CSS_URL', WDES_POPUP_URL . 'assets/css' );
		// PATH
		$this->define( 'WDES_POPUP_PATH', plugin_dir_path( __FILE__ ) );
		$this->define( 'WDES_POPUP_LIB_PATH', WDES_POPUP_PATH . 'lib' );
		$this->define( 'WDES_POPUP_ADMIN_PATH', WDES_POPUP_LIB_PATH . '/admin' );
		$this->define( 'WDES_POPUP_VIEW_PATH', WDES_POPUP_LIB_PATH . '/view' );
		$this->define( 'WDES_POPUP_FUNCTIONS_PATH', WDES_POPUP_LIB_PATH . '/functions' );
		$this->define( 'WDES_POPUP_TEMPLATE_PATH', WDES_POPUP_LIB_PATH . '/templates' );
		// DIR
		$this->define( 'WDES_POPUP_PARENT_THEME_DIR', get_template_directory() );
		$this->define( 'WDES_POPUP_CHILD_THEME_DIR', get_stylesheet_directory() );
	}
	private function init_hooks() {
		add_filter( 'plugin_row_meta', array( $this, 'add_action_links' ), 10, 2 );
		add_action( 'admin_print_styles', array( $this, 'admin_styles' ) );
		add_action( 'admin_print_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'styles_scripts' ) );
		add_action( 'template_redirect', 'wdes_popup_template_redirect' );
		add_action( 'add_meta_boxes', 'wdes_popup_edit_shortcode_settings' );
		add_action( 'save_post', 'wdes_popup_styles_save_meta_box_data' );
		add_action( 'add_meta_boxes', 'wdes_popup_edit_page_settings' );
		
		#add_filter( 'wdes_popup_the_content', 'run_shortcode', 8 );
		#add_filter( 'wdes_popup_the_content', 'autoembed', 8 );
		add_filter( 'wdes_popup_the_content', 'wptexturize' );
		add_filter( 'wdes_popup_the_content', 'convert_smilies', 20 );
		add_filter( 'wdes_popup_the_content', 'wpautop' );
		add_filter( 'wdes_popup_the_content', 'shortcode_unautop' );
		add_filter( 'wdes_popup_the_content', 'prepend_attachment' );
		add_filter( 'wdes_popup_the_content', 'wp_make_content_images_responsive' );
		add_filter( 'wdes_popup_the_content', 'do_shortcode', 11 );
		
		add_action( 'get_footer', 'wdes_popup_include_the_shortcode' );
		add_shortcode( 'wdes-popup-title', array( $this, 'title' ) );
		add_shortcode( 'wdes-popup-content', array( $this, 'content' ) );
		add_action( 'wdes_popup_styles', 'wdes_popup_styles_fields', 5 );
	}
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}
	public function add_action_links( $plugin_meta, $plugin_file ) {
		if( $plugin_file == plugin_basename(__FILE__) ){
			$plugin_meta[] = sprintf( '<a href="https://www.anthonycarbon.com/wdes-responsive-popup-documentation/" target="_blank">%s</a>', __( 'Documentaion', WDES_POPUP ) );
			$plugin_meta[] = sprintf( '<a href="https://demo.anthonycarbon.com/wdes-responsive-popup-examples/" target="_blank">%s</a>', __( 'Demo', WDES_POPUP ) );
			$plugin_meta[] = '<a class="dashicons-before dashicons-awards" href="https://www.paypal.me/anthonypagaycarbon" target="_blank">' . __( 'Donate, buy me a coffee', WDES_POPUP ) . '</a>';
		}
		return $plugin_meta;
	}
	public function title( $atts ) {
		$GLOBALS['wdes_popup_title_atts'] = shortcode_atts( $this->title_args, $atts );
		ob_start();
		include( WDES_POPUP_VIEW_PATH . '/title.php' );
		return ob_get_clean();
	}
	public function content( $atts ) {
		$GLOBALS['wdes_popup_content_atts'] = shortcode_atts( $this->content_args, $atts );	
		wp_enqueue_script( 'wdes-popup' );
		wp_enqueue_style( 'wdes-popup' );
		ob_start();
		if( in_array( $atts['id'], wdes_popup_all_ids() ) ){
			return ob_get_clean();
		}
		include( WDES_POPUP_VIEW_PATH . '/content.php' );
		return ob_get_clean();
	}
	public function footer_content( $atts ) {	
		wp_enqueue_script( 'wdes-popup' );
		wp_enqueue_style( 'wdes-popup' );
		$GLOBALS['wdes_popup_content_atts'] = shortcode_atts( $this->content_args, $atts );
		ob_start();
		include( WDES_POPUP_VIEW_PATH . '/content.php' );
		return ob_get_clean();
	}
	private function register() {
		register_post_type(
			'wdespopup',
			array(
				'labels' => array(
					'name' => __( 'All Shortcodes', WDES_POPUP ),
					'singular_name' => __( 'Popup Shortcode', WDES_POPUP ),
					'add_new' => __( 'Add Shortcode', WDES_POPUP ),
					'add_new_item' => __( 'Add new shortcode', WDES_POPUP ),
					'edit_item' => __( 'Edit Shortcode', WDES_POPUP ),
					'all_items' => __( 'All Shortcodes', WDES_POPUP ),
					'menu_name' => __( 'WDES Popup', WDES_POPUP ),
					'view_item' => false,
				),
				'public' => true,
				'hierarchical' => false,
				'rewrite' => false,
				'query_var' => false,
				'show_in_nav_menus' => false,
				'exclude_from_search' => true,
				'supports' => array( 'title', 'editor', 'revisions', 'thumbnail' ),
			)
		);
	}
	public function includes() {
		include_once( WDES_POPUP_FUNCTIONS_PATH . '/functions-helpers.php' );
		include_once( WDES_POPUP_FUNCTIONS_PATH . '/functions.php' );
		include_once( WDES_POPUP_ADMIN_PATH . '/settings-fields.php' );
		include_once( WDES_POPUP_ADMIN_PATH . '/edit-shortcode-settings.php' );
		include_once( WDES_POPUP_ADMIN_PATH . '/edit-page-settings.php' );
		include_once( WDES_POPUP_FUNCTIONS_PATH . '/classes.php' );
		include_once( WDES_POPUP_FUNCTIONS_PATH . '/inline-styles.php' );
		include_once( WDES_POPUP_VIEW_PATH . '/appear-from-center/appear-from-center.php' );
		include_once( WDES_POPUP_VIEW_PATH . '/appear-from-center/default.php' );	
	}
	public function admin_styles(){
		wp_register_style( 'wdes-popup-admin', WDES_POPUP_CSS_URL . '/admin.min.css' );
		wp_enqueue_style( 'wdes-popup-admin' );
	}	
	public function admin_scripts() {
		global $bp,$wpdb;
		$prefix = $wpdb->prefix;
		wp_enqueue_style( 'wp-color-picker' ); 
		wp_enqueue_script( 'wp-color-picker' ); 
		wp_enqueue_media();
		wp_register_script( 'wdes-popup-admin', WDES_POPUP_JS_URL . '/admin.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'wdes-popup-admin' );
		$popups = $wpdb->get_results( "SELECT ID, post_title FROM {$prefix}posts WHERE post_status = 'publish' AND post_type = 'wdespopup'" );
		$popup_ids = array();
		$popup_names = array();
		$_popup_ids = array();
		$popupids = array();
		foreach( $popups as $popup ){
			$popup_ids[] = $popup->ID;
			$popup_names[] = $popup->post_title;
		}
		$_popups = $wpdb->get_results( "SELECT post_id, meta_value FROM {$prefix}postmeta WHERE meta_key = '_menu_item_wdes_popup' AND meta_value != '' ORDER BY meta_value DESC" );
		foreach( $_popups as $_popup ){
			if( ! in_array( $_popup->meta_value, $popupids ) ){
				$_popup_ids[$_popup->post_id] = $_popup->meta_value;
			}
		}
		wp_localize_script(
			'wdes-popup-admin',
			'popup',
			array(
				'ajaxurl' 	=> admin_url('admin-ajax.php'),
				'popup_url' 	=> WDES_POPUP_URL,
				'popup_img_url'	=> WDES_POPUP_IMG_URL,
				'ids' 			=> $popup_ids,
				'names' 		=> $popup_names,
				'active_ids' 	=> $_popup_ids,
				'asps' 			=> wdes_popup_enable_asps(),
				'notice'		=> __( '<strong>NOTE:</strong> This is not working unless you have installed <strong>WDES Responsive Popup ASPS Addon</strong>. <a class="button" href="https://www.anthonycarbon.com/product/wdes-responsive-popup-asps-addon/" target="_blank">BUY NOW !!!</a><br><br>', WDES_POPUP )
			)
		);
	}
	public function styles_scripts(){
		wp_register_script( 'wdes-popup', WDES_POPUP_JS_URL . '/script.min.js', array( 'jquery' ) );
		wp_register_style( 'wdes-popup', WDES_POPUP_CSS_URL . '/style.min.css' );
		//wp_enqueue_script( 'wdes-popup' );
		wp_localize_script(
			'wdes-popup',
			'popup',
			apply_filters( 'wdes_popup_localize_script', array() )
		);
	}
}

add_action( 'plugins_loaded', 'plugins_loaded_wdes_popup', 5 );
function plugins_loaded_wdes_popup(){
	new WDES_Responsive_Popup;
}

else :
	
add_action( 'admin_notices', function(){
	printf(
		'<div class="error notice"><p>%s</p></div>',
		__( '<strong>WDES Responsive Popup</strong> PHP class (<code>class WDES_Responsive_Popup {</code>} is already exist.', 'wdes-rp' )
	);
} );

endif;