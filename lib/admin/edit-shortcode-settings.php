<?php

if ( ! defined('ABSPATH') ){ exit; }

function wdes_popup_edit_shortcode_settings() {
	add_meta_box(
		'wdes_popup_styles',
		wdes_popup( 'WDES Popup Styles' ),
		'wdes_popup_styles',
		'wdespopup'
	);
	if( ! wdes_popup_get_post() ){ return; }
	add_meta_box(
		'wdes_popup_shortcode',
		wdes_popup( 'WDES Popup Shortcode' ),
		'wdes_popup_shortcode',
		'wdespopup',
		'side',
		'high'
	);
}

function wdes_popup_shortcode(){
	if( ! wdes_popup_get_post() ){ return; }
	printf( '<span class="wdes-popup-notice">%s</span>', __( 'Make sure to use both title and content shortcode in order to execute the popup.' ) );
	printf(
		'<div class="wdes-shortcode">[wdes-popup-title id="%s"] [wdes-popup-content id="%s"]</div>',
		wdes_popup_get_post(), wdes_popup_get_post()
	);
	printf( '<p>%s</p>',  wdes_popup( 'Manage your popup styles in <strong>WDES Popup Styles</strong> tab below.' ) );
}

function wdes_popup_styles(){
	echo '<div id="wdes-popup-settings">';
	if( ! wdes_popup_enable_asps() ) :
	echo '<div class="pro-overlay"> <div class="group-1"> <div class="group-2"> <h2>This settings is just a DEMO, need to purchase WDES Responsive Popup ASPS add-ons. Click the buy now button below, it is very affordable plugin.</h2> <p>WDES Responsive Popup ASPS Addon - <a class="btn button  wdes-rmm" href="https://www.anthonycarbon.com/checkout/?add-to-cart=1593">Buy Now</a></p><p>&nbsp;</p> <a class="btn button close-overlay wdes-rmm" href="#">Close Now</a> </div> </div> </div>';
	endif;
	echo '<div class="wdes-popup-group">';
	if( ! wdes_popup_enable_asps() ) :
		printf(
			'<p class="edit-notice"><a class="button" href="%s" target="_blank" style="float: right;">%s</a>%s</p>',
			'https://www.anthonycarbon.com/product/wdes-responsive-popup-asps-addon/',
			__( 'BUY ANIMATIONS AND STYLES ADDON NOW !!!', WDES_POPUP ),
			__( '<strong>NOTE:</strong> Animations and Styles is not working unless you have installed <strong><em>WDES Responsive Popup ASPS Addon</em></strong>.', WDES_POPUP )
		);
	endif;
	do_action( 'wdes_popup_styles' );
	echo '</div></div>';
}

