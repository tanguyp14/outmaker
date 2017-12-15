<?php
if (!function_exists('liven_pricing_table1')) {
    function liven_pricing_table1($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'table_title' => '',
            'icon_price' => '',
            'table_price' => '',
            'table_price_period' => '',
			'liven_ptable_cnt' => '',
			'price_table_link' => '',
			'price_table_note' => '',
			'liven_animation' => '',
			'liven_animation_type' => 'fadeInDown',
			'table_el_class' => '',			
        ), $atts));
		
		$output = '';
		$btn = vc_build_link( $price_table_link );
        $liven_ptable_cnt=(array) vc_param_group_parse_atts( $liven_ptable_cnt );	
		$list_icon = $pg_content = $list_icon = $anim = '';
		
		if($liven_animation == 'true'){
			$anim = 'wow '.$liven_animation_type;
		}
        $output = '<div class="col-md-3 col-sm-6 text-center '.$table_el_class.' '.$anim.'">
					<div class="pricing-table-2">
					  <h3>'.$table_title.'</h3>
					  <h2>';
					  if($icon_price != ''){
					  	$output .= '<sup><i class="'.$icon_price.'"></i></sup>';
					  }
					 	$output .= $table_price;
					  if($table_price_period != ''){
						$output .= '<sub>'.$table_price_period.'</sub>';
					  }
		$output .= '</h2>
					  <ul class="text-left">';
						foreach ( $liven_ptable_cnt as $k => $v ) {
							
							if(isset($v['icon_select'])){
								$list_icon = '<i class="'.$v['icon_select'].' fa-2x-before"></i> ';
							}
									if(!isset($v['table_point'])){
									$v['table_point'] = '';	
									}	
							$output .= '<li>';
								if(isset($v['is_bold'])){
								if($v['is_bold']==true)
								{
									$output .= '<strong>'.$list_icon.$v['table_point'].'</strong>';
								}else{
									$output .= $list_icon.$v['table_point'];
								}
								}else{
									$output .= $list_icon.$v['table_point'];
								}
							$output .= '</li>';
						}					
		  $output .= '</ul>
					  <p>'.$price_table_note.'</p>
					  <a href="'.$btn['url'].'" target="'.$btn['target'].'" class="pt1-btn">'.$btn['title'].'</a>
					</div>
				  </div>';
        
        return $output;
    }
    
}

if (!function_exists('liven_pricing_table2')) {
    function liven_pricing_table2($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'table_title' => '',
            'icon_price' => '',
            'table_price' => '',
            'table_price_period' => '',
			'liven_ptable_cnt' => '',
			'price_table_link' => '',
			'price_table_note' => '',
			'liven_animation' => '',
			'liven_animation_type' => 'fadeInDown',	
			'table_el_class' => '',			
        ), $atts));
		
		$list_icon = $pg_content = $list_icon = $anim = '';
		$btn = vc_build_link( $price_table_link );
        $liven_ptable_cnt=(array) vc_param_group_parse_atts( $liven_ptable_cnt );
		if($liven_animation == 'true'){
			$anim = 'wow '.$liven_animation_type;
		}
        $output = '<div class="col-md-3 col-sm-6 '.$table_el_class.' '.$anim.'">
					<div class="pricing-table-3">
					  <div class="pricing-head-3">
						<h4>'.$table_title.'</h4>
						<h2>';
						  if($icon_price != ''){
							$output .= '<sup><i class="'.$icon_price.'"></i></sup>';
						  }
							$output .= $table_price;
						  if($table_price_period != ''){
							$output .= '<sub>'.$table_price_period.'</sub>';
						  }
			$output .= '</h2>
						<div class="pricing-shape-3"></div>
					  </div>
					  <div class="pricing-info-3">
						<ul class="text-left">';
						foreach ( $liven_ptable_cnt as $k => $v ) {
							if(isset($v['icon_select'])){
								$list_icon = '<i class="'.$v['icon_select'].' fa-2x-before"></i> ';
							}
							$output .= '<li>';
								if(isset($v['is_bold'])){
								if($v['is_bold']==true)
								{
									$output .= '<strong>'.$list_icon.$v['table_point'].'</strong>';
								}else{
									$output .= $list_icon.$v['table_point'];
								}
								}else{
									$output .= $list_icon.$v['table_point'];
								}
							$output .= '</li>';
						}					
		  $output .= '</ul>
						<p>'.$price_table_note.'</p>
						<a  href="'.$btn['url'].'" target="'.$btn['target'].'" class="pt2-btn">'.$btn['title'].'<i class="fa fa-angle-right fa-1x-after"></i></a>
					  </div>
					</div>
				  </div>';
       
        return $output;
    }
    
}


