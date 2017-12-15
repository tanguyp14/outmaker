<?php
	add_action( 'vc_before_init', 'liven_counter_integrateWithVC' );
	function liven_counter_integrateWithVC() {
		add_shortcode( 'liven_counter_base', 'liven_counter_base_function' );
		function liven_counter_base_function( $atts, $content = null ) {
   			extract( shortcode_atts( array(
      			'liven_counter_number' => '',
      			'liven_counter_color' => '',
	      		'liven_counter_image_icon' => 'icon',
	      		'liven_counter_icon_class' => 'folder-open',
	      		'liven_counter_icon_color' => '',
	      		'liven_counter_image_url' => '',
	      		'liven_counter_text' => '',
	      		'liven_counter_text_color' => '',
	      		'liven_counter_alignment' => 'text-left',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',
	      		'liven_counter_el_class' => '',
				'css' => ''
   			), $atts ));
			
			$pg_content = $anim = '';
			$u_id = uniqid();			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, '' ));
			
			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}		
			$GLOBALS['pg_content'].= '
								.liven_counter_icon_color_class'.$u_id.'{
									color:'.$liven_counter_icon_color.';
								}
								.liven_counter_color_class'.$u_id.'{
									color:'.$liven_counter_color.';
								}
								.liven_counter_text_color_class'.$u_id.'{
									color:'.$liven_counter_text_color.';
								}
							';
			
			$pg_content .= 	'<div class="'.$liven_counter_alignment.' number-counter '.$css_class.' '.$anim.' '.$liven_counter_el_class.'">';
								if($liven_counter_image_icon == "icon"){
					$pg_content .=	'<i class="fa-3x '.$liven_counter_icon_class.' liven_counter_icon_color_class'.$u_id.'"></i>';
								}
								else if($liven_counter_image_icon == "image"){
									$imgArray= wp_get_attachment_image_src($liven_counter_image_url,'full');
											if(isset($imgArray[0])){
													$pg_content .=	'<img src="'.$imgArray[0].'" class="img-responsive">	';
											}		
								}
        		$pg_content .=	'<div class="clr"></div>
									<span class="counter liven_counter_color_class'.$u_id.'">'.$liven_counter_number.'</span>
									<p class="liven_counter_text_color_class'.$u_id.'">'.$liven_counter_text.'</p>
							</div>';
   			return $pg_content;
		}
		class WPBakeryShortCode_liven_counter_base extends WPBakeryShortCode {
		}

		vc_map(array(
	   		'name' => esc_html__('Liven Counter', 'liven') ,
	    	'base' => 'liven_counter_base',
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
		    'category' => esc_html__('Liven Extensions', 'liven') ,
    		'params' => array(
	    		array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Total Counts', 'liven') ,
		            'param_name' => 'liven_counter_number',
	       			'description' => esc_html__('Enter only integer value. ', 'liven'),
	       		),
	       		array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Counter Color', 'liven' ),
					'param_name' => 'liven_counter_color',
					'description' => esc_html__( 'Select color for counter.', 'liven' ),
					'std' => '#000',
				),
	    	    array(
	            	'type' => 'dropdown',
		            'heading' => esc_html__('Image Or Icon', 'liven') ,
	    	        'param_name' => 'liven_counter_image_icon',
					'std' => 'icon',
    	    	    'value' => array(
	            	    esc_html__( 'Icon', 'liven' )  => 'icon',
    	            	esc_html__( 'Image', 'liven' ) => 'image',
    	            ),
    	    	),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__('Select Icon:', 'liven'),
					'param_name' => 'liven_counter_icon_class',
					'std' => 'folder-open',
					'dependency' => array(
						'element' => 'liven_counter_image_icon',
						'value' => 'icon'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),	
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'liven' ),
					'param_name' => 'liven_counter_icon_color',
					'description' => esc_html__( 'Select color for icon.', 'liven' ),
					'std' => '#000',
					'dependency' => array(
						'element' => 'liven_counter_image_icon',
						'value' => 'icon'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
	    	    array(
					'type' => 'attach_image',
        	    	'heading' => esc_html__('Image', 'liven'),
                	'holder' => 'div',
    	            'param_name' => 'liven_counter_image_url',
    	            'dependency' => array(
						'element' => 'liven_counter_image_icon',
						'value' => 'image'
					)
				),
				array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Text', 'liven') ,
		            'param_name'  => 'liven_counter_text',
	       			'description' => esc_html__('Enter text for counter.', 'liven'),
	       			'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Text Color', 'liven' ),
					'param_name' => 'liven_counter_text_color',
					'description' => esc_html__( 'Select color for text.', 'liven' ),
					'std' => '#000',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
    	        array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Text Alignment', 'liven' ),
					'description' => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'liven' ),
					'param_name' => 'liven_counter_alignment',
					'value' => array(
						esc_html__( 'Left', 'liven' ) => 'text-left',
						esc_html__( 'Center', 'liven' ) => 'text-center',
						esc_html__( 'Right', 'liven' ) => 'text-right',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Apply Animation?', 'liven' ),
					'param_name' => 'liven_animation',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'CSS Animation', 'liven' ),
					'description' => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'liven' ),
					'param_name' => 'liven_animation_type',
					'std' => 'fadeInDown',
					'dependency' => array(
						'element' => 'liven_animation',
						'value' => 'true',
					),		
					'value' => array(
						esc_html__( 'Bounce', 'liven' ) => 'bounce',
						esc_html__( 'Flash', 'liven' ) => 'flash',
						esc_html__( 'Pulse', 'liven' ) => 'pulse',
						esc_html__( 'Rubber Band', 'liven' ) => 'rubberBand',
						esc_html__( 'Shake', 'liven' ) => 'shake',
						esc_html__( 'Swing', 'liven' ) => 'swing',
						esc_html__( 'Tada', 'liven' ) => 'tada',
						esc_html__( 'Wobble', 'liven' ) => 'wobble',
						esc_html__( 'Bounce In', 'liven' ) => 'bounceIn',
						esc_html__( 'Bounce In Down', 'liven' ) => 'bounceInDown',
						esc_html__( 'Bounde In Left', 'liven' ) => 'bounceInLeft',
						esc_html__( 'Bounce In Right', 'liven' ) => 'bounceInRight',
						esc_html__( 'Bounce In Up', 'liven' ) => 'bounceInUp',
						esc_html__( 'Bounce Out', 'liven' ) => 'bounceOut',
						esc_html__( 'Bounce Out Down', 'liven' ) => 'bounceOutDown',
						esc_html__( 'Bounce Out Left', 'liven' ) => 'bounceOutLeft',
						esc_html__( 'Bounce Out Right', 'liven' ) => 'bounceOutRight',
						esc_html__( 'Bounce Out Up', 'liven' ) => 'bounceOutUp',
						esc_html__( 'Fade In', 'liven' ) => 'fadeIn',
						esc_html__( 'Fade In Down', 'liven' ) => 'fadeInDown',
						esc_html__( 'Fade In Down Big', 'liven' ) => 'fadeInDownBig',
						esc_html__( 'Fade In Left', 'liven' ) => 'fadeInLeft',
						esc_html__( 'Fade In Left Big', 'liven' ) => 'fadeInLeftBig',
						esc_html__( 'Fade In Right', 'liven' ) => 'fadeInRight',
						esc_html__( 'Fade In Right Big', 'liven' ) => 'fadeInRightBig',
						esc_html__( 'Fade In Up', 'liven' ) => 'fadeInUp',
						esc_html__( 'Fade In Up Big', 'liven' ) => 'fadeInUpBig',
						esc_html__( 'Fade Out', 'liven' ) => 'fadeOut',
						esc_html__( 'Fade Out Down', 'liven' ) => 'fadeOutDown',
						esc_html__( 'Fade Out Down Big', 'liven' ) => 'fadeOutDownBig',
						esc_html__( 'Fade Out Left', 'liven' ) => 'fadeOutLeft',
						esc_html__( 'Fade Out Left Big', 'liven' ) => 'fadeOutLeftBig',
						esc_html__( 'Fade Out Right', 'liven' ) => 'fadeOutRight',
						esc_html__( 'Fade Out Right Big', 'liven' ) => 'fadeOutRightBig',
						esc_html__( 'Fade Out Up', 'liven' ) => 'fadeOutUp',
						esc_html__( 'Fade Out Up Big', 'liven' ) => 'fadeOutUpBig',
						esc_html__( 'Flip In X', 'liven' ) => 'flipInX',
						esc_html__( 'Flip In Y', 'liven' ) => 'flipInY',
						esc_html__( 'Flip Out X', 'liven' ) => 'flipOutX',
						esc_html__( 'Flip Out Y', 'liven' ) => 'flipOutY',
						esc_html__( 'Light Speed In', 'liven' ) => 'lightSpeedIn',
						esc_html__( 'Light Speed Out', 'liven' ) => 'lightSpeedOut',
						esc_html__( 'Rotate In', 'liven' ) => 'rotateIn',
						esc_html__( 'Rotate In Down Left', 'liven' ) => 'rotateInDownLeft',
						esc_html__( 'Rotate In Down Right', 'liven' ) => 'rotateInDownRight',
						esc_html__( 'Rotate In Up Left', 'liven' ) => 'rotateInUpLeft',
						esc_html__( 'Rotate In Up Right', 'liven' ) => 'rotateInUpRight',
						esc_html__( 'Rotate Out', 'liven' ) => 'rotateOut',
						esc_html__( 'Rotate Out Down Left', 'liven' ) => 'rotateOutDownLeft',
						esc_html__( 'Rotate Out Down Right', 'liven' ) => 'rotateOutDownRight',
						esc_html__( 'Rotate Out Up Left', 'liven' ) => 'rotateOutUpLeft',
						esc_html__( 'Rotate Out Up Right', 'liven' ) => 'rotateOutUpRight',
						esc_html__( 'Slide In Down', 'liven' ) => 'slideInDown',
						esc_html__( 'Slide In Left', 'liven' ) => 'slideInLeft',
						esc_html__( 'Slide In Right', 'liven' ) => 'slideInRight',
						esc_html__( 'Slide Out Left', 'liven' ) => 'slideOutLeft',
						esc_html__( 'Slide Out Right', 'liven' ) => 'slideOutRight',
						esc_html__( 'Slide Out Up', 'liven' ) => 'slideOutUp',
						esc_html__( 'Slide In Up', 'liven' ) => 'slideInUp',
						esc_html__( 'Slide Out Down', 'liven' ) => 'slideOutDown',
						esc_html__( 'Hinge', 'liven' ) => 'hinge',
						esc_html__( 'Roll In', 'liven' ) => 'rollIn',
						esc_html__( 'Roll Out', 'liven' ) => 'rollOut',
						esc_html__( 'Zoom In', 'liven' ) => 'zoomIn',
						esc_html__( 'Zoom In Down', 'liven' ) => 'zoomInDown',
						esc_html__( 'Zoom In Left', 'liven' ) => 'zoomInLeft',
						esc_html__( 'Zoom In Right', 'liven' ) => 'zoomInRight',
						esc_html__( 'Zoom In Up', 'liven' ) => 'zoomInUp',
						esc_html__( 'Zoom Out', 'liven' ) => 'zoomOut',
						esc_html__( 'Zoom Out Down', 'liven' ) => 'zoomOutDown',
						esc_html__( 'Zoom Out Left', 'liven' ) => 'zoomOutLeft',
						esc_html__( 'Zoom Out Right', 'liven' ) => 'zoomOutRight',
						esc_html__( 'Zoom Out Up', 'liven' ) => 'zoomOutUp',						
					),					
				),
				array(
    		        'type' => 'textfield',
        		    'heading' => esc_html__('Extra Class Name', 'liven') ,
	        	    'param_name' => 'liven_counter_el_class',
	        	    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
		    	),
				//==========================================================================================
				array(
					'type' => 'css_editor',
					'heading' => esc_html__( 'Css', 'liven' ),
					'param_name' => 'css',
					'group' => esc_html__( 'Design options', 'liven' ),
				),
			)
		));
	}