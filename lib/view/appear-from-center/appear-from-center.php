<?php

if ( !defined('ABSPATH') ){ exit; }

function wdes_popup_appear_from_center( $atts ){
	$window	= wdes_popup_meta( get_the_ID(), 'popup_window_style' );
	if( wdes_popup_enable_asps() ) :
		switch( $window ){		
			case 'fit-to-the-screen':
				wdes_popup_afc_ftts( $atts );
				break;		
			case 'custom-width':
				wdes_popup_afc_custom( $atts );
				break;		
			default:
				wdes_popup_afc_default( $atts );
				break;
		}
	else :
		wdes_popup_afc_default( $atts );
	endif;
}