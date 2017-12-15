<?php
	add_action( 'vc_before_init', 'liven_progressbar_integrateWithVC' );
	function liven_progressbar_integrateWithVC() {
		add_shortcode( 'liven_progressbar_base', 'liven_progressbar_base_function' );
		function liven_progressbar_base_function( $atts ) {
   			extract( shortcode_atts( array(
      			'liven_progressbar_number' => '',
      			'liven_progressbar_add_text' => 'false',
      			'liven_progressbar_title' => '',
      			'liven_progressbar_text_position' => 'top', 
      			'liven_progressbar_text_align' => 'left',
      			'liven_progressbar_text_color' => '#000000',
      			'liven_progressbar_add_icon' => '',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',
				'el_class' => '',
      			'liven_progressbar_icon_class' => '',
      			'liven_progressbar_foreground_color' => '#009cff',
      			'liven_progressbar_background_color' => '#f5f5f5',
      		), $atts ));
			
      		$pg_content = $anim = '';
      		$uniqueID = uniqid();
			$liven_progressbar_number = intval(preg_replace('/[^0-9]+/', '', $liven_progressbar_number), 10);
							
			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}			

			if($liven_progressbar_add_icon == 'true'){
      			$icon_display = '<i class="'.$liven_progressbar_icon_class.'"></i>';
			}			
      		$GLOBALS['pg_content'].= '
      							.pBar'.$uniqueID.'{      								
									background-color: '.$liven_progressbar_background_color.';
      							}
								.pBar'.$uniqueID.' .move{
									background: '.$liven_progressbar_foreground_color.' 
								}
								.pBar'.$uniqueID.' .progressbar{
									color: '.$liven_progressbar_text_color.';
									text-align: '.$liven_progressbar_text_align.';
								}
      						';
			
			if($liven_progressbar_add_text == 'true'){
					
				if($liven_progressbar_text_position == 'top'){				
					$pg_content .= '<div class="progressbar-2 '.$anim.' '.$el_class.'">
									<div class="progressbase pBar'.$uniqueID.'">
									  <div class="progressbar-blue p-blue-1 move text-'.$liven_progressbar_text_align.'" role="progressbar" aria-valuenow="'.$liven_progressbar_number.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$liven_progressbar_number.'%"> <span class="progressbar">'.$icon_display.$liven_progressbar_title.' <strong>'.$liven_progressbar_number.'%</strong></span> </div>
									</div><div class="clr"></div>
									</div>';
						
				}elseif($liven_progressbar_text_position == 'inside'){				
					$pg_content .= '<div class="progressbase progressbar-1 pBar'.$uniqueID.' '.$anim.'">
									  <div class="'.$el_class.' progressbar-blue move text-'.$liven_progressbar_text_align.'" role="progressbar" aria-valuenow="'.$liven_progressbar_number.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$liven_progressbar_number.'%"><span class="progressbar">'.$icon_display.$liven_progressbar_title.' <strong>'.$liven_progressbar_number.'%</strong></span></div></div>';
						
				}elseif($liven_progressbar_text_position == 'bottom'){				
					$pg_content .= '<div class="'.$anim.' '.$el_class.' progressbar-3"><div class="progressbase pBar'.$uniqueID.'">
									  <div class="progressbar-blue move text-'.$liven_progressbar_text_align.'" role="progressbar" aria-valuenow="'.$liven_progressbar_number.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$liven_progressbar_number.'%"> <span class="progressbar">'.$icon_display.$liven_progressbar_title.' <strong>'.$liven_progressbar_number.'%</strong></span> </div>
									</div></div>';						
				}
				
			}else{
					$pg_content .= '<div class="'.$anim.' '.$el_class.' progressbase pBar'.$uniqueID.'">
								  <div class="progressbar-blue move" role="progressbar" aria-valuenow="'.$liven_progressbar_number.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$liven_progressbar_number.'%"></div>
								</div>';
			}
			
			return $pg_content;
		}

		vc_map(array(
	   		'name' => esc_html__('Liven Progress Bar', 'liven') ,
	    	'base' => 'liven_progressbar_base',
		    'category' => esc_html__('Liven Extensions', 'liven') ,
    		'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
    		'admin_enqueue_js' => array(get_template_directory_uri().'/static/js/vc_custom_js/liven_vc_element.js'),
    		'params' => array(
	    		array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Progress Bar Count', 'liven') ,
		            'param_name' => 'liven_progressbar_number',
	       			'description' => esc_html__('Enter only integer value in percentage. ', 'liven'),
					'admin_label' => true,
	       		),
	       		array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Add Text?', 'liven' ),
					'param_name' => 'liven_progressbar_add_text',
					'std' => 'false',
				),
	       		array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Progress Bar Title', 'liven') ,
		            'param_name' => 'liven_progressbar_title',
	       			'description' => esc_html__('Enter Progress Bar Title.', 'liven'),
					'admin_label' => true,
	       			'dependency' => array(
						'element' => 'liven_progressbar_add_text',
						'value' => 'true'
					)
	       		),				
	       		array(
	            	'type' => 'dropdown',
		            'heading' => esc_html__('Text Position', 'liven') ,
	    	        'param_name' => 'liven_progressbar_text_position',
    	    	    'value' => array(
	            	    esc_html__( 'Above Progress Bar', 'liven' )  => 'top',
    	            	esc_html__( 'Inside Progress Bar', 'liven' )  => 'inside',
    	            	esc_html__( 'Below Progress Bar', 'liven' )  => 'bottom',
    	            ),
    	            'dependency' => array(
						'element' => 'liven_progressbar_add_text',
						'value' => 'true'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
    	    	),
    	    	array(
	            	'type' => 'dropdown',
		            'heading' => esc_html__('Text Alignment', 'liven') ,
	    	        'param_name' => 'liven_progressbar_text_align',
    	    	    'value' => array(
						esc_html__( 'Left', 'liven' )   => 'left',
						esc_html__( 'Center', 'liven' ) => 'center',
						esc_html__( 'Right', 'liven' )  => 'right',
					),
					'dependency' => array(
						'element' => 'liven_progressbar_add_text',
						'value' => 'true'
		    		),
		    		'edit_field_class' => 'vc_col-sm-6 vc_column',
    	    	),	       		
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Add icon?', 'liven' ),
					'param_name' => 'liven_progressbar_add_icon',
					'dependency' => array(
						'element' => 'liven_progressbar_add_text',
						'value' => 'true'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__('Select Icon:', 'liven'),
					'param_name' => 'liven_progressbar_icon_class',					
					'description' => esc_html__('Select the icon from the list.', 'liven'),
					'dependency' => array(
						'element' => 'liven_progressbar_add_icon',
						'value' => 'true'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
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
	        	    'param_name' => 'el_class',
	        	    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
		    	),//========================================================================================================
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Content Color', 'liven' ),
					'param_name' => 'liven_progressbar_text_color',
					'description' => esc_html__( 'Select color for text.', 'liven' ),
					'std' => '#000000',
					'group' => esc_html__( 'Design Options', 'liven' ),					
				),  	   
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Progress Bar Foreground Color', 'liven' ),
					'param_name' => 'liven_progressbar_foreground_color',
					'description' => esc_html__( 'Select front color for progress bar.', 'liven' ),
					'std' => '#009cff',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Progress Bar Background Color', 'liven' ),
					'param_name' => 'liven_progressbar_background_color',
					'description' => esc_html__( 'Select bg color for progress bar.', 'liven' ),
					'std' => '#f5f5f5',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
			)
		));
	}