<?php
	add_action( 'vc_before_init', 'liven_vc_team_member_integrateWithVC' );
	function liven_vc_team_member_integrateWithVC() {
		add_shortcode( 'liven_vc_team_member', 'liven_vc_team_member_func' );
		function liven_vc_team_member_func( $atts, $content = null ) {
   			extract( shortcode_atts( array(
   			    'liven_team_members' => '',
   			    'liven_team_members_count' => '-1',
				'liven_team_members_name_color'	=> '',
				'liven_team_members_desi_color' => '',
				'liven_team_members_display_style' => 'style1',
				'liven_team_members_details_align' => '',
				'liven_team_members_hover_bg_clr' => '',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',
				'el_class' => ''
   			), $atts ));
   			
			$anim = '';
   			$pg_content ='';
   			if($liven_team_members==''){
		        $query_options = array(		
    		        'post_type' => 'liven_team',
    	    		'posts_per_page' =>  $liven_team_members_count,
	    	    	'orderby' => 'post__in'
		    	);
    		}
	    	else{
   		        $query_options = array(		
			        'post__in' => explode(', ',esc_html__($liven_team_members)),	
                    'post_type' => 'liven_team',
	        		'posts_per_page' => $liven_team_members_count,
		        	'orderby' => 'post__in'
    		    );
    	    }
			
   			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}
			
		    $query = get_posts($query_options);            
            $pg_content='';
            
            switch ($liven_team_members_display_style) {
		        case 'style1':
		        {
		            $uniqueID = uniqid();
		            $GLOBALS['pg_content'].= '						    
							.team-box-2'.$uniqueID.' h3{ 
							    color:'.$liven_team_members_name_color.' !important;
							}
							.team-box-2'.$uniqueID.' p span{ 
							    color:'.$liven_team_members_desi_color.' !important; 
							}
						
					';
					$pg_content .=  '
					    <div class="teammember-main">
					';
			            foreach ($query as $p) :
                            $liven_team_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'full');
                            $pg_content .=  '
							                        
                            <div class="col-md-4 col-sm-4 team-box-2 team-box-2'.$uniqueID.' '.$anim.'">
                                <div class="team-img">';
											if(isset($liven_team_img_url[0]))
                                               $pg_content .=  '   <img src="'.esc_url($liven_team_img_url[0]).'" alt="'.$p->post_title.'" />';
                                           $pg_content .=  ' </div>
                                <div class="team-min-height text-'.$liven_team_members_details_align.'">
                                    <h3>'.$p->post_title.'</h3>';
                                    $des = get_post_meta($p->ID, '_t_designation', true);
                                    if($des != ""){
                                        $pg_content .= '<p><span>'. esc_html(get_post_meta($p->ID, '_t_designation', true)).'</span></p>';
                                    }
                            		
                                    $liven_facbookurl = get_post_meta($p->ID, '_t_facebook_url', true);
									$liven_twitterurl = get_post_meta($p->ID, '_t_twitter_url', true);
									$liven_googlerurl = get_post_meta($p->ID, '_t_googleplus_url', true);
									$liven_linkedinurl = get_post_meta($p->ID, '_t_linkedin_url', true);
									if($liven_facbookurl != "" || $liven_twitterurl != "" || $liven_googlerurl != "" || $liven_linkedinurl != ""){
										$pg_content .='
											<div class="team-social">';
												if($liven_facbookurl != ""){
													$pg_content .='<a href="'.$liven_facbookurl.'" class="team-facebook"></a>';
												}
												if($liven_twitterurl != ""){
													$pg_content .='<a href="'.$liven_twitterurl.'" class="team-twitter"></a>';
													}
												if($liven_googlerurl != ""){
													$pg_content .='<a href="'.$liven_googlerurl.'" class="team-gplus"></a>';
												}
												if($liven_googlerurl != ""){
													$pg_content .='<a href="'.$liven_linkedinurl.'" class="team-linkedin"></a>';
												}
											$pg_content .='
											</div>';    
									}
                                $pg_content .='
                                </div>
                            </div>
                            ';
                        endforeach;
                    $pg_content .='
                        </div>
                    ';
                }
		        break;
		        case 'style2':
		        {
		            $uniqueID = uniqid();
		          $GLOBALS['pg_content'].= '
                            .team-box'.$uniqueID.' .team2-img:hover .mask-team { 
                                background: '.$liven_team_members_hover_bg_clr.';
                            }
							.team-box'.$uniqueID.' h4{ 
							    color:'.$liven_team_members_name_color.' !important;
							}
							.team-box'.$uniqueID.' p span{ 
							    color:'.$liven_team_members_desi_color.' !important; 
							}
						
					';
					$pg_content .=  '<div class="teammember-main">';
			        foreach ($query as $p) :
                        $liven_team_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'full');
                        $pg_content .=  '
                            <div class="col-md-4 col-sm-4 team-box team-box'.$uniqueID.' '.$anim.'">
                                <div class="team2-img">';
											if(isset($liven_team_img_url[0]))
                                               $pg_content .=  '  <img src="'.esc_url($liven_team_img_url[0]).'" alt="'.$p->post_title.'" /> ';
                                           $pg_content .=  ' <div class="mask-team text-center">
                                        <h4>'.$p->post_title.'</h4>';
                                        $des = get_post_meta($p->ID, '_t_designation', true);
                                        if($des != ""){
                                            $pg_content .= '<p><span>'. esc_html(get_post_meta($p->ID, '_t_designation', true)).'</span></p>';
                                        }
										
                                        $liven_facbookurl = get_post_meta($p->ID, '_t_facebook_url', true);
                                        $liven_twitterurl = get_post_meta($p->ID, '_t_twitter_url', true);
                                        $liven_googlerurl = get_post_meta($p->ID, '_t_googleplus_url', true);
										$liven_linkedinurl = get_post_meta($p->ID, '_t_linkedin_url', true);
                                        if($liven_facbookurl != "" || $liven_twitterurl != "" || $liven_googlerurl != "" || $liven_linkedinurl != ""){
                                            $pg_content .='
                                                <div class="team-social">';
                                                    if($liven_facbookurl != ""){
                                                        $pg_content .='<a href="'.$liven_facbookurl.'" class="team-facebook"></a>';
                                                    }
                                                    if($liven_twitterurl != ""){
                                                        $pg_content .='<a href="'.$liven_twitterurl.'" class="team-twitter"></a>';
                                                        }
                                                    if($liven_googlerurl != ""){
                                                        $pg_content .='<a href="'.$liven_googlerurl.'" class="team-gplus"></a>';
                                                    }
													if($liven_googlerurl != ""){
                                                        $pg_content .='<a href="'.$liven_linkedinurl.'" class="team-linkedin"></a>';
                                                    }
                                                $pg_content .='
                                                </div>';    
                                        }
                                    $pg_content .='
                                    </div>
                                </div>
                            </div>
                        ';
                    endforeach;
                    $pg_content .='
                        </div>
                    ';
                }
		        break;
		    }
		    return $pg_content;
		}
		
		vc_map(array(
		    'name' => esc_html__('Liven Team Member', 'liven') ,
    		'base' => 'liven_vc_team_member',
			'content_element' => true,
			'show_settings_on_create' => true,
			'is_container' => true,
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
			'category' => esc_html__('Liven Extensions', 'liven') ,
			'description' => esc_html__('Place information about team member', 'liven') ,
		    'params' => array(
		        array(
                    'type' => 'autocomplete',
                    'heading' => esc_html__('Team Members', 'liven') , 
                    'param_name' => 'liven_team_members',
    	    		'admin_label' => true, 
	    	    	'settings' => array(
        		        'multiple' => true,
    	    			'sortable' => true,
			    		'groups' => true,
    			    	'unique_values' => true,
    					'display_inline' => true,			
	    				'auto_focus' => true,
    	    			'values' => liven_get_cpt_data('liven_team')
    	    		),
                    'description' => esc_html__('Select Team members', 'liven')
                ) ,
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Count', 'liven') , 
                    'param_name' => 'liven_team_members_count',
                    'value' => '-1',
                    'description' => esc_html__('How many team members you would like to show? (-1 means unlimited)', 'liven')
                ) ,
		        array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Display Option', 'liven' ),
					'param_name' => 'liven_team_members_display_style',
					'description' => esc_html__( 'Select display style for display at front side.', 'liven' ),
					'std' => 'style1',
					'value' => array(
						esc_html__( 'Style 1', 'liven' ) => 'style1',
						esc_html__( 'Style 2', 'liven' ) => 'style2',						
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Alignment', 'js_composer' ),
					'param_name' => 'liven_team_members_details_align',
					'description' => esc_html__( 'Select details alignment left, center or right.', 'liven' ),
					'std' => 'left',
					'value' => array(
						esc_html__( 'Left', 'liven' ) => 'left',
						esc_html__( 'Center', 'liven' ) => 'center',						
						esc_html__( 'Right', 'liven' ) => 'right',
					),
					'dependency' => array(
						'element' => 'liven_team_members_display_style',
						'value' => array('style1'),
					),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Layer Color', 'liven' ),
					'param_name' => 'liven_team_members_hover_bg_clr',
					'description' => esc_html__( 'Select background layer color for hover.', 'liven' ),
					'dependency' => array(
						'element' => 'liven_team_members_display_style',
						'value' => 'style2',
					),					
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
		        array(
					'type'          => 'colorpicker',
					'heading'       => esc_html__( 'Name Font Color', 'liven' ),
					'param_name'    => 'liven_team_members_name_color',
					'description'	=> esc_html__( 'Select font color for Name.', 'liven' ),
					'std'			=> '#000',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Designation Font Color', 'liven' ),
					'param_name' => 'liven_team_members_desi_color',
					'description' => esc_html__( 'Select font color for Designation.', 'liven' ),
					'std' => '#000',				
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
	            	'param_name' => 'el_class',
	       		    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'liven')
    		    ) ,							
			) ,
			
		));		
	}