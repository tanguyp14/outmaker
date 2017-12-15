<?php	
	add_action( 'vc_before_init', 'liven_vc_service_diamond_integrateWithVC' );
	function liven_vc_service_diamond_integrateWithVC() {
		
		add_shortcode( 'liven_vc_service_diamond', 'liven_vc_service_diamond_func' );
		function liven_vc_service_diamond_func( $atts, $content = null ) {
   			extract( shortcode_atts( array(
				'diamond_service_display_style'	=> 'style1',	
				'diamond_services' => '',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',
				'diamond_service_el_class' => '',
				'diamond_service_bg_color' => '#f1f1f1',
				'diamond_service_bgh_color' => '#e5e5e5',
				'diamond_service_icon_color' => '#009cff',
				'diamond_service_iconhover_color' => '#000000',
				'diamond_service_title_color' => '#009cff',
				'diamond_service_titlehover_color' => '#000000',
				'diamond_service_border_color' => '#009cff',
				'diamond_service_borderhover_color'	=> '#000000',
   			), $atts ));
			
			$pg_content = $anim = '';
			$uniqueID = uniqid();
			$diamond_services=(array) vc_param_group_parse_atts( $diamond_services );
			$total_count = count($diamond_services);				
			
			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}
			if($total_count<10 && $diamond_service_display_style=='style1'){
				$GLOBALS['pg_content'].= '
								.dss'.$uniqueID.' .diamond-shapes-preview{ background-color:'.$diamond_service_bg_color.'; border-color:'.$diamond_service_border_color.'; }
								.dss'.$uniqueID.' .diamond-shapes-preview:hover{ background-color:'.$diamond_service_bgh_color.'; border-color:'.$diamond_service_borderhover_color.';}
								.dss'.$uniqueID.' .diamond-shapes-preview h3{ color:'.$diamond_service_title_color.'; }
								.dss'.$uniqueID.' .diamond-shapes-preview:hover h3{ color:'.$diamond_service_titlehover_color.';}
								.dss'.$uniqueID.' .diamond-shapes-preview .dismond-icn{ color:'.$diamond_service_icon_color.'; }
								.dss'.$uniqueID.' .diamond-shapes-preview:hover .dismond-icn{ color:'.$diamond_service_iconhover_color.';}								
							';								
				$pg_content .= '<div class="dss'.$uniqueID.' diamond-square '.$anim.' '.$diamond_service_el_class.'">';
												
								$count= 0;						
								foreach ( $diamond_services as $k => $v ) {
									$href_temp = "";
									if(isset($v['service_link'])){
									$href_temp = explode('|',$v['service_link']);	
									}
									if(!isset($v['diamond_service_icon'])){
									$v['diamond_service_icon'] = '';	
									}	
									if(!isset($v['diamond_service_name'])){
									$v['diamond_service_name'] = '';	
									}									
								   	$count++;
								   	$pg_content .='<a href="';
										if(isset($v['service_link'][1])){
											$href_temp = explode('|',$v['service_link']);
										$pg_content .=urldecode(substr($href_temp[0],strrpos($href_temp[0],':')+1)).'" title="'.substr($href_temp[1],strrpos($href_temp[1],':')+1);
										}
										else {
											$pg_content .='#';
										}
										$pg_content .='" class="diamond-shapes-preview">
													<div class="diamond-shapes-data">
													  <div class="dismond-icn"><i class="'.$v['diamond_service_icon'].' fa-3x"></i></div>
													  <h3>'.$v['diamond_service_name'].'</h3>
													</div>
													</a>';
										if($total_count == 3 && $count==1)		  				
											$pg_content .= '<div class="clr"></div>';
										if($total_count == 4 && ($count==1 || $count==3))		  				
											$pg_content .= '<div class="clr"></div>';
										if($total_count == 6 && ($count==1 || $count==3))		  				
											$pg_content .= '<div class="clr"></div>';
										if($total_count == 7 && ($count==2 || $count==5))		  				
											$pg_content .= '<div class="clr"></div>';
										if($total_count == 8 && ($count==1 || $count==3 || $count==6))		  				
											$pg_content .= '<div class="clr"></div>';
										if($total_count == 9 && ($count==1 || $count==3 || $count==6 || $count==8))		  				
											$pg_content .= '<div class="clr"></div>';
								}
				$pg_content .= '</div>';				
			}
			else{
				$GLOBALS['pg_content'].= '
								.dss'.$uniqueID.' .diamond-shapes-small{ background-color:'.$diamond_service_bg_color.'; }
								.dss'.$uniqueID.' a:hover .diamond-shapes-small{ background-color:'.$diamond_service_bgh_color.'; }
								.dss'.$uniqueID.' h3{ color:'.$diamond_service_title_color.'; }
								.dss'.$uniqueID.' a:hover h3{ color:'.$diamond_service_titlehover_color.';}
								.dss'.$uniqueID.' a .diamond-shapes-small .small-diamond-icn{ color:'.$diamond_service_icon_color.'; }
								.dss'.$uniqueID.' a:hover .diamond-shapes-small .small-diamond-icn{ color:'.$diamond_service_iconhover_color.';}								
							';
							
				$pg_content .='<div class="dss'.$uniqueID.' diamond-square-small wow fadeInDown '.$diamond_service_el_class.'">';
				
				$count= 0;						
				foreach ( $diamond_services as $k => $v ) {
					
									if(!isset($v['diamond_service_icon'])){
									$v['diamond_service_icon'] = '';	
									}	
									if(!isset($v['diamond_service_name'])){
									$v['diamond_service_name'] = '';	
									}							
					$count++;
					$pg_content .='<div class="diamond-shape-div"> <a href="';
					if(isset($v['service_link'][1])){
						$href_temp = explode('|',$v['service_link']);
					$pg_content .=urldecode(substr($href_temp[0],strrpos($href_temp[0],':')+1)).'" title="'.substr($href_temp[1],strrpos($href_temp[1],':')+1);
					}
					else {
						$pg_content .='#';
					}
					$pg_content .='">
					<div class="diamond-shapes-small">
					  <div class="small-diamond-icn"><i class="'.$v['diamond_service_icon'].' fa-3x"></i></div>
					</div>
					<h3>'.$v['diamond_service_name'].'</h3>
					</a> </div>';
				}
				$pg_content .='<div class="clr"></div>
								</div>';								   										
			}
			return $pg_content;
		}
		class WPBakeryShortCode_liven_vc_service_diamond extends WPBakeryShortCode {
		}
		
		vc_map(array(
		    'name' => esc_html__('Liven Diamond Services', 'liven') ,
    		'base' => 'liven_vc_service_diamond',
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
			'content_element' => true,
			'show_settings_on_create' => true,
			'is_container' => true,
			'category' => esc_html__('Liven Extensions', 'liven') ,
			'description' => esc_html__('Place Services in Diamond shape.', 'liven') ,
		    'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Display Style', 'liven' ),
					'param_name' => 'diamond_service_display_style',
					'std' => 'style1',
					'value' => array(
						esc_html__( 'Style 1', 'liven' ) => 'style1',
						esc_html__( 'Style 2', 'liven' ) => 'style2',
					),
				),
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Services', 'liven' ),
					'param_name' => 'diamond_services',
					'description' => esc_html__('Place Services in Diamond shape. [NOTE: You can add maximum 9 Service to style 1 for proper design otherwise it will display style 2 design]', 'liven') ,
					'value' => urlencode( json_encode( array(
						array(
							'diamond_service_name' => esc_html__( 'Diamond Service', 'liven' ),
							'diamond_service_icon' => 'fa fa-cog',
							'service_link' => '#',
						),
						array(
							'diamond_service_name' => esc_html__( 'Diamond Service 2', 'liven' ),
							'diamond_service_icon' => 'fa fa-user',
							'service_link' => '#',
						),
						
					) ) ),
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Service Name', 'liven' ),
							'param_name' => 'diamond_service_name',
							'description' => esc_html__( 'Enter Individual Service Name.', 'liven' ),
							'admin_label' => true,
						),
						array(
							'type' => 'iconpicker',
							'heading' => esc_html__( 'Icon For Service', 'liven' ),
							'description' => esc_html__( 'Select icon for service.', 'liven' ),
							'param_name' => 'diamond_service_icon',														
						),
						array(
							'type' => 'vc_link',
							'heading' => esc_html__( 'URL (Link)', 'liven' ),
							'param_name' => 'service_link',
							'description' => esc_html__( 'Add link to service.', 'liven' ),								
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
	        	    'param_name' => 'diamond_service_el_class',
	        	    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
		    	),
				//====================== Service Colors =============================================											
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Main Background Color', 'liven' ),
					'param_name' => 'diamond_service_bg_color',
					'std' => '#f1f1f1',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Service Colors', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Main Background Hover Color', 'liven' ),
					'param_name' => 'diamond_service_bgh_color',
					'std' => '#e5e5e5',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Service Colors', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'liven' ),
					'param_name' => 'diamond_service_icon_color',
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Service Colors', 'liven' ),
				),				
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Hover Color', 'liven' ),
					'param_name' => 'diamond_service_iconhover_color',
					'std' => '#000',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Service Colors', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Service Title Color', 'liven' ),
					'param_name' => 'diamond_service_title_color',
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Service Colors', 'liven' ),
				),				
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Service Title Hover Color', 'liven' ),
					'param_name' => 'diamond_service_titlehover_color',
					'std' => '#000',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' =>esc_html__( 'Service Colors', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'liven' ),
					'param_name' => 'diamond_service_border_color',
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' =>esc_html__( 'Service Colors', 'liven' ),
					'dependency' => array(
						'element' => 'diamond_service_display_style',
						'value' => 'style1'
					)
				),				
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Hover Color', 'liven' ),
					'param_name' => 'diamond_service_borderhover_color',
					'std' => '#000',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' =>esc_html__( 'Service Colors', 'liven' ),
					'dependency' => array(
						'element' => 'diamond_service_display_style',
						'value' => 'style1'
					)
				),																							
			) ,
			
		));		
	}