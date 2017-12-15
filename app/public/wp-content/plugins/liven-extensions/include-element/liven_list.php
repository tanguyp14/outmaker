<?php	
	add_action( 'vc_before_init', 'liven_vc_list_integrateWithVC' );
	function liven_vc_list_integrateWithVC() {
		add_shortcode( 'liven_vc_list', 'liven_vc_list_func' );
		function liven_vc_list_func( $atts, $content = null ) {
   			extract( shortcode_atts( array(
				'list_display_style' => 'licon',	
				'list_icon_items' => '',
				'list_items' => '',
				'list_type'	=> 'ul',
				'list_type_ul' => 'square',
				'list_type_ol' => 'a',
				'horizontal_list' => '',
				'hlist_spacing' => '',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',		
				'list_el_class' => '',
				'list_color' => '#000',
				'list_icon_color' => '#009cff',
				'list_icon_h_color' => '#000000',	
				'list_link_color' => '#333333',
				'list_link_hover_color' => '#009cff',
   			), $atts ));
			
			$uniqueID = uniqid();			
			$pg_content = $hlist = $anim = '';
			$hlist_spacing = intval(preg_replace('/[^0-9]+/', '', $hlist_spacing), 10);
			$list_icon_items=(array) vc_param_group_parse_atts( $list_icon_items );
			$list_items=(array) vc_param_group_parse_atts( $list_items );
			
			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}
			if($horizontal_list == 'true'){
				$hlist = 'inlineList';
			}			
			if($list_display_style == 'licon'){
				$GLOBALS['pg_content'].= '
									.list'.$uniqueID.' li{ color:'.$list_color.'; margin-right:'.$hlist_spacing.'px; }
									.list'.$uniqueID.' li .fa{ color:'.$list_icon_color.'}
									.list'.$uniqueID.' li:hover .fa{ color:'.$list_icon_h_color.'}
									.list'.$uniqueID.' li a{ color:'.$list_link_color.'}
									.list'.$uniqueID.' li a:hover{ color:'.$list_link_hover_color.'}
								';
				$pg_content .= '<ul class="list-icons '.$list_el_class.' list'.$uniqueID.' '.$anim.' '.$hlist.'">';
								foreach ( $list_icon_items as $k => $v ) {
									$text="";									
									if(isset($v['list_icon']))
											$text .= '<i class="fa-1x '.$v['list_icon'].'"></i>';
											
									if(isset($v['list_icon_display_style']) && $v['list_icon_display_style']=="ilink"){
										if(isset($v['link_item'][1])){
											$href_temp = explode('|',$v['link_item']);
											$text .='<a href="'.urldecode(substr($href_temp[0],strrpos($href_temp[0],':')+1)).'" title="'.urldecode(substr($href_temp[1],strrpos($href_temp[1],':')+1)).'">'.urldecode(substr($href_temp[1],strrpos($href_temp[1],':')+1)).'</a>';	
										}
									}else{
											$text .='<span>'.$v['list_icon_item'].'</span>';
									}
									$pg_content .= ' <li>'.$text.'</li>';
								}
				$pg_content .= '</ul>';
			}else{
				$text="";
				foreach ( $list_items as $k => $v ) {
					if(isset($v['list_is_display_style']) && $v['list_is_display_style']=="ilink"){
						if(isset($v['list_link_item'][1])){
							$href_temp = explode('|',$v['list_link_item']);
							$text .='<li><span><a href="'.urldecode(substr($href_temp[0],strrpos($href_temp[0],':')+1)).'" title="'.urldecode(substr($href_temp[1],strrpos($href_temp[1],':')+1)).'">'.urldecode(substr($href_temp[1],strrpos($href_temp[1],':')+1)).'</a></span></li>';	
						}
					}else{
							$text .='<li> <span>'.$v['list_item'].'</span></li>';
					}
				}
				if($list_type == 'ul'){				
					$GLOBALS['pg_content'].= '
										.list'.$uniqueID.' li{ color:'.$list_color.'; margin-right:'.$hlist_spacing.'px;}
										.list'.$uniqueID.' li{ list-style:inside '.$list_type_ul.' }										
										.list'.$uniqueID.' li a{ color:'.$list_link_color.'}
										.list'.$uniqueID.' li a:hover{ color:'.$list_link_hover_color.'}
									';
					$pg_content .= '<'.$list_type.' class="livenList '.$list_el_class.' list'.$uniqueID.' '.$anim.' '.$hlist.'">'.$text. '</'.$list_type.'>';
				}elseif($list_type == 'ol'){
					$GLOBALS['pg_content'].= '
										.list'.$uniqueID.' li{ color:'.$list_color.'}
										.list'.$uniqueID.' li a{ color:'.$list_link_color.'}
										.list'.$uniqueID.' li a:hover{ color:'.$list_link_hover_color.'}									
									';
					$pg_content .= '<'.$list_type.' class="livenList '.$list_el_class.' list'.$uniqueID.' '.$anim.' '.$hlist.'" type="'.$list_type_ol.'">'.$text. '</'.$list_type.'>';
				}
			}
			
			return $pg_content;
		}
		class WPBakeryShortCode_liven_vc_list extends WPBakeryShortCode {
		}
		
		vc_map(array(
		    'name' => esc_html__('Liven List', 'liven') ,
    		'base' => 'liven_vc_list',
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
			'content_element' => true,
			'show_settings_on_create' => true,
			'is_container' => true,
			'category' => esc_html__('Liven Extensions', 'liven') ,
		    'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'List Display Style', 'liven' ),
					'param_name' => 'list_display_style',
					'std' => 'licon',
					'value' => array(
						esc_html__( 'List Icon', 'liven' ) => 'licon',
						esc_html__( 'List Simple', 'liven' ) => 'lsimple',	
					),
				),
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'List Icon', 'liven' ),
					'param_name' => 'list_icon_items',
					'dependency' => array(
						'element' => 'list_display_style',
						'value' => 'licon',
					),					
					'params' => array(
					
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Item Type', 'liven' ),
							'param_name' => 'list_icon_display_style',
							'std' => 'itext',
							'value' => array(
								esc_html__( 'Text', 'liven' ) => 'itext',
								esc_html__( 'Link', 'liven' ) => 'ilink',	
							),
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'List Icon Item', 'liven' ),
							'param_name' => 'list_icon_item',
							'admin_label' => true,
							'dependency' => array(
								'element' => 'list_icon_display_style',
								'value' => 'itext',
							),					
						),
						
						array(
							'type' => 'vc_link',
							'heading' => esc_html__( 'Link Item', 'liven' ),
							'param_name' => 'link_item',
							'dependency' => array(
								'element' => 'list_icon_display_style',
								'value' => 'ilink',
							),					
						),
						array(
							'type' => 'iconpicker',
							'heading' => esc_html__( 'Icon For Service', 'liven' ),
							'param_name' => 'list_icon',
							'dependency' => array(
								'element' => 'list_display_style',
								'value' => 'licon',
							),
						),										  
					),
				),
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'List ', 'liven' ),
					'param_name' => 'list_items',
					'dependency' => array(
						'element' => 'list_display_style',
						'value' => 'lsimple',
					),					
					'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Item Type', 'liven' ),
							'param_name' => 'list_is_display_style',
							'std' => 'itext',
							'value' => array(
								esc_html__( 'Text', 'liven' ) => 'itext',
								esc_html__( 'Link', 'liven' ) => 'ilink',	
							),
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'List Item', 'liven' ),
							'param_name' => 'list_item',
							'admin_label' => true,
							'dependency' => array(
								'element' => 'list_is_display_style',
								'value' => 'itext',
							),
						),
						array(
							'type' => 'vc_link',
							'heading' => esc_html__( 'Link Item', 'liven' ),
							'param_name' => 'list_link_item',
							'dependency' => array(
								'element' => 'list_is_display_style',
								'value' => 'ilink',
							),					
						),
					),
					
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'List Stype', 'liven' ),
					'param_name' => 'list_type',
					'std' => 'ul',
					'value' => array(
						esc_html__( 'Unordered', 'liven' ) => 'ul',
						esc_html__( 'Ordered', 'liven' ) => 'ol',
					),
					'dependency' => array(
						'element' => 'list_display_style',
						'value' => 'lsimple',
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Unordered List Style Type', 'liven' ),
					'param_name' => 'list_type_ul',
					'std' => 'square',
					'value' => array(
						esc_html__( 'Disc', 'liven' ) => 'disc',
						esc_html__( 'Circle', 'liven' ) => 'circle',
						esc_html__( 'Square', 'liven' ) => 'square',
						esc_html__( 'None', 'liven' ) => 'none',
					),
					'dependency' => array(
						'element' => 'list_type',
						'value' => 'ul',
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Ordered List Style Type', 'liven' ),
					'param_name' => 'list_type_ol',
					'std' => 'a',
					'value' => array(
						esc_html__( 'Numbers', 'liven' ) => '1',
						esc_html__( 'Uppercase ', 'liven' ) => 'A',
						esc_html__( 'Lowercase ', 'liven' ) => 'a',
						esc_html__( 'Uppercase Roman Numbers', 'liven' ) => 'I',
						esc_html__( 'Lowercase Roman Numbers', 'liven' ) => 'i',
					),
					'dependency' => array(
						'element' => 'list_type',
						'value' => 'ol',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Display As Horizontal List?', 'liven' ),
					'param_name' => 'horizontal_list',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Spacing between items', 'liven' ),
					'description' => esc_html__( 'Size unit will be px.', 'liven' ),
					'param_name' => 'hlist_spacing',
					'dependency' => array(
						'element' => 'horizontal_list',
						'value' => 'true',
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
	        	    'param_name' => 'list_el_class',
	        	    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
		    	),
				//============================================ Design Option =============================================											
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'List Color', 'liven' ),
					'param_name' => 'list_color',
					'std' => '#333333',
					'group' => esc_html__( 'Design Option', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'List Icon Color', 'liven' ),
					'param_name' => 'list_icon_color',
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Option', 'liven' ),
					'dependency' => array(
						'element' => 'list_display_style',
						'value' => 'licon',
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'List Icon Hover Color', 'liven' ),
					'param_name' => 'list_icon_h_color',
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Option', 'liven' ),
					'dependency' => array(
						'element' => 'list_display_style',
						'value' => 'licon',
					),
				),	
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'List Link Color', 'liven' ),
					'param_name' => 'list_link_color',
					'std' => '#333333',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Option', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'List Link Hover Color', 'liven' ),
					'param_name' => 'list_link_hover_color',
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Option', 'liven' ),
				),																							
			) ,
			
		));		
	}