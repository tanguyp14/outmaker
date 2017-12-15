<?php
add_action('vc_before_init', 'liven_custom_slider_integrateWithVC');
function liven_custom_slider_integrateWithVC()
{
    add_shortcode('liven_vc_custom_slider', 'liven_vc_custom_slider_func');
    function liven_vc_custom_slider_func($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'title' => '',
			'style' => 'style1',
			'i_slider' => '',
			'i_t_slider' => '',
			'i_t_d_slider' => '',
			't_d_slider' => '',
			'liven_animation' => '',
			'liven_animation_type' => 'fadeInDown',
			'el_class' => '',
        ), $atts));
		
		$pg_content = $anim = '';
		if($liven_animation == 'true'){
			$anim = 'wow '.$liven_animation_type;
		}
		$pg_content .=	'<div class=" halfwidthslider '.$anim.'">';
		switch ($style) {
		
			case 'style1':
			{
			$pg_content .=	 '<div class="halfwidthleft '.$anim.' '.$el_class.'">';
  
					$i_slider=(array) vc_param_group_parse_atts( $i_slider );
					foreach ( $i_slider as $k => $v ) {
						
												if(!isset($v['i_slider_image'])){
													$v['i_slider_image'] = '';	
												}
						 $pg_content .='<div><img src="';
								$liven_extenstion_img_url= wp_get_attachment_image_src( $v['i_slider_image'], 'full');
								$pg_content .= esc_url($liven_extenstion_img_url[0]);
						 $pg_content .= '" class="img-responsive" alt=""></div>';
					}
					$pg_content .=	 '</div>';
				
			}
			break;
			case 'style2':
			{
				
					$pg_content .=	 '<div class="halfwidthright '.$anim.' '.$el_class.'">';
  
					$i_t_slider=(array) vc_param_group_parse_atts( $i_t_slider );
					foreach ( $i_t_slider as $k => $v ) {
						
												if(!isset($v['i_t_slider_image'])){
													$v['i_t_slider_image'] = '';	
												}
												
												if(!isset($v['i_t_slider_title'])){
													$v['i_t_slider_title'] = '';	
												}
						 $pg_content .='<div> ';
						 	$liven_extenstion_img_url= wp_get_attachment_image_src( $v['i_t_slider_image'], 'full');
											if(isset($liven_extenstion_img_url[0])){
												$pg_content .=  '<img src="';
											
												$pg_content .= esc_url($liven_extenstion_img_url[0]);
												$pg_content .= '" class="img-responsive" alt="">';
											}
                                               $pg_content .=  '  <div class="caption">
								<div class="captiontext">
								'.(($v['i_t_slider_title']!="")?('<h3>'.$v['i_t_slider_title'].'</h3>'):'').'
								  <p></p>
								</div>
							  </div></div>';
					}
					$pg_content .=	 '</div>';
		
			}
			break;
			case 'style3':
			{
				
				$pg_content .=	 '<div class="halfwidthright '.$anim.' '.$el_class.'">';
  
					$i_t_d_slider=(array) vc_param_group_parse_atts( $i_t_d_slider );
					foreach ( $i_t_d_slider as $k => $v ) {
						
												if(!isset($v['i_t_d_slider_image'])){
													$v['i_t_d_slider_image'] = '';	
												}
												if(!isset($v['i_t_d_slider_title'])){
													$v['i_t_d_slider_title'] = '';	
												}
												if(!isset($v['i_t_d_slider_desc'])){
													$v['i_t_d_slider_desc'] = '';	
												}
						 $pg_content .='<div>';
						 $liven_extenstion_img_url= wp_get_attachment_image_src( $v['i_t_d_slider_image'], 'full');
								if(isset($liven_extenstion_img_url[0])){
												$pg_content .=  '<img src="';
											
												$pg_content .= esc_url($liven_extenstion_img_url[0]);
												$pg_content .= '" class="img-responsive" alt="">';
											}
						 $pg_content .= ' <div class="caption">
								<div class="captiontext">
								'.(($v['i_t_d_slider_title']!="")?('<h3>'.$v['i_t_d_slider_title'].'</h3>'):'').' <p>'.$v['i_t_d_slider_desc'].'</p>
								</div>
							  </div></div>';
					}
					$pg_content .=	 '</div>';
		
			}
			break;
			case 'style4':
			{
				$pg_content .=	 '<div class="contentslider '.$anim.' '.$el_class.'">';
  
					$t_d_slider=(array) vc_param_group_parse_atts( $t_d_slider );
					foreach ( $t_d_slider as $k => $v ) {
						
												if(!isset($v['t_d_slider_title'])){
													$v['t_d_slider_title'] = '';	
												}
												if(!isset($v['t_d_slider_desc'])){
													$v['t_d_slider_desc'] = '';	
												}
						 $pg_content .='<div>
						 '.(($v['t_d_slider_title']!="")?('<h3>'.$v['t_d_slider_title'].'</h3>'):'').'
								  <p>'.$v['t_d_slider_desc'].'</p>
								</div>';
					}
					$pg_content .=	 '</div>';
					
		
			}
		}
			$pg_content .=	 '</div>';
        return $pg_content;
    }
    
    vc_map(array(
        'name' => esc_html__('Liven Slider', 'liven'),
        'base' => 'liven_vc_custom_slider',
        'category' => esc_html__('Liven Extensions', 'liven'),
        'icon' => get_template_directory_uri()  . '/vc_extend/vc_liven_icon.png',    
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Slider Style', 'liven'),
                'param_name' => 'style',
                'admin_label' => true,
                'value' => array(
                    'Image Slider' => 'style1',
                    'Image & Title Slider' => 'style2',
                    'Image & Title With Description Slider' => 'style3',
                    'Title With Description Slider' => 'style4'
                )
            ),
            array(
                'type' => 'param_group',
                'heading' =>esc_html__('Image Slider Containt', 'liven'),
                'param_name' => 'i_slider',
                'params' => array(
                    array(
					'type' => 'attach_image',
        	    	'heading' => esc_html__('Slide Image', 'liven'),
                	'holder' => 'div',
    	            'param_name' => 'i_slider_image',
    	        ),
                ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'style1' )
                )
            ),
            
            array(
                'type' => 'param_group',
                'heading' =>esc_html__('Image & Title Slider Containt', 'liven'),
                'param_name' => 'i_t_slider',
                'params' => array(
                    array(
						'type' => 'attach_image',
						'heading' => esc_html__('Slide Image', 'liven'),
						'holder' => 'div',
						'param_name' => 'i_t_slider_image',
    	        	),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Slide Title', 'liven') ,
						'param_name' => 'i_t_slider_title',
		    		),
                ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'style2' )
                )
            ),
            
            array(
	            'type' => 'param_group',
                'heading' =>esc_html__('Image & Title With Description Containt', 'liven'),
                'param_name' => 'i_t_d_slider',
                'params' => array(
                    array(
						'type' => 'attach_image',
						'heading' => esc_html__('Slide Image', 'liven'),
						'holder' => 'div',
						'param_name' => 'i_t_d_slider_image',
    	        	),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Slide Title', 'liven') ,
						'param_name' => 'i_t_d_slider_title',
		    		),
					array(
						'type' => 'textarea',
						'heading' => esc_html__( 'Description', 'liven' ),
						'param_name' => 'i_t_d_slider_desc',
					),
                ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'style3' )
                )
            ),
			
			array(
            	'type' => 'param_group',
                'heading' =>esc_html__('Title With Description Containt', 'liven'),
                'param_name' => 't_d_slider',
                'params' => array(
					 array(
						'type' => 'textfield',
						'heading' => esc_html__('Slide Title', 'liven') ,
						'param_name' => 't_d_slider_title',
		    		),
					array(
						'type' => 'textarea',
						'heading' => esc_html__( 'Description', 'liven' ),
						'param_name' => 't_d_slider_desc',
					),
                ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'style4' )
                )
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
                'heading' => esc_html__('Extra Class Name', 'liven'),
                'param_name' => 'el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'liven')
            ),
			//========================================= Design Options =============================================
			
        )
    ));
}