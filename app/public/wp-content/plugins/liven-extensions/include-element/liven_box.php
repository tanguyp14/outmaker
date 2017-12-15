<?php
	add_action( 'vc_before_init', 'liven_box_integrateWithVC' );
	function liven_box_integrateWithVC() {
		add_shortcode( 'liven_box_base', 'liven_box_base_function' );
		function liven_box_base_function( $atts, $content = null ) {
   			extract( shortcode_atts( array(
      			'liven_box_title' => '',
      			'liven_box_title_color' => '#009cff',
      			'liven_box_style' => 'style1',
      			'liven_box_bg_color' => '#fff',
      			'liven_box_ptrn1_color' => '#fff',
      			'liven_box_ptrn2_color' => '#fff',
      			'liven_box_border' => '',
      			'liven_box_border_color' => '',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',
	      		'liven_box_el_class' => '',
	      		'liven_box_align' => 'left',
	      		'liven_box_button_text' => '',
	      		'link' => '',
	      		'size' => 'btn-small',
	      		'shape' => 'square',
	      		'box_button_bg_color' => '',
	      		'liven_box_button_text_color' => '',
	      		'liven_box_button_border_color' => '',
	      		'liven_box_button_hover_effect' => '',
	      		'liven_box_button_hover_bg_color' => '',
	      		'liven_box_button_hover_text_color' => '',
	      		'liven_box_button_hover_border_color' => '',
	      		'liven_button_add_icon' => '',
	      		'liven_button_i_align' => 'left'
   			), $atts )); 
			
   			$pg_content = $box_btn = $anim = '';
			$href = vc_build_link( $link );
   			$uniqueID = uniqid();
			
			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}
   			if($liven_box_border == 'true'){
   				$box_border = 'border:'.$liven_box_border_color.' 1px solid;';
   			}
   			else{
   				$box_border = 'border:none;';
   			}
   			$GLOBALS['pg_content'].= '.liven_button'.$uniqueID.'{ background:'.$box_button_bg_color.'; color:'.$liven_box_button_text_color.'; border:'.$liven_box_button_border_color.' 1px solid; } ';
			if($liven_box_button_hover_effect == 'true') {
				$GLOBALS['pg_content'].= ' .liven_button'.$uniqueID.':hover { background:'.$liven_box_button_hover_bg_color.'; color:'.$liven_box_button_hover_text_color.'; border:'.$liven_box_button_hover_border_color.' 1px solid; text-decoration:none;} ';
			}
   			if ($href['url']!= '' || $href['title']!= '') {
				if($liven_button_i_align == 'right'){
					$box_btn .=	'<a href="'.$href['url'].'" title="'.$href['title'].'" class=" '.$size.' liven_button'.$uniqueID.'" >'.$href['title'].' <i class="fa fa-1x fa fa-angle-right"></i></a>';
				}
				else{
					$box_btn .=	'<a href="'.$href['url'].'" title="'.$href['title'].'" class="'.$size.' liven_button'.$uniqueID.'" ><i class="fa fa-1x fa fa-angle-right"></i> '.$href['title'].'</a>';
				}
			}
   			
   			switch ($liven_box_style) {
   				case 'style1':
   				{
   					$pg_content .= 	'<div class="boxes liven_box_align '.$liven_box_el_class.' '.$anim.'" style="background-color:'.$liven_box_bg_color.'; text-align:'.$liven_box_align.'; '.$box_border.'">
		        						<h5 style="color:'.$liven_box_title_color.';">'.$liven_box_title.'</h5>
										<p>'.do_shortcode($content).'</p>'.$box_btn.'</div>';
   				}
   				break;
   				case 'style2':
   				{
   					$pg_content .= 	'<div class="boxes liven_box_align '.$liven_box_el_class.' '.$anim.'" style="background-color:'.$liven_box_bg_color.'; text-align:'.$liven_box_align.'; '.$box_border.'">
		        						<h5 style="color:'.$liven_box_title_color.';">'.$liven_box_title.'</h5>
										<p>'.do_shortcode($content).'</p>'.$box_btn.'
										<div class="boxes-pattern">
	        								<div class="pattern-2" style="border-bottom:'.$liven_box_ptrn2_color.' 30px solid;"></div>
											<div class="pattern-1" style="border-bottom:'.$liven_box_ptrn1_color.' 35px solid;"></div>
										</div>
      								</div>';
   				}
   				break;
   				case 'style3':
   				{
   					$pg_content .= 	'<div class="boxes liven_box_align '.$liven_box_el_class.' '.$anim.'" style="background-color:'.$liven_box_bg_color.'; text-align:'.$liven_box_align.'; '.$box_border.'">
		        						<h5 style="color:'.$liven_box_title_color.';">'.$liven_box_title.'</h5>
										<p>'.do_shortcode($content).'</p>'.$box_btn.'
										<div class="boxes-pattern">
	        								<div class="pattern-2" style="border-bottom:'.$liven_box_ptrn2_color.' 30px solid;"></div>
											<div class="pattern-1" style="border-bottom:'.$liven_box_ptrn1_color.' 35px solid;"></div>
										</div>
      								</div>';
   				}
   				break;
   			}
   			return $pg_content;
		}

		vc_map(array(
	    	'name' => esc_html__('Liven Box', 'liven') ,
	    	'base' => 'liven_box_base',
		    'category' => esc_html__('Liven Extensions', 'liven') ,
    		'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
    		'params' => array(
	    		array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Title Line', 'liven') ,
		            'param_name' => 'liven_box_title',
    		        'admin_label' => true,
	    	    ),
	    	    array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Title Color', 'liven' ),
					'param_name' => 'liven_box_title_color',
					'std' => '#009cff',
				),
    		    array(
	    	        'type' => 'textarea_html',
    	    	    'holder' => 'div',
		            'heading' => esc_html__( 'Content', 'liven' ),
    		        'param_name' => 'content',
        		    'description' => esc_html__( 'Enter your content.', 'liven' )
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
					'dependency'  => array(
						'element' => 'liven_animation',
						'value'   => 'true',
					),		
					'value'       => array(
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
	        	    'param_name'  => 'liven_box_el_class',
	        	    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
		        ), 
				//=============================================================================================
		        array(
	            	'type' => 'dropdown',
		            'heading' => esc_html__('Box Alignment', 'liven') ,
	    	        'param_name' => 'liven_box_align',
    	    	    'value' => array(
	            	    esc_html__( 'Left', 'liven' ) => 'left',
	            	    esc_html__( 'Center', 'liven' ) => 'center',
	            	    esc_html__( 'Right', 'liven' ) => 'right',
	            	),
	            	'group' => esc_html__( 'Design Options', 'liven' ),
    	    	),
	    	    array(
	            	'type' => 'dropdown',
		            'heading' => esc_html__('Style', 'liven') ,
	    	        'param_name' => 'liven_box_style',
    	    	    'value' => array(
	            	    esc_html__( 'BG Color', 'liven' ) => 'style1',
    	            	esc_html__( 'BG Pattern', 'liven' ) => 'style2',
    	            	esc_html__( 'BG Color with Pattern', 'liven' ) => 'style3',
    	            ),
	            	'group' => esc_html__( 'Design Options', 'liven' ),
    	    	),
    	    	array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'liven' ),
					'param_name' => 'liven_box_bg_color',
					'description' => esc_html__( 'Select background color for your element.', 'liven' ),
					'std' => '#fff',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'dependency' => array(
						'element' => 'liven_box_style',
						'value' => array('style1' ,'style3')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Pattern 1 Color', 'liven' ),
					'param_name' => 'liven_box_ptrn1_color',
					'description' => esc_html__( 'Select pattern color for your element.', 'liven' ),
					'std' => '#fff',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency' => array(
						'element' => 'liven_box_style',
						'value' => array('style2' ,'style3')
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Pattern 2 Color', 'liven' ),
					'param_name' => 'liven_box_ptrn2_color',
					'description' => esc_html__( 'Select pattern color for your element.', 'liven' ),
					'std' => '#fff',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency' => array(
						'element' => 'liven_box_style',
						'value' => array('style2' ,'style3')
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Add border?', 'liven' ),
					'param_name' => 'liven_box_border',
					'group' => esc_html__( 'Design Options', 'liven' )
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'liven' ),
					'param_name' => 'liven_box_border_color',
					'description' => esc_html__( 'Select border color for your element.', 'liven' ),
					'std' => '#fff',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'dependency'  => array(
						'element' => 'liven_box_border',
						'value' => 'true'
					),
				),
				//=============================================================================================				
				array(
					'type' => 'vc_link',
					'heading' => esc_html__( 'URL (Link)', 'liven' ),
					'param_name' => 'link',
					'description' => esc_html__( 'Add link to button.', 'liven' ),
					'group' => esc_html__( 'Button', 'liven' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Size', 'liven' ),
					'param_name' => 'size',
					'description' => esc_html__( 'Select button display size.', 'liven' ),
					'std' => 'btn-regular',
					'value' => array(
						esc_html__( 'Mini', 'liven' )   => 'btn-small',
						esc_html__( 'Small', 'liven' )  => 'btn-regular',
						esc_html__( 'Normal', 'liven' ) => 'btn-mid',
						esc_html__( 'large', 'liven' )  => 'btn-large'
					),
					'group' => esc_html__( 'Button', 'liven' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Shape', 'liven' ),
					'description' => esc_html__( 'Select button shape.', 'liven' ),
					'param_name' => 'shape',
					'value' => array(
						esc_html__( 'Rounded', 'liven' ) => 'rounded',
						esc_html__( 'Square', 'liven' )  => 'square',
					),
					'group' => esc_html__( 'Button', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'BG Color', 'liven' ),
					'param_name' => 'box_button_bg_color',
					'description' => esc_html__( 'Select background color for button.', 'liven' ),
					'std' => '#fff',
					'group' => esc_html__( 'Button', 'liven' ),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Text Color', 'liven' ),
					'param_name' => 'liven_box_button_text_color',
					'description' => esc_html__( 'Select text color for button.', 'liven' ),
					'std' => '#000',
					'group' => esc_html__( 'Button', 'liven' ),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'liven' ),
					'param_name' => 'liven_box_button_border_color',
					'description' => esc_html__( 'Select border color for button.', 'liven' ),
					'std' => '#000',
					'group' => esc_html__( 'Button', 'liven' ),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Hover effect?', 'liven' ),
					'param_name' => 'liven_box_button_hover_effect',
					'group' => esc_html__( 'Button', 'liven' )
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Hover BG Color', 'liven' ),
					'param_name' => 'liven_box_button_hover_bg_color',
					'description' => esc_html__( 'Select hover background color for button.', 'liven' ),
					'std' => '#fff',
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
					'param_name' => 'liven_box_button_hover_text_color',
					'description' => esc_html__( 'Select hover text color for button.', 'liven' ),
					'std' => '#000',
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
					'param_name' => 'liven_box_button_hover_border_color',
					'description' => esc_html__( 'Select hover border color for button.', 'liven' ),
					'std' => '#000',
					'group' => esc_html__( 'Button', 'liven' ),
					'dependency' => array(
						'element' => 'liven_box_button_hover_effect',
						'value' => 'true',
					),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Add icon?', 'liven' ),
					'param_name' => 'liven_button_add_icon',
					'group' => esc_html__( 'Button', 'liven' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Alignment', 'liven' ),
					'description' => esc_html__( 'Select icon alignment.', 'liven' ),
					'param_name' => 'liven_button_i_align',
					'value' => array(
						esc_html__( 'Left', 'liven' )  => 'left',
						esc_html__( 'Right', 'liven' ) => 'right',
					),
					'dependency' => array(
						'element' => 'liven_button_add_icon',
						'value' => 'true',
					),
					'group' => esc_html__( 'Button', 'liven' )
				),
			)
		));
	}
?>