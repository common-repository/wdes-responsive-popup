<?php

if ( !defined('ABSPATH') ){ exit; }

function wdes_popup_close_classes( $style ){
	if( wdes_popup_enable_asps() ) :
		$style = $style;
	else :
		$style = 'style-1';
	endif;
	$classes	= wdes_popup_x( 'cursor close absolute lr-0-ba absolute-ba close-' . $style );
	$window		= wdes_popup_get_meta( 'popup_window_style' );
	$animation	= wdes_popup_get_meta( 'popup_animation' );
	$default 	= wdes_popup_close_cwafh_classes( $style );
	if( $animation == 'right-to-left' ){
		$default = wdes_popup_close_cwafh_rtl_classes( $style );	
	}
	if( wdes_popup_enable_asps() ) :
		switch( $window ){		
			case 'fit-to-the-screen':
				$classes = wdes_popup_close_fttc_classes( $style );
				break;
			case 'custom-width-and-full-height':
				$classes = $default;
				break;		
			default:
				$classes = wdes_popup_close_default_classes( $style );
				break;		
		}
	else :
		$classes = wdes_popup_close_default_classes( $style );
	endif;
	return $classes;
}

function wdes_popup_close_default_classes( $style ){
	$classes	= wdes_popup_x( 'cursor close absolute lr-0-ba absolute-ba close-' . $style );
	if( $style == 'style-1' ){
		$classes .= wdes_popup_x( 'fff-bc-ba right--30' );
	}
	if( $style == 'style-2' ){
		$classes .= wdes_popup_x( '333-bc-ba rt-15' );
	}
	if( $style == 'style-3' ){
		$classes .= wdes_popup_x( '333-bc-ba rt-15 333-border squire-30 width-16-ba' );
	}
	if( $style == 'style-4' ){
		$classes .= wdes_popup_x( '333-bc-ba rt-15 333-border squire-30 circle width-16-ba' );
	}
	if( $style == 'style-5' ){
		$classes .= wdes_popup_x( '333-bc-ba 333-border squire-30 fff-bc-ba width-16-ba fff-bc rt--15' );
	}
	if( $style == 'style-6' ){
		$classes .= wdes_popup_x( '333-bc-ba 333-border squire-30 fff-bc-ba circle width-16-ba fff-bc rt--15' );
	}
	if( $style == 'style-7' ){
		$classes .= wdes_popup_x( 'fff-bc-ba fff-border squire-30 width-16-ba right--40' );
	}
	if( $style == 'style-8' ){
		$classes .= wdes_popup_x( 'fff-bc-ba fff-border squire-30 width-16-ba right--40 circle' );
	}
	if( $style == 'style-9' ){
		$classes .= wdes_popup_x( 'fff-bc-ba fff-border squire-30 width-16-ba right-0 top--40' );
	}
	if( $style == 'style-10' ){
		$classes .= wdes_popup_x( 'fff-bc-ba fff-border squire-30 width-16-ba right-0 top--40 circle' );
	}	
	return $classes;
}

function wdes_popup_close_fttc_classes( $style ){
	$classes = wdes_popup_x( 'cursor close absolute lr-0-ba absolute-ba close-' . $style );
	if( in_array( $style, array( 'style-1', 'style-2', 'style-5', 'style-6', 'style-7', 'style-8', 'style-9', 'style-10' ) ) ){
		$classes .= wdes_popup_x( '333-bc-ba rt-15' );
	}
	if( $style == 'style-3' ){
		$classes .= wdes_popup_x( '333-bc-ba rt-15 333-border squire-30 width-16-ba' );
	}
	if( $style == 'style-4' ){
		$classes .= wdes_popup_x( '333-bc-ba rt-15 333-border squire-30 circle width-16-ba' );
	}
	if( $style == 'style-7' ){
		$classes .= wdes_popup_x( 'fff-border squire-30' );
	}
	return $classes;
}

function wdes_popup_close_cwafh_classes( $style ){
	$classes		= wdes_popup_x( 'cursor close absolute lr-0-ba absolute-ba top-10 close-' . $style );
	if( in_array( $style, array( 'style-1', 'style-5', 'style-6', 'style-9', 'style-10' ) ) ){
		$classes 	.= wdes_popup_x( 'fff-bc-ba right--30' );
	}
	if( $style == 'style-2' ){
		$classes 	.= wdes_popup_x( '333-bc-ba rt-15' );
	}
	if( $style == 'style-3' ){
		$classes 	.= wdes_popup_x( '333-bc-ba rt-15 333-border squire-30 width-16-ba' );
	}
	if( $style == 'style-4' ){
		$classes 	.= wdes_popup_x( '333-bc-ba rt-15 333-border squire-30 circle width-16-ba' );
	}
	if( $style == 'style-7' ){
		$classes 	.= wdes_popup_x( 'fff-bc-ba fff-border squire-30 width-16-ba right--40' );
	}
	if( $style == 'style-8' ){
		$classes 	.= wdes_popup_x( 'fff-bc-ba fff-border squire-30 width-16-ba right--40 circle' );
	}
	return $classes;
}

function wdes_popup_close_cwafh_rtl_classes( $style ){
	$classes		= wdes_popup_x( 'cursor close absolute lr-0-ba absolute-ba top-10 close-' . $style );
	if( in_array( $style, array( 'style-1', 'style-5', 'style-6', 'style-9', 'style-10' ) ) ){
		$classes 	.= wdes_popup_x( 'fff-bc-ba left--30' );
	}
	if( $style == 'style-2' ){
		$classes 	.= wdes_popup_x( '333-bc-ba rt-15' );
	}
	if( $style == 'style-3' ){
		$classes 	.= wdes_popup_x( '333-bc-ba rt-15 333-border squire-30 width-16-ba right-30' );
	}
	if( $style == 'style-4' ){
		$classes 	.= wdes_popup_x( '333-bc-ba rt-15 333-border squire-30 circle width-16-ba' );
	}
	if( $style == 'style-7' ){
		$classes 	.= wdes_popup_x( 'fff-bc-ba fff-border squire-30 width-16-ba left--40' );
	}
	if( $style == 'style-8' ){
		$classes 	.= wdes_popup_x( 'fff-bc-ba fff-border squire-30 width-16-ba left--40 circle' );
	}
	return $classes;
}