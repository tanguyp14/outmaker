<?php
	add_action( 'vc_before_init', 'liven_paralax_with_content_integrateWithVC' );
	function liven_paralax_with_content_integrateWithVC() {
		add_shortcode( 'liven_vc_paralax_with_content', 'liven_vc_paralax_with_content_func' );
		function liven_vc_paralax_with_content_func( $atts, $content = null ) {
   			extract( shortcode_atts( array(
   			    'liven_paralax_style' => 'style1', 	
				'liven_content' => '',
				'liven_paralax_image_url' => '',
				'liven_object_image_url' => '',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',
				'el_class' => ''
   			), $atts ));
			
			$anim = '';
			$pg_content ='';
			$uniqueID = uniqid();
			$liven_content=(array) vc_param_group_parse_atts( $liven_content );
			
			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}
			$paraimgArray = wp_get_attachment_image_src($liven_paralax_image_url,'full');
			$objimgArray  = wp_get_attachment_image_src($liven_object_image_url,'full');
			$GLOBALS['pg_content'].= '
				    .liven_parallax'.$uniqueID.'{
						background: url('.$paraimgArray[0].') 50% 0 no-repeat; 
					}
			';
			
			switch ($liven_paralax_style) {
			    case 'style1':
		        {
			        $pg_content .= '
			        <div class="'.$el_class.'">
        			    <div class="parallax-mobile">
                            <div class="parallax fixed fixed-desktop liven_parallax liven_parallax'.$uniqueID.'" >
                                <div class="parallax-overlay-black typo-white">
                                    <div class="container parallax-object-div">
                                        <div class="parallax-object">';
											if(isset($objimgArray[0]))
                                               $pg_content .=  ' <img src="'.$objimgArray[0].'" alt="Parallax Mobile Object"/>';
                                           $pg_content .=  '</div>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-7 pull-right parallax-data '.$anim.'">';
                                            $count=0;
                                            if(!empty($liven_content[0]))
                                            {
                                            
    						        	        foreach ( $liven_content as $k => $v ) {
													
												if(!isset($v['liven_title'])){
													$v['liven_title'] = '';	
												}	
												if(!isset($v['liven_info'])){
													$v['liven_info'] = '';	
												}	
												if(!isset($v['liven_icon'])){
													$v['liven_icon'] = '';	
												}	
	    					        	        $pg_content .= '
		            						        <div class="parallax-data-item">
                                                        <div class="pull-left">
                                                            <i class="fa '.$v['liven_icon'].' fa-2x icons-white"></i>
                                                        </div>
                                                        <div class="parallax-data-info">
                                                            <h5><span>'.$v['liven_title'].'</span></h5>
                                                            
                                                            <p>'.$v['liven_info'].'</p>
                                                        </div>
                                                        <div class="clr"></div>
                                                    </div>
            									';
		            					        $count++;
		            					        }
				        			        }
                                 $pg_content .= '
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
		        	';
		        }
		        break;
		        
		        case 'style2':
		        {
			        $pg_content .= '
			        <div class="'.$el_class.'">
        			    <div class="parallax-mobile3">
                            <div class="parallax fixed fixed-desktop liven_parallax liven_parallax'.$uniqueID.'">
                                <div class="parallax-overlay-black">
                                    <div class="container parallax-object-div">
                                        <div class="row">
                                            <div class="parallax-3-data '.$anim.'">';
                                            $count=0;
                                            if(!empty($liven_content[0]))
                                            {
						        	        foreach ( $liven_content as $k => $v ) {
												if(!isset($v['liven_title'])){
													$v['liven_title'] = '';	
												}	
												if(!isset($v['liven_info'])){
													$v['liven_info'] = '';	
												}	
												if(!isset($v['liven_icon'])){
													$v['liven_icon'] = '';	
												}	
    						        	        $pg_content .= '
	    					        	            <div class="col-sm-4 col-md-4 parallax-data-item text-center">
                                                        <div class="margin-bottom-20"><i class="fa '.$v['liven_icon'].' fa-3x icons-white"></i></div>
                                                        <h5>'.$v['liven_title'].'</h5>
                                                        <p>'.$v['liven_info'].'</p>
                                                        <div class="clr"></div>
                                                    </div>
        					    				';
		        				    	        $count++;
		        					            }
				        			        }
                                     $pg_content .= '
                                                <div class="col-md-12 text-center margin-top-10"> ';
											if(isset($objimgArray[0]))
                                               $pg_content .=  '  <div class="obj-img"><img src="'.$objimgArray[0].'" alt="Parallax Mobile Object"/> </div>';
                                           $pg_content .=  ' </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
		        	';
		        }
		        break;
		    }
	        return $pg_content;
		}
		class WPBakeryShortCode_liven_vc_paralax_with_content extends WPBakeryShortCode {
		}
		
		vc_map(array(
		    'name' => esc_html__('Liven Parallax Content', 'liven') ,
    		'base' => 'liven_vc_paralax_with_content',
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
			'content_element' => true,
			'show_settings_on_create' => true,
			'is_container' => true,
			'category' => esc_html__('Liven Extensions', 'liven') ,
		    'params' => array(
		        array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Style', 'liven' ),
					'description' => esc_html__( 'Select style.', 'liven' ),
					'param_name' => 'liven_paralax_style',
					'std' => 'style1',
					'value' => array(						
						esc_html__( 'Style 1', 'liven' )   => 'style1',
						esc_html__( 'Style 2', 'liven' ) => 'style2',
					),										
				),	
		        array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Content', 'liven' ),
					'param_name' => 'liven_content',
					'description' => esc_html__( 'Maximum of 6 elements can be shown properly.', 'liven' ),
					'params' => array(
						array(
							'type' => 'iconpicker',
							'heading' => esc_html__( 'Icon', 'liven' ),
							'description' => esc_html__( 'Select icon.', 'liven' ),
							'param_name' => 'liven_icon',														
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Title', 'liven' ),
							'param_name' => 'liven_title',
							'description' => esc_html__( 'Enter title.', 'liven' ),
							'admin_label' => true,
						),
						array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Info', 'liven' ),
							'param_name' => 'liven_info',
							'description' => esc_html__( 'Enter information.', 'liven' ),
						),
					),
				),
				array(
					'type' => 'attach_image',
        	    	'heading' => esc_html__('Paralax Image', 'liven'),
                	'holder' => 'div',
    	            'param_name' => 'liven_paralax_image_url',
    	            'edit_field_class' => 'vc_col-sm-6 vc_column',
    	        ),
				array(
					'type' => 'attach_image',
        	    	'heading' => esc_html__('Object Image', 'liven'),
                	'holder' => 'div',
    	            'param_name' => 'liven_object_image_url',
    	            'edit_field_class' => 'vc_col-sm-6 vc_column',
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
                    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
                )		
			) ,
			
		));		
	}