function wdes_popup_args(){
	$fields			= array();
	$fields[]		= array(
		'type'		=> 'hidden',
		'name'		=> 'Has been save',
		'value'		=> 'true',
		'settings'	=> false
	);
	$fields[]		= array(
		'type'		=> 'select',
		'name'		=> 'Popup Animation',
		'desc'		=> wdes_popup( 'Default is "Appear from center". See examples in [<a href="https://demo.anthonycarbon.com/wdes-responsive-popup-examples/" target="_blank">WDES Responsive Popup Animation</a>]' ),
		'select' 	=> 'custom',
		'default'	=> 'Appear from center',
		'options'	=> array( 'Appear from center', 'Top to bottom', 'Bottom to top', 'Left to right', 'Right to left' ),
		'settings'	=> false
	);
	$fields[]		= array(
		'type'		=> 'select',
		'name'		=> 'Popup Window Style',
		'select' 	=> 'custom',
		'default'	=> 'Default',
		'options'	=> array( 'Default', 'Fit to the screen', 'Custom width', 'Custom width and full height' ),
		'settings'	=> false
	);
	$fields[]		= array(
		'type'		=> 'number',
		'name'		=> 'Popup Width',
		'default' 	=> 500,
		'settings'	=> false,
		'min'		=> '100', 
		'max'		=> '9999',
		'desc'		=> wdes_popup( 'Effective if you chose [Custom Width] option in [Popup Window Style] dropdown.' ),
	);
	$fields[]		= array(
		'type'		=> 'checkbox',
		'name'		=> 'Popup Background Image Style',
		'desc'		=> wdes_popup( 'Enable this option to fit the background image into your screen. Upload image in [Featured Image].' ),
		'style'		=> 'on-off',
		'settings'	=> false
	);
	$fields[]		= array(
		'type'		=> 'color',
		'name'		=> 'Popup Overlay Background Color',
		'desc'		=> wdes_popup( 'Default is rgba(0, 0, 0, 0.5).' ),
		'value' 	=> 'rgba(0, 0, 0, 0.5)',
		'settings'	=> false
	);
	$fields[]		= array(
		'type'		=> 'checkbox',
		'name'		=> 'Popup Overlay onClick',
		'desc'		=> wdes_popup( 'If disable, the popup will not close if clicking outside the box (overlay).' ),
		'style'		=> 'on-off',
		'default'	=> 1,
		'settings'	=> false
	);
	$fields[]		= array(
		'type'		=> 'select',
		'name'		=> 'Popup Close Icon Style',
		'desc'		=> wdes_popup( 'See examples of Close Icon Style in [<a href="https://demo.anthonycarbon.com/wdes-responsive-popup-examples/" target="_blank">WDES Popup Close Icon Examples</a>].' ),
		'select' 	=> 'custom',
		'default'	=> 'Style 1',
		'options'	=> array( 'Style 1', 'Style 2', 'Style 3', 'Style 4', 'Style 5', 'Style 6', 'Style 7', 'Style 8', 'Style 9', 'Style 10' ),
		'settings'	=> false
	);
	$fields[]		= array(
		'type'		=> 'color',
		'name'		=> 'Popup Close Icon Background Color',
		'settings'	=> false
	);
	$fields[]		= array(
		'type'		=> 'color',
		'name'		=> 'Popup Close Icon Border Color',
		'settings'	=> false
	);
	$fields[]		= array(
		'type'		=> 'color',
		'name'		=> 'Popup Close Icon Color',
		'desc'		=> wdes_popup( 'Default is #fff.' ),
		'settings'	=> false
	);
	$fields[]		= array(
		'type'		=> 'color',
		'name'		=> 'Popup Background Color',
		'desc'		=> wdes_popup( 'Default is #ffffff.' ),
		'value' 	=> '#fff',
		'settings'	=> false
	);
	$fields[]		= array(
		'type'		=> 'color',
		'name'		=> 'Popup Color',
		'settings'	=> false
	);
	$fields[]		= array(
		'type'		=> 'number',
		'name'		=> 'Popup Font Size',
		'settings'	=> false,
		'default' 	=> 16,
		'min'		=> '1',
		'max'		=> '9999',
	);
	$fields[]		= array(
		'type'		=> 'checkbox',
		'name'		=> 'Padding arround the box',
		'desc'		=> wdes_popup( 'Has padding around the box. Default is enabled.' ),
		'style'		=> 'on-off',
		'default'	=> 1,
		'settings'	=> false
	);
	$fields[]		= array(
		'type'		=> 'checkbox',
		'name'		=> 'Login',
		'desc'		=> wdes_popup( 'Hide the popup or do not show the popup if the user is logged in.' ),
		'style'		=> 'on-off',
		'default'	=> 0,
		'settings'	=> false
	);
	$fields[]		= array(
		'type'		=> 'text',
		'name'		=> 'Login Link',
		'desc'		=> wdes_popup( 'Add link if the user is logged in.' ),
		'size'		=> 70,
	);
	$fields[]		= array(
		'type'		=> 'checkbox',
		'name'		=> 'Auto Fit',
		'desc'		=> wdes_popup( "The popup will appear in the same place you've just click and the body animation will be disabled." ),
		'style'		=> 'on-off',
		'default'	=> 0,
		'settings'	=> false
	);
	return apply_filters( 'wdes_popup_edit_args', $fields );
}

function wdes_popup_styles_fields(){
	wp_nonce_field( 'wdes_popup_styles_meta_box', 'wdes_popup_styles_meta_box_nonce' );
	$args = apply_filters( 'wdes_popup_edit_fields_args', wdes_popup_args() );
	wdes_popup_fields( $args );
}

function wdes_popup_styles_save_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['wdes_popup_styles_meta_box_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['wdes_popup_styles_meta_box_nonce'], 'wdes_popup_styles_meta_box' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_type'] ) && 'wdespopup' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}
	if( wdes_popup_save_options() ) :
		foreach( wdes_popup_save_options() as $field ) :
			$keyname = wdes_popup_name_to_key( $field );
			update_post_meta( $post_id, $keyname, $_POST[$keyname] );
		endforeach;
	endif;
}