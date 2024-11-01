<?php

global $wdes_popup_content_atts, $post;

$atts = $wdes_popup_content_atts;

$_post = $post;

if( wdes_popup_attr_id( $atts['id'], 'login' ) && is_user_logged_in() ) { return; }

do_action( 'wdes_popup_before_content', $atts );
do_action( 'wdes_popup_before_content_' . $atts['id'], $atts );

$popup = new WP_Query( array( 'post_type' => 'wdespopup', 'post__in' => array( $atts['id'] ) ) );

if ( $popup->have_posts() ) :
	while ( $popup->have_posts() ) {
		$popup->the_post();
		do_action( 'wdes_popup_content_' . $atts['id'], $atts );
		do_action( 'wdes_popup_content', $atts );
		$animation	= wdes_popup_attr_id( get_the_ID(), 'popup_animation' );
		if( wdes_popup_enable_asps() ) :
			switch( $animation ){
				case 'top-to-bottom':
					wdes_popup_top_to_bottom( $atts );
					break;				
				case 'bottom-to-top':
					wdes_popup_bottom_to_top( $atts );
					break;				
				case 'left-to-right':
					wdes_popup_left_to_right( $atts );
					break;				
				case 'right-to-left':
					wdes_popup_right_to_left( $atts );
					break;
				default:
					wdes_popup_appear_from_center( $atts );
					break;
			}
		else :
			wdes_popup_appear_from_center( $atts );
		endif;
	}
	wp_reset_postdata();
	
endif;

$post = $_post;

do_action( 'wdes_popup_after_content', $atts );
do_action( 'wdes_popup_after_content_' . $atts['id'], $atts );