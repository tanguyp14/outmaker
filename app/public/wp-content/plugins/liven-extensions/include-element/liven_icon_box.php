<?php
	add_action( 'vc_before_init', 'liven_vc_icon_box_integrateWithVC' );
	function liven_vc_icon_box_integrateWithVC() {
		add_shortcode( 'liven_vc_icon_box', 'liven_vc_icon_box_func' );
		
		function liven_vc_icon_box_func( $atts, $content = null ) {
   			extract( shortcode_atts( array(	
				'icon'							=> '',
				'icon_color'					=> '#009cff',
				'icon_bg_color'					=> 'transparent',
				'box_cnt_color'					=> '#dddddd',
				'box_bg_color'					=> 'transparent',
				'box_border_color'				=> '#666666',
				'liven_icon_box_animation' 		=> '',
				'liven_icon_box_animation_type' => 'fadeInDown',
				'el_class'                      => '',
				'facebook'						=> '',
				'twitter'						=> '',
				'gplus'							=> '',
				'linkedin'						=> '',
				'spacing'						=> '5',
				'css'							=> ''
   			), $atts ));
			
			$uniqueID = uniqid();
			$anim = '';
			$pg_content ='';
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, '' ));			
			$mspacing = intval(preg_replace('/[^0-9]+/', '', $spacing), 10);

			$soc_icon = '';
			if($facebook !='')
				$soc_icon .= '<a href="'.$facebook.'" class="facebook"></a>';
			else
				$soc_icon .= '';
				
			if($twitter !='')
				$soc_icon .= '<a href="'.$twitter.'" class="twitter"></a>';
			else
				$soc_icon .= '';
				
			if($gplus !='')
				$soc_icon .= '<a href="'.$gplus.'" class="gplus"></a>';
			else
				$soc_icon .= '';
				
			if($linkedin !='')
				$soc_icon .= '<a href="'.$linkedin.'" class="linkedin"></a>';
			else
				$soc_icon .= '';
						
			$GLOBALS['pg_content'].= '							
									.ib'.$uniqueID.' .footerinfo { border-color: '.$box_border_color.'; background: '.$box_bg_color.'; color:'.$box_cnt_color.'}
									.ib'.$uniqueID.' .footerinfo p, .ib'.$uniqueID.' .footerinfo a { color:'.$box_cnt_color.' }
									.ib'.$uniqueID.' .footerinfo-icn.fa { background: '.$icon_bg_color.'; color:'.$icon_color.'}
									.soc-icons'.$uniqueID.' a{ margin: 10px '.$mspacing.'px 0 }
						   		';
			if($liven_icon_box_animation == 'true'){
				$anim = $liven_icon_box_animation_type;
			}
								
			$pg_content  .= '<div class="ib'.$uniqueID.' '.$css_class.' wow '.$anim.' '.$el_class.'">
							  <div class="footerinfo"> <i class="footerinfo-icn '.$icon.' fa-2x "></i>'.$content;
			if($soc_icon != ''){
				$pg_content  .= '<div class="icn-social soc-icons'.$uniqueID.'">'.$soc_icon.'</div>';
			}
			$pg_content  .=  '</div>							  
							</div>';

			return $pg_content;
		}
		class WPBakeryShortCode_liven_vc_icon_box extends WPBakeryShortCode {
		}
		
		
		
		vc_map(array(
			'name' => esc_html__( 'Liven Icon Box', 'liven' ),
			'base' => 'liven_vc_icon_box',
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
			'content_element' => true,
			'show_settings_on_create' => true,
			'is_container' => true,
			'category' => esc_html__('Liven Extensions', 'liven') ,
			'params' => array(
				array(
					'type' => 'iconpicker',
					'heading' =>esc_html__('Select Icon:', 'liven'),
					'param_name' => 'icon',
					'admin_label' => true,
					'description' => esc_html__('Select the icon from the list.', 'liven'),
				),				
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'liven' ),
					'param_name' => 'icon_color',
					'std' => '#009cff',
                    'edit_field_class' => 'vc_col-sm-6 vc_column',

				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Background Color', 'liven' ),
					'param_name' => 'icon_bg_color',
					'std' => 'transparent',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'heading' => esc_html__('Table HTML content.', 'liven') ,
					'param_name' => 'content',
					'description' => esc_html__('Insert box content here.', 'liven'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Box Content Color', 'liven' ),
					'param_name' => 'box_cnt_color',
					'std' => '#ffffff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),				
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Box Border Color', 'liven' ),
					'param_name' => 'box_border_color',
					'std' => '#666666',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Apply Animation?', 'liven' ),
					'param_name' => 'liven_icon_box_animation',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'CSS Animation', 'liven' ),
					'description' => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'liven' ),
					'param_name' => 'liven_icon_box_animation_type',
					'std' => 'fadeInDown',
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
					'dependency' => array(
						'element' => 'liven_icon_box_animation',
						'value' => 'true',
					),
				),		
				array(
    		        'type' => 'textfield',
        		    'heading' => esc_html__('Extra Class Name', 'liven') ,
	        	    'param_name' => 'el_class',
	        	    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
		    	),
				//=========================================================================================				
				array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Facebook', 'liven') ,
		            'param_name' => 'facebook',
					'group' => esc_html__( 'Social Links', 'liven' ),
	    	    ),
				array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Twitter', 'liven') ,
		            'param_name' => 'twitter',
					'group' => esc_html__( 'Social Links', 'liven' ),
	    	    ),
				array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Google Plus', 'liven') ,
		            'param_name' => 'gplus',
					'group' => esc_html__( 'Social Links', 'liven' ),
	    	    ),
				array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('LinkedIn', 'liven') ,
		            'param_name' => 'linkedin',
					'group' => esc_html__( 'Social Links', 'liven' ),
	    	    ),
				array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Spacing', 'liven') ,
		            'param_name' => 'spacing',
					'group' => esc_html__( 'Social Links', 'liven' ),
					'description' => esc_html__( 'Space between two icons in px.', 'liven' ),
	    	    ),				
			)			
		));		
	}