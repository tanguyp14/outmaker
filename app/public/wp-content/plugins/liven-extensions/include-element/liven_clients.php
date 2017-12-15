<?php
    add_action( 'vc_before_init', 'liven_clients_integrateWithVC' );
    function liven_clients_integrateWithVC() {
        add_shortcode( 'liven_vc_clients', 'liven_vc_clients_func' );
        function liven_vc_clients_func( $atts, $content = null ) {
   		    extract( shortcode_atts( array(
          		'liven_client_display_option' => 'slider',
          		'liven_clients' => '',
          		'liven_clients_count' => '-1',
          		'liven_clients_bg_color' => '',
          		'liven_clients_hover_bg_color' => '',
          		'liven_clients_border_color' => '',
          		'liven_clients_hover_border_color' => '',
          		'liven_clients_opacity' => '',
          		'liven_clients_hover_opacity' => '',
          		'liven_clients_margin' => '0px 0px 30px',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',
          		'el_class' => '',
       		), $atts ));
			
			$pg_content1 = $pg_content = $anim = $pg_content = $query_options = '';
			
	        if($liven_clients==''){
		        $query_options = array(		
    		        'post_type' => 'liven_clients',
    	    		'posts_per_page' =>  $liven_clients_count,
	    	    	'orderby' => 'post__in'
		    	);
    		}
	    	else{
   		        $query_options = array(		
			        'post__in' => explode(', ',esc_html($liven_clients)),	
                    'post_type' => 'liven_clients',
	        		'posts_per_page' => $liven_clients_count,
		        	'orderby' => 'post__in'
    		    );
    	    }
   			$query = get_posts($query_options);		
			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}	
            switch ($liven_client_display_option) {
		        case 'slider':
		        {
			        foreach ($query as $p) :
                        $liven_client_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'full');
                        $pg_content .=  '<div class="imgoverflow"> ';
											if(isset($liven_client_img_url[0]))
                                               $pg_content .=  ' <img src="'.esc_url($liven_client_img_url[0]).'" class="img-responsive" alt="'.$p->post_title.'">';
                                           $pg_content .=  ' </div>';
                    endforeach;
 
                    $pg_content1 .= '<div class="'.$el_class.' '.$anim.'">
										<div class="clientslidersection container">											
											<div class="clientslider">';
												$pg_content=$pg_content1.$pg_content;
												$pg_content .='
											</div>
										</div>
									</div>';
		        }
		        break;
		        case 'list':
		        {
		            if($liven_clients_border_color != ''){
		                $liven_clients_border_color = '1px solid '.$liven_clients_border_color;
		            }
		            else{
		                $liven_clients_border_color = '1px solid transparent';
		            }
		            if($liven_clients_hover_border_color != ''){
		                $liven_clients_hover_border_color = '1px solid '.$liven_clients_hover_border_color;
		            }
		            else{
		                $liven_clients_hover_border_color = '1px solid transparent';
		            }
		            
		            $uniqueID = uniqid();
   			      	$GLOBALS['pg_content'].= '
										.liven_client'.$uniqueID.' {
											background:'.$liven_clients_bg_color.';
											border:'.$liven_clients_border_color.';
											margin: '.$liven_clients_margin.';
										}
										.liven_client'.$uniqueID.':hover {
											background:'.$liven_clients_hover_bg_color.';
											border:'.$liven_clients_hover_border_color.';
										}
										.liven_client'.$uniqueID.' img {
											opacity: '.$liven_clients_opacity.';
										}
										.liven_client'.$uniqueID.':hover img {
											 opacity: '.$liven_clients_hover_opacity.';
										}';
		            
		            $pg_content .=  '<div class="row"><div class="'.$el_class.'">';
		            foreach ($query as $p) :
                        $liven_client_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'full');
                        
                        $pg_content .=  '<div class="col-sm-3 '.$anim.'">
											<div class="liven_client'.$uniqueID.'">
												<a href="'. esc_url(get_post_meta($p->ID, '_pg_link', true)).'" target="_blank"> ';
											if(isset($liven_client_img_url[0]))
                                               $pg_content .=  ' <img src="'.esc_url($liven_client_img_url[0]).'" class="img-responsive" alt="'.$p->post_title.'">';
                                           $pg_content .=  ' </a>
											</div>
										</div>';
                    endforeach;
                    $pg_content .=  '</div></div>';
		        }
            break;
	        }
	        return $pg_content;
        }
    
        vc_map(array(
            'name' => esc_html__('Liven Clients', 'liven') ,
            'base' => 'liven_vc_clients',
            'category' => esc_html__('Liven Extensions', 'liven') ,
            'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
            'params' => array(
                array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Display Option', 'liven' ),
					'param_name' => 'liven_client_display_option',
					'description' => esc_html__( 'Select client display option.', 'liven' ),
					'value' => array(
						esc_html__( 'Slider', 'liven' )   => 'slider',
						esc_html__( 'List', 'liven' )  => 'list',
					),
				),	            
	    	    array(
                    'type' => 'autocomplete',
                    'heading' => esc_html__('Clients', 'liven') , 
                    'param_name' => 'liven_clients',
    	    		'admin_label' => true, 
	    	    	'settings' => array(
        		        'multiple' => true,
    	    			'sortable' => true,
			    		'groups' => true,
    			    	'unique_values' => true,
    					'display_inline' => true,			
	    				'auto_focus' => true,
    	    			'values' => liven_get_cpt_data('liven_clients')
    	    		),                    
                ) ,
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Count', 'liven') , 
                    'param_name' => 'liven_clients_count',
                    'value' => '-1',
                    'description' => esc_html__('How many clients you would like to show? (-1 means unlimited)', 'liven')
                ) ,
                array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'liven' ),
					'param_name' => 'liven_clients_bg_color',
					'description' => esc_html__( 'Select background color for client logo.', 'liven' ),
					'dependency' => array(
						'element' => 'liven_client_display_option',
						'value' => 'list',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Hover Background Color', 'liven' ),
					'param_name' => 'liven_clients_hover_bg_color',
					'description' => esc_html__( 'Select hover background color for client logo.', 'liven' ),
					'dependency' => array(
						'element' => 'liven_client_display_option',
						'value' => 'list',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'liven' ),
					'param_name' => 'liven_clients_border_color',
					'description' => esc_html__( 'Select border color for client logo box.', 'liven' ),
					'dependency' => array(
						'element' => 'liven_client_display_option',
						'value' => 'list',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Hover Border Color', 'liven' ),
					'param_name' => 'liven_clients_hover_border_color',
					'description' => esc_html__( 'Select Hover border color for client logo box.', 'liven' ),
					'dependency' => array(
						'element' => 'liven_client_display_option',
						'value' => 'list',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Image Opacity Value', 'liven') ,
                    'param_name' => 'liven_clients_opacity',
                    'description' => esc_html__('Type opacity value from 0 to 1', 'liven'),
                    'dependency' => array(
						'element' => 'liven_client_display_option',
						'value'   => 'list',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => 'Design Options'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Image Hover Opacity Value', 'liven') ,
                    'param_name' => 'liven_clients_hover_opacity',
                    'description' => esc_html__('Type hover opacity value from 0 to 1', 'liven'),
                    'dependency' => array(
						'element' => 'liven_client_display_option',
						'value' => 'list',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => 'Design Options'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Margin', 'liven') ,
                    'param_name' => 'liven_clients_margin',
                    'value' => '0px 0px 30px',
                    'description' => esc_html__('Margin in px. Ex: 0px 0px 30px', 'liven'),
                    'dependency' => array(
						'element' => 'liven_client_display_option',
						'value' => 'list',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column'
                ),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Apply Animation?', 'liven' ),
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
                    'param_name' => 'el_class',
                    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
                )
            )
        ));
    }