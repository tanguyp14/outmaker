<?php
    add_action( 'vc_before_init', 'liven_contact_form_integrateWithVC' );
    function liven_contact_form_integrateWithVC($contact_forms = array()) {
	    add_shortcode( 'liven_vc_contact_form', 'liven_vc_contact_form_func' );
        function liven_vc_contact_form_func( $atts, $content = null ) {
			extract( shortcode_atts( array(
	      		'contact_form' => '',				
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',	
				'contact_form_label_color' => '',
				'contact_form_txt_color' => '',
	      		'contact_form_bg_color' => '',
	      		'contact_form_border_color' => '',
	  		    'el_class' => '',
       		), $atts ));
			
			$anim = $pg_content = '';
			$uniqueID = uniqid();
			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}
			
			$GLOBALS['pg_content'].= '
							.form'.$uniqueID.' input[type="email"], .form'.$uniqueID.' input[type="text"], .form'.$uniqueID.' input[type="password"], .form'.$uniqueID.' select, .form'.$uniqueID.' textarea, .form'.$uniqueID.' input[type="tel"]{ color:'.$contact_form_txt_color.'; border-color:'.$contact_form_border_color.'; background-color:'.$contact_form_bg_color.'; } 
							.form'.$uniqueID.' label{ color:'.$contact_form_label_color.'; }
							.form'.$uniqueID.' .wpcf7-list-item span{ color:'.$contact_form_txt_color.'; }
						 ';
            $pg_content .=  '<div class="'.$el_class.' '.$anim.' form'.$uniqueID.' ">'.do_shortcode('[contact-form-7 id="'.__($contact_form,"liven").'"]').'</div>';
			
			return $pg_content;
        };			
        
        if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
            global $wpdb;
            $cfs = $wpdb->get_results( "SELECT ID,post_title FROM ".$wpdb->prefix."posts WHERE post_type='wpcf7_contact_form'");			
            $contact_forms = array();
            if ($cfs) {
                foreach ( $cfs as $cf ) {					
                    $contact_forms[esc_html($cf->post_title)] = $cf->ID;
                }
            } 
            else {
                $contact_forms["No forms found"] = 0;
            }
  
            vc_map(array(
                'name' => esc_html__('Liven Contact Forms', 'liven') ,
                'base' => 'liven_vc_contact_form',
                'category' => esc_html__('Liven Extensions', 'liven') ,
                'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
                'params' => array(                    				
			    	array(
				    	'type' => 'dropdown',
					    'heading' => esc_html__( 'Contact Forms', 'liven' ),
    					'param_name' => 'contact_form',
	    				'admin_label' => true,
		    			'value' => $contact_forms,
			    		'save_always' => true,
				    	'description' => esc_html__( 'Select your Contact Form.', 'liven' ),
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
			    		'heading' => esc_html__( 'Extra Class Name', 'liven' ),
				    	'param_name' => 'el_class',
    					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'liven' ),
	    			),
					
					//==========================================================================================================
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Label Color', 'liven' ),
						'param_name' => 'contact_form_label_color',
						'description' => esc_html__( 'Select label color in your contant form.', 'liven' ),
						'std' => '#000000',
						'group' => esc_html__( 'Design Options', 'liven' ),						
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'BG Color', 'liven' ),
						'param_name' => 'contact_form_bg_color',
						'description' => esc_html__( 'Select background color for contact form.', 'liven' ),
						'std' => '#ffffff',
						'group' => esc_html__( 'Design Options', 'liven' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Border Color', 'liven' ),
						'param_name' => 'contact_form_border_color',
						'description' => esc_html__( 'Select border color for contact form.', 'liven' ),
						'std' => '#dddddd',
						'group' => esc_html__( 'Design Options', 'liven' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Text Color', 'liven' ),
						'param_name' => 'contact_form_txt_color',
						'description' => esc_html__( 'Select text color for input boxes in contact form.', 'liven' ),
						'std' => '#333333',
						'group' => esc_html__( 'Design Options', 'liven' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Placeholder Color', 'liven' ),
						'param_name' => 'contact_form_ph_color',
						'description' => esc_html__( 'Select placeholder color for input boxes in contact form.', 'liven' ),
						'std' => '#999999',
						'group' => esc_html__( 'Design Options', 'liven' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
                )
            ));
        }
    }