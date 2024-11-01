<?php

if ( !defined('ABSPATH') ){ exit; }

function wdes_popup_inline_styles( $id ){
	global $wdes_popup_content_atts;
	$r = $wdes_popup_content_atts;
	$cssid = $r['content-id'] ? "#" . $r['content-id'] : "#wdes-popup-$id";
	$iconbc		= wdes_popup_meta( $id, 'popup_close_icon_background_color' );
	$iconborder	= wdes_popup_meta( $id, 'popup_close_icon_border_color' );
	$iconcolor	= wdes_popup_meta( $id, 'popup_close_icon_color' );
	$color		= wdes_popup_meta( $id, 'popup_color' );
	$css_1		= array( 'property' => 'background-color', 'value' => $iconbc );
	$css_2		= array( 'property' => 'border-color', 'value' => $iconborder );
	$css_3		= array( 'property' => 'background-color', 'value' => $iconcolor );
	$css_4		= array( 'property' => 'color', 'value' => $color );
	$inlinecss	= '';
	if( wdes_popup_get_inline_css( $css_1 ) ){
		$_css_1		= wdes_popup_get_inline_css( $css_1 );
		$inlinecss	.= "{$cssid} .wdes-popup-close{{$_css_1}}";
	}
	if( wdes_popup_get_inline_css( $css_2 ) ){
		$_css_2		= wdes_popup_get_inline_css( $css_2 );
		$inlinecss	.= "{$cssid} .wdes-popup-fff-border,{$cssid} .wdes-popup-333-border{{$_css_2}}";
	}
	if( wdes_popup_get_inline_css( $css_3 ) ){
		$_css_3		= wdes_popup_get_inline_css( $css_3 );
		$inlinecss	.= "{$cssid} .wdes-popup-fff-bc-ba:before,{$cssid} .wdes-popup-fff-bc-ba:after,{$cssid} .wdes-popup-333-bc-ba:before,{$cssid} .wdes-popup-333-bc-ba:after{{$_css_3}}";
	}
	if( wdes_popup_get_inline_css( $css_4 ) ){
		$_css_4		= wdes_popup_get_inline_css( $css_4 );
		$inlinecss	.= "{$cssid},{$cssid} p,{$cssid} h1,{$cssid} h2,{$cssid} h3,{$cssid} h4,{$cssid} h5,{$cssid} h6 {{$_css_4}}";
	}
	if( ! wdes_popup_meta( $id, 'padding_arround_the_box' ) && metadata_exists( 'post', $id, 'padding_arround_the_box' ) ) :
		$inlinecss	.= "{$cssid} .wdes-popup-group{padding: 0;}";
	endif;
	if( $inlinecss ){
		printf( '<style>%s</style>', $inlinecss );
	}
	do_action( 'wdes_popup_inline_styles', $id );
	do_action( 'wdes_popup_inline_styles_' . $id, $id );
}