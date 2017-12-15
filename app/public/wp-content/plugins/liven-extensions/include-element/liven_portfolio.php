<?php
    add_action( 'vc_before_init', 'liven_portfolio_integrateWithVC' );
    function liven_portfolio_integrateWithVC() {
        add_shortcode( 'liven_vc_portfolio', 'liven_vc_portfolio_func' );
        function liven_vc_portfolio_func( $atts, $content = null ) {
   		    extract( shortcode_atts( array(
          		'liven_portfolio_display_option' => 'slider',
          		'liven_portfolio_style_option' => 'style1',
          		'liven_portfolio' => '',
          		'liven_portfolio_filter_tabs' => '',
          		'liven_portfolio_count' => '-1',
          		'liven_portfolio_title_color' => '',
          		'liven_portfolio_category_color' => '',
          		'liven_portfolio_icon_class' => 'folder-open',
          		'liven_portfolio_icon_color' => '#fff',
          		'liven_portfolio_hover_color' => '#fff',
          		'liven_portfolio_slider_arraow_bg_color' => '#009cff',
          		'liven_portfolio_slider_arraow_bg_hover_color' => '#000',
          		'liven_portfolio_filter_tab_bg_color' => '',
          		'liven_portfolio_filter_tab_hover_bg_color' => '',
          		'liven_portfolio_filter_tab_text_color' => '',
          		'liven_portfolio_filter_tab_hover_text_color' => '',
          		'liven_portfolio_date_filter_bg_color' => '',
          		'liven_portfolio_date_filter_text_color' => '',
				'liven_animation' => '',
				'liven_animation_type' => 'fadeInDown',
          		'el_class' => '',
       		), $atts ));
			
			$anim = '';
			$pg_content ='';
			
	        if($liven_portfolio==''){
		        $query_options = array(		
    		        'post_type' => 'portfolio',
    	    		'posts_per_page' => $liven_portfolio_count,
	    	    	'orderby' => 'post__in'
		    	);
    		}
	    	else{
   		        $query_options = array(		
			        'post__in' => explode(', ',esc_html($liven_portfolio)),	
                    'post_type' => 'portfolio',
	        		'posts_per_page' => $liven_portfolio_count,
		        	'orderby' => 'post__in'
    		    );
    	    }
   		
		    $query = get_posts($query_options);
   			if($liven_animation == 'true'){
				$anim = 'wow '.$liven_animation_type;
			}

		    switch ($liven_portfolio_display_option) {
		        case 'slider':
		        {
		            $filterarray=array();
                    $uniqueID = uniqid();
                    $pg_content='';
                    $pg_content1='';
            
                   $GLOBALS['pg_content'].= '
   			                .liven_portfolio_hover_color'.$uniqueID.':hover .mask {
                                opacity: 0.8;
                                background: '.$liven_portfolio_hover_color.';
                            }
                            .cls'.$uniqueID.' .slick-next, .cls'.$uniqueID.'  .slick-prev {
                                background: '.$liven_portfolio_slider_arraow_bg_color.';
                            }
                            .cls'.$uniqueID.' .slick-next:focus, .cls'.$uniqueID.' .slick-next:hover, .cls'.$uniqueID.' .slick-prev:focus, .cls'.$uniqueID.' .slick-prev:hover {
                                background: '.$liven_portfolio_slider_arraow_bg_hover_color.';
                            }                            
                            .liven_portfolio_icon_color'.$uniqueID.'{
                                color:'.$liven_portfolio_icon_color.';
                            }
                            .cls'.$uniqueID.' h4{
                                color: '.$liven_portfolio_title_color.';
                            }
                            .cls'.$uniqueID.' h6{
                                color: '.$liven_portfolio_category_color.';
                            }
   			           
		            ';
		            foreach ($query as $p) :
                        $liven_portfolio_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'full');
                        $liven_post_terms='';
                        $terms=get_the_terms(  $p->ID ,'portfolio_categories') ;
                        $first = true;
                        if($terms!=''){
                            foreach ($terms  as $term ) {
                                if ( $first ){
                                    $liven_post_terms .= esc_html($term->name);
                                    $first = false;
                                }
                                else {
                                    $liven_post_terms .= ' | '.esc_html($term->name);
                                }
                                
                                if (!in_array($term->name, $filterarray, true)) {
                                    array_push($filterarray,esc_html($term->name));
                                }
                            }
                        }
                        
                        $pg_content .=  '
                        <div>
                            <div class="view thumb-hover-effect liven_portfolio_hover_color'.$uniqueID.' "> ';
											if(isset($liven_portfolio_img_url[0]))
                                               $pg_content .=  '   <img src="'.esc_url($liven_portfolio_img_url[0]).'" class="img-responsive" alt="'.$p->post_title.'">';
                                           $pg_content .=  ' <div class="mask cls'.$uniqueID.'">
                                    <a href = "'.get_the_permalink($p->ID).'" class="info" >
                                        <i class="'.$liven_portfolio_icon_class.' fa-2x liven_portfolio_icon_color'.$uniqueID.'"></i>
                                        <h4>'.$p->post_title.'</h4>
                                        <h6>'.$liven_post_terms.'</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                        ';
                    endforeach;
 
                    $pg_content1 .= '
                    <div class="'.$el_class.'">
                        <div class="portfolio-full-slide '.$anim.'">                            
                            <div class="variable-width cls'.$uniqueID.'">';
                                $pg_content=$pg_content1.$pg_content;
                                $pg_content .='
                            </div>
                        </div>
                    </div>
                    ';
                }
		        break;
		        case 'list':
		        {
		            switch ($liven_portfolio_style_option) {
		                case 'style1':
		                {
		                    $filterarray=array();
		                    $uniqueID = uniqid();
		                    $pg_content="";
                            $pg_content1="";
                            
		                    $GLOBALS['pg_content'].= ' 
		                            .cls'.$uniqueID.':hover .mask-img {
                                        opacity: 0.8;
                                        background: '.$liven_portfolio_hover_color.';
                                    }
                                    .liven_portfolio_hover_color'.$uniqueID.':hover .mask {
                                        opacity: 0.8;
                                        background: '.$liven_portfolio_hover_color.';
                                    }                                    
                                    .liven_portfolio_icon_color'.$uniqueID.'{
                                        color:'.$liven_portfolio_icon_color.';
                                    }
                                    .cls'.$uniqueID.' h4{
                                        color: '.$liven_portfolio_title_color.';
                                    }
                                    .cls'.$uniqueID.' span{
                                        color: '.$liven_portfolio_category_color.';
                                    }
                                    .cls'.$uniqueID.' ul li a {
                                        color: '.$liven_portfolio_filter_tab_text_color.';
                                        background: '.$liven_portfolio_filter_tab_bg_color.';
                                    }
                                    .cls'.$uniqueID.' ul li a.active, .cls'.$uniqueID.' ul li a:focus, .cls'.$uniqueID.' ul li a:hover {
                                        background: '.$liven_portfolio_filter_tab_hover_bg_color.';
                                        color: '.$liven_portfolio_filter_tab_hover_text_color.';
                                        text-decoration: none;
                                    }
   			                   
    		                ';
		                    
                            
                            foreach ($query as $p) :
                                $liven_post_terms="";
                                $terms=get_the_terms(  $p->ID ,'portfolio_categories') ;
                                $first = true;
                                if($terms!=""){
                                    foreach ($terms  as $term ) {
                                        if ( $first ){
                                            $liven_post_terms .= esc_html($term->name);
                                            $first = false;
                                        }
                                        else {
                                            $liven_post_terms .= " | ".esc_html($term->name);
                                        }
                                        if (!in_array($term->name, $filterarray, true)) {
                                            array_push($filterarray,esc_html($term->name));
                                        }
                                    }
                                }
                                $liven_portfolio_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'full');
                                $pg_content .=  '
                                    <div class="'.str_replace('_|_',' ',str_replace(' ', '_', $liven_post_terms)).' text-center portfoliobox">
                                        <a href="'.get_the_permalink($p->ID).'">
                                            <div class="portfolio1 cls'.$uniqueID.'">  ';
											if(isset($liven_portfolio_img_url[0]))
                                               $pg_content .=  '     <img src="'. esc_url($liven_portfolio_img_url[0]) .'" alt="'.$p->post_title.'"/>';
                                           $pg_content .=  '  <div class="mask-img">
                                                    <div class="zoomicon">
                                                        <i class="'.$liven_portfolio_icon_class.' fa-2x liven_portfolio_icon_color'.$uniqueID.'"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="portfoliotitle cls'.$uniqueID.' ">
                                                <h4>'.esc_html($p->post_title).'</h4>
                                                <span>'.$liven_post_terms.'</span>
                                            </div>
                                        </a>
                                    </div>
                                '; 
                            endforeach;
		                    $pg_content1 .='
		                    <div class="'.$el_class.'">
		                        <div class="col-md-12">';
                                    if($liven_portfolio_filter_tabs == true){
                    $pg_content1 .='<div class="portfolioFilter cls'.$uniqueID.' wow fadeInDown">
                                        <ul class="portfolio-filter-wrap">
                                            <li><a href="#" data-filter="*" class="active">All</a></li>';
                                            foreach ($filterarray  as $term ) {
                                                $pg_content1 .= '  <li><a href="#"  data-filter=".'.esc_html(str_replace(' ', '_', $term)).'">'.ucwords(esc_html($term)).'</a></li>';
                                            }
                       $pg_content1 .= '</ul>
									</div>';
                                    }
                                    
                    $pg_content1 .='
                                    <div class="portfoliodiv wow fadeInDown">';
                                        $pg_content = $pg_content1.$pg_content;
                         $pg_content .= '<div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            ';
		                }
		                break;
		                case 'style2':
		                {
		                    $filterarray=array();
		                    $uniqueID = uniqid();
		                    $pg_content="";
                            $pg_content1="";
                            
                          $GLOBALS['pg_content'].= '
		                            .cls'.$uniqueID.':hover .mask-img {
                                        opacity: 0.8;
                                        background: '.$liven_portfolio_hover_color.';
                                    }
                                    .liven_portfolio_hover_color'.$uniqueID.':hover .mask {
                                        opacity: 0.8;
                                        background: '.$liven_portfolio_hover_color.';
                                    }
                                    .liven_portfolio_icon_color'.$uniqueID.'{
                                        color:'.$liven_portfolio_icon_color.';
                                    }
                                    .cls'.$uniqueID.' h4 span{
                                        color: '.$liven_portfolio_title_color.';
                                    }
                                    .cls'.$uniqueID.' span{
                                        color: '.$liven_portfolio_category_color.';
                                    }
                                    .cls'.$uniqueID.' ul li a {
                                        color: '.$liven_portfolio_filter_tab_text_color.';
                                        background: '.$liven_portfolio_filter_tab_bg_color.';
                                    }
                                    .cls'.$uniqueID.' ul li a.active, .cls'.$uniqueID.' ul li a:focus, .cls'.$uniqueID.' ul li a:hover {
                                        background: '.$liven_portfolio_filter_tab_hover_bg_color.';
                                        color: '.$liven_portfolio_filter_tab_hover_text_color.';
                                        text-decoration: none;
                                    }
   			                   
    		                ';
    		                
    		                foreach ($query as $p) :
                                $liven_post_terms="";
                                $terms=get_the_terms(  $p->ID ,'portfolio_categories') ;
                                $first = true;
                                if($terms!=""){
                                    foreach ($terms  as $term ) {
                                        if ( $first ){
                                            $liven_post_terms .= esc_html($term->name);
                                            $first = false;
                                        }
                                        else {
                                            $liven_post_terms .= " | ".esc_html($term->name);
                                        }
                                        if (!in_array($term->name, $filterarray, true)) {
                                            array_push($filterarray,esc_html($term->name));
                                        }
                                    }
                                }
                                $liven_portfolio_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'full');
                                $pg_content .=  '
                                    <div class="'.str_replace('_|_',' ',str_replace(' ', '_', $liven_post_terms)).' text-center portfoliobox2"> 
                                        <a href="'.get_the_permalink($p->ID).'">
                                            <div class="portfolio2 cls'.$uniqueID.' "> ';
											if(isset($liven_portfolio_img_url[0]))
                                               $pg_content .=  '  <img src="'. esc_url($liven_portfolio_img_url[0]) .'" alt="'.$p->post_title.'"/>';
                                           $pg_content .=  ' <div class="mask-img cls'.$uniqueID.'">
                                                    <h4><span>'.esc_html($p->post_title).'</span></h4>
                                                    <span>'.$liven_post_terms.'</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                '; 
                            endforeach;
                            
                            $pg_content1 .='
                            <div class="'.$el_class.'">
		                        <div class="col-md-12">';
                                    if($liven_portfolio_filter_tabs == true){
                    $pg_content1 .='<div class="portfolioFilter cls'.$uniqueID.' wow fadeInDown">
                                        <ul class="portfolio-filter-wrap">
                                            <li><a href="#" data-filter="*" class="active">All</a></li>';
                                            foreach ($filterarray  as $term ) {
                                                $pg_content1 .= '  <li><a href="#"  data-filter=".'.esc_html(str_replace(' ', '_', $term)).'">'.ucwords(esc_html($term)).'</a></li>';
                                            }
                       $pg_content1 .= '</ul>
									</div>';
                                    }
                                    
                    $pg_content1 .='
                                    <div class="portfoliodiv wow fadeInDown">';
                                        $pg_content = $pg_content1.$pg_content;
                         $pg_content .= '<div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            ';
		                }
		                break;
		                
		                case 'style3':
		                {
		                    $filterarray=array();
		                    $uniqueID = uniqid();
		                    $pg_content="";
                            $pg_content1="";
                            
                         $GLOBALS['pg_content'].= '
		                            .cls'.$uniqueID.':hover .mask-img {
                                        opacity: 0.8;
                                        background: '.$liven_portfolio_hover_color.';
                                    }
                                    .liven_portfolio_hover_color'.$uniqueID.':hover .mask {
                                        opacity: 0.8;
                                        background: '.$liven_portfolio_hover_color.';
                                    }
                                    .liven_portfolio_icon_color'.$uniqueID.'{
                                        color:'.$liven_portfolio_icon_color.';
                                    }
                                    .cls'.$uniqueID.' h4{
                                        color: '.$liven_portfolio_title_color.';
                                    }
                                    .cls'.$uniqueID.' span{
                                        color: '.$liven_portfolio_category_color.';
                                    }
                                    .cls'.$uniqueID.' ul li a {
                                        color: '.$liven_portfolio_filter_tab_text_color.';
                                        background: '.$liven_portfolio_filter_tab_bg_color.';
                                    }
                                    .cls'.$uniqueID.' ul li a.active, .cls'.$uniqueID.' ul li a:focus, .cls'.$uniqueID.' ul li a:hover {
                                        background: '.$liven_portfolio_filter_tab_hover_bg_color.';
                                        color: '.$liven_portfolio_filter_tab_hover_text_color.';
                                        text-decoration: none;
                                    }
   			                 
    		                ';
    		                
    		                foreach ($query as $p) :
                                $liven_post_terms="";
                                $terms=get_the_terms(  $p->ID ,'portfolio_categories') ;
                                $first = true;
                                if($terms!=""){
                                    foreach ($terms  as $term ) {
                                        if ( $first ){
                                            $liven_post_terms .= esc_html($term->name);
                                            $first = false;
                                        }
                                        else {
                                            $liven_post_terms .= " | ".esc_html($term->name);
                                        }
                                        if (!in_array($term->name, $filterarray, true)) {
                                            array_push($filterarray,esc_html($term->name));
                                        }
                                    }
                                }
                                $liven_portfolio_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'full');
                                $pg_content .=  '
                                    <div class="'.str_replace('_|_',' ',str_replace(' ', '_', $liven_post_terms)).' text-center portfoliobox3">
                                        <a href="'.get_the_permalink($p->ID).'">
                                            <div class="portfolio3 cls'.$uniqueID.'">';
											if(isset($liven_portfolio_img_url[0]))
                                               $pg_content .=  '   <img src="'. esc_url($liven_portfolio_img_url[0]) .'" alt="'.$p->post_title.'"/>';
                                           $pg_content .=  '  <div class="mask-img cls'.$uniqueID.' ">
                                                    <div class="zoomicn">
                                                        <i class="'.$liven_portfolio_icon_class.' fa-2x liven_portfolio_icon_color'.$uniqueID.'"></i>
                                                    </div>
                                                    <h4>'.esc_html($p->post_title).'</h4>
                                                    <span>'.$liven_post_terms.'</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                '; 
                            endforeach;
                            
                            $pg_content1 .='
                            <div class="'.$el_class.'">';
                                if($liven_portfolio_filter_tabs == true){
                $pg_content1 .='<div class="portfolioFilter cls'.$uniqueID.' wow fadeInDown">
                                    <ul class="portfolio-filter-wrap">
                                        <li><a href="#" data-filter="*" class="active">All</a></li>';
                                        foreach ($filterarray  as $term ) {
                                            $pg_content1 .= '  <li><a href="#"  data-filter=".'.esc_html(str_replace(' ', '_', $term)).'">'.ucwords(esc_html($term)).'</a></li>';
                                        }
                    $pg_content1 .= '</ul>
								</div>';
                                }
                $pg_content1 .='
                                <div class="portfoliodiv wow fadeInDown">';
                                    $pg_content = $pg_content1.$pg_content;
                                    $pg_content .= '<div class="clearfix"></div>
                                </div>
                            </div>
                            ';
		                }
		                break;
		                
		                case 'style4':
		                {
		                    $filterarray=array();
		                    $uniqueID = uniqid();
		                    $pg_content="";
                            $pg_content1="";
                            
                            $GLOBALS['pg_content'].= '
		                            .cls'.$uniqueID.':hover .mask-img {
                                        opacity: 0.8;
                                        background: '.$liven_portfolio_hover_color.';
                                    }
                                    .liven_portfolio_hover_color'.$uniqueID.':hover .mask {
                                        opacity: 0.8;
                                        background: '.$liven_portfolio_hover_color.';
                                    }
                                    .liven_portfolio_icon_color'.$uniqueID.'{
                                        color:'.$liven_portfolio_icon_color.';
                                    }
                                    .cls'.$uniqueID.' h4{
                                        color: '.$liven_portfolio_title_color.';
                                    }
                                    .cls'.$uniqueID.' span{
                                        color: '.$liven_portfolio_category_color.';
                                    }
                                    .cls'.$uniqueID.' ul li a {
                                        color: '.$liven_portfolio_filter_tab_text_color.';
                                        background: '.$liven_portfolio_filter_tab_bg_color.';
                                    }
                                    .cls'.$uniqueID.' ul li a.active, .cls'.$uniqueID.' ul li a:focus, .cls'.$uniqueID.' ul li a:hover {
                                        background: '.$liven_portfolio_filter_tab_hover_bg_color.';
                                        color: '.$liven_portfolio_filter_tab_hover_text_color.';
                                        text-decoration: none;
                                    }
   			                    
    		                ';
    		                
    		                foreach ($query as $p) :
                                $liven_post_terms="";
                                $terms=get_the_terms(  $p->ID ,'portfolio_categories') ;
                                $first = true;
                                if($terms!=""){
                                    foreach ($terms  as $term ) {
                                        if ( $first ){
                                            $liven_post_terms .= esc_html($term->name);
                                            $first = false;
                                        }
                                        else {
                                            $liven_post_terms .= " | ".esc_html($term->name);
                                        }
                                        //$liven_post_terms .=esc_html($term->name);
                                        if (!in_array($term->name, $filterarray, true)) {
                                            array_push($filterarray,esc_html($term->name));
                                        }
                                    }
                                }
                                $liven_portfolio_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'full');
                                $pg_content .=  '
                                    <div class="'.str_replace('_|_',' ',str_replace(' ', '_', $liven_post_terms)).' text-center portfoliobox4">
                                        <a href="'.get_the_permalink($p->ID).'">
                                            <div class="portfolio4 cls'.$uniqueID.' ">';
											if(isset($liven_portfolio_img_url[0]))
                                               $pg_content .=  ' <img src="'. esc_url($liven_portfolio_img_url[0]) .'" alt="'.$p->post_title.'"/>';
                                           $pg_content .=  ' <div class="mask-img">
                                                    <div class="hvrlink cls'.$uniqueID.'">
                                                        <i class="'.$liven_portfolio_icon_class.' fa-2x liven_portfolio_icon_color'.$uniqueID.'"></i>
                                                        <h4>'.esc_html($p->post_title).'</h4>
                                                        <span>'.$liven_post_terms.'</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                '; 
                            endforeach;
                            
                            $pg_content1 .='
                            <div class="'.$el_class.'">';
                                if($liven_portfolio_filter_tabs == true){
                $pg_content1 .='<div class="col-lg-12 filter cls'.$uniqueID.' wow fadeInDown">
                                    <ul class="portfolio-filter-wrap">
                                        <li><a href="#" data-filter="*" class="active">All</a></li>';
                                        foreach ($filterarray  as $term ) {
                                            $pg_content1 .= '  <li><a href="#"  data-filter=".'.esc_html(str_replace(' ', '_', $term)).'">'.ucwords(esc_html($term)).'</a></li>';
                                        }
                    $pg_content1 .= '</ul>
								</div>';
                                }
                $pg_content1 .='
                                <div class="clearfix"></div>
                                <div class="portfoliodiv4 wow fadeInDown">';
                                    $pg_content = $pg_content1.$pg_content;
                                    $pg_content .= '<div class="clearfix"></div>
                                </div>
                            </div>
                            ';
		                }
		                break;
		                
		                case 'style5':
		                {
							$query_options5	 = array();	
		                    if($liven_portfolio==""){
		                        $query_options5 = array(		
                                    'post_type'      => 'portfolio',
                                    'posts_per_page' => $liven_portfolio_count,
                                    'orderby'        => 'post__in'
                                );
                            }
                            else{			
								$query_options5 = array(		
                                    'post__in'       => explode(", ",esc_html($liven_portfolio)),	
                                    'post_type'      => 'portfolio',
	                    	    	'posts_per_page' => $liven_portfolio_count,
		                    	    'orderby'        => array('post_date' => 'DESC'),
                                );
                            }
                            $query5 = get_posts($query_options5);
                            
		                    $filterarray=array();
		                    $uniqueID = uniqid();
		                    $pg_content="";
                            $pg_content1="";
                            $post_count = 1;
                            
                            $GLOBALS['pg_content'].= '
		                            .cls'.$uniqueID.':hover .mask-img {
                                        opacity: 0.8;
                                        background: '.$liven_portfolio_hover_color.';
                                    }
                                    .liven_portfolio_hover_color'.$uniqueID.':hover .mask {
                                        opacity: 0.8;
                                        background: '.$liven_portfolio_hover_color.';
                                    }
                                    .liven_portfolio_icon_color'.$uniqueID.'{
                                        color:'.$liven_portfolio_icon_color.';
                                    }
                                    .cls'.$uniqueID.' h4{
                                        color: '.$liven_portfolio_title_color.';
                                    }
                                    .cls'.$uniqueID.' span{
                                        color: '.$liven_portfolio_category_color.';
                                    }
                                    .liven_month_filter'.$uniqueID.' {
                                        background: '.$liven_portfolio_date_filter_bg_color.';
                                        color: '.$liven_portfolio_date_filter_text_color.';
                                    }
                                
    		                ';
    		                
    		                $temp_date = '';
		                    $post_cc = 1;
		                    foreach ($query5 as $p) :
		                        $liven_post_terms="";
                                $terms=get_the_terms(  $p->ID ,'portfolio_categories') ;
                                $first = true;
                                if($terms!=""){
                                    foreach ($terms  as $term ) {
                                        if ( $first ){
                                            $liven_post_terms .= esc_html($term->name);
                                            $first = false;
                                        }
                                        else {
                                            $liven_post_terms .= " | ".esc_html($term->name);
                                        }
                                        
                                        if (!in_array($term->name, $filterarray, true)) {
                                            array_push($filterarray,esc_html($term->name));
                                        }
                                    }
                                }
                                $liven_post_date=    strtotime($p->post_date);
                                $liven_portfolio_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'full');
                              
                                    if( $post_count == 1) { 
                                        $pg_content .='
                                            <div class="monthtitle liven_month_filter'.$uniqueID.'">
                                                '.date('F Y', $liven_post_date).'
                                            </div>
                                            <div class="clr"></div>
                                        ';
                                    }
                                    else{
                                        if(date('m Y',$temp_date) !=  date('m Y', strtotime($p->post_date)))
                                        {
											$post_cc = 1;
                                            $pg_content .='
                                                <div class="clr"></div>
                                                <div class="monthtitle liven_month_filter'.$uniqueID.'">
                                                    '.date('F Y', $liven_post_date).'
                                                </div>
                                                <div class="clr"></div>
                                            ';
                                        }
                                    }
                                    $temp_date  =   $liven_post_date;
									if($post_cc % 2 == 0){
                                       	$txt_align = "text-left";
                                   	}
                                   	else{
                                    	$txt_align = "text-right";
                                   	}
                                    
                    $pg_content .=  '<div class="portfoliobox5 '.$anim.'">
                                        <a href="'.get_the_permalink($p->ID).'">
                                            <h3 class="'.$txt_align.'"> '.$p->current_post.'   <strong>'.date("d", $liven_post_date).'</strong> '.date("F", $liven_post_date).'</h3>
                                            <div class="portfolio5 cls'.$uniqueID.' "> ';
											if(isset($liven_portfolio_img_url[0]))
                                               $pg_content .=  '<img src="'. esc_url($liven_portfolio_img_url[0]) .'" alt="'.$p->post_title.'"/>';
                                           $pg_content .=  ' <div class="mask-img">
                                                    <div class="hvrlink cls'.$uniqueID.' ">
                                                        <i class="'.$liven_portfolio_icon_class.' fa-2x liven_portfolio_icon_color'.$uniqueID.'"></i>
                                                        <h4>'.esc_html($p->post_title).'</h4>
                                                        <span>'.$liven_post_terms.'</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                ';
                                $post_count++;
								$post_cc++;
                            endforeach;
		                    
                            $pg_content1 .= '
                            <div class="'.$el_class.'">
                                <div class="col-lg-12"> 
                                    <div class="portfoliotimeline"> '; 
                       $pg_content1 .=' <div class="portfoliocenter">';
                                            $pg_content = $pg_content1.$pg_content;
                         $pg_content .= '
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
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
            'name' => esc_html__('Liven Portfolio', 'liven') ,
            'base' => 'liven_vc_portfolio',
            'category' => esc_html__('Liven Extensions', 'liven') ,
            'icon' => get_template_directory_uri() . '/vc_extend/vc_liven_icon.png',
            'description' => esc_html__('Adds styles to portfolio.', 'liven') ,
            'params' => array(
                array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Display Option', 'liven' ),
					'param_name' => 'liven_portfolio_display_option',
					'description' => esc_html__( 'Select portfolio display option.', 'liven' ),
					'value' => array(
						esc_html__( 'Slider', 'liven' )   => 'slider',
						esc_html__( 'List', 'liven' )  => 'list',
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Style Option', 'liven' ),
					'param_name' => 'liven_portfolio_style_option',
					'description' => esc_html__( 'Select portfolio style option for listing.', 'liven' ),
					'value' => array(
						esc_html__( 'Style 1', 'liven' ) => 'style1',
						esc_html__( 'Style 2', 'liven' ) => 'style2',
						esc_html__( 'Style 3', 'liven' ) => 'style3',
						esc_html__( 'Style 4', 'liven' ) => 'style4',
						esc_html__( 'Style 5', 'liven' ) => 'style5',
					),
					'dependency' => array(
						'element' => 'liven_portfolio_display_option',
						'value' => 'list',
					),
				),
	    	    array(
                    'type' => 'autocomplete',
                    'heading' => esc_html__('Portfolio', 'liven') , 
                    'param_name' => 'liven_portfolio',
    	    		'admin_label' => true, 
	    	    	'settings' => array(
        		        'multiple' => true,
    	    			'sortable' => true,
			    		'groups' => true,
    			    	'unique_values' => true,
    					'display_inline' => true,			
	    				'auto_focus' => true,
    	    			'values' => liven_get_cpt_data('portfolio')
    	    		),
                ) ,
                array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Filter Tabs?', 'liven' ),
					'param_name' => 'liven_portfolio_filter_tabs',
					'dependency' => array(
						'element' => 'liven_portfolio_display_option',
						'value' => 'list',
					),
					'description' => esc_html__('Enable or disable filter gallery tabs', 'liven')
				),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Count', 'liven') , 
                    'param_name' => 'liven_portfolio_count',
                    'value' => '-1',
                    'description' => esc_html__('How many portfolios you would like to show? (-1 means unlimited)', 'liven')
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
				//======================================== Design Options ==========================================
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Portfolio Title Color', 'liven' ),
					'param_name' => 'liven_portfolio_title_color',
					'description' => esc_html__( 'Select color for portfolio title.', 'liven' ),
					'std' => '#000',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Category Color', 'liven' ),
					'param_name' => 'liven_portfolio_category_color',
					'description' => esc_html__( 'Select color for portfolio category.', 'liven' ),
					'std' => '#009cff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__('Select Icon:', 'liven'),
					'param_name' => 'liven_portfolio_icon_class',
					'description' => esc_html__('Select the icon from the list.', 'liven'),
					'std' => 'folder-open',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'liven' ),
					'param_name' => 'liven_portfolio_icon_color',
					'description' => esc_html__( 'Select color for portfolio icon.', 'liven' ),
					'std' => '#fff',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Portfolio Hover Color', 'liven' ),
					'param_name' => 'liven_portfolio_hover_color',
					'description' => esc_html__( 'Select color for hover effect.', 'liven' ),
					'std' => '#fff',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Slider Arrow Bacground', 'liven' ),
					'param_name' => 'liven_portfolio_slider_arraow_bg_color',
					'description' => esc_html__( 'Select color for slider arrows.', 'liven' ),
					'std' => '#009cff',
					'dependency' => array(
						'element' => 'liven_portfolio_display_option',
						'value' => 'slider',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group'       => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Slider Arrow Hover Bacground', 'liven' ),
					'param_name' => 'liven_portfolio_slider_arraow_bg_hover_color',
					'description' => esc_html__( 'Select hover color for slider arrows.', 'liven' ),
					'std' => '#009cff',
					'dependency' => array(
						'element' => 'liven_portfolio_display_option',
						'value' => 'slider',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group' => esc_html__( 'Design Options', 'liven' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Filter Tab BG Color', 'liven' ),
					'param_name' => 'liven_portfolio_filter_tab_bg_color',
					'description' => esc_html__( 'Select background color for filter tab', 'liven' ),
					'std' => '#f3f3f3',
					'dependency' => array(
						'element' => 'liven_portfolio_filter_tabs',
						'value' => 'true',
					),
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Filter Tab Hover BG Color', 'liven' ),
					'param_name' => 'liven_portfolio_filter_tab_hover_bg_color',
					'description' => esc_html__( 'Select hover background color for filter tab', 'liven' ),
					'std' => '#009cff',
					'dependency' => array(
						'element' => 'liven_portfolio_filter_tabs',
						'value' => 'true',
					),
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Filter Tab Text Color', 'liven' ),
					'param_name' => 'liven_portfolio_filter_tab_text_color',
					'description' => esc_html__( 'Select text color for filter tab', 'liven' ),
					'std' => '#000',
					'dependency' => array(
						'element' => 'liven_portfolio_filter_tabs',
						'value' => 'true',
					),
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Filter Tab Hover Text Color', 'liven' ),
					'param_name' => 'liven_portfolio_filter_tab_hover_text_color',
					'description' => esc_html__( 'Select hover text color for filter tab', 'liven' ),
					'std' => '#fff',
					'dependency' => array(
						'element' => 'liven_portfolio_filter_tabs',
						'value' => 'true',
					),
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Date Filter BG Color', 'liven' ),
					'param_name' => 'liven_portfolio_date_filter_bg_color',
					'description' => esc_html__( 'Select background color for month filter', 'liven' ),
					'std' => '#009cff',
					'dependency' => array(
						'element' => 'liven_portfolio_style_option',
						'value' => 'style5',
					),
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Date Filter Text Color', 'liven' ),
					'param_name' => 'liven_portfolio_date_filter_text_color',
					'description' => esc_html__( 'Select text color for month filter', 'liven' ),
					'std' => '#fff',
					'dependency' => array(
						'element' => 'liven_portfolio_style_option',
						'value' => 'style5',
					),
					'group' => esc_html__( 'Design Options', 'liven' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),				
            )
        ));
    }