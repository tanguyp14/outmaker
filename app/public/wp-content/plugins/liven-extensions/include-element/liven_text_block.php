<?php
	add_action( 'vc_before_init', 'liven_text_block_integrateWithVC' );
	function liven_text_block_integrateWithVC() {
		add_shortcode( 'liven_text_block_base', 'liven_text_block_base_function' );
		function liven_text_block_base_function( $atts, $content = null ) {
   			extract( shortcode_atts( array(
      			'liven_text_block_title' => '',
      			'heading' => 'h2',
				'liven_text_block_title_size' => '',
				'liven_text_block_title_alignment' => 'left',
				'liven_tb_title_upper' => '',
				'liven_tb_title_lspace' => '',
				'liven_text_block_title_color' => '#000',
				'liven_text_block_title_bg_color' => '',
				'liven_tb_title_padding' => '0px 0px 0px 0px',
				'liven_tb_title_cnt_space' => '20px',
				'liven_sec_cnt_width' => true,
				'liven_text_block_color' => '#333333',
				'liven_text_block_align' => 'text-left',
	      		'liven_text_block_animation' => '',
	      		'liven_text_block_animation_type' => 'fadeInDown',
	      		'liven_text_block_el_class' => '',
				'css' => ''	  ,    		
   			), $atts ));	
			
			$pg_content ='';
			$fSize = intval(preg_replace('/[^0-9]+/', '', $liven_text_block_title_size), 10);
			$liven_tb_title_cnt_space = intval(preg_replace('/[^0-9]+/', '', $liven_tb_title_cnt_space), 10);			
			$uniqueID = uniqid();
			$td_upper = $td_ls = $anim = $section_md = '';
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, '' ));
						
			if($liven_tb_title_upper == true) { $td_upper = 'uppercase'; }
			if($liven_tb_title_lspace == true) { $td_ls = '5px';	}
			if($liven_text_block_animation == true) { $anim = 'wow '.$liven_text_block_animation_type; }
			if($liven_sec_cnt_width != true){ $section_md = 'section-md'; }
			$GLOBALS['pg_content'].= '
								.tBox'.$uniqueID.' '.$heading.'{ font-size:'.$fSize.'px; color:'.$liven_text_block_title_color.'; text-transform:'.$td_upper.'; letter-spacing:'.$td_ls.'; margin:0 auto '.$liven_tb_title_cnt_space.'px; background-color:'.$liven_text_block_title_bg_color.'; padding:'.$liven_tb_title_padding.'; }
								.tBox'.$uniqueID.' .tBox-cnt, .tBox'.$uniqueID.' .tBox-cnt p{ color: '.$liven_text_block_color.'}
						   ';
						   
			
				$pg_content .=   '<div class="'.$section_md.' '.$css_class.' tBox'.$uniqueID.' '.$liven_text_block_el_class.' '.$anim.' text-'.$liven_text_block_title_alignment.' liven-tb">';
										if($liven_text_block_title != '')
										{
											$pg_content .= '<'.$heading.'>'.$liven_text_block_title.'</'.$heading.'>';
										}
										if($content != '')
										{
											$pg_content .= '<div class="tBox-cnt '.$liven_text_block_align.'">'.wpb_js_remove_wpautop(do_shortcode($content), true).'</div>';
										}
        			$pg_content .= '</div>';
			
   			return $pg_content;
		}
		class WPBakeryShortCode_liven_text_block_base extends WPBakeryShortCode {
		}

		vc_map(array(
	   		'name' => esc_html__('Liven Title Content', 'liven') ,
	    	'base' => 'liven_text_block_base',
		    'category' => esc_html__('Liven Extensions', 'liven') ,
    		'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
		    'description' => esc_html__('Adds styles to your text block element.', 'liven') ,
    		'params' => array(
	    		array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Title', 'liven') ,
		            'param_name' => 'liven_text_block_title',
	       			'description' => esc_html__('Enter title for text block.', 'liven'),
					'admin_label' => true,
	    	    ),
	    	    array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Select Heading Tag', 'liven' ),
					'param_name' => 'heading',
					'std' => 'h2',
					'value' => array(
						esc_html__( 'h1', 'liven' ) => 'h1',
						esc_html__( 'h2', 'liven' ) => 'h2',
						esc_html__( 'h3', 'liven' ) => 'h3',
						esc_html__( 'h4', 'liven' ) => 'h4',
						esc_html__( 'h5', 'liven' ) => 'h5',
						esc_html__( 'h6', 'liven' ) => 'h6',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title Font Size', 'liven' ),
					'param_name' => 'liven_text_block_title_size',
					'description' => 'Size will be measured in px.',	
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Title Alignment', 'liven' ),
					'param_name' => 'liven_text_block_title_alignment',
					'value' => array(
						esc_html__( 'Left', 'liven' )   => 'left',
						esc_html__( 'Center', 'liven' ) => 'center',
						esc_html__( 'Right', 'liven' )  => 'right',
					),
				),				
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Is Title Uppercase?', 'liven' ),
					'param_name' => 'liven_tb_title_upper',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Apply Letter Spacing?', 'liven' ),
					'param_name' => 'liven_tb_title_lspace',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Title Color', 'liven' ),
					'param_name' => 'liven_text_block_title_color',
					'std' => '#000',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Title Background Color', 'liven' ),
					'param_name' => 'liven_text_block_title_bg_color',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title Padding', 'liven' ),
					'param_name' => 'liven_tb_title_padding',
					'value' => '0px 0px 0px 0px',
					'description' => 'Size will be measured in px.',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title & Content Spacing', 'liven' ),
					'param_name' => 'liven_tb_title_cnt_space',
					'description' => 'Size will be measured in px.',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
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
					'heading' => esc_html__( 'Is Content Fullwidth?', 'liven' ),					
					'param_name' => 'liven_sec_cnt_width',
					'std' => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Text Box Content Color', 'liven' ),
					'param_name' => 'liven_text_block_color',
					'std' => '#333333',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Content Alignment', 'liven' ),
					'param_name' => 'liven_text_block_align',
					'value' => array(
						esc_html__( 'Left', 'liven' )   => 'text-left',
						esc_html__( 'Center', 'liven' ) => 'text-center',
						esc_html__( 'Right', 'liven' )  => 'text-right',
					),
				),
    		    array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Apply Animation?', 'liven' ),
					'param_name' => 'liven_text_block_animation',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'CSS Animation', 'liven' ),
					'description' => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'liven' ),
					'param_name' => 'liven_text_block_animation_type',
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
						esc_html__( 'Move', 'liven' ) => 'move',
					),
					'dependency' => array(
						'element' => 'liven_text_block_animation',
						'value' => 'true',
					),
				),				
				array(
    		        'type' => 'textfield',
        		    'heading' => esc_html__('Extra class name', 'liven') ,
	        	    'param_name' => 'liven_text_block_el_class',
	        	    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
		    	),
				//==============================================================================================================
				array(
					'type' => 'css_editor',
					'heading' =>esc_html__( 'Css', 'liven' ),
					'param_name' => 'css',
					'group' => esc_html__( 'Design options', 'liven' ),
				),
			)
		));				
	}