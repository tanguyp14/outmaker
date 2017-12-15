<?php
    add_action( 'vc_before_init', 'liven_revslider_integrateWithVC' );
    function liven_revslider_integrateWithVC($revsliders = array()) {
	    add_shortcode( 'liven_vc_revslider', 'liven_vc_revslider_func' );
        function liven_vc_revslider_func( $atts, $content = null ) {
			extract( shortcode_atts( array(
			    'liven_revslider_style' => 'style1',
      		    'alias' => '',
	  		    'el_class' => '',
       		), $atts ));
			
       		$anim = '';
			$pg_content ='';
       		$revsl = apply_filters( 'vc_revslider_shortcode', do_shortcode( '[rev_slider ' .liven_vc_containtdata(__($alias,'liven'). ']' ) ));
			
       		switch ($liven_revslider_style) {
       		    
       		    case 'style1':
       		    {
       		        $pg_content='
       		            <div class="'.$el_class.'">
                            <div class="slidermain">
                                '.$revsl .'
                                <div class="divider leftdiv"></div>
                                <div class="divider rightdiv"></div>
                            </div>
                        </div>
       		        ';    
       		    }
       		    break;
       		    
       		    case 'style2':
       		    {
       		        $pg_content='
       		            <div class="'.$el_class.'">
                            <div class="slidermain">
                                '.$revsl .'
                                <div class="dividerfull"></div>
                            </div>
                        </div>
       		        ';    
       		    }
       		    break;
       		    
       		    case 'style3':
       		    {
       		        $pg_content='
       		            <div class="'.$el_class.'">
                            <div class="slidermain">
                                '.$revsl .'
                            </div>
                        </div>
       		        ';    
       		    }
       		    break;
       		}
       		return $pg_content;
       	};
        
		
		 if (is_plugin_active('revslider/revslider.php')) {
			 
		$slider = new RevSlider();
		$arrSliders = $slider->getArrSliders();

		$revsliders = array();
		if ( $arrSliders ) {
			foreach ( $arrSliders as $slider ) {				
				$revsliders[ $slider->getTitle() ] = $slider->getAlias();
			}
		} else {
			$revsliders[ esc_html__( 'No sliders found', 'js_composer' ) ] = 0;
		}
			
		vc_map(array(
			'name' => esc_html__('Liven Revolution Slider', 'liven') ,
			'base' => 'liven_vc_revslider',
			'category' => esc_html__('Liven Extensions', 'liven') ,
			'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
			'description' => esc_html__('Adds different styles to revolution slider.', 'liven') ,
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Slider Style', 'liven' ),
					'param_name' => 'liven_revslider_style',
					'description' => esc_html__( 'Select style for slider.', 'liven' ),
					'value' => array(
						esc_html__( 'Style 1', 'liven' ) => 'style1',
						esc_html__( 'Style 2', 'liven' ) => 'style2',
						esc_html__( 'Style 3', 'liven' ) => 'style3',
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Revolution Slider', 'liven' ),
					'param_name' => 'alias',
					'admin_label' => true,
					'value' => $revsliders,
					'save_always' => true,
					'description' => esc_html__( 'Select your Revolution Slider.', 'liven' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra Class Name', 'liven' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'liven' ),
				),
			)
		));
        }
    }