<?php

if ( !defined('ABSPATH') ){ exit; }

function wdes_popup_title( $atts ){
	$popup = new WDES_Responsive_Popup;
	$atts = wp_parse_args( $atts, $popup->title_args );
	if( $atts['echo'] ) :
		echo $popup->title( $atts );
	else :
		return $popup->title( $atts );
	endif;	
}

function wdes_popup_content( $atts ){
 	wp_enqueue_script( 'wdes-popup' );
 	wp_enqueue_style( 'wdes-popup' );
	$popup = new WDES_Responsive_Popup;
	$atts = wp_parse_args( $atts, $popup->content_args );
	if( $atts['echo'] ) :
		echo $popup->content( $atts );
	else :
		return $popup->content( $atts );
	endif;	
}

function wdes_popup_footer_content( $atts ){
	$popup = new WDES_Responsive_Popup;
 	wp_enqueue_script( 'wdes-popup' );
 	wp_enqueue_style( 'wdes-popup' );
	$atts = wp_parse_args( $atts, $popup->content_args );
	if( $atts['echo'] ) :
		echo $popup->footer_content( $atts );
	else :
		return $popup->footer_content( $atts );
	endif;	
}

function wdes_popup_enable_asps(){
	return apply_filters( 'wdes_popup_enable_asps', false );
}

function wdes_popup_template_redirect(){
	if( get_post_type() == 'wdespopup' ){
		wp_redirect( get_bloginfo( 'url' ) );
		exit();
	}
}

function wdes_popup_get_post(){
	if( empty( $_GET['post'] ) ){ return; }
	return $_GET['post'];
}

function wdes_popup_output( $args ){
	$before = ! empty( $args['before'] ) ? $args['before'] : '';
	$after = ! empty( $args['after'] ) ? $args['after'] : '';
	$value = ! empty( $args['value'] ) ? $args['value'] : '';
	$default = ! empty( $args['default'] ) ? $args['default'] : '';
	if( empty( $value ) ){
		$value = $default;
	}
	return $before . $value . $after;
}

function wdes_popup( $text, $echo = false ){
	if( $echo == false ){
		return __( $text, WDES_POPUP );
	}else if ( $echo == true ){
		_e( $text, WDES_POPUP );
	}
}

function wdes_popup_return_slug( $text ) {
	$slug	= str_replace( array( ".", ":", "(", ")", "/", "'", "," ), '', $text );
	$slug	= str_replace( " ", "-", $slug );
	$slug	= strtolower( $slug );
	return	$slug;
}

function wdes_popup_name_to_key( $text ) {
	$slug	= str_replace( array( ".", ":", "(", ")", "/", "'", "," ), '', $text );
	$slug	= str_replace( " ", "_", $slug );
	$slug	= strtolower( $slug );
	return	$slug;
}

function wdes_popup_field_name( $key ) {
 	return "wdes_popup_settings[$key]";
}

function wdes_popup_meta( $id, $key ) {
 	return get_post_meta( $id, wdes_popup_name_to_key( $key ), true );
}

function wdes_popup_get_meta( $key, $id = null ) {
	if( $id == null ){
		$id = get_the_ID();
	}
	return get_post_meta( $id, wdes_popup_name_to_key( $key ), true ); 	
}

function wdes_popup_attr_id( $id, $key ) {
 	return wdes_popup_return_slug( wdes_popup_meta( $id, $key ) );
}

function wdes_popup_get_option( $key ) {
 	$options = get_option( 'wdes_popup_settings' );
 	$output = ! empty( $options[$key] ) ? $options[$key] : '';
 	return $output;
}

function wdes_popup_x( $classes ){
	if( empty( $classes ) ){ return; }
	$classes = explode( ' ', $classes );
	$output = '';
	for( $a = 0; $a < count( $classes ); $a++ ){
		$output .= ' wdes-popup-' . $classes[$a];
	}
	return $output;
}

