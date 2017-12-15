<?php
	add_action( 'vc_before_init', 'liven_vc_section_integrateWithVC' );
	function liven_vc_section_integrateWithVC() {
		add_shortcode( 'liven_vc_section', 'liven_vc_sec_func' );
		function liven_vc_sec_func( $atts, $content = null ) {
   			extract( shortcode_atts( array(	
				'section_title'	=> '',
				'liven_sec_title_heading_tag' => 'h2',
				'section_title_size' => '',
				'sec_title_align' => 'left',
				'sec_content' => '',
				'sec_cnt_align' => 'center',
				'liven_sec_cnt_width' => '',
				'liven_sec_is_container' => '',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',
				'id' => '',			
	  			'el_class' => '',
				'title_color' => '',
				'title_bg_color' => '',
				'des_color'	=> '',	
				'liven_sec_overlay'	=> '',		
					
   			), $atts ));
			
			$pg_content ='';
			$container = $section_md = $anim = '';
			$uniqueID = uniqid();
			$heading = $liven_sec_title_heading_tag;
			$fsize = intval(preg_replace('/[^0-9]+/', '', $section_title_size), 10);
			
			if($liven_animation == true){ $anim = 'wow '.$liven_animation_type; }
			if($liven_sec_cnt_width != true){ $section_md = 'section-md'; }
			if($liven_sec_is_container == true){ $container = 'container'; }
			
			$GLOBALS['pg_content'].= '
								.sec-cnt'.$uniqueID.' '.$heading.' span, .sec-cnt'.$uniqueID.' h1 span{color:'.$title_color.'; font-size:'.$fsize.'px; background:'.$title_bg_color.'} 
								.sec-cnt'.$uniqueID.', .sec-cnt'.$uniqueID.' p{ color:'.$des_color.'; text-align:'.$sec_cnt_align.'; }																						
						  ';
			
			
				$pg_content .=	'<section '.(($id!='')?('id="'.$id.'"'):('')).' class="'.$container.' '.$el_class.'  sec-tran '.$anim.'" >';
				if($section_title != '' && $sec_content != ''){
					$pg_content .=	'<div class="sec-cnt'.$uniqueID.'"><'.$heading.' class="text-'.$sec_title_align.'"><span>'.$section_title.'</span></'.$heading.'><div class="'.$section_md.'">'.do_shortcode($sec_content).'</div></div>';
				}
					$pg_content .=	'<div>'.do_shortcode($content).'</div>
								</section>';
			return $pg_content;
		}
		
		vc_map(array(
		    'name' => esc_html__('Liven Section', 'liven') ,
    		'base' => 'liven_vc_section',
			'content_element' => true,
			'is_container' => true,
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
			'category' => esc_html__('Liven Extensions', 'liven') ,
			'description' => esc_html__('Place content elements inside the section', 'liven') ,
		    'params' => array(
				array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Section Title', 'liven') ,
		            'param_name' => 'section_title',
	       			'description' => esc_html__('This is display as Section Title at front side', 'liven'),
	    	    ),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Select Heading Tag', 'liven' ),
					'param_name' => 'liven_sec_title_heading_tag',
					'std' => 'h2',	
					'value' => array(
						esc_html__( 'h1', 'liven' ) => 'h1',
						esc_html__( 'h2', 'liven' ) => 'h2',
						esc_html__( 'h3', 'liven' ) => 'h3',
						esc_html__( 'h4', 'liven' ) => 'h4',
						esc_html__( 'h5', 'liven' ) => 'h5',
						esc_html__( 'h6', 'liven' ) => 'h6',
					),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Section Title Size', 'liven') ,
		            'param_name' => 'section_title_size',
	       			'description' => esc_html__('Size unit will be in px.', 'liven'),
	       			'edit_field_class' => 'vc_col-sm-4 vc_column',
	    	    ),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Section Title Alignment', 'liven' ),
					'param_name' => 'sec_title_align',
					'std' => 'left',
					'value' => array(						
						esc_html__( 'Left', 'liven' )   => 'left',
						esc_html__( 'Center', 'liven' ) => 'center',
						esc_html__( 'Right', 'liven' )  => 'right',
					),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),								
				array(
	    	        'type' => 'textarea',
		            'heading' => esc_html__( 'Section Content', 'liven' ),
    		        'param_name' => 'sec_content',        		    
    		    ),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Is Content Fullwidth?', 'liven' ),
					'param_name' => 'liven_sec_cnt_width',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Section Content Alignment', 'liven' ),
					'description' => esc_html__( 'Select section content alignment.', 'liven' ),
					'param_name' => 'sec_cnt_align',
					'std' => 'center',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'value' => array(						
						esc_html__( 'Left', 'liven' )   => 'left',
						esc_html__( 'Center', 'liven' ) => 'center',
						esc_html__( 'Right', 'liven' )  => 'right',
					),										
				),				
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Use As Fullwidth Overlay Section?', 'liven' ),
					'param_name' => 'liven_sec_is_container',
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
						'element' => 'liven_animation',
						'value' => 'true',
					),
				),          		
		        array(
		            'type' => 'textfield',
    		        'heading' => esc_html__('Section ID', 'liven') ,
        		    'param_name' => 'id',
            		'description' => esc_html__('This option comes handy when you are creating One page scroll website and here you can set ID which you used in your navigation anchor tag.', 'liven')
		        ) ,
	        	array(
    	        	'type' => 'textfield',
    	    	    'heading' => esc_html__('Extra Class Name', 'liven') ,
	            	'param_name' => 'el_class',
	       		    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'liven')
    		    ) ,
				//======================= Design Option ===========================================
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Section Title Color', 'liven' ),
					'param_name' => 'title_color',
					'description' => esc_html__( 'Select title color for your section.', 'liven' ),
					'std' => '#FFF',
					'group' => esc_html__( 'Design Options', 'liven' ),					
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Section Title Background Color', 'liven' ),
					'param_name' => 'title_bg_color',
					'description' => esc_html__( 'Select title background color for your section.', 'liven' ),
					'std' => 'transparent',
					'group' => esc_html__( 'Design Options', 'liven' ),	
					'edit_field_class' => 'vc_col-sm-6 vc_column',				
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Section Description Color', 'liven' ),
					'param_name' => 'des_color',
					'description' => esc_html__( 'Select description color for your section.', 'liven' ),
					'std' => '#FFF',
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),				
			) ,
			'js_view' => 'VcColumnView'
		));
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_liven_vc_section extends WPBakeryShortCodesContainer {
			}
		}
	}