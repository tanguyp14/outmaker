<?php
	add_action( 'vc_before_init', 'liven_vc_tabs_integrateWithVC' );
	function liven_vc_tabs_integrateWithVC() {
		add_shortcode( 'liven_vc_tabs', 'liven_vc_tabs_func' );
		function liven_vc_tabs_func( $atts, $content = null ) {
   			extract( shortcode_atts( array(	
				'liven_tabs_display_style'	=> 'htabs',
				'liven_tabs' => '',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',
				'liven_tabs_el_class' => '',
				'tabs_back_color' => '#eeeeee',
				'tabs_title_color' => '#000000',
				'tabs_border_color' => '#eeeeee',
				'tabs_back_h_color' => '#009cff',
				'tabs_title_h_color' => '#ffffff',
				'tabs_border_h_color' => '#009cff',				
   			), $atts ));
			
			$pg_content = $anim = '';
			if($liven_tabs==''){
		        $query_options = array(		
    		        'post_type' => 'liven_tabs',
    	    		'posts_per_page' => 100,
	    	    	'orderby' => 'post__in'
		    	);
    		}
	    	else{
   		        $query_options = array(		
			        'post__in' => explode(', ',esc_html($liven_tabs)),	
                    'post_type' => 'liven_tabs',
		        	'orderby' => 'post__in'
    		    );
    	    }
			$uniqe=uniqid();
			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}
			if( $liven_tabs_display_style == 'htabs'){
				$GLOBALS['pg_content'].= '
								.hori'.$uniqe.' li { background:'.$tabs_back_color.'; color:'.$tabs_title_color.'; border-color:'.$tabs_border_color.'; }
								.hori'.$uniqe.' li:hover, .hori'.$uniqe.' li.resp-tab-active { background:'.$tabs_back_h_color.'; color:'.$tabs_title_h_color.'; border-color:'.$tabs_border_h_color.'; }
								.hori'.$uniqe.' .resp-tab-content { border-top-color:'.$tabs_back_h_color.'; }								
							';
			    $pg_content .=  '<div id="parentHorizontalTab'.$uniqe.'" class="'.$liven_tabs_el_class.' hori'.$uniqe.' '.$anim.'">';
			}
			else {
				$GLOBALS['pg_content'].= '
								.verti'.$uniqe.' li { background:'.$tabs_back_color.'; color:'.$tabs_title_color.'; border-color:'.$tabs_border_color.'; }
								.verti'.$uniqe.' li:hover, .verti'.$uniqe.' li.resp-tab-active { background:'.$tabs_back_h_color.'; color:'.$tabs_title_h_color.'; border-color:'.$tabs_border_h_color.'; }
								.verti'.$uniqe.' .resp-tabs-container { border-left-color: '.$tabs_back_h_color.'; }								
							';
    		    $pg_content .=  '<div id="parentVerticalTab'.$uniqe.'" class="'.$liven_tabs_el_class.' verti'.$uniqe.' '.$anim.'">';
    		}
			
			$pg_content1='';				
			$pg_content2='';
			
			$pg_content .=  '<ul class="resp-tabs-list hor_1">';
							 
		    $query = get_posts($query_options);
			foreach ($query as $t) :
    			$pg_content2 .= '<li>'.do_shortcode( $t->post_title).'</li>';				
				$pg_content1 .= '<div>'.do_shortcode( $t->post_content).'</div>';
            endforeach;
			
			$pg_content .= $pg_content2.'</ul> <div class="resp-tabs-container hor_1">'.$pg_content1.' </div> </div>';
				
			return $pg_content;
		}
		class WPBakeryShortCode_liven_vc_tabs extends WPBakeryShortCode {
		}
		
		vc_map(array(
		    'name' => esc_html__('Liven Tabs', 'liven') ,
    		'base' => 'liven_vc_tabs',
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
			'content_element' => true,
			'show_settings_on_create' => true,
			'is_container' => true,
			'category' => esc_html__('Liven Extensions', 'liven') ,
		    'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Display Style', 'liven' ),
					'param_name' => 'liven_tabs_display_style',
					'std' => 'htabs',
					'value' => array(
						esc_html__( 'Horizontal Tab', 'liven' ) => 'htabs',
						esc_html__( 'Vertical Tab', 'liven' ) => 'vtabs',
					),
				),
				
				 array(
                    'type' => 'autocomplete',
                    'heading' => esc_html__('Tabs', 'liven') , 
                    'param_name' => 'liven_tabs',
    	    		'admin_label' => true, 
	    	    	'settings' => array(
        		        'multiple' => true,
    	    			'sortable' => true,
			    		'groups' => true,
    			    	'unique_values' => true,
    					'display_inline' => true,			
	    				'auto_focus' => true,
    	    			'values' => liven_get_cpt_data('liven_tabs')
    	    		),
                ) ,
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
	        	    'param_name' => 'liven_tabs_el_class',
	        	    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
		    	),
				//=========================================================================================================															
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Tab Background Color', 'liven' ),
					'param_name' => 'tabs_back_color',
					'std' => '#eeeeee',
					'edit_field_class' => 'vc_col-sm-4 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Tab Title Color', 'liven' ),
					'param_name' => 'tabs_title_color',
					'std' => '#000000',
					'edit_field_class' => 'vc_col-sm-4 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),				
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Tab Border Color', 'liven' ),
					'param_name' => 'tabs_border_color',
					'std' => '#eeeeee',
					'edit_field_class' => 'vc_col-sm-4 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Tab Background Hover Color', 'liven' ),
					'param_name' => 'tabs_back_h_color',
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-4 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Tab Title Hover Color', 'liven' ),
					'param_name' => 'tabs_title_h_color',
					'std' => '#ffffff',
					'edit_field_class' => 'vc_col-sm-4 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),				
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Tab Border Hover Color', 'liven' ),
					'param_name' => 'tabs_border_h_color',
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-4 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),																											
			) ,
			
		));		
	}