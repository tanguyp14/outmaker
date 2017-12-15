<?php
/**
 * Template part for displaying breadcrumb.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package liven
*/

if ( ! function_exists( 'liven_custom_breadcrumbs' ) ) :
function liven_custom_breadcrumbs() {
    
    $liven_breadcrumb_separator      = get_theme_mod('liven_breadcrumb_separator');
    $liven_breadcrumb_homepage_text  = get_theme_mod('liven_breadcrumb_homepage_text');
    
    if(!empty($liven_breadcrumb_separator)){
        $live_temp_text = " ".$liven_breadcrumb_separator." ";
        $separator = esc_html($live_temp_text);
    }
    else{
        $separator = esc_html__(' / ',"liven");
    }
    if(!empty($liven_breadcrumb_homepage_text)){
        $home_title = ucwords(esc_html($liven_breadcrumb_homepage_text));
    }
    else{
        $home_title = esc_html__('Home',"liven");
    }
    
    $custom_taxonomy    = 'product_cat';
    global $post,$wp_query;
    
    if ( is_front_page() && is_home() ) {
        // Default homepage
    }
    elseif ( is_front_page() ) {
        // static homepage
    }
    elseif ( is_home() ) {
        // blog page
        echo '<a class="bread-link bread-home" href="' . esc_url(get_home_url('/')) . '" title="' . esc_html($home_title) . '">' . esc_html($home_title) . '</a>';
        echo esc_html($separator);
        echo '<span class="active">'.esc_html__("Blog","liven").'</span>';
    }   
    elseif ( !is_front_page() ) {
        echo '<a class="bread-link bread-home" href="' . esc_url(get_home_url('/')) . '" title="' . esc_html($home_title) . '">' . esc_html($home_title) . '</a>';
        echo esc_html($separator);
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
            echo '<span class="active">'.get_the_archive_title().'</span>';
        } 
        else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
            $post_type = get_post_type();
            
            if($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<a class="bread-cat bread-custom-post-type-' . esc_html($post_type) . '" href="' . esc_url($post_type_archive) . '" title="' . esc_html($post_type_object->labels->name) . '">' . esc_html($post_type_object->labels->name) . '</a>';
                echo esc_html($separator);
            }
            $custom_tax_name = get_queried_object()->name;
            echo  '<span class="active">'.$custom_tax_name.'</span>';
        } 
        else if ( is_single() ) {
            $post_type = get_post_type();
            
            if($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<a class="bread-cat bread-custom-post-type-' . esc_html($post_type) . '" href="' . esc_url($post_type_archive) . '" title="' . esc_html($post_type_object->labels->name) . '">' . esc_html($post_type_object->labels->name) . '</a>';
                echo esc_html($separator);
            }
            $category = get_the_category();
             
            if(!empty($category)) {
                $array_cat = array_values($category);
                $last_category = end($array_cat);
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= $parents;
                    $cat_display .= $separator;
                }
            }
              
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
            }
              
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<span class="active">'.esc_html(get_the_title()).'</span>';
                  
            } 
            else if(!empty($cat_id)) {
                echo '<a class="bread-cat bread-cat-' . esc_html($cat_id) . ' bread-cat-' . esc_html($cat_nicename) . '" href="' . esc_url($cat_link) . '" title="' . esc_html($cat_name) . '">' . esc_html($cat_name) . '</a>';
                echo esc_html($separator);
                echo '<span class="active">'.esc_html(get_the_title()).'</span>';
            } 
            else {
                echo '<span class="active">'.esc_html(get_the_title()).'</span>';
            }
              
        }
        else if ( is_category() ) {
            echo '<span class="active">'.esc_html(single_cat_title('', false)).'</span>';
        }
        else if ( is_page() ) {
            if( $post->post_parent ){
                $anc = get_post_ancestors( $post->ID );
                $anc = array_reverse($anc);
                $parents = "";
                foreach ( $anc as $ancestor ) {
                    $parents .= '<a class="bread-parent bread-parent-' . esc_html($ancestor) . '" href="' . esc_url(get_permalink($ancestor)) . '" title="' . esc_html(get_the_title($ancestor)) . '">' . esc_html(get_the_title($ancestor)) . '</a>';
                    $parents .= $separator;
                }
                echo $parents;
                echo '<span class="active">'.esc_html(get_the_title()).'</span>';
                   
            }
            else {
               echo '<span class="active">'.esc_html(get_the_title()).'</span>';
            }
               
        }
        else if ( is_tag() ) {
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            echo '<span class="active">'.esc_html($get_term_name).'</span>';
        }
        elseif ( is_day() ) {
            echo '<a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . esc_url(get_year_link( get_the_time('Y') )) . '" title="' . esc_html(get_the_time('Y')) . '">' . esc_html(get_the_time('Y')) . esc_html__(' Archives',"liven").' </a>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . esc_html($separator) . ' </li>';
               
            echo '<a class="bread-month bread-month-' . get_the_time('m') . '" href="' . esc_url(get_month_link( get_the_time('Y'), get_the_time('m') )) . '" title="' . esc_html(get_the_time('M')) . '">' . esc_html(get_the_time('M')) . esc_html__(' Archives',"liven").' </a>';
            echo esc_html($separator);
               
            echo '<span class="active">'.esc_html(get_the_time('jS')) . ' ' . esc_html(get_the_time('M')) . esc_html__(' Archives',"liven").'</span>';
               
        } 
        else if ( is_month() ) {
            echo '<a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . esc_url(get_year_link( get_the_time('Y') ),"liven") . '" title="' . esc_html(get_the_time('Y')) . '">' . esc_html(get_the_time('Y')) . esc_html__(' Archives',"liven").'</a>';
            echo esc_html($separator);
            echo  '<span class="active">'.esc_html(get_the_time('M')) . esc_html__(' Archives',"liven").'</span>';
               
        }
        else if ( is_year() ) {
              echo  '<span class="active">'.esc_html(get_the_time('Y')) . esc_html__(' Archives',"liven").'</span>';
        }
        else if ( is_author() ) {
            global $author;
            $userdata = get_userdata( $author );
            echo  '<span class="active">'.esc_html__('Author: ',"liven") . esc_html($userdata->display_name).'</span>';
        }
        else if ( get_query_var('paged') ) {
             echo  '<span class="active">'.esc_html__('Page',"liven") . ' ' . esc_html(get_query_var('paged')).'</span>';
               
        }
        else if ( is_search() ) {
            echo  '<span class="active">'.esc_html__('Search results for: ',"liven") . esc_html(get_search_query()).'</span>';
           
        }
        elseif ( is_404() ) {
            echo  '<span class="active">'.esc_html__('Error 404',"liven").'</span>';
        }
    }
}
endif;

