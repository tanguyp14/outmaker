<?php
add_action('vc_before_init', 'liven_vc_post_list_integrateWithVC');
function liven_vc_post_list_integrateWithVC(){
    $postTypes = get_post_types( array() );
	$postTypesList = array();
	$excludedPostTypes = array(
		'revision',
		'page',
		'attachment',
		'liven_tabs',
		'clients',
		'nav_menu_item',
		'vc_grid_item',
	);
	$anim = '';
	if ( is_array( $postTypes ) && ! empty( $postTypes ) ) {
		foreach ( $postTypes as $postType ) {
			
			if ( ! in_array( $postType, $excludedPostTypes ) ) {
				 $obj = get_post_type_object( $postType );
				$label =$obj->labels->singular_name;
				$postTypesList[] = array(
					$postType,
					$label,
				);
			}
		}
	}
    
    add_shortcode('liven_vc_post_list', 'liven_vc_post_list_func');
    function liven_vc_post_list_func($atts, $content = null)
    {
        extract(shortcode_atts(array(
			'post_type' => '',
			'post_v_style' => 'haff',
			'image_url' => '',
			'liven_animation' => '',
			'liven_animation_type' => 'fadeInDown',
            'el_class' => ''
        ), $atts));
		$pg_content='';
		$pg_content1='';
		$classtemp='';
		$query_options = array(			
            'post_type' => esc_html($post_type),
			'posts_per_page'   => 3,
			'orderby' => 'post__in'
		);
		
		if($liven_animation == 'true'){
			$anim = 'wow '.$liven_animation_type;
		}
		$liven_img= wp_get_attachment_image_src( $image_url, 'full');
		$src =$liven_img[0];
		
		if($post_v_style=="haff")
			$pg_content.='	<div class="blogbg" style="background-image:url('.esc_url($src).');">
							  <div class="container">
								<div class="blogsec">
								  <div class="blogdiv wow fadeInDown">
									<div class="row">';
		else $pg_content.='	<div class="blogbg-col-2" style="background-image:url('.esc_url($src).');">
							  <div class="container">
									<div class="row">';
			$query = get_posts($query_options);
			foreach ($query as $p) :
			$image_src =  wp_get_attachment_image_src( get_post_thumbnail_id($p->ID), 'full' ); 
				$pg_content.=	'<div class="col-md-4 col-sm-4 blogcell '.$anim.' '.$el_class.'">
									<div class="zoomeffect_cell"><a href="'.get_page_link($p->ID).'">';
											if(isset($image_src[0]))
                                               $pg_content .=  ' <img src="'.$image_src[0].'" class="img-responsive zoomeffect" alt="'.esc_html($p->post_title).'"/>';
                                           $pg_content .=  '</a></div>
									<h4><a href="'.get_page_link($p->ID).'">'.esc_html($p->post_title).'</a></h4>';
								
								if(esc_html($post_type)=="testimonial" || esc_html($post_type)=="liven_team"  ){
									$key_1_value = get_post_meta( $p->ID, '_t_designation', true );
										
										if ( ! empty( $key_1_value ) ) {
											$pg_content.= '<p><small>'.$key_1_value.'</small></p>';
										}
										else {
											$pg_content.= '<p><small>'.get_the_date( 'd F Y', $p->ID).'</small></p>';
										}
								}elseif(esc_html($post_type)=="portfolio"){
									 $terms=get_the_terms(  $p->ID ,'portfolio_categories') ;
									 if($terms!=""){
										 $liven_post_terms=array();
										foreach ($terms  as $term ) {
												 $liven_post_terms[]= esc_html($term->name);
										}
										$pg_content.= '<p><small>'.implode(" | ",$liven_post_terms).'</small></p>';
									 }
									 else
										{
										$pg_content.= '<p><small>'.get_the_date( 'd F Y', $p->ID).'</small></p>';
										}									
								}else{
									  $pg_content.=	'<p><small>'.get_the_date( 'd F Y', $p->ID).'</small></p>';
									  }
									  $pg_content.=	'</div>';
			endforeach;
			if($post_v_style=="haff"){
									$pg_content.= '<div class="clr"></div>
												</div>
											  </div>
											</div>
											<div class="clearfix"></div>
										  </div>
										</div>';
			}else{ 					$pg_content.='  <div class="clr"></div>
												</div>
											<div class="clearfix"></div>
										  </div>
										</div>';
			}
        return $pg_content;
    }
    
    vc_map(array(
        'name' => esc_html__('Liven Post List', 'liven'),
        'base' => 'liven_vc_post_list',
        'category' => esc_html__('Liven Extensions', 'liven'),
        'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',      
        'params' => array(
           array(
                'type' => 'dropdown',
                'heading' => esc_html__('Background Style', 'liven'),
                'param_name' => 'post_v_style',
                'admin_label' => false,
                'value' => array(
                    'Half Background' => 'haff',    
                    'Full Background' => 'full',                
                ),
            ),
           array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Data Source', 'liven' ),
				'param_name' => 'post_type',
				'value' => $postTypesList,
				'save_always' => true,
				'description' => esc_html__( 'Select content type for your grid.', 'liven' ),
				'admin_label' => true,
			),		
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Image', 'liven'),
				'holder' => 'div',
				'param_name' => 'image_url',
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
            )
        )
    ));
}