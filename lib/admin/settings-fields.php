<?php

if ( ! defined('ABSPATH') ){ exit; }

function wdes_popup_field( $field ) {
	$default_args = array(
		'type'			=> '',
		'placeholder' 	=> '',
		'value' 		=> '',
		'default' 		=> '',
		'name' 			=> '',
		'size' 			=> '',
		'min' 			=> '',
		'options'		=> array()
	);
	$args = wp_parse_args( $field, $default_args );
	$active  	= '';
	$type 		= ! empty( $field['type'] ) ? $field['type'] : '';
	$name 		= ! empty( $field['name'] ) ? wdes_popup( $field['name'] ) : '';
	$class 	 	= ! empty( $field['class'] ) ? $field['class'] : array( 'table', 'cell', 'input' );
	$table_id	= ! empty( $field['table_id'] ) ? $field['table_id'] : 'table-id';
	$tablestyle	= ! empty( $field['hide'] ) ? ' style="display:none;"' : '';
	$table 	 	= ! empty( $class['table'] ) ? $class['table'] : '';
	$cell 	 	= ! empty( $class['cell'] ) ? $class['cell'] : '';
	$input 	 	= ! empty( $class['input'] ) ? $class['input'] : '';
	$value 		= ! empty( $field['value'] ) ? $field['value'] : '';
	$size 		= ! empty( $field['size'] ) ? $field['size'] : '';
	$default 	= ! empty( $field['default'] ) ? $field['default'] : '';
	$select 	= ! empty( $field['select'] ) ? $field['select'] : '';
	$style 		= ! empty( $field['style'] ) ? $field['style'] : '';
	$min 		= ! empty( $field['min'] ) ? $field['min'] : '';
	$max 		= ! empty( $field['max'] ) ? $field['max'] : '';
	$settings 	= ! empty( $field['settings'] ) ? $field['settings'] : '';
	$dataclass 	= ! empty( $class['data-class'] ) ? $class['data-class'] : '';
	//$field = wp_parse_args( $field, $defaults );
	$slug 	 	= wdes_popup_return_slug( $name );
	$_name 	 	= wdes_popup_field_name( $slug );
	if( $settings == false ){
		$slug 	= wdes_popup_name_to_key( $name );
		$_name	= $slug;
	}
	$desc 		= ! empty( $field['desc'] ) ? wdes_popup( $field['desc'] ) : '';
	$desc 		= str_replace( "[", "<b>", $desc );
	$desc 		= str_replace( "]", "</b>", $desc );
	if( wdes_popup_get_option( 'has-been-save' ) ){
		$value 	= wdes_popup_get_option( $slug );
	}
	if( $settings == false && wdes_popup_meta( wdes_popup_get_post(), 'has_been_save' ) ){
		$value 	= wdes_popup_meta( wdes_popup_get_post(), $slug );
	}
	$display	= 'none';
	$fw			= array( '100', '200', '300', '400', '500', '600', '700', '800', '900' );
	$options	= ! empty( $field['options'] ) ? $field['options'] : array();
	$iconlayout	= array( 'Default', 'Circle', 'Boxed' );
	$current 	= wdes_popup_get_option( 'wdes-popup-active' ) ? wdes_popup_get_option( 'wdes-popup-active' ) : 'logoicon-setup';
	$submit_1 	= $value ? wdes_popup( 'Change image' ) : wdes_popup( 'Upload image' );
	if( $current == $slug ){
		$display	= 'block';
		$active 	= ' wdes-active';
	}
	ob_start();
	switch( $type ){
		case 'hidden':		
			printf(
				'<input type="%s" name="%s" id="%s" class="wdes-popup %s" value="%s" />',
				$type, $_name, $slug, $input, $value
			);
			break;
		case 'text':
			printf( '<div id="%s" class="wdes-table %s"%s>', $table_id, $table, $tablestyle );
			printf( '<div class="wdes-cell h4">%s</div>', $name );
			printf(
				'<div class="%s"><input type="%s" name="%s" id="%s" class="wdes-popup %s" value="%s" size="%s" placeholder="%s" /><i>%s</i></div>',
				$cell, $type, $_name, $slug, $input, wdes_popup( $value ), $size, $args['placeholder'], $desc
			);
			echo '</div>';
			break;
		case 'number':
			printf( '<div id="%s" class="wdes-table %s"%s>', $table_id, $table, $tablestyle );
			printf( '<div class="wdes-cell h4">%s</div>', $name );
			printf(
				'<div class="%s"><input type="%s" name="%s" id="%s" class="wdes-popup %s" value="%s" min="%s" max="%s" placeholder="%s" /><i>%s</i></div>',
				$cell, $type, $_name, $slug, $input, $value, $min, $max, $default, $desc
			);
			echo '</div>';
			break;
		case 'color':
			printf( '<div id="%s" class="wdes-table %s"%s>', $table_id, $table, $tablestyle );
			printf( '<div class="wdes-cell h4">%s</div>', $name );
			printf(
				'<div class="%s"><input type="text" name="%s" id="%s" class="wdes-color-picker %s" value="%s" /><i>%s</i></div>',
				$cell, $_name, $slug, $input, $value, $desc
			);
			echo '</div>';
			break;
		case 'checkbox':
			if( $default && ! metadata_exists( 'post', wdes_popup_get_post(), $_name ) ) :
				$value 	= $default;
			endif;
			printf( '<div id="%s" class="wdes-table %s"%s>', $table_id, $table, $tablestyle );
			printf( '<div class="wdes-cell h4">%s</div>', $name );
			if( $style == 'on-off' ){
				printf(
					'<div class="%s"><input type="%s" name="%s" id="%s" class="wdes-popup %s" data-class="%s" value="%s" %s /><i>%s</i></div>',
					$cell, $type, $_name, $slug, $style, $dataclass, $value, checked( 1, $value, false ), $desc
				);
			}
			if( $style == 'multiple' ){
				printf( '<div class="%s"><i>%s</i><br /><br />', $cell, $desc );
				foreach( $options as $option ){
					$checked = in_array( $option, (array)$value ) ? 'checked="checked"' : ''; //  checked="checked"
					printf(
						'<label> <input type="%s" name="%s[]" id="%s" class="checkbox-%s %s" value="%s" %s /> %s</label>',
						$type, $_name, $slug, wdes_popup_return_slug( $option ), $input, $option, $checked, $option
					);
				}
				echo '</div>';
			}
			echo '</div>';
			break;
		case 'select':
			$closeiconnotice = '';
			$window = wdes_popup_meta( wdes_popup_get_post(), 'popup_window_style' );
			printf( '<div id="%s" class="wdes-table %s"%s>', $table_id, $table, $tablestyle );
			printf( '<div class="wdes-cell h4">%s</div>', $name );
			printf(
				'<div class="%s">%s<select name="%s" id="%s" class="wdes-popup %s">',
				$cell, $closeiconnotice, $_name, $slug, $input
			);
			if( $select == 'icon-layout' ){
				foreach( $iconlayout as $item ){
					printf(
						'<option value="%s"%s>%s</option>',
						wdes_popup_return_slug( $item ),
						selected( $value, wdes_popup_return_slug( $item ), false ),
						wdes_popup( $item )
					);
				}
			}
			if( $select == 'font-weight' ){
				foreach( $fw as $item ){
					$value = $value ? $value : $default;
					printf( '<option value="%s"%s>%s</option>', $item, selected( $value, $item, false ), wdes_popup( $item ) );
				}
			}
			if( $select == 'nav-menus' ){
				$nav_menus = wp_get_nav_menus();
				$menu_locations = get_nav_menu_locations();
				$primary = $menu_locations['primary'];
				$value = $value ? $value : $primary;
				printf( '<option value="0"%s>%s</option>', selected( $value, 0, false ), wdes_popup( "Select a menus" ) );
				foreach ( (array) $nav_menus as $_nav_menu ){
					printf(
						'<option value="%s"%s>%s</option>',
						esc_attr( $_nav_menu->term_id ),
						selected( $value, $_nav_menu->term_id, false ),
						wdes_popup( esc_html( $_nav_menu->name ) )
					);
				}
			}
			if( $select == 'custom' ){
				foreach( $options as $option ){
					$value = $value ? $value : $default;
					$slug = wdes_popup_return_slug( $option );
					printf( '<option value="%s"%s>%s</option>', $slug, selected( $value, $slug, false ), wdes_popup( $option ) );
				}
			}
			printf( '</select><i>%s</i><span class="wdes-popup-image-view"></span></div>', $desc );
			echo '</div>';
			break;
		case 'image':
			printf( '<div id="%s" class="wdes-table %s"%s>', $table_id, $table, $tablestyle );
			printf( '<div class="wdes-cell h4">%s</div>', $name );
			printf(
				'<div class="%s %s"><input type="text" name="%s" id="%s" class="wdes-popup %s" value="%s" size="70" placeholder="No file chosen" />',
				$cell, $slug, $_name, $slug, $input, $value
			);
			printf(
				'<input class="wdes-popup wdes-change-image button" type="button" data-id="%s" value="%s">',
		 		$slug, $submit_1
			);
			printf(
				'<input class="wdes-popup wdes-clear-value button" type="button" data-id="%s" value="%s">',
		 		$slug, wdes_popup( 'Clear' )
			);
			printf(
				'<i>%s</i></div>',
		 		$desc
			);
			echo '</div>';
			break;
		case 'heading':
			printf(
				'</div><h4 class="wdes-table wdes-h4 %s">%s</h4><div class="wdes-toggle-content %s" style="display:%s;">',
				$active, $name, $slug, $display
			);
			break;
		case 'html':
			printf( '<div id="%s" class="wdes-table %s"%s>', $table_id, $table, $tablestyle );
			if( $name ) :
				printf( '<div class="wdes-cell h4">%s</div>', $name );
			endif;
			if( $desc ) :
				printf(
					'<div class="%s">%s</div>',
					$cell, $desc
				);
			endif;
			echo '</div>';
			break;
	}
	return	ob_get_clean();
}

function wdes_popup_fields( $fields ) {
	foreach( $fields as $field ) {
		echo wdes_popup_field( $field );
	}
}