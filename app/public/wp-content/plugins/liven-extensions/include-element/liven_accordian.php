<?php
	add_action( 'vc_before_init', 'liven_vc_accordian_integrateWithVC' );
	function liven_vc_accordian_integrateWithVC() {
		add_shortcode( 'liven_vc_accordian', 'liven_vc_accordian_func' );
		function liven_vc_accordian_func( $atts, $content = null ) {
   			extract( shortcode_atts( array(	
				'liven_accordian' => '',
				'liven_accordian_display_style'	=> 'style1',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',				
				'liven_accordian_el_class' => '',
				'accordian_title_color' => '#009cff',
				'accordian_titlehover_color' => '#000',
				'accordian_title_bg_color' => '#f1f1f1',
				'accordian_title_bgh_color' => '#e5e5e5',
				'accordian_title_border_color' => '#cccccc',			
   			), $atts ));
			
			$uniqueID = uniqid();
			$liven_accordian=(array) vc_param_group_parse_atts( $liven_accordian );					
			$pg_content = $anim = '';
			
			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}
			$GLOBALS['pg_content'].= '.acc'.$uniqueID.' .acc-btn h1{ color:'.$accordian_title_color.'; background-color:'.$accordian_title_bg_color.'; }
							  .acc'.$uniqueID.' .acc-btn:hover h1, .acc'.$uniqueID.' .acc-btn h1.selected { color:'.$accordian_titlehover_color.'; background-color:'.$accordian_title_bgh_color.'; }
							  .acc'.$uniqueID.' .acc-btn h1 .plus-sign { color:'.$accordian_title_color.'; }
							  .acc'.$uniqueID.' .acc-btn:hover h1 .plus-sign { color:'.$accordian_titlehover_color.'; }
							  .acc'.$uniqueID.' .acc-btn h1.selected .plus-sign { color:'.$accordian_titlehover_color.'; }
							';
							
			if($liven_accordian_display_style == 'style1'){
				$GLOBALS['pg_content'].= '
							  .acc'.$uniqueID.' .acc-btn2 h1.selected { color:'.$accordian_titlehover_color.'; }
							  .acc'.$uniqueID.' .acc-btn2 h1 .plus-sign2 { color:'.$accordian_title_color.'; }
							  .acc'.$uniqueID.' .acc-btn2:hover h1 .plus-sign2 { color:'.$accordian_titlehover_color.'; }
							  .acc'.$uniqueID.' .acc-btn2 h1.selected .plus-sign2 { color:'.$accordian_titlehover_color.'; }
						';
						
				$pg_content .= '<div class="'.$liven_accordian_el_class.' acc-container acc'.$uniqueID.' '.$anim.'">';
								
								$count= 0;						
								foreach ( $liven_accordian as $k => $v ) {
											if(!isset($v['accordian_title'])){
													$v['accordian_title'] = '';	
												}
											if(!isset($v['accordian_content'])){
													$v['accordian_content'] = '';	
												}
								   	$count++;
									if($count == 1){ $default = 'open'; $selected = 'selected'; $icon = 'fa-minus'; }else{ $default = $selected = ''; $icon = 'fa-plus'; }
								   	$pg_content .='<div class="acc-btn">
													  <h1 class="'.$selected.'">'.$v['accordian_title'].'<span class="plus-sign pull-right"><i class="fa '.$icon.'"></i></span></h1>
													</div>
													<div class="acc-content '.$default.'">
													  <div class="acc-content-inner">'.$v['accordian_content'].'</div>
													</div>';										
								}
				$pg_content .= '</div>';
			}else{
				$GLOBALS['pg_content'].= '
							  .acc'.$uniqueID.' .acc-btn h1{ color:'.$accordian_title_color.'; background-color:'.$accordian_title_bg_color.'; }
							  .acc'.$uniqueID.' .acc-btn2 h1{ color:'.$accordian_title_color.'; border-color:'.$accordian_title_border_color.' }
							  .acc'.$uniqueID.' .acc-btn:hover h1, .acc'.$uniqueID.' .acc-btn h1.selected { color:'.$accordian_titlehover_color.'; background-color:'.$accordian_title_bgh_color.'; }
							  .acc'.$uniqueID.' .acc-btn2:hover h1, .acc'.$uniqueID.' .acc-btn2 h1.selected { color:'.$accordian_titlehover_color.'; }
							  .acc'.$uniqueID.' .acc-btn h1 .plus-sign, .acc'.$uniqueID.' .acc-btn2 h1 .plus-sign2 { color:'.$accordian_title_color.'; }
							  .acc'.$uniqueID.' .acc-btn:hover h1 .plus-sign, .acc'.$uniqueID.' .acc-btn2:hover h1 .plus-sign2 { color:'.$accordian_titlehover_color.'; }
							  .acc'.$uniqueID.' .acc-btn h1.selected .plus-sign, .acc'.$uniqueID.' .acc-btn2 h1.selected .plus-sign2 { color:'.$accordian_titlehover_color.'; }
							';
							
				$pg_content .= '<div id="acc" class="'.$liven_accordian_el_class.' acc-container acc'.$uniqueID.' '.$anim.'">';
								
								$count= 0;						
								foreach ( $liven_accordian as $k => $v ) {
									if(!isset($v['accordian_title'])){
													$v['accordian_title'] = '';	
												}
											if(!isset($v['accordian_content'])){
													$v['accordian_content'] = '';	
												}
								   	$count++;
									if($count == 1){ $default = 'open'; $selected = 'selected'; $icon = 'fa-minus'; }else{ $default = $selected = ''; $icon = 'fa-plus'; }
								   	$pg_content .='<div class="acc-btn2">
													  <h1 class="'.$selected.'"><span class="plus-sign2"><i class="fa '.$icon.'"></i></span>'.$v['accordian_title'].'</h1>
													</div>
													<div class="acc-content2 '.$default.'">
													  <div class="acc-content-inner2">'.$v['accordian_content'].'</div>
													</div>';										
								}
				$pg_content .= '</div>';
			} 
			return $pg_content;
		}
		class WPBakeryShortCode_liven_vc_accordian extends WPBakeryShortCode {
		}
		
		vc_map(array(
		    'name' => esc_html__('Liven Accordian', 'liven') ,
    		'base' => 'liven_vc_accordian',
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
			'content_element' => true,
			'show_settings_on_create' => true,
			'is_container' => true,
			'category' => esc_html__('Liven Extensions', 'liven') ,
		    'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Accordian Display Style', 'liven' ),
					'param_name' => 'liven_accordian_display_style',
					'std' => 'style1',
					'value' => array(
						esc_html__( 'Style 1', 'liven' ) => 'style1',
						esc_html__( 'Style 2', 'liven' ) => 'style2',
					),
				),
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Accordian', 'liven' ),
					'param_name' => 'liven_accordian',
					'value' => urlencode( json_encode( array(
						array(
							'accordian_title' => esc_html__( 'Accordian Title 1', 'liven' ),
							'accordian_content'	=> '',
						),
						array(
							'accordian_title' => esc_html__( 'Accordian Title 2', 'liven' ),
							'accordian_content'	=> '',
						),						
					) ) ),
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Accordian Title', 'liven' ),
							'param_name' => 'accordian_title',
							'description' => esc_html__( 'Enter individual accordian name.', 'liven' ),
							'admin_label' => true,
						),
						array(
							'type' => 'textarea',
							'holder' => 'div',
							'heading' => esc_html__( 'Accordian Content', 'liven' ),
							'param_name' => 'accordian_content', 
						),					  
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
					'dependency'  => array(
						'element' => 'liven_animation',
						'value'   => 'true',
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
	        	    'param_name' => 'liven_accordian_el_class',
	        	    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
		    	),
				//====================== Design options =============================================											
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Accordian Title Color', 'liven' ),
					'param_name' => 'accordian_title_color',
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),				
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Accordian Title Hover Color', 'liven' ),
					'param_name' => 'accordian_titlehover_color',
					'std' => '#000',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' 		=> esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Accordian Title Background Color', 'liven' ),
					'param_name' => 'accordian_title_bg_color',
					'std' => '#f1f1f1',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'dependency' => array(
						'element' => 'liven_accordian_display_style',
						'value' => 'style1'
					)
				),				
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Accordian Title Background Hover Color', 'liven' ),
					'param_name' => 'accordian_title_bgh_color',
					'std' => '#e5e5e5',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'dependency' => array(
						'element' => 'liven_accordian_display_style',
						'value' => 'style1'
					)
				),	
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Accordian Title Border Color', 'liven' ),
					'param_name' => 'accordian_title_border_color',
					'std' => '#cccccc',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'dependency' => array(
						'element' => 'liven_accordian_display_style',
						'value' => 'style2'
					)
				),																										
			) ,
			
		));		
}