$liven_general_global_page_title = get_theme_mod('liven_general_global_page_title'); 
$liven_general_global_breadcrumb = get_theme_mod('liven_general_global_breadcrumb');
$liven_breadcrumb_style          = get_theme_mod('liven_breadcrumb_style');
$breadcrumb_opt                  = get_post_meta(get_the_ID(), 'breadcrumb_option_key', true);
$pagetitle_opt                   = get_post_meta(get_the_ID(), 'pagetitle_option_key', true);
    
?>    
<div class="breadcrumb">
    <?php
    if($liven_breadcrumb_style == 'liven_breadcrumb_style_1' || $liven_breadcrumb_style == ''){
        if($liven_general_global_page_title == 'on' || $liven_general_global_page_title == '' || $liven_general_global_breadcrumb == 'on' || $liven_general_global_breadcrumb == ''){
            if($pagetitle_opt == 'on' || $pagetitle_opt == '' || $breadcrumb_opt == 'on' || $breadcrumb_opt == ''){
            ?>
                <div class="innerpagetitle">
                    <div class="container">
                    <?php
                        if($liven_general_global_page_title == 'on' || $liven_general_global_page_title == ''){
                            if($pagetitle_opt == 'on' || $pagetitle_opt == ''){
                            ?>
                                <h1>
                                    <span>
                                    <?php
                                        $liven_breadcrumb_homepage_text  = get_theme_mod('liven_breadcrumb_homepage_text');
                                        if ( is_front_page() && is_home() ) {
                                            if(!empty($liven_breadcrumb_homepage_text)){
                                                echo ucwords(esc_html($liven_breadcrumb_homepage_text));
                                            }
                                            else{
                                                echo esc_html__('Home',"liven");
                                            }
                                        }
                                        elseif ( is_front_page() ) {
                                            echo ucwords(esc_html(get_the_title()));
                                        }
                                        elseif ( is_home() ) {
                                            echo esc_html__('Blog',"liven");
                                        }   
                                        elseif ( is_archive() ) {
                                            the_archive_title();
                                        }
                                        elseif ( is_search() ) {
                                            $allsearch = new WP_Query("s=$s&showposts=-1");
                                            echo $allsearch->post_count;
                                            echo esc_html__(' Search Results For : ',"liven");
                                            the_search_query();
                                        }
                                        else{
                                            the_title(); 
                                        }
                                    ?>
                                    </span>
                                </h1>
                            <?php
                            }
                        }
                        if($liven_general_global_breadcrumb == 'on' || $liven_general_global_breadcrumb == ''){
                            if($breadcrumb_opt == 'on' || $breadcrumb_opt == ''){
                            ?>
                                <div class="innerbreadcrumb"> 
                                    <?php liven_custom_breadcrumbs(); ?>
        		                </div> 
                            <?php
                            }
                        }
                    ?>                        
	        	    </div>
                </div>
            <?php
            }
        }
    }
    else if($liven_breadcrumb_style == 'liven_breadcrumb_style_2'){
        if($liven_general_global_page_title == 'on' || $liven_general_global_page_title == '' || $liven_general_global_breadcrumb == 'on' || $liven_general_global_breadcrumb == ''){
            if($pagetitle_opt == 'on' || $pagetitle_opt == '' || $breadcrumb_opt == 'on' || $breadcrumb_opt == ''){
            ?>
                <div class="breadcrumb-4">
                    <div class="container">
                    <?php
                        if($liven_general_global_page_title == 'on' || $liven_general_global_page_title == ''){
                            if($pagetitle_opt == 'on' || $pagetitle_opt == ''){
                            ?>
                                <h1>
                                    <span>
                                    <?php
                                        $liven_breadcrumb_homepage_text  = get_theme_mod('liven_breadcrumb_homepage_text');
                                        if ( is_front_page() && is_home() ) {
                                            if(!empty($liven_breadcrumb_homepage_text)){
                                                echo ucwords(esc_html($liven_breadcrumb_homepage_text));
                                            }
                                            else{
                                                echo esc_html__('Home',"liven");
                                            }
                                        }
                                        elseif ( is_front_page() ) {
                                            echo ucwords(esc_html(get_the_title()));
                                        }
                                        elseif ( is_home() ) {
                                            echo esc_html__('Blog',"liven");
                                        }   
                                        elseif ( is_archive() ) {
                                            the_archive_title();
                                        }
                                        elseif ( is_search() ) {
                                            $allsearch = new WP_Query("s=$s&showposts=-1");
                                            echo $allsearch->post_count;
                                            echo esc_html__(' Search Results For : ',"liven");
                                            the_search_query();
                                        }
                                        else{
                                            the_title(); 
                                        }
                                    ?>
                                    </span>
                                </h1>
                            <?php
                            }
                        }
                        if($liven_general_global_breadcrumb == 'on' || $liven_general_global_breadcrumb == ''){
                            if($breadcrumb_opt == 'on' || $breadcrumb_opt == ''){
                            ?>
                                <div class="breadcrumb-4-link">
                                <?php
                                    liven_custom_breadcrumbs();
        	    		        ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="clr"></div>
                    </div>
                </div>
            <?php
            }
        }
    }
    else if($liven_breadcrumb_style == 'liven_breadcrumb_style_3'){
        if($liven_general_global_page_title == 'on' || $liven_general_global_page_title == '' || $liven_general_global_breadcrumb == 'on' || $liven_general_global_breadcrumb == ''){
            if($pagetitle_opt == 'on' || $pagetitle_opt == '' || $breadcrumb_opt == 'on' || $breadcrumb_opt == ''){
            ?>
                <div class="breadcrumb-7">
                    <div class="container">
                    <?php
                        if($liven_general_global_breadcrumb == 'on' || $liven_general_global_breadcrumb == ''){
                            if($breadcrumb_opt == 'on' || $breadcrumb_opt == ''){
                            ?>
                                <div class="breadcrumb-7-link">
                                    <?php liven_custom_breadcrumbs(); ?>
                                </div>
                            <?php
                            }
                        }
                        if($liven_general_global_page_title == 'on' || $liven_general_global_page_title == ''){
                            if($pagetitle_opt == 'on' || $pagetitle_opt == ''){
                            ?>
                                <h1>
                                    <span>
                                    <?php
                                        $liven_breadcrumb_homepage_text  = get_theme_mod('liven_breadcrumb_homepage_text');
                                        if ( is_front_page() && is_home() ) {
                                            if(!empty($liven_breadcrumb_homepage_text)){
                                                echo ucwords(esc_html($liven_breadcrumb_homepage_text));
                                            }
                                            else{
                                                echo esc_html__('Home',"liven");
                                            }
                                        }
                                        elseif ( is_front_page() ) {
                                            echo ucwords(esc_html(get_the_title()));
                                        }
                                        elseif ( is_home() ) {
                                            echo esc_html__('Blog',"liven");
                                        }   
                                        elseif ( is_archive() ) {
                                            the_archive_title();
                                        }
                                        elseif ( is_search() ) {
                                            $allsearch = new WP_Query("s=$s&showposts=-1");
                                            echo $allsearch->post_count;
                                            echo esc_html__(' Search Results For : ',"liven");
                                            the_search_query();
                                        }
                                        else{
                                            the_title(); 
                                        }
                                    ?>
                                    </span>
                                </h1>
                            <?php
                            }
                        }
                    ?>
                    </div>
                </div>
            <?php
            }
        }
    }
    ?>
</div>