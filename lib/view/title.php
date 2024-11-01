<?php

global $wdes_popup_title_atts;

$atts = $wdes_popup_title_atts;

if( wdes_popup_meta( $atts['id'], 'login' ) && is_user_logged_in() && ! wdes_popup_meta( $atts['id'], 'login_link' ) ) { return; }

$animation = wdes_popup_meta( $atts['id'], 'popup_animation' );
$id = $atts['id'] ? : wp_rand();

$title = wdes_popup_output( array(
	'value' => wdes_popup( 'Popup Title Not Found' ),
	'default' => wdes_popup( 'Popup Title Not Found' )
));

if( ! empty( $atts['id'] ) ){
	$title = wdes_popup_output( array(
		'value' => get_the_title( $atts['id'] ),
		'default' => wdes_popup( 'Popup Title Not Found' )
	));
}

if( ! empty( $atts['title'] ) ){
	$title = wdes_popup_output( array(
		'value' => $atts['title'],
		'default' => wdes_popup( 'Popup Title Not Found' )
	));
}

$titleid = wdes_popup_output( array(
	'before' => ' id="',
	'after' => '"',
	'value' => $atts['title-id'],
	'default' => 'title-' . wdes_popup_return_slug( get_the_title( $atts['id'] ) )
));

$contentid = wdes_popup_output( array(
	'before' => ' content-id="#',
	'after' => '"',
	'value' => empty( $atts['content-id'] ) ? 'wdes-popup-' . $id : $atts['content-id']
));

$style = wdes_popup_output( array(
	'before' => ' popup-style="',
	'after' => '"',
	'value' => $animation
));

$auto_fit = wdes_popup_output( array(
	'before' => ' auto-fit="',
	'after' => '"',
	'value' => wdes_popup_meta( $atts['id'], 'auto_fit' )
));

$data = '';

do_action( 'wdes_popup_before_title_' . $atts['id'], $atts );
do_action( 'wdes_popup_before_title', $atts );
do_action( 'wdes_popup_title', $atts );
do_action( 'wdes_popup_title_' . $atts['id'], $atts );

if( wdes_popup_meta( $atts['id'], 'login' ) && wdes_popup_meta( $atts['id'], 'login_link' ) && is_user_logged_in() ){
	printf(
		'<a class="%s" href="%s">%s</a>',
		$atts['class'],
		do_shortcode( wdes_popup_meta( $atts['id'], 'login_link' ) ),
		$title
	);
}else{
	$attr = wpkeyvalue( $atts, 'attr' ) ? : '';
	printf(
		'<span%s class="wdes-popup-cursor wdes-popup-title-%s wdes-popup-title %s" %s %s %s %s %s>%s</span>',
		$titleid,
		$atts['id'],
		$atts['class'],
		$attr,
		$contentid,
		$auto_fit,
		apply_filters( 'wdes_popup_title_data', $data, $atts ),
		$style,
		$title
	);
}

do_action( 'wdes_popup_after_title_' . $atts['id'], $atts );
do_action( 'wdes_popup_after_title', $atts );