<?php
	add_action( 'vc_before_init', 'liven_vc_soc_icons_integrateWithVC' );
	function liven_vc_soc_icons_integrateWithVC() {
		add_shortcode( 'liven_vc_soc_icons', 'liven_vc_soc_icons_func' );
		function liven_vc_soc_icons_func( $atts, $content = null ) {
   			extract( shortcode_atts( array(
				'css' => '',					
				'facebook' => '',
				'twitter' => '',
				'gplus' => '',
				'linkedin' => '',
				'spacing' => '',
				'liven_soc_icons_animation' => '',
				'liven_soc_icons_animation_type' => 'fadeInDown',
				'liven_soc_icons_el_class' => '',
				'css' => ''	  			
   			), $atts ));
			
			$anim = '';
			$pg_content ='';	
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, '' ));	
			$uniqueID = uniqid();
			
			if($liven_soc_icons_animation == 'true'){
				$anim = 'wow '.$liven_soc_icons_animation_type;
			}			
			$GLOBALS['pg_content'].= '.soc-icons'.$uniqueID.' a{ margin: 10px '.$spacing.'px 0 }';
			
			if($facebook !='')
				$fb = '<a href="'.$facebook.'" class="facebook"></a>';
			else
				$fb = '';
				
			if($twitter !='')
				$twitter = '<a href="'.$twitter.'" class="twitter"></a>';
			else
				$twitter = '';
				
			if($gplus !='')
				$gplus = '<a href="'.$gplus.'" class="gplus"></a>';
			else
				$gplus = '';
				
			if($linkedin !='')
				$linkedin = '<a href="'.$linkedin.'" class="linkedin"></a>';
			else
				$linkedin = '';
				
			$pg_content .= '<div class="'.$css_class.' icn-social '.$liven_soc_icons_el_class.' soc-icons'.$uniqueID.' '.$anim.'">'.$fb.$twitter.$gplus.$linkedin.'</div>';
			
			return $pg_content;
		}
		class WPBakeryShortCode_liven_vc_soc_icons extends WPBakeryShortCode {
		}		
		
		vc_map(array(
		    'name' => esc_html__('Liven Social Icons', 'liven') ,
    		'base' => 'liven_vc_soc_icons',
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
			'content_element' => true,
			'show_settings_on_create' => true,
			'is_container' => true,
			'category' => esc_html__('Liven Extensions', 'liven') ,
			'description' => esc_html__('Place information about Service', 'liven') ,
		    'params' => array(							
				array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Facebook', 'liven') ,
		            'param_name' => 'facebook',
	    	    ),
				array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Twitter', 'liven') ,
		            'param_name' => 'twitter',
	    	    ),
				array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Google Plus', 'liven') ,
		            'param_name' => 'gplus',
	    	    ),
				array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('LinkedIn', 'liven') ,
		            'param_name' => 'linkedin',
	    	    ),
				array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Spacing', 'liven') ,
		            'param_name' => 'spacing',
					'description' => esc_html__( 'Space between two icons in px.', 'liven' ),
	    	    ),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Apply Animation?', 'liven' ),
					'param_name' => 'liven_soc_icons_animation',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'CSS Animation', 'liven' ),
					'description' => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'liven' ),
					'param_name' => 'liven_soc_icons_animation_type',
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
						'element' => 'liven_soc_icons_animation',
						'value' => 'true',
					),
				),
				array(
    		        'type' => 'textfield',
        		    'heading' => esc_html__('Extra Class Name', 'liven') ,
	        	    'param_name' => 'liven_soc_icons_el_class',
	        	    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
		    	),
				//====================================================================================
				array(
					'type' => 'css_editor',
					'heading' => esc_html__( 'Css', 'liven' ),
					'param_name' => 'css',
					'group' => esc_html__( 'Design options', 'liven' ),
				),														
			) ,
			
		));		
	}