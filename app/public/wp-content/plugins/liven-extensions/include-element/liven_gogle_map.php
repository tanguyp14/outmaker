<?php	
	add_action( 'vc_before_init', 'liven_vc_gmap_integrateWithVC' );

	function liven_vc_gmap_integrateWithVC() {
		add_shortcode( 'liven_vc_gmap', 'liven_vc_gmap_func' );
		function liven_vc_gmap_func( $atts, $content = null ) {
   			extract( shortcode_atts( array(
				'map_input_style' => 'gmap',
				'map_latitude' => '',
				'map_longitude' => '',
				'map_zoom' => '',	
				'map_height' => '',
				'gmap_el_class' => '',
   			), $atts ));
			
			$pg_content = '';
			$uniqueID = uniqid();
			$map_height = intval(preg_replace('/[^0-9]+/', '', $map_height), 10);
			
			$pg_content ='<div id="'.$map_input_style.$uniqueID.'" class="mapstyle" data-latitude="'.$map_latitude.'" data-longitude="'.$map_longitude.'"   data-zoom="'.$map_zoom.'" style="height:'.$map_height.'px"></div>';
			return $pg_content;
		}
		class WPBakeryShortCode_liven_vc_gmap extends WPBakeryShortCode {
		}
		
		vc_map(array(
		    'name' => esc_html__('Liven Google Map', 'liven') ,
    		'base' => 'liven_vc_gmap',
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
			'content_element' => true,
			'show_settings_on_create' => true,
			'category' => esc_html__('Liven Extensions', 'liven') ,
		    'params' => array(
				array(
	            	'type' => 'dropdown',
		            'heading' => esc_html__('Map Style', 'liven') ,
	    	        'param_name' => 'map_input_style',
    	    	    'value' => array(
	            	    esc_html__( 'Gray', 'liven' ) => 'gmap',
	            	    esc_html__( 'Dark Gray', 'liven' ) => 'dgmap',
	            	    esc_html__( 'Blue', 'liven' ) => 'bmap',
	            	),
    	    	),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Map Latitude', 'liven' ),
					'param_name' => 'map_latitude',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Map Longitude', 'liven' ),
					'param_name' => 'map_longitude',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Zoom Level', 'liven' ),
					'param_name' => 'map_zoom',
				),	
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Map Height', 'liven' ),
					'param_name' => 'map_height',
				),	
							
				array(
    		        'type' => 'textfield',
        		    'heading' => esc_html__('Extra Class Name', 'liven') ,
	        	    'param_name' => 'gmap_el_class',
	        	    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
		    	),
			) ,
			
		));		
	}