add_action('vc_before_init', 'liven_pricing_table_integrateWithVC');
function liven_pricing_table_integrateWithVC()
{
    add_shortcode('pricing_tables_group', 'liven_pricing_table_base_function');
    function liven_pricing_table_base_function($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'pricing_table_style' => 'pt_style2',
            'primary_tbl_clr' => '#009cff',
            'secondary_tbl_clr' => '#000',			
		    'el_class' => '',			
        ), $atts));
		
		$list_icon = $pg_content = $list_icon = $anim = '';
		$uniqueID = uniqid();		
        if ($pricing_table_style == 'pt_style1')
            {  add_shortcode('single_table', 'liven_pricing_table1');}
        if ($pricing_table_style == 'pt_style2')
            {  add_shortcode('single_table', 'liven_pricing_table2');}
			
		$GLOBALS['pg_content'].= '
							.pt'.$uniqueID.' .pricing-table-2:hover { border-color:'.$primary_tbl_clr.'; }
							.pt'.$uniqueID.' .pricing-table-2 h2{ color:'.$primary_tbl_clr.'; }
							.pt'.$uniqueID.' .pt1-btn { border-color:'.$primary_tbl_clr.'; background-color:'.$primary_tbl_clr.'; }
							.pt'.$uniqueID.' .pt1-btn:hover { color:'.$primary_tbl_clr.'; background-color:transparent; }  
							
							.pt'.$uniqueID.' .pricing-table-3:hover { border-color:'.$primary_tbl_clr.'; }								
							.pt'.$uniqueID.' .pt2-btn { border-color:'.$primary_tbl_clr.'; background-color:'.$primary_tbl_clr.'; }
							.pt'.$uniqueID.' .pt2-btn:hover { color:'.$primary_tbl_clr.'; background-color:transparent; }  
							.pt'.$uniqueID.' .pricing-head-3 { background-color:'.$secondary_tbl_clr.'; }
							.pt'.$uniqueID.' .pricing-table-3:hover .pricing-head-3 { background-color:'.$primary_tbl_clr.'; }
						'; 
			
        $pg_content .= '<div class="pricing-table  pt'.$uniqueID.' '.$el_class.'">'.do_shortcode($content).'</div>'; 
        
		return $pg_content;
    }
    
    vc_map(array(
        'name' =>esc_html__('Liven Pricing Tables Group', 'liven'),
        'base' => 'pricing_tables_group',
		'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
        'category' => esc_html__('Liven Extensions', 'liven'),
        'as_parent' => array(
            'only' => 'single_table'
        ),
        'content_element' => true,
        'show_settings_on_create' => true,
        'is_container' => true,
        'params' => array(
            
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Style', 'liven'),
                'param_name' => 'pricing_table_style',
                'std' => 'pt_style2',
                'value' => array(
                    esc_html__('Two Color', 'liven') => 'pt_style2',
                    esc_html__('One Color', 'liven') => 'pt_style1'
                )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Default Table Color', 'liven'),
                'param_name' => 'primary_tbl_clr',
                'std' => '#009cff',                
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Header Background Color', 'liven'),
                'param_name' => 'secondary_tbl_clr',
                'std' => '#000',
                'dependency' => array(
                    'element' => 'pricing_table_style',
                    'value' => 'pt_style2'
                )
            ),			
            array(
                'type' => 'textfield',
                'heading' =>esc_html__('Extra Class Name', 'liven'),
                'param_name' => 'el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'liven')
            )
        ),
        'js_view' => 'VcColumnView'
    ));
	//*************************************************************************************************************************
    vc_map(array(
        'name' => esc_html__('Liven Pricing Table', 'liven'),
        'base' => 'single_table',
		'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
        'category' => esc_html__('Liven Extensions', 'liven'),
        'content_element' => true,
        'as_child' => array(
            'only' => 'pricing_table'
        ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Table Title', 'liven'),
                'param_name' => 'table_title'
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Select Icon', 'liven'),
                'param_name' => 'icon_price',
                'edit_field_class' => 'vc_col-sm-4 vc_column'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Table Price', 'liven'),
                'edit_field_class' => 'vc_col-sm-4 vc_column',
                'param_name' => 'table_price'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Price Period', 'liven'),
                'edit_field_class' => 'vc_col-sm-4 vc_column',
                'param_name' => 'table_price_period'
            ),
            
            array(
                'type' => 'param_group',
                'heading' => esc_html__('Pricing Table Content', 'liven'),
                'param_name' => 'liven_ptable_cnt',
                'value' => urlencode(json_encode(array(
                    array(
                        'table_point' => esc_html__('Point 1', 'liven'),
                        'icon_select' => 'fa fa-check',
						'is_bold' => false,
                    )
                ))),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Table Point', 'liven'),
                        'param_name' => 'table_point',
                        'admin_label' => true
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__('Select List Icon', 'liven'),
                        'param_name' => 'icon_select',
						'std' => 'fa fa-checked',
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__('Is Bold ?', 'liven'),
                        'param_name' => 'is_bold',
						'std' => false,                        
                    )
                )
            ),
            
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Table Note*', 'liven'),
                'description' => esc_html__('Enter your Pricing Table Note.', 'liven'),
                'param_name' => 'price_table_note',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Pricing Table Forward Link', 'liven'),
                'param_name' => 'price_table_link',
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
                'heading' => esc_html__('Extra Class Name', 'liven'),
                'param_name' => 'table_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'liven'),
            ),
        )
    ));
    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_pricing_tables_group extends WPBakeryShortCodesContainer
        {
        }
    }
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_single_table extends WPBakeryShortCode
        {
        }
    }
}