<?php

if ( ! defined('ABSPATH') ){ exit; }

function wdes_popup_edit_page_settings() {
	if( get_post_type() == 'wdespopup' ){ return; }
	add_meta_box(
		'wdes_popup_dropdown_list',
		wdes_popup( 'On page load popup window' ),
		'wdes_popup_dropdown_list',
		'',
		'side',
		'high'
	);
}

function wdes_popup_dropdown_list(){
	if( ! wdes_popup_get_post() ){ return; }
	if( ! wdes_popup_enable_asps() ) :
		printf(
			'<span class="wdes-popup-notice">%s <br /><br /><a class="button" href="%s" target="_blank">%s</a></span>',
			__( '<strong>NOTE:</strong> This is not working unless you have installed <strong><em>WDES Responsive Popup ASPS Addon</em></strong>.', WDES_POPUP ),
			'https://www.anthonycarbon.com/product/wdes-responsive-popup-asps-addon/',
			__( 'BUY NOW !!!', WDES_POPUP )
		);
	else :
		printf( '<span class="wdes-popup-notice">%s</span>', __( 'Select your popup in dropdown option.' ) );
	endif;	
	wp_nonce_field( 'wdes_popup_onload_meta_box', 'wdes_popup_onload_meta_box_nonce' );
	$value = get_post_meta( get_the_ID(), 'wdes_popup_onload', true );
	?>
	<p id="wdes-popup-settings" style="padding:0;">
	<select id="wdes_popup_onload" class="wdes-popup" name="wdes_popup_onload">
        <option value="" <?php selected( $value,  '' ); ?>	><?php _e('Select Options', WDES_POPUP ); ?></option>
        <?php
			global $wpdb;
			$prefix = $wpdb->prefix;
			$popups = $wpdb->get_results( "SELECT ID, post_title FROM {$prefix}posts WHERE post_status = 'publish' AND post_type = 'wdespopup'" );
			foreach( $popups as $popup ){
				printf(
					'<option value="%s" %s>%s</option>',
					$popup->ID,						
					selected( $value, $popup->ID, true ),
					__( $popup->post_title, WDES_POPUP )
				);
			}				
        ?>
	</select>
	</p>
	<?php
}