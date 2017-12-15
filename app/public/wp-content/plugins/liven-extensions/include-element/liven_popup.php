<?php
	add_action( 'vc_before_init', 'liven_vc_popup_integrateWithVC' );
	function liven_vc_popup_integrateWithVC() {
		add_shortcode( 'liven_vc_popup', 'liven_vc_popup_func' );
		function liven_vc_popup_func( $atts, $content = null ) {
   			extract( shortcode_atts( array(	
				'popup_title' => '',				
				'popup_btn_text' => '',
				'pop_id' => '',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',					
	  			'el_class' => '',
				'btn_size' => '',
				'shape' => '',
				'btn_bg_color' => '#000',
				'btn_text_color' => '#fff',
				'btn_border_color' => '#000',
				'btn_hover_effect' => '',
				'btn_h_bg_color' => '#000',
				'btn_h_text_color' => '#fff',
				'btn_h_border_color' => '#000',
				'btn_add_icon' => '',
				'btn_i_align' => 'left',
				'popup_title_color' => '#fff',
				'popup_title_bg_color' => '#009cff'
   			), $atts ));
			
			$anim = '';
			$uniqueID = uniqid();
			$pg_content ='';
			
			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}
			if($shape=='rounded'){
				$GLOBALS['pg_content'].= '
								.pop'.$uniqueID.' button{ border-radius:5px}
						  ';
			}else{
				$GLOBALS['pg_content'].= '
								.pop'.$uniqueID.' button{ border-radius:0px}
						  ';
			}
			if($pop_id != ''){
				$pop_id = 'id="'.$pop_id.'"';
			}	
			$GLOBALS['pg_content'].= '
								.pop'.$uniqueID.' { display:inline-block; }
								.pop'.$uniqueID.' .liven-btn{ background-color:'.$btn_bg_color.'; color:'.$btn_text_color.'; border:1px solid '.$btn_border_color.'}
								.pop'.$uniqueID.' .liven-btn:hover, .pop'.$uniqueID.' .liven-btn:focus{ background-color:'.$btn_h_bg_color.'; color:'.$btn_h_text_color.'; border:1px solid '.$btn_h_border_color.'}
								#pp'.$uniqueID.'{ color:'.$popup_title_color.'; }
								.pp-header'.$uniqueID.'{ background-color:'.$popup_title_bg_color.'; }
						   ';
		
			if($btn_add_icon=='true' && $btn_i_align=='left'){
				$pg_content .=	'<div '.$pop_id.' class="'.$el_class.' pop'.$uniqueID.' '.$anim.'">
									<button type="button" class="liven-btn '.$btn_size.'" data-toggle="modal" data-target="#'.$uniqueID.'"><i class="fa fa-1x-after fa-angle-right"></i> '.$popup_btn_text.'</button>
								</div>';
			}elseif($btn_add_icon=='true' && $btn_i_align=='right'){
				$pg_content .=	'<div '.$pop_id.' class="'.$el_class.' pop'.$uniqueID.' '.$anim.'">
									<button type="button" class="liven-btn '.$btn_size.'" data-toggle="modal" data-target="#'.$uniqueID.'">'.$popup_btn_text.' <i class="fa fa-1x-after fa-angle-right"></i></button>
								</div>';
			}else{
				$pg_content .=	'<div '.$pop_id.' class="'.$el_class.' pop'.$uniqueID.' '.$anim.'">
									<button type="button" class="liven-btn '.$btn_size.'" data-toggle="modal" data-target="#'.$uniqueID.'">'.$popup_btn_text.'</button>
								</div>';
			}
			$pg_content .=  '<div class="modal fade" id="'.$uniqueID.'" tabindex="-1" role="dialog" aria-labelledby="pp'.$uniqueID.'" aria-hidden="true">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header pp-header'.$uniqueID.'">
									  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close icons-white"></i></span></button>
									  <h4 class="modal-title " id="pp'.$uniqueID.'">'.$popup_title.'</h4>
									</div>
									<div class="modal-body">'.do_shortcode($content).'</div>
									</div>
								  </div>
								</div>';
			
			return $pg_content;
		}
		
		vc_map(array(
		    'name' => esc_html__('Liven Popup', 'liven') ,
    		'base' => 'liven_vc_popup',
			'content_element' => true,
			'show_settings_on_create' => true,
			'is_container' => true,
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
			'category' => esc_html__('Liven Extensions', 'liven') ,
			'description' => esc_html__('Place content elements inside the popup', 'liven') ,
		    'params' => array(
				array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Popup Title', 'liven') ,
		            'param_name' => 'popup_title',
	       			'description' => esc_html__('This is display as Popup Title at front side', 'liven')
	    	    ),				
				 array(
	    	        'type' => 'textarea_html',
    	    	    'holder' => 'div',
		            'heading' => esc_html__( 'Content', 'liven' ),
    		        'param_name' => 'content', 
        		    'description' => esc_html__( 'Enter your popup content.', 'liven' )
    		    ),																	        		
		        array(
		            'type' => 'textfield',
    		        'heading' => esc_html__('Popup ID', 'liven') ,
        		    'param_name' => 'pop_id',
            		'description' => esc_html__('This option comes handy when you are creating One page scroll website and here you can set ID which you used in your navigation anchor tag.', 'liven')
		        ) ,
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
	            	'param_name' => 'el_class',
	       		    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'liven')
    		    ) ,							
				//==========================================================================================================
				array(
    	        	'type' => 'textfield',
    	    	    'heading' => esc_html__('Popup Buton Text', 'liven') ,
	            	'param_name' => 'popup_btn_text',
	       		    'description' => esc_html__('This is display as button title at front side.', 'liven'),
					'group' => esc_html__( 'Button', 'liven' ),
    		    ) ,
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Buton Size', 'js_composer' ),
					'param_name' => 'btn_size',
					'description' => esc_html__( 'Select button display size.', 'liven' ),
					'std' => 'btn-regular',
					'value' => array(
						esc_html__( 'Small', 'liven' ) => 'btn-regular',
						esc_html__( 'Mini', 'liven' ) => 'btn-small',						
						esc_html__( 'Normal', 'liven' ) => 'btn-mid',
						esc_html__( 'large', 'liven' ) => 'btn-large'
					),
					'group' => esc_html__( 'Button', 'liven' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Shape', 'liven' ),
					'description' => esc_html__( 'Select button shape.', 'liven' ),
					'param_name' => 'shape',
					'std' => 'square',
					'value' => array(						
						esc_html__( 'Square', 'liven' ) => 'square',
						esc_html__( 'Rounded', 'liven' ) => 'rounded',
					),
					'group' => esc_html__( 'Button', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'BG Color', 'liven' ),
					'param_name' => 'btn_bg_color',
					'description' => esc_html__( 'Select background color for button.', 'liven' ),
					'group' => esc_html__( 'Button', 'liven' ),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Text Color', 'liven' ),
					'param_name' => 'btn_text_color',
					'description' => esc_html__( 'Select text color for button.', 'liven' ),
					'group' => esc_html__( 'Button', 'liven' ),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'liven' ),
					'param_name' => 'btn_border_color',
					'description' => esc_html__( 'Select border color for button.', 'liven' ),
					'group' => esc_html__( 'Button', 'liven' ),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Hover Effect?', 'liven' ),
					'param_name' => 'liven_box_button_hover_effect',
					'group' => esc_html__( 'Button', 'liven' )
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Hover BG Color', 'liven' ),
					'param_name' => 'btn_h_bg_color',
					'description' => esc_html__( 'Select hover background color for button.', 'liven' ),
					'group' => esc_html__( 'Button', 'liven' ),
					'dependency' => array(
						'element' => 'liven_box_button_hover_effect',
						'value' => 'true',
					),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Hover Text Color', 'liven' ),
					'param_name' => 'btn_h_text_color',
					'description' => esc_html__( 'Select hover text color for button.', 'liven' ),
					'group' => esc_html__( 'Button', 'liven' ),
					'dependency' => array(
						'element' => 'liven_box_button_hover_effect',
						'value' => 'true',
					),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Hover Border Color', 'liven' ),
					'param_name' => 'btn_h_border_color',
					'description' => esc_html__( 'Select hover border color for button.', 'liven' ),
					'group' => esc_html__( 'Button', 'liven' ),
					'dependency' => array(
						'element' => 'liven_box_button_hover_effect',
						'value' => 'true',
					),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Add Icon?', 'liven' ),
					'param_name' => 'btn_add_icon',
					'group' => esc_html__( 'Button', 'liven' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Alignment', 'liven' ),
					'description' => esc_html__( 'Select icon alignment.', 'liven' ),
					'param_name' => 'btn_i_align',
					'value' => array(
						esc_html__( 'Left', 'liven' )  => 'left',
						esc_html__( 'Right', 'liven' ) => 'right',
					),
					'dependency' => array(
						'element' => 'btn_add_icon',
						'value' => 'true',
					),
					'group' => esc_html__( 'Button', 'liven' )
				),
				//================================================================================================
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Popup Title Color', 'liven' ),
					'param_name' => 'popup_title_color',
					'description' => esc_html__( 'Select title color for your popup.', 'liven' ),
					'std' => '#ffffff',
					'group' => esc_html__( 'Design Options', 'liven' ),					
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Popup Title Background Color', 'liven' ),
					'param_name' => 'popup_title_bg_color',
					'description' => esc_html__( 'Select title background color for your popup.', 'liven' ),
					'std' => '#009cff',
					'group' => esc_html__( 'Design Options', 'liven' ),					
				),				
			) ,
			
		));		
	}