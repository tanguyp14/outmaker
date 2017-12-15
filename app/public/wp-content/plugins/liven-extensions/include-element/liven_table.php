<?php
	add_action( 'vc_before_init', 'liven_vc_table_integrateWithVC' );
	function liven_vc_table_integrateWithVC() {
		add_shortcode( 'liven_vc_table', 'liven_vc_table_func' );
		function liven_vc_table_func( $atts, $content = null, $iconpicker = null ) {
   			extract( shortcode_atts( array(
				'style' => 'style1',
				'border_color' => '#dddddd',
				'head_foot_bg_clr' => '#eeeeee',
				'bg_color1' => '#ffffff',
				'bg_color2' => '#f4f4f4',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',
				'el_class' => '',				
				'css' => '',
   			), $atts ));
			
			$pg_content ='';
			$tbl_class = $anim = '';	
			$uniqueID = uniqid();
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, '' ));
			$content = wpb_js_remove_wpautop($content, true);
			
			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}
			if($style == 'style2'){
				$tbl_class = 'table-striped ';
			}elseif($style == 'style3'){
				$tbl_class = 'table-bordered ';
			}
			
			$GLOBALS['pg_content'].= '
								.tbl'.$uniqueID.' .table tbody tr td, .tbl'.$uniqueID.' .table tbody tr th, .tbl'.$uniqueID.' .table tfoot tr td, .tbl'.$uniqueID.' .table tfoot tr th, .tbl'.$uniqueID.' .table thead tr td, .tbl'.$uniqueID.' .table thead tr th{ border-color:'.$border_color.'; }
								.tbl'.$uniqueID.' .table tfoot tr td, .tbl'.$uniqueID.' .table tfoot tr th, .tbl'.$uniqueID.' .table thead tr th, .tbl'.$uniqueID.' .table thead tr td { background-color:'.$head_foot_bg_clr.'; }
								.tbl'.$uniqueID.' .table-striped tbody tr:nth-of-type(2n+1) { background-color: '.$bg_color1.'; }
								.tbl'.$uniqueID.' .table-striped tbody tr:nth-of-type(2n) { background-color: '.$bg_color2.'; }
								.tbl'.$uniqueID.' .table-bordered, .tbl'.$uniqueID.' .table-bordered tbody tr td, .tbl'.$uniqueID.' .table-bordered tbody tr th, .tbl'.$uniqueID.' .table-bordered tfoot tr td, .tbl'.$uniqueID.' .table-bordered tfoot tr th, .tbl'.$uniqueID.' .table-bordered thead tr td, .tbl'.$uniqueID.' .table-bordered thead tr th { border-color:'.$border_color.'}
						   ';
						   
			$pg_content .= '<div class="tbl'.$uniqueID.' '.$el_class.' '.$css_class.' '.$anim.'"><div class="table '.$tbl_class.' table-responsive">'.$content.'</div></div>';
			
			return $pg_content;
		}
		
		vc_map(array(
			'name' => esc_html__('Liven Table', 'liven') ,
			'base' => 'liven_vc_table',
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
			'category' => esc_html__('Liven Extensions',  'liven') ,			
			'description' => esc_html__('Adds styles to your data tables.',  'liven') ,
			'params' => array(							
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'heading' => esc_html__('Table HTML content.', 'liven') ,
					'param_name' => 'content',
					'value' => '<table>
								<thead>
								<tr>
								<th>header 1</th>
								<th>header 2</th>
								<th>header 3</th>
								<th>header 4</th>
								</tr>
								</thead>
								<tbody>
								<tr>
								<td>Item #1</td>
								<td>Item #1-1</td>
								<td>Item #1-2</td>
								<td>Item #1-3</td>
								</tr>
								
								<tr>
								<td>Item #2</td>
								<td>Item #2-1</td>
								<td>Item #2-2</td>
								<td>Item #2-3</td>
								</tr>
								
								<tr>
								<td>Item #3</td>
								<td>Item #3-1</td>
								<td>Item #3-2</td>
								<td>Item #3-3</td>
								</tr>
								</tbody>
								
								<tfoot>
								<tr>
								<th>Footer 1</th>
								<th>Footer 2</th>
								<th>Footer 3</th>
								<th>Footer 4</th>
								</tr>										
								</tfoot>
								</table>',
					'description' => esc_html__('Paste your table HTML code here.', 'liven')
				) ,
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Style', 'liven') ,
					'param_name' => 'style',
					'value' => array(
						'Style 1' => 'style1',
						'Style 2' => 'style2',
						'Style 3' => 'style3'
					),
				) ,
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__('Table Border Color', 'liven') ,
					'param_name' => 'border_color',
					'std' => '#dddddd',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				) ,
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__('Table Header & Footer Background Color', 'liven') ,
					'param_name' => 'head_foot_bg_clr',
					'std' => '#cccccc',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				) ,
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__('First Background Color', 'liven') ,
					'param_name' => 'bg_color1',
					'dependency' => array(
						'element' => 'style',
						'value' => 'style2',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				) ,
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__('Second Background Color ', 'liven') ,
					'param_name' => 'bg_color2',
					'dependency' => array(
						'element' => 'style',
						'value' => 'style2',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
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
					'param_name'  => 'liven_animation_type',
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
				//=========================== Design Option ===============================				
				array(
					'type' => 'css_editor',
					'heading' => esc_html__( 'Css', 'liven' ),
					'param_name' => 'css',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
			)
		));
    }