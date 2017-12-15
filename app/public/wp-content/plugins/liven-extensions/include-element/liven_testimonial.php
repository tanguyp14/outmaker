<?php
    add_action( 'vc_before_init', 'liven_testimonial_integrateWithVC' );
    function liven_testimonial_integrateWithVC() {
        add_shortcode( 'liven_vc_testimonial', 'liven_vc_testimonial_func' );
        function liven_vc_testimonial_func( $atts, $content = null ) {
   		    extract( shortcode_atts( array(
          		'liven_testimonial_display_option' => 'slider',
          		'liven_testimonial_slider_style_option' => 'style1',
          		'liven_testimonial_style_option' => 'style1',
          		'liven_testimonials_title' => '',
          		'liven_testimonials' => '',
          		'liven_testimonials_count' => '-1',
				'liven_show_navi' => '',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',
          		'liven_testimonials_heading_color' => '#000',
          		'liven_testimonials_content_color' => '#000',
          		'liven_testimonial_slider_arraow_bg_color' => '',
          		'liven_testimonial_slider_arraow_bg_hover_color' => '',
          		'liven_testimonials_odd_bg_color' => '#f1f1f1',
          		'liven_testimonials_even_bg_color' => '',
          		'liven_testimonials_bg_color' => '#fff',
          		'liven_testimonials_slider_bg_color' => '#f1f1f1',
          		'liven_testimonials_title_color' => '#000',
          		'liven_testimonials_designation_color' => '#009cff',
          		'liven_testimonial_slider_icon_class' => 'folder-open',
          		'liven_testimonials_slider_icon_color' => '#009cff',
          		'liven_testimonial_icon_class' => 'folder-open',
          		'liven_testimonials_icon_color' => '#009cff',
          		'el_class' => '',
       		), $atts ));
			
			$show_navigation = $anim = $pg_content = '';
			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}
			if($liven_show_navi == true){
				$show_navigation = 'display:block !important';
			}
		
	        if($liven_testimonials==''){
		        $query_options = array(		
    		        'post_type' => 'liven_testimonial',
    	    		'posts_per_page' => $liven_testimonials_count,
	    	    	'orderby' => 'post__in'
		    	);
    		}
	    	else{
   		        $query_options = array(		
			        'post__in' => explode(', ',esc_html($liven_testimonials)),	
                    'post_type' => 'liven_testimonial',
	        		'posts_per_page' => $liven_testimonials_count,
		        	'orderby' => 'post__in'
    		    );
    	    }
   		    
   		    $uniqueID = uniqid();
		    $query = get_posts($query_options);
            $pg_content='';
            $pg_content1='';
            
            
            switch ($liven_testimonial_display_option) {
		        case 'slider':
		        {
		            switch ($liven_testimonial_slider_style_option) {
		                case 'style1':
		                {
		                   $GLOBALS['pg_content'].= '
                                    .cls'.$uniqueID.' .slick-next, .cls'.$uniqueID.'  .slick-prev {
                                        background: '.$liven_testimonial_slider_arraow_bg_color.';
                                    }
                                    .cls'.$uniqueID.' .slick-next:focus, .cls'.$uniqueID.' .slick-next:hover, .cls'.$uniqueID.' .slick-prev:focus, .cls'.$uniqueID.' .slick-prev:hover {
                                        background: '.$liven_testimonial_slider_arraow_bg_hover_color.';
                                    }
                                    .cls'.$uniqueID.' h4{
                                        color: '.$liven_testimonials_title_color.';
                                    }
                                    .cls'.$uniqueID.' h2 span{
                                        color: '.$liven_testimonials_heading_color.';
                                    }
                                    .cls'.$uniqueID.' p small{
                                        color: '.$liven_testimonials_designation_color.';
                                    }
                                    .cls'.$uniqueID.' p{
                                        color: '.$liven_testimonials_content_color.';
                                    }
   			                   
        		            ';
		                    foreach ($query as $p) :
                                $liven_testimonial_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'full');
                                $pg_content .=  '
                                <div>
                                    <div class="section-md">
                                        <div class="avtarshape">
                                            <div class="losange">
                                                <div class="los1">';
											if(isset($liven_testimonial_img_url[0]))
                                               $pg_content .=  '     <img src="'.esc_url($liven_testimonial_img_url[0]).'" class="img-responsive" alt="'.$p->post_title.'"> ';
                                           $pg_content .=  ' </div>
                                            </div>
                                        </div>										
                                        <h4>'.$p->post_title.'</h4>
                                        <p><small>'. esc_html(get_post_meta($p->ID, '_t_designation', true)).'</small></p>
                                        <p class="testi-cnt">'.liven_vc_containtdata(__( $p->post_content,"liven")).'</p>
                                    </div>
                                </div>
                            ';
                            endforeach;
 
                            $pg_content1 .= '
                            <div class="'.$el_class.' '.$anim.'">
                                <div class="container testimonialfull-data text-center wow fadeInDown cls'.$uniqueID.'">
									'.(($liven_testimonials_title!="")?('<h2><span>'.esc_html($liven_testimonials_title).'</span></h2>'):'').'
                                    <div class="testimonialslider testi-slider1">';
                                        $pg_content=$pg_content1.$pg_content;
                                        $pg_content .='           
                                    </div>
                                </div>
                            </div>
                            ';
		                }
		                break;
		                
		                case 'style2':
		                {
		                   $GLOBALS['pg_content'].= '
                                    .cls'.$uniqueID.' .usrname strong{
                                        color: '.$liven_testimonials_title_color.';
                                    }
                                    .cls'.$uniqueID.' h2 span{
                                        color: '.$liven_testimonials_heading_color.';
                                    }
                                    .cls'.$uniqueID.' .usrname p {
                                        color: '.$liven_testimonials_designation_color.';
                                    }
                                    .cls'.$uniqueID.' .testimonialbg p{
                                        color: '.$liven_testimonials_content_color.';
                                    }
                                    .liven_testimonials_slider_bg_color'.$uniqueID.' {
                                        background:'.$liven_testimonials_slider_bg_color.';
                                    }
                                    .liven_testimonials_slider_bg_color'.$uniqueID.'::before {
                                        color:'.$liven_testimonials_slider_bg_color.';
                                    }
                                    .liven_testimonials_slider_bg_color'.$uniqueID.' span {
                                        color:'.$liven_testimonials_slider_icon_color.';
                                    }
									.cls'.$uniqueID.' .testimonialright .slick-dots{
										'.$show_navigation.'									
									}
   			                   
        		            ';
		                    foreach ($query as $p) :
                                $liven_testimonial_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'full');
                                $pg_content .=  '
                                <div>
                                    <div class="testimonialbg liven_testimonials_slider_bg_color'.$uniqueID.' ">
                                        <span><i class="fa fa-1x fa-'.$liven_testimonial_slider_icon_class.'"></i></span>
                                        <p>'.liven_vc_containtdata(__( $p->post_content,"liven")).'</p>
                                    </div>
                                    <div class="userimg">';
											if(isset($liven_testimonial_img_url[0]))
                                               $pg_content .=  '  <img src="'.esc_url($liven_testimonial_img_url[0]).'"  alt="'.$p->post_title.'" /> ';
                                           $pg_content .=  ' </div>
                                    <div class="usrname">
                                        <strong>'.$p->post_title.'</strong>
                                        <p>'. esc_html(get_post_meta($p->ID, '_t_designation', true)).'</p>
                                    </div>
                                </div>
                            ';
                            endforeach;
 
                            $pg_content1 .= '
                            <div class="'.$el_class.' '.$anim.'">
                                <div class="cls'.$uniqueID.'">
									'.(($liven_testimonials_title!="")?('<h2><span>'.esc_html($liven_testimonials_title).'</span></h2>'):'').'
                                    <div class="testimonialright">';
                                        $pg_content=$pg_content1.$pg_content;
                                        $pg_content .='           
                                    </div>
                                </div>
                            </div>
                            ';
		                }
		                break;
		            }
		        }
		        break;
		        case 'list':
		        {
		            switch ($liven_testimonial_style_option) {
		                case 'style1':
		                {
		                    $uniqueID = uniqid();
		                  $GLOBALS['pg_content'].= '
   			                        .liven_testimonial_odd_bg'.$uniqueID.' {
                                        background:'.$liven_testimonials_odd_bg_color.';
   			                        }
   			                        .liven_testimonial_even_bg'.$uniqueID.' {
                                        background:'.$liven_testimonials_even_bg_color.';
   			                        }
   			                        .liven_testimonials_title_color'.$uniqueID.' {
                                        color:'.$liven_testimonials_title_color.';
   			                        }
   			                        .liven_testimonials_designation_color'.$uniqueID.'{
   			                            color: '.$liven_testimonials_designation_color.'!important;
   			                            font-weight: 400 !important;
   			                        }
   			                        .liven_testimonials_icon_color'.$uniqueID.'{
   			                            color: '.$liven_testimonials_icon_color.'!important;
   			                        }
   			                    
		                    ';
		                    $pg_content .=  '<div class="'.$el_class.'">';
		                    $cc =1;
		                    foreach ($query as $p) :
                                $liven_testimonial_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'full');
                                
                                if($cc % 2 != 0 ){
                                    $pg_content .=  '
                                        <div class=" '.$anim.' testimonials-1 liven_testimonial_odd_bg'.$uniqueID.'">
                                            <div class="col-md-2 col-sm-2 col-xs-12 testimonials-1-pic">';
											if(isset($liven_testimonial_img_url[0]))
                                               $pg_content .=  '  <img src="'.esc_url($liven_testimonial_img_url[0]).'" class="img-responsive img-circle" alt="'.$p->post_title.'">';
                                           $pg_content .=  '  </div>
                                            <div class="col-md-10 col-sm-10 col-xs-12 testimonial-1-info">
                                                <h3 class="liven_testimonials_title_color'.$uniqueID.'">'.$p->post_title.'&nbsp; 
                                                    <small class="liven_testimonials_designation_color'.$uniqueID.'">
                                                        '.esc_html(get_post_meta($p->ID, '_t_designation', true)).'
                                                    </small>
                                                </h3>
                                                <span><i class="fa fa-1x fa-'.$liven_testimonial_icon_class.' liven_testimonials_icon_color'.$uniqueID.'"></i></span>
                                                <p>'.liven_vc_containtdata(__( $p->post_content,"liven")).'</p>
                                            </div>
                                        </div>
                                    ';
                                }else{
                                    $pg_content .=  '
                                        <div class="'.$anim.' testimonials-1 liven_testimonial_even_bg'.$uniqueID.'">
                                            <div class="col-md-2 col-sm-2 col-xs-12 testimonials-1-pic pull-right">   ';
											if(isset($liven_testimonial_img_url[0]))
                                               $pg_content .=  ' <img src="'.esc_url($liven_testimonial_img_url[0]).'" class="img-responsive img-circle" alt="'.$p->post_title.'">';
                                           $pg_content .=  ' </div>
                                            <div class="col-md-10 col-sm-10 col-xs-12 testimonial-1-info">
                                                <h3 class="liven_testimonials_title_color'.$uniqueID.'">'.$p->post_title.'&nbsp; 
                                                    <small class="liven_testimonials_designation_color'.$uniqueID.'">
                                                        '.esc_html(get_post_meta($p->ID, '_t_designation', true)).'
                                                    </small>
                                                </h3>
                                                <span><i class="fa fa-1x fa-'.$liven_testimonial_icon_class.' liven_testimonials_icon_color'.$uniqueID.'"></i></span> 
                                                <p>'.liven_vc_containtdata(__( $p->post_content,"liven")).'</p>
                                            </div>
                                        </div>    
                                    ';
                                }
                            $cc++;
                            endforeach;
                            $pg_content .=  '</div>';
                        }
		                break;
		                case 'style2':
		                {
		                    $uniqueID = uniqid();
		                   $GLOBALS['pg_content'].= '
		                            .liven_testimonials_downarrow_color'.$uniqueID.'{
		                                color:'.$liven_testimonials_bg_color.'!important;
		                            } 
   			                        .liven_testimonials_bg_color'.$uniqueID.' {
                                        background:'.$liven_testimonials_bg_color.';
                                        padding:15px;
   			                        }
   			                        .liven_testimonials_bg_color'.$uniqueID.' p{
                                            margin-left: 30px;
   			                        }
   			                        .liven_testimonials_bg_color'.$uniqueID.' span{
   			                            position: absolute;
                                        left: 35px;
                                        top: 17px;
                                    }
   			                        .liven_testimonials_title_color'.$uniqueID.' {
                                        color:'.$liven_testimonials_title_color.';
   			                        }
   			                        .liven_testimonials_designation_color'.$uniqueID.'{
   			                            color: '.$liven_testimonials_designation_color.'!important;
   			                            font-style: italic;
                                        font-size: 14px;
   			                        }
   			                        .liven_testimonials_icon_color'.$uniqueID.'{
   			                            color: '.$liven_testimonials_icon_color.'!important;
   			                        }  
		                    ';
		                    $pg_content .='
		                        <div class="'.$el_class.'">
		                            <div class="'.$anim.' testimonials-1 ">
		                    ';
		                    foreach ($query as $p) :
		                        $liven_testimonial_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'full');
		                        
    		                    $pg_content .='
	    	                        <div class="col-md-6 col-sm-6 testimonials-2">
                                        <div class="liven_testimonials_bg_color'.$uniqueID.'">
                                            <p>'.liven_vc_containtdata(__( $p->post_content,"liven")).'</p>
                                            <span><i class="fa fa-1x fa-'.$liven_testimonial_icon_class.' liven_testimonials_icon_color'.$uniqueID.'"></i></span>
                                        </div>
                                        <div class="testimonial-2-pic">
                                            <div class="testimonial-2-figure">';
											if(isset($liven_testimonial_img_url[0]))
                                               $pg_content .=  '  <img src="'.esc_url($liven_testimonial_img_url[0]).'" class="img-responsive img-circle" alt="'.$p->post_title.'">';
                                           $pg_content .=  '<span><i class="fa fa-3x fa-caret-down liven_testimonials_downarrow_color'.$uniqueID.'"></i></span>
                                            </div>
                                            <div class="testimonial-2-user">
                                                <p><strong class="liven_testimonials_title_color'.$uniqueID.'">'.$p->post_title.'</strong></p>
                                                <p><span class="liven_testimonials_designation_color'.$uniqueID.'">'.esc_html(get_post_meta($p->ID, '_t_designation', true)).'</span></p>
                                            </div>
                                            <div class="clr"></div>
                                        </div>
                                    </div>
                                ';
		                    endforeach;
		                    $pg_content .='
		                            </div>
		                        </div>
		                    ';
		                }
		                break;
		                case 'style3':
		                {
		                    $uniqueID = uniqid();
		                    $GLOBALS['pg_content'].= '
		                            .liven_testimonials_bg_color'.$uniqueID.' {
                                        background:'.$liven_testimonials_bg_color.';
                                        margin-bottom: 30px;
   			                        }
   			                        
   			                        .liven_testimonials_bg_color'.$uniqueID.' small{
   			                            color: '.$liven_testimonials_designation_color.';
                                        font-style: italic;
                                        font-size: 14px;
   			                        }
   			                        .liven_testimonials_title_color'.$uniqueID.' {
                                        color:'.$liven_testimonials_title_color.';
   			                        }
   			                        .liven_testimonials_icon_color'.$uniqueID.'{
   			                            color: '.$liven_testimonials_icon_color.'!important;
   			                        }
   			                    
		                    ';
		                    
		                    $pg_content .='
		                        <div class="'.$el_class.' '.$anim.'">
							';
								foreach ($query as $p) :
									$pg_content .='
										<div class="col-md-6 col-sm-6">
											<div class="liven_testimonials_bg_color'.$uniqueID.'">
												<div class="testimonial-3-info">
													<span><i class="fa fa-1x fa-'.$liven_testimonial_icon_class.' liven_testimonials_icon_color'.$uniqueID.'"></i></span>
													<p>'.liven_vc_containtdata(__( $p->post_content,"liven")).'</p>
													<p>
														<i class="fa fa-user fa-1x-before liven_testimonials_title_color'.$uniqueID.'"></i>
														<strong class="liven_testimonials_title_color'.$uniqueID.'">'.$p->post_title.'</strong>
														<small>- '.esc_html(get_post_meta($p->ID, '_t_designation', true)).'</small>
													</p>
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
		        }
                break;
	        }
	        return $pg_content;
        }
    
        vc_map(array(
            'name' => esc_html__('Liven Testimonial', 'liven') ,
            'base' => 'liven_vc_testimonial',
            'category' => esc_html__('Liven Extensions', 'liven') ,
            'icon' => get_template_directory_uri()  . '/vc_extend/vc_liven_icon.png',
            'description' => esc_html__('Adds styles to testimonials.', 'liven') ,
            'params' => array(
                array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Display Option', 'liven' ),
					'param_name' => 'liven_testimonial_display_option',
					'description' => esc_html__( 'Select testimonial display option.', 'liven' ),
					'value' => array(
						esc_html__( 'Slider', 'liven' ) => 'slider',
						esc_html__( 'List', 'liven' ) => 'list',
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Slider Style Option', 'liven' ),
					'param_name' => 'liven_testimonial_slider_style_option',
					'description' => esc_html__( 'Select testimonial slider style option for listing.', 'liven' ),
					'value' => array(
						esc_html__( 'Style 1', 'liven' ) => 'style1',
						esc_html__( 'Style 2', 'liven' ) => 'style2',
					),
					'dependency' => array(
						'element' => 'liven_testimonial_display_option',
						'value' => 'slider',
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'List Style Option', 'liven' ),
					'param_name' => 'liven_testimonial_style_option',
					'description' => esc_html__( 'Select testimonial style option for listing.', 'liven' ),
					'value' => array(
						esc_html__( 'Style 1', 'liven' ) => 'style1',
						esc_html__( 'Style 2', 'liven' ) => 'style2',
						esc_html__( 'Style 3', 'liven' ) => 'style3',
					),
					'dependency' => array(
						'element' => 'liven_testimonial_display_option',
						'value' => 'list',
					),
				),
	            array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'liven') ,
                    'param_name'  => 'liven_testimonials_title',
                    'value' => '',
                    'dependency' => array(
						'element' => 'liven_testimonial_display_option',
						'value' => 'slider',
					),
                ) ,
	    	    array(
                    'type' => 'autocomplete',
                    'heading' => esc_html__('Testimonials', 'liven') , 
                    'param_name' => 'liven_testimonials',
    	    		'admin_label' => true, 
	    	    	'settings' => array(
        		        'multiple' => true,
    	    			'sortable' => true,
			    		'groups' => true,
    			    	'unique_values' => true,
    					'display_inline' => true,			
	    				'auto_focus' => true,
    	    			'values' => liven_get_cpt_data('liven_testimonial')
    	    		),
                ) ,
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Count', 'liven') , 
                    'param_name' => 'liven_testimonials_count',
                    'value' => '-1',
                    'description' => esc_html__('How many testimonials you would like to show? (-1 means unlimited)', 'liven')
                ) ,               
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Navigation?', 'liven' ),
					'param_name' => 'liven_show_navi',
					'std' => false,
					'dependency' => array(
						'element' => 'liven_testimonial_slider_style_option',
						'value' => 'style2',
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
                    'param_name' => 'el_class',
                    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
                ),
				//==================================================================================================================
                array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'liven' ),
					'param_name' => 'liven_testimonials_slider_bg_color',
					'description' => esc_html__( 'Select background color for testimonial slider.', 'liven' ),
					'std' => '#f1f1f1',
					'dependency' => array(
					    'element' => 'liven_testimonial_slider_style_option',
						'value' => 'style2',
					),
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
                array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Main Heading Color', 'liven' ),
					'param_name' => 'liven_testimonials_heading_color',
					'description' => esc_html__( 'Select color for main heading title.', 'liven' ),
					'std' => '#000',
					'dependency' => array(
						'element' => 'liven_testimonial_display_option',
						'value' => 'slider',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Title Color', 'liven' ),
					'param_name' => 'liven_testimonials_title_color',
					'description' => esc_html__( 'Select color for testimonial title.', 'liven' ),
					'std' => '#000',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group'       => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Designation Color', 'liven' ),
					'param_name' => 'liven_testimonials_designation_color',
					'description' => esc_html__( 'Select color for testimonial designation.', 'liven' ),
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Content Color', 'liven' ),
					'param_name' => 'liven_testimonials_content_color',
					'description' => esc_html__( 'Select color for content.', 'liven' ),
					'std' => '#000',
					'dependency' => array(
						'element' => 'liven_testimonial_display_option',
						'value' => 'slider',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group'       => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__('Select Icon:', 'liven'),
					'param_name' => 'liven_testimonial_slider_icon_class',
					'description' => esc_html__('Select the icon from the list.', 'liven'),
					'std' => 'folder-open',
					'dependency' => array(
						'element' => 'liven_testimonial_slider_style_option',
						'value' => 'style2',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'liven' ),
					'param_name' => 'liven_testimonials_slider_icon_color',
					'description' => esc_html__( 'Select color for testimonial icon.', 'liven' ),
					'std' => '#009cff',
					'dependency' => array(
						'element' => 'liven_testimonial_slider_style_option',
						'value' => 'style2',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
                array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Slider Arrow Bacground', 'liven' ),
					'param_name' => 'liven_testimonial_slider_arraow_bg_color',
					'description' => esc_html__( 'Select color for slider arrows.', 'liven' ),
					'std' => '#009cff',
					'dependency' => array(
						'element' => 'liven_testimonial_slider_style_option',
						'value' => 'style1',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Slider Arrow Hover Bacground', 'liven' ),
					'param_name' => 'liven_testimonial_slider_arraow_bg_hover_color',
					'description' => esc_html__( 'Select hover color for slider arrows.', 'liven' ),
					'std' => '#009cff',
					'dependency' => array(
						'element' => 'liven_testimonial_slider_style_option',
						'value' => 'style1',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
                array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Odd Background Color', 'liven' ),
					'param_name' => 'liven_testimonials_odd_bg_color',
					'description' => esc_html__( 'Select odd background color for testimonial.', 'liven' ),
					'std' => '#F1F1F1',
					'dependency' => array(
						'element' => 'liven_testimonial_style_option',
						'value' => 'style1',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group'       => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Even Background Color', 'liven' ),
					'param_name' => 'liven_testimonials_even_bg_color',
					'description' => esc_html__( 'Select even background color for testimonial.', 'liven' ),
					'dependency' => array(
						'element' => 'liven_testimonial_style_option',
						'value' => 'style1',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group'       => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'liven' ),
					'param_name' => 'liven_testimonials_bg_color',
					'description' => esc_html__( 'Select background color for testimonial.', 'liven' ),
					'dependency' => array(
					    'element' => 'liven_testimonial_style_option',
						'value' => array('style2' ,'style3'),
					),
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__('Select Icon:', 'liven'),
					'param_name' => 'liven_testimonial_icon_class',
					'description' => esc_html__('Select the icon from the list.', 'liven'),
					'std' => 'quote-left',
					'dependency' => array(
						'element' => 'liven_testimonial_display_option',
						'value' => 'list',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'liven' ),
					'param_name' => 'liven_testimonials_icon_color',
					'description' => esc_html__( 'Select color for testimonial icon.', 'liven' ),
					'std' => '#009cff',
					'dependency' => array(
						'element' => 'liven_testimonial_display_option',
						'value' => 'list',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
			)
        ));
    }