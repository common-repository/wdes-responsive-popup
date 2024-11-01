<?php
if ( !defined('ABSPATH') ){ exit; }
function wdes_popup_afc_default( $atts ){
	$overlaybg 	= wdes_popup_get_meta( 'popup_overlay_background_color' );
	$popupbg 	= wdes_popup_get_meta( 'popup_background_color' );
	$popupcolor	= wdes_popup_get_meta( 'popup_color' );
	$popupsize	= wdes_popup_get_meta( 'popup_font_size' );
	$animation	= wdes_popup_get_meta( 'popup_animation' );
	$window		= wdes_popup_get_meta( 'popup_window_style' ) ? : 'default';
	$closestyle	= wdes_popup_get_meta( 'popup_close_icon_style' ) ? : 'style-1';
	$_gwrap 	= '';
	$_main		= wdes_popup_x( 'main top-0 left-0 fit ' . $animation . ' main-close-' . $closestyle . ' ' . $window );
	$_main		.= ' ' . $atts['class'];
	$_group		= wdes_popup_x( 'group transition' );
	$_scroll	= wdes_popup_x( 'scroll transition' );
	$_close		= wdes_popup_close_classes( $closestyle );
	$_inner		= wdes_popup_x( 'inner fff-bc relative bg inline-block lh-normal align-left' );
	$_wrap		= wdes_popup_x( 'inner-wrap center' );
	$_cell		= wdes_popup_x( 'cell' );
	$_table		= wdes_popup_x( 'table transition opacity-0 min-width-full' );
	$_overlay	= wdes_popup_x( 'overlay absolute top-0 left-0 fit bg' );
	if( ! wdes_popup_get_meta( 'popup_overlay_onclick' ) ){
		$_overlay	.= wdes_popup_x( 'disable' );
	}
	$css_1		= array( 'property' => 'font-size', 'value' => $popupsize, 'extention' => 'px' );
	$css_2		= array( 'property' => 'color', 'value' => $popupcolor );
	$css_3		= array( 'property' => 'background-color', 'value' => $popupbg );
	$css_4		= array( 'property' => 'background-color', 'value' => $overlaybg );
	$css_5		= wdes_popup_get_image_url( get_the_ID() ) ? array( 'property' => 'background-image', 'value' => wdes_popup_get_image_url( get_the_ID() ), 'before' => 'url(', 'after' => ')' ) : '';
	$groupcss	= wdes_popup_get_inline_css( $css_1 );
	$groupcss	.= wdes_popup_get_inline_css( $css_2 );
	$innercss	= wdes_popup_get_inline_css( $css_3 );
	$overlaycss	= wdes_popup_get_inline_css( $css_4 );
	$imagecss	= '';
	if( wdes_popup_get_meta( 'Popup Background Image Style' ) && wdes_popup_get_image_url( get_the_ID() ) ){
		$imagecss	.= wdes_popup_get_inline_css( $css_5 );
	}else{
		$innercss	.= wdes_popup_get_inline_css( $css_5 );
	}
	if( empty( $atts['id'] )  ){ return; }
	ob_start();
	wdes_popup_the_content();
	do_action( 'wdes_popup_content_' . get_the_ID() );
	$content = ob_get_clean();
	$group 		= sprintf( '<div class="%s" style="%s">%s</div>', $_group, $groupcss, $content );
	$scroll 	= sprintf( '<div class="%s">%s</div>', $_scroll, $group );
	$close 		= sprintf( '<div class="%s"></div>%s', $_close, $scroll );
	$inner 		= sprintf( '<div class="%s" style="%s">%s</div>', $_inner, $innercss, $close );
	$wrap 		= sprintf( '<div class="%s">%s</div>', $_wrap, $inner );
	$cell 		= sprintf( '<div class="%s">%s</div>', $_cell, $wrap );
	$table 		= sprintf( '<div class="%s">%s</div>', $_table, $cell );
	$overlay	= sprintf( '<div class="%s" style="%s"></div>%s', $_overlay, $imagecss, $table );
	$contentid	= empty( $atts['content-id'] ) ? 'wdes-popup-' . get_the_ID() : $atts['content-id'];
	printf( '<div id="%s" class="%s" style="display:none;%s">%s</div>', $contentid, $_main, $overlaycss, $overlay );
	wdes_popup_inline_styles( get_the_ID() );
}