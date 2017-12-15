<?php 	
	add_action( 'vc_before_init', 'liven_tag_integrateWithVC' );
	function liven_tag_integrateWithVC() {
		add_shortcode( 'liven_tag_base', 'liven_tag_base_function' );
		function liven_tag_base_function( $atts, $content = null ) {
   			extract( shortcode_atts( array(
      			'tag_cloud_name' => '',
      			'tag_cloud_name_size' => '',
	      		'tag_cloud_name_align' => 'left',
	      		'tag_cloud_name_color' => '#fff',
	      		'tag_list' => '',
	      		'liven_tags_count' => '',
	      		'liven_tag_image_url' => '',
	      		'liven_tag_text' => '',
	      		'liven_tag_text_color' => '',
	      		'liven_tag_alignment' => 'text-left',
	      		'liven_tag_el_class' => '',
				'tags_color' => '#fff',
				'tags_hover_color' => '#009cff',
				'tags_border_color' => '#009cff',
				'tags_border_hover_color' => '#009cff',
				'tags_background_color' => '#009cff',
				'tags_background_hover_color' => '#fff',
				'liven_tags_animation' => '',
				'liven_tags_animation_type' => 'fadeInDown',
				'liven_tags_el_class' => '',
				'css' => '',
   			), $atts ));
			
			$anim = '';	
			$pg_content ='';
			$u_id = uniqid();
			$tag_cloud_name_size = intval(preg_replace('/[^0-9]+/', '', $tag_cloud_name_size), 10);			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, '' ));
			
			if($liven_tags_animation == 'true'){
				$anim = 'wow '.$liven_tags_animation_type;
			}
			if ($tag_list == '') {
				$query_options = array(
				    'number' => $liven_tags_count,
				    'order'        => 'ASC'
				);
			} else {
				$query_options = array(
				    'include' => $tag_list,
				    'number' => $liven_tags_count,
				    'order'        => 'ASC'
				);
			}
			
			$query = get_tags($query_options);
			$GLOBALS['pg_content'].= '
								.tc'.$u_id.' h5{ text-align:'.$tag_cloud_name_align.'; color:'.$tag_cloud_name_color.'; font-size:'.$tag_cloud_name_size.'px; }
								.tc'.$u_id.' a{ color:'.$tags_color.'; border-color:'.$tags_border_color.'; background-color:'.$tags_background_color.'; }
								.tc'.$u_id.' a:hover{ color:'.$tags_hover_color.'; border-color:'.$tags_border_hover_color.'; background-color:'.$tags_background_hover_color.'; }
							';
			
			
			$pg_content .= 	'<div class="'.$css_class.' '.$liven_tags_el_class.' tag-cloud tc'.$u_id.' '.$anim.'">
							  <h5>'.$tag_cloud_name.'</h5>
							  <div>';
			foreach ($query as $p):
				$pg_content .=	'<a href="'.get_tag_link($p->term_id).'" title="'.$p->name.'" class="tc'.$p->slug.'">'.$p->name.'</a>';
			endforeach;			
			$pg_content .=	'</div>
							</div>';
			
   			return $pg_content;
		}
		class WPBakeryShortCode_liven_tag_base extends WPBakeryShortCode {
		}

		vc_map(array(
	   		'name' => esc_html__('Liven Tag Cloud', 'liven') ,
	    	'base' => 'liven_tag_base',
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
		    'category' => esc_html__('Liven Extensions', 'liven') ,
		    'description' => esc_html__('Adds styles to your element.', 'liven') ,
    		'params' => array(
	    		array(
    	    	    'type' => 'textfield',
	        	    'heading' => esc_html__('Tag Cloud Name', 'liven') ,
		            'param_name' => 'tag_cloud_name',
	       		),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Tag Cloud Name Color', 'liven' ),
					'param_name' => 'tag_cloud_name_color',
					'std' => '#fff',
				),
	       		array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Tag Cloud Name Size', 'liven' ),
					'param_name' => 'tag_cloud_name_size',
					'description' => 'Size will be displayed in px.',	
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Tag Cloud Name Alignment', 'liven' ),
					'param_name'  => 'tag_cloud_name_align',
					'value' => array(
						esc_html__( 'Left', 'liven' ) => 'left',
						esc_html__( 'Center', 'liven' ) => 'center',
						esc_html__( 'Right', 'liven' ) => 'right',
					),
				),				
				array(
					'type' => 'autocomplete',
					'heading' => esc_html__('Tags', 'liven') , 
					'param_name' => 'tag_list',
					'admin_label' => true, 
					'settings' => array(
							'multiple' => true,
							'sortable' => true,
							'groups' => true,
							'unique_values' => true,
							'display_inline'=> true,
							'auto_focus' => true,
							'values' => liven_get_type_tags_data(),
					),					
				) ,
				array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Count', 'liven') , 
                    'param_name' => 'liven_tags_count',
                    'value' => '-1',
                    'description' => esc_html__('How many tags you would like to show? (-1 means unlimited)', 'liven')
                ) ,
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Apply Animation?', 'liven' ),
					'param_name' => 'liven_tags_animation',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'CSS Animation', 'liven' ),
					'description' => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'liven' ),
					'param_name' => 'liven_tags_animation_type',
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
						'element' => 'liven_tags_animation',
						'value' => 'true',
					),
				),				
				array(
    		        'type' => 'textfield',
        		    'heading' => esc_html__('Extra Class Name', 'liven') ,
	        	    'param_name' => 'liven_tags_el_class',
	        	    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
		    	),
				//==========================================================================================
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Tags Color', 'liven' ),
					'param_name' => 'tags_color',
					'std' => '#fff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Tags Colors Settings', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Tags Hover Color', 'liven' ),
					'param_name' => 'tags_hover_color',
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Tags Colors Settings', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Tags Border Color', 'liven' ),
					'param_name' => 'tags_border_color',
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Tags Colors Settings', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Tags Border Hover Color', 'liven' ),
					'param_name' => 'tags_border_hover_color',
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Tags Colors Settings', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Tags Background Color', 'liven' ),
					'param_name' => 'tags_background_color',
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Tags Colors Settings', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Tags Background Hover Color', 'liven' ),
					'param_name' => 'tags_background_hover_color',
					'std' => '#fff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Tags Colors Settings', 'liven' ),
				),
				
				//==========================================================================================
				array(
					'type' => 'css_editor',
					'heading' => esc_html__( 'Css', 'liven' ),
					'param_name' => 'css',
					'group' => esc_html__( 'Design options', 'liven' ),
				),
			)
		));
	}