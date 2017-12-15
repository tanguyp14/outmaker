<?php
	add_action( 'vc_before_init', 'liven_vc_service_integrateWithVC' );
	function liven_vc_service_integrateWithVC() {
		add_shortcode( 'liven_vc_service', 'liven_vc_service_func' );
		function liven_vc_service_func( $atts, $content = null ) {
   			extract( shortcode_atts( array(	
				'service_title' => '',
				'name_font_color' => '#000',
				'service_bg_color' => 'transparent',
				'service_icon' => 'cogs',
				'icon_color' => '',
				'link' => '',	  			
				'link_color' => '#009cff',
				'link_hover_color' => '#000',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',
				'el_class' => '',
				'display_style'	=> 'style1',
				'icon_bg_color'	=> 'transparent',
				'css' => ''
   			), $atts ));
			
			$pg_content = $anim = '';
			$uniqueID = uniqid();
			$href = vc_build_link( $link );
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, '' ));
			
			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}

			if($display_style == 'style1'){
				$GLOBALS['pg_content'].= '
								.sl'.$uniqueID.' .services-title { background: '.$service_bg_color.'; }
								.sl'.$uniqueID.' .services-title h3 { color: '.$name_font_color.' !important }
								.sl'.$uniqueID.' .servicesicn{ background: '.$icon_bg_color.'; color:'.$icon_color.'; }
								.sl'.$uniqueID.' .detail-link{ color:'.$link_color.'; }
								.sl'.$uniqueID.' .detail-link:hover { color:'.$link_hover_color.'; }									
							';								
				$pg_content .= '<div class="'.$css_class.' serviceslist sl'.$uniqueID.' '.$anim.' '.$el_class.'">
									<div class="servicestitle">
										<div class="servicesicn graycolor"><i class="'.$service_icon.' fa-3x "></i></div>
										<div class="services-title"><h3>'.$service_title.'</h3></div>
										<div class="clr"></div>
									</div>
									<p>'.$content.'</p>';
					if(!$link == ''){					
						$pg_content .=	'<p><a class="detail-link" href="'.$href['url'].'" target='.$href['target'].'>'.$href['title'].'</a></p>';
					}
				$pg_content .= '</div>';
			}else{
				$GLOBALS['pg_content'].= '
								.sl'.$uniqueID.' .servicestitle h3 { color: '.$name_font_color.' !important }
								.sl'.$uniqueID.' .style3icn{  color:'.$icon_color.';}
								.sl'.$uniqueID.' .detail-link{ color:'.$icon_color.';}
							';
				$pg_content .= '<div class="'.$css_class.' text-center serviceslist sl'.$uniqueID.' '.$anim.' '.$el_class.'">
									<div class="servicestitle">
										<div class="margin-bottom-10 style3icn"><i class="'.$service_icon.' fa-3x"></i></div>
										<div><h3>'.$service_title.'</h3></div>
										<div class="clr"></div>
									</div>
									<p>'.$content.'</p>';
					if(!$link == ''){					
						$pg_content .=	'<p><a class="detail-link" href="'.$href['url'].'" target='.$href['target'].'>'.$href['title'].'</a></p>';
					}
				$pg_content .= '</div>';
			}
			
			return $pg_content;
		}
		class WPBakeryShortCode_liven_vc_service extends WPBakeryShortCode {
		}
		
		vc_map(array(
		    'name' => esc_html__('Liven Service', 'liven') ,
    		'base' => 'liven_vc_service',
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
			'category' => esc_html__('Liven Extensions', 'liven') ,
			'description' => esc_html__('Place information about Service', 'liven') ,
		    'params' => array(
		        array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Display Style', 'liven' ),
					'param_name' => 'display_style',
					'description' => esc_html__( 'Select display style for service element at front side.', 'liven' ),
					'value' => array(
						esc_html__( 'Style 1', 'liven' ) => 'style1',
						esc_html__( 'Style 2', 'liven' ) => 'style2',									
					),
				),
				array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Service Name', 'liven') ,
		            'param_name' => 'service_title',
					'admin_label' => true,
	       			'description' => esc_html__('This is display as Service name.', 'liven')
	    	    ),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Service Name Font Color', 'liven' ),
					'param_name' => 'name_font_color',
					'std' => '#000',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),				
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Service Name Background Color', 'liven' ),
					'param_name' => 'service_bg_color',
					'std' => 'transparent',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__('Select Icon:', 'liven'),
					'param_name' => 'service_icon',
					'std' => 'cogs',
					'description' => esc_html__('Select the icon from the list.', 'liven'),
				),	
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Service Icon Color', 'liven' ),
					'param_name' => 'icon_color',
					'std' => '#000',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Service Icon Background Color', 'liven' ),
					'param_name' => 'icon_bg_color',
					'std' => 'transparent',
					'dependency' => array(
						'element' => 'display_style',
						'value' => 'style1',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),				
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'heading' => esc_html__('Table HTML content.', 'liven') ,
					'param_name' => 'content',
					'description' => esc_html__('Write service description here.', 'liven')
				) ,
				array(
					'type' => 'vc_link',
					'heading' => esc_html__( 'URL (Link)', 'liven' ),
					'param_name' => 'link',
					'description' => esc_html__( 'Add link to service detail.', 'liven' ),								
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Link Color', 'liven' ),
					'param_name' => 'link_color',
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Link Hover Color', 'liven' ),
					'param_name' => 'link_hover_color',
					'std' => '#000',
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
					'param_name'  => 'liven_animation_type',
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
				),											
				//=============================================== Design Options =======================================
				array(
					'type' => 'css_editor',
					'heading' => esc_html__( 'Css', 'liven' ),
					'param_name' => 'css',
					'group' => esc_html__( 'Design options', 'liven' ),
				),						
			) ,
			
		));		
	}