function wdes_popup_get_inline_css( $css ){
	$output		= '';
	$property	= ! empty( $css['property'] ) ? $css['property'] : '';
	$before		= ! empty( $css['before'] ) ? $css['before'] : '';
	$after		= ! empty( $css['after'] ) ? $css['after'] : '';
	$value		= ! empty( $css['value'] ) ? $css['value'] : '';
	$_value		= $value;
	$extention	= ! empty( $css['extention'] ) ? $css['extention'] : '';
	if( $extention ){
		$value	= $value . $extention;
	}
	if( $before && $after ){
		$value	= $before . $value . $after;
	}
	if( ! $property || ! $_value ){ return $output; }
	$output = "$property: $value;";
	return $output;
}

function wdes_popup_get_fields( $fields ){
	return $fields;
}

function wdes_popup_get_image_url( $id ){
	global $wpdb;
	return get_the_post_thumbnail_url( $id, 'full' );
}

function wdes_popup_wpdb( $method, $select, $type = OBJECT ){
	global $wpdb;
	if( ! $type ){
		return $wpdb->$method( $select );
	}
	return $wpdb->$method( $select, $type );
}

function wdes_popup_is_home(){
	if( is_home() || is_front_page() ){
		return true;
	}
	return false;
}

function wp_footer_popup_ids(){
	return apply_filters( 'wp_footer_popup_ids', array() );
}

function wdes_popup_all_ids(){
	global $wpdb, $wp_query;
	$prefix = $wpdb->prefix;
	
	if( isset( $_GET['anton_debug'] ) ) : print_r( $wp_query ); endif;
	
	$onloadids = (array) wdes_popup_meta( get_the_ID(), 'wdes_popup_onload' );
	$menupopupids = $wpdb->get_col( "SELECT meta_value FROM {$prefix}postmeta WHERE meta_key = '_menu_item_wdes_popup' AND meta_value != '' GROUP BY meta_value ORDER BY meta_value DESC" );
	$ids = array_merge( wp_footer_popup_ids(), $onloadids, $menupopupids );
	$ids = array_filter( $ids );
	$ids = array_unique( $ids );
	return apply_filters( 'wdes_popup_id_collection', $ids );
}

function wdes_popup_include_the_shortcode(){
	if( wdes_popup_all_ids() ) :
		foreach( wdes_popup_all_ids() as $id ) :
			wdes_popup_footer_content( array( 'id' => $id ) );
		endforeach;
	endif;
}

function wdes_popup_the_content( $more_link_text = null, $strip_teaser = false ) {
	global $wdes_popup_content_atts;
	if( $wdes_popup_content_atts['content'] ) :
		echo do_shortcode( $wdes_popup_content_atts['content'] );
	else :
		$content = get_the_content( $more_link_text, $strip_teaser );
		$content = apply_filters( 'wdes_popup_the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );
		echo $content;
	endif;
}

function wdes_popup_get( $value ) {
	if( ! empty( $value ) ) :
		return $value;
	endif;
	return false;
}

function wdes_popup_get_names() {
	$default = array();
	foreach( wdes_popup_args() as $arg ) :
		if( isset( $arg['name'] ) ) :
			$default[] = $arg['name'];
		endif;
	endforeach;
	return $default;
}

function wdes_popup_save_options(){
	$default = array();
	$args = apply_filters( 'wdes_popup_save_options', array() );
	$type = isset( $arg['type'] ) ? $arg['type'] : '';
	if( $args ) :
		foreach( $args as $arg ) :
			if( isset( $arg['name'] ) && $type != 'html' ) :
				$default[] = $arg['name'];
			endif;
		endforeach;
	endif;
	return $default;
}

function wdes_popup_get_default( $key ) {
	$default = array();
	foreach( wdes_popup_args() as $args ) :
		if( isset( $args['name'] ) ) :
			$default[wdes_popup_name_to_key( $args['name'] )] = isset( $args['default'] ) ? $args['default'] : '';
		endif;
	endforeach;
	return $default[$key];
}