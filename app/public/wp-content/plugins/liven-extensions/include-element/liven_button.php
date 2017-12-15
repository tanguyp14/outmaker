<?php
	add_action( 'vc_before_init', 'liven_button_integrateWithVC' );
	function liven_button_integrateWithVC() {
		add_shortcode( 'liven_button_base', 'liven_button_base_function' );
		function liven_button_base_function( $atts ) {
   			extract( shortcode_atts( array(
				'button_title_size' => '15',
				'button_align' => 'left',
	      		'link' => '',	      			      		
	      		'box_button_bg_color' => '',
	      		'liven_box_button_text_color' => '',
	      		'liven_box_button_border_color' => '',
	      		'liven_box_button_hover_effect' => '',
	      		'liven_box_button_hover_bg_color' => '',
	      		'liven_box_button_hover_text_color' => '',
	      		'liven_box_button_hover_border_color' => '',
	      		'liven_button_add_icon' => '',
	      		'liven_button_i_align' => 'left',
				'liven_button_choose_icon' => 'fa fa-angle-right',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',
				'el_class' => '',
				'liven_button_add_tooltip' => '',				
				'liven_button_tooltip' => '',
				'button_tooltip_align' => 'tooltip-bottm',
				'liven_button_radius' => '0',
				'liven_button_padd_top' => '5',
				'liven_button_padd_right' => '5',
				'liven_button_padd_btm' => '5',
				'liven_button_padd_left' => '5',	
   			), $atts ));
   			
   			$href = vc_build_link( $link );
   			$uniqueID = uniqid();
			$pg_content = $cnt = $tclass = $ttitle = $anim = $target = '';
			$fsize = intval(preg_replace('/[^0-9]+/', '', $button_title_size), 10);
			$liven_button_radius = intval(preg_replace('/[^0-9]+/', '', $liven_button_radius), 10);
			$liven_button_padd_top = intval(preg_replace('/[^0-9]+/', '', $liven_button_padd_top), 10);
			$liven_button_padd_right = intval(preg_replace('/[^0-9]+/', '', $liven_button_padd_right), 10);
			$liven_button_padd_btm = intval(preg_replace('/[^0-9]+/', '', $liven_button_padd_btm), 10);
			$liven_button_padd_left = intval(preg_replace('/[^0-9]+/', '', $liven_button_padd_left), 10);
			
			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}				
			if($href['target'] != ''){
				$target = ''.$target.'';
			}			
			
   			$GLOBALS['pg_content'].= '
							.btn'.$uniqueID.'{
								text-align:'.$button_align.';
							} 
							.btn'.$uniqueID.' a{ 
								background:'.$box_button_bg_color.'; 
								color:'.$liven_box_button_text_color.'; 
								border:'.$liven_box_button_border_color.' 1px solid;
								font-size:'.$fsize.'px;
								border-radius:'.$liven_button_radius.'px;
								padding-top:'.$liven_button_padd_top.'px;
								padding-right:'.$liven_button_padd_right.'px;
								padding-bottom:'.$liven_button_padd_btm.'px;
								padding-left:'.$liven_button_padd_left.'px;								
							}';
			if($liven_button_add_tooltip == true){
				$ttitle = $liven_button_tooltip;
				$tclass = $button_tooltip_align;
			}else{
				$ttitle = $href['title'];
			}
			if($liven_box_button_hover_effect == 'true') {
				$GLOBALS['pg_content'].= ' .btn'.$uniqueID.' a:hover { background:'.$liven_box_button_hover_bg_color.'; color:'.$liven_box_button_hover_text_color.'; border:'.$liven_box_button_hover_border_color.' 1px solid; text-decoration:none;} ';
			}
			else{
				$GLOBALS['pg_content'].= ' .btn'.$uniqueID.' a:hover { background:'.$box_button_bg_color.'; color:'.$liven_box_button_text_color.'; border:'.$liven_box_button_border_color.' 1px solid; text-decoration:none;} ';
			}
			if($liven_button_add_icon == 'true'){
				if($liven_button_i_align == 'right'){
					$cnt =	'<a href="'.$href['url'].'" title="'.$ttitle.'" '.$target.' class="'.$tclass.'">'.$href['title'].' <i style="margin-left:5px;" class="'.$liven_button_choose_icon.'"></i></a>';				
				}
				else{
					$cnt =	'<a href="'.$href['url'].'" title="'.$ttitle.'" '.$target.' class="'.$tclass.'"> <i style="margin-right:5px;" class="'.$liven_button_choose_icon.'"></i>'.$href['title'].'</a>';
				}
			}
			else{
				$cnt =	'<a href="'.$href['url'].'" title="'.$ttitle.'" '.$target.' class="'.$tclass.'">'.$href['title'].'</a>';
			}
			$pg_content .= '<div class="btn'.$uniqueID.' liven-btn '.$el_class.' '.$anim.'">'.$cnt.'</div>'; 
			
			return $pg_content;
		}

		vc_map(array(
	    	'name' => esc_html__('Liven Button', 'liven') ,
	    	'base' => 'liven_button_base',
		    'category' => esc_html__('Liven Extensions', 'liven') ,
    		'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
    		'params' => array(
	    		array(
					'type' => 'vc_link',
					'heading' => esc_html__( 'Button Link', 'liven' ),
					'param_name' => 'link',
					'description' => esc_html__( 'Add link to button.', 'liven' ),
					'group' => esc_html__( 'Button', 'liven' ),
				),								
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Title Size', 'liven' ),
					'param_name' => 'button_title_size',
					'group' => esc_html__( 'Button', 'liven' ),
				),								
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Add Icon?', 'liven' ),
					'param_name' => 'liven_button_add_icon',
					'group' => esc_html__( 'Button', 'liven' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Alignment', 'liven' ),
					'description' => esc_html__( 'Select icon alignment.', 'liven' ),
					'param_name' => 'liven_button_i_align',
					'group' => esc_html__( 'Button', 'liven' ),
					'value' => array(
						esc_html__( 'Left', 'liven' ) => 'left',
						esc_html__( 'Right', 'liven' ) => 'right',
					),
					'dependency' => array(
						'element' => 'liven_button_add_icon',
						'value' => 'true',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'liven' ),
					'param_name' => 'liven_button_choose_icon',
					'group' => esc_html__( 'Button', 'liven' ),
					'std' => 'fa fa-angle-right',
					'dependency'  => array(
						'element' => 'liven_button_add_icon',
						'value'   => 'true',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Apply Animation?', 'liven' ),
					'param_name' => 'liven_animation',
					'group' => esc_html__( 'Button', 'liven' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'CSS Animation', 'liven' ),
					'description' => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'liven' ),
					'param_name' => 'liven_animation_type',
					'group' => esc_html__( 'Button', 'liven' ),
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
                    'param_name'  => 'el_class',
					'group' => esc_html__( 'Button', 'liven' ),
                    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
                ),
				//==========================================================================================================
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Add Tooltip?', 'liven' ),
					'param_name'  => 'liven_button_add_tooltip',
					'group' => esc_html__( 'Tooltip', 'liven' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Tooltip', 'liven' ),
					'param_name'  => 'liven_button_tooltip',
					'group' => esc_html__( 'Tooltip', 'liven' ),
					'dependency' => array(
						'element' => 'liven_button_add_tooltip',
						'value' => 'true',
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Tooltip Position', 'liven' ),
					'param_name' => 'button_tooltip_align',
					'group' => esc_html__( 'Tooltip', 'liven' ),
					'std' => 'bottom',
					'value' => array(						
						esc_html__( 'Bottom', 'liven' ) => 'tooltip-bottom',
						esc_html__( 'Top', 'liven' ) => 'tooltip-top',
						esc_html__( 'Left', 'liven' ) => 'tooltip-left',
						esc_html__( 'Right', 'liven' ) => 'tooltip-right',
					),
					'dependency' => array(
						'element' => 'liven_button_add_tooltip',
						'value' => 'true',
					),										
				),
				//==========================================================================================================
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Alignment', 'liven' ),
					'param_name' => 'button_align',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'std' => 'left',
					'value' => array(						
						esc_html__( 'Left', 'liven' ) => 'left',
						esc_html__( 'Center', 'liven' ) => 'center',
						esc_html__( 'Right', 'liven' ) => 'right',
					),										
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Border Radius', 'liven' ),
					'param_name' => 'liven_button_radius',
					'description' => esc_html__( 'Insert 0 for square button.', 'liven' ),
					'std' => '0',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Padding Top', 'liven' ),
					'param_name' => 'liven_button_padd_top',
					'std' => '5',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-3 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Padding Right', 'liven' ),
					'param_name' => 'liven_button_padd_right',
					'std' => '5',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-3 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Padding Bottom', 'liven' ),
					'param_name' => 'liven_button_padd_btm',
					'std' => '5',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-3 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Padding Left', 'liven' ),
					'param_name' => 'liven_button_padd_left',
					'std' => '5',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-3 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'BG Color', 'liven' ),
					'param_name' => 'box_button_bg_color',
					'description' => esc_html__( 'Select background color for button.', 'liven' ),
					'std' => '#fff',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
					
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Text Color', 'liven' ),
					'param_name' => 'liven_box_button_text_color',
					'description' => esc_html__( 'Select text color for button.', 'liven' ),
					'std' => '#000',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'liven' ),
					'param_name' => 'liven_box_button_border_color',
					'description' => esc_html__( 'Select border color for button.', 'liven' ),
					'std' => '#000',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Hover Effect?', 'liven' ),
					'param_name' => 'liven_box_button_hover_effect',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Hover BG Color', 'liven' ),
					'param_name' => 'liven_box_button_hover_bg_color',
					'description' => esc_html__( 'Select hover background color for button.', 'liven' ),
					'std' => '#fff',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
					'dependency' => array(
						'element' => 'liven_box_button_hover_effect',
						'value' => 'true',
					),
					
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Hover Text Color', 'liven' ),
					'param_name' => 'liven_box_button_hover_text_color',
					'description' => esc_html__( 'Select hover text color for button.', 'liven' ),
					'std' => '#000',
					'group' => esc_html__( 'Design Options', 'liven' ),
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
					'group' => esc_html__( 'Design Options', 'liven' ),
					'dependency' => array(
						'element' => 'liven_box_button_hover_effect',
						'value' => 'true',
					),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
			)
		));
	}