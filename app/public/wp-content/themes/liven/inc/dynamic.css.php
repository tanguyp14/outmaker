<?php
/**
 * Liven Dynamic Style Sheet.
 *
 * @package liven
 */

/**
 * Add dynamic css.
 *
 */

/***************************************** blog style starts here  *****************************************/
function liven_custom_dynamic_blog_style() {
    wp_enqueue_style( 
        'liven_custom_dynamic_blog_style', 
        get_template_directory_uri() . '/static/css/liven_custom_dynamic_styles.css'
    );
    $liven_blog_title_color       = esc_html( get_theme_mod('liven_blog_title_color', '#000'));
    $liven_blog_title_hover_color = esc_html( get_theme_mod('liven_blog_title_hover_color', '#009cff'));
    $liven_bloginfo_color         = esc_html( get_theme_mod('liven_bloginfo_color', '#bbb'));
    $liven_blog_date_color        = esc_html( get_theme_mod('liven_blog_date_color', '#000'));
        
    $custom_blog_css = "
        .p-gallery h3 a, .mask-blog h4, .blog3 h3 a, .blog4 h3 a, .blog5 h5 a, .blogdetailhead h2 {
            color: ".esc_html($liven_blog_title_color).";
        }
        .p-gallery h3 a:hover, .blog3 h3 a:hover, .blog4 h3 a:hover, .blog5 h5 a:hover{
            color: ".esc_html($liven_blog_title_hover_color).";
        }
        .icons-gray, .bloginfo small a, .bloginfo small a:hover, .bloginfo a small, .bloginfo small, .blogdetailhead span {
            color: ".esc_html($liven_bloginfo_color).";
        }
        .blog5 h3 {
            color: ".esc_html($liven_blog_date_color).";
        }
    ";
    wp_add_inline_style( 'liven_custom_dynamic_blog_style', $custom_blog_css );
}   
add_action( 'wp_enqueue_scripts', 'liven_custom_dynamic_blog_style' ,150);
/*****************************************  blog style ends here   *****************************************/


/***************************************** global color style starts here  *****************************************/
function liven_custom_dynamic_global_color_style() {
    wp_enqueue_style( 
        'liven_custom_dynamic_global_color_style', 
        get_template_directory_uri() . '/static/css/liven_custom_dynamic_styles.css'
    );
    $liven_global_page_bg_color     = esc_html( get_theme_mod('liven_global_page_bg_color', '#fff'));
    $liven_global_text_color        = esc_html( get_theme_mod('liven_global_text_color', '#000'));
    $liven_global_link_color        = esc_html( get_theme_mod('liven_global_link_color', '#009cff'));
    $liven_global_link_hover_color  = esc_html( get_theme_mod('liven_global_link_hover_color', '#333'));
    $liven_global_button_color      = esc_html( get_theme_mod('liven_global_button_color', '#009cff'));
    $liven_global_button_text_color = esc_html( get_theme_mod('liven_global_button_text_color', '#fff'));
    $liven_global_heading_color     = esc_html( get_theme_mod('liven_global_heading_color', '#000'));
        
    $custom_global_color_css = "
        body, .leftdiv, .rightdiv, .dividerfull{
            background: ".esc_html($liven_global_page_bg_color).";
        }
        body {
            color: ".esc_html($liven_global_text_color).";
        }
        a{
            color: ".esc_html($liven_global_link_color).";
        }
        a:hover{
	        color: ".esc_html($liven_global_link_hover_color).";
        }
        
        button[type='submit'], input[type='button'], input[type='submit'] {
            background: ".esc_html($liven_global_button_color).";
            border: 1px solid ".esc_html($liven_global_button_color).";
            color: ".esc_html($liven_global_button_text_color).";
        }
        button[type='submit']:hover, input[type='button']:hover, input[type='submit']:hover {
            background: transparent;
            border: 1px solid ".esc_html($liven_global_button_color).";
            color: ".esc_html($liven_global_button_color).";
        }
        
        .cd-top {
            background: ".esc_html($liven_global_button_color).";
            border: 1px solid ".esc_html($liven_global_button_color).";
            color: ".esc_html($liven_global_button_text_color).";
        }
            
        .no-touch .cd-top:hover {
	        background: transparent;
            border: 1px solid ".esc_html($liven_global_button_color).";
            color: ".esc_html($liven_global_button_color).";
            opacity: 1
        }
        .monthtitle {
            background: ".esc_html($liven_global_button_color).";
            color: ".esc_html($liven_global_button_text_color).";
        }
            
        .nav-links a:hover, .nav-links .current {
            background-color: ".esc_html($liven_global_button_color).";
            border: 1px solid ".esc_html($liven_global_button_color).";
            color: ".esc_html($liven_global_button_text_color).";
        }
            
        .cmt-pagi .current, .cmt-pagi .page-numbers:hover{	
            background-color: ".esc_html($liven_global_button_color).";
            border:1px solid ".esc_html($liven_global_button_color).";
        }
            
        .search-form input[type='submit'] {
            color: ".esc_html($liven_global_button_text_color).";
            background-color: ".esc_html($liven_global_button_color).";
        }
        .search-form input[type='submit']:hover {
            color: ".esc_html($liven_global_button_color).";
            background-color: transparent;
        }
        
        .search-form button[type='submit'] {
            color: ".esc_html($liven_global_button_text_color).";
            background-color: ".esc_html($liven_global_button_color).";
        }
        .search-form button[type='submit']:hover {
            color: ".esc_html($liven_global_button_color).";
            background-color: transparent;
        }
        
        .slick-list .slick-prev:hover, .slick-list .slick-next:hover, .slick-list .slick-prev:focus, .slick-list .slick-next:focus{
            background-color: ".esc_html($liven_global_button_color).";
        }
        .slick-dots .slick-active, .slick-dots li:hover{
            color: ".esc_html($liven_global_button_color).";
        }
            
        .halfwidthleft .slick-next:focus, .halfwidthleft .slick-next:hover, .halfwidthleft .slick-prev:focus, .halfwidthleft .slick-prev:hover {
            background: ".esc_html($liven_global_button_color).";
        }
            
        .slick-dots li button:focus::before, .slick-dots li button:hover::before, .slick-dots li.slick-active button::before {
            color: ".esc_html($liven_global_button_color).";
        }
            
        .fixslider .slick-next:focus, .fixslider .slick-next:hover, .fixslider .slick-prev:focus, .fixslider .slick-prev:hover {
            background: ".esc_html($liven_global_button_color).";
        }
        .tagcloud a {
            background: ".esc_html($liven_global_button_color).";
            border: 1px solid ".esc_html($liven_global_button_color).";
            color: ".esc_html($liven_global_button_text_color).";
        }
        .tagcloud a:hover {
            background-color: transparent;
            border: 1px solid ".esc_html($liven_global_button_color).";
            color: ".esc_html($liven_global_button_color).";
        }
        
        h1, h2, h3, h4, h5, h6{
	        color: ".esc_html($liven_global_heading_color).";
        }
        
    ";
    wp_add_inline_style( 'liven_custom_dynamic_global_color_style', $custom_global_color_css );
}   
add_action( 'wp_enqueue_scripts', 'liven_custom_dynamic_global_color_style' ,150);
/***************************************** global color style ends here  *****************************************/  


/***************************************** breadcrumb style starts here  *****************************************/
function liven_custom_dynamic_breadcrumb_style() {
    wp_enqueue_style( 
        'liven_custom_dynamic_breadcrumb_style', 
        get_template_directory_uri() . '/static/css/liven_custom_dynamic_styles.css'
    );
    $liven_breadcrumb_bg              = esc_html( get_theme_mod('liven_breadcrumb_bg'));
    $liven_breadcrumb_bg_image        = esc_html( get_theme_mod('liven_breadcrumb_bg_image'));
    $liven_breadcrumb_bg_color        = esc_html( get_theme_mod('liven_breadcrumb_bg_color', '#009cff'));
    $breadcrumb_bg_img_url            = esc_url( get_theme_mod('liven_breadcrumb_bg_image'));
    $liven_breadcrumb_pg_color        = esc_html( get_theme_mod('liven_breadcrumb_pg_color', '#caecff'));
    $liven_breadcrumb_hover_pg_color  = esc_html( get_theme_mod('liven_breadcrumb_hover_pg_color', '#fff'));
    $liven_breadcrumb_active_pg_color = esc_html( get_theme_mod('liven_breadcrumb_active_pg_color', '#fff'));
    $liven_page_title_color           = esc_html( get_theme_mod('liven_page_title_color', '#fff'));
    
     
    
    if($liven_breadcrumb_bg == ""){
        $custom_breadcrumb_css = "
            .innerpagetitle, .breadcrumb-4, .breadcrumb-7{
                background: ".esc_html($liven_breadcrumb_bg_color).";
            }
        ";
    }
    if($liven_breadcrumb_bg == 'image' && $liven_breadcrumb_bg_image != ''){
        $custom_breadcrumb_css = "
            .innerpagetitle, .breadcrumb-4, .breadcrumb-7{
                background: url(".esc_html($breadcrumb_bg_img_url).") center bottom;
            }
        ";
    }
    else if($liven_breadcrumb_bg == 'color' || $liven_breadcrumb_bg_image == ''){
        $custom_breadcrumb_css = "
            .innerpagetitle, .breadcrumb-4, .breadcrumb-7{
                background: url(".esc_html($breadcrumb_bg_img_url).") center bottom;
            }
            .innerpagetitle, .breadcrumb-4, .breadcrumb-7{
                background: ".esc_html($liven_breadcrumb_bg_color).";
            }
        ";
    }
    $custom_breadcrumb_css .= "
        .innerpagetitle h1 span, .breadcrumb-4 h1 span, .breadcrumb-7 h1 span {
            color: ".esc_html($liven_page_title_color).";
        }
        .innerbreadcrumb span.active, .breadcrumb-4-link span.active, .breadcrumb-7-link span.active  {
            color: ".esc_html($liven_breadcrumb_active_pg_color).";
        }
        .innerbreadcrumb, .innerbreadcrumb a, .breadcrumb-4-link, .breadcrumb-4-link a, .breadcrumb-7-link, .breadcrumb-7-link a {
            color: ".esc_html($liven_breadcrumb_pg_color).";
        }
        .innerbreadcrumb a:hover, .breadcrumb-4-link a:hover, .breadcrumb-7-link a:hover {
            color: ".esc_html($liven_breadcrumb_hover_pg_color).";
        }
        
    ";
    wp_add_inline_style( 'liven_custom_dynamic_breadcrumb_style', $custom_breadcrumb_css );
}   
add_action( 'wp_enqueue_scripts', 'liven_custom_dynamic_breadcrumb_style' ,150);
/***************************************** breadcrumb style ends here  *****************************************/


/***************************************** header toolbar style starts here  *****************************************/
function liven_custom_header_toolbar_style() {
    wp_enqueue_style( 
        'liven_custom_header_toolbar_style', 
        get_template_directory_uri() . '/static/css/liven_custom_dynamic_styles.css'
    );
    $liven_header_toolbar_bg_color   = esc_html( get_theme_mod('liven_header_toolbar_bg_color', '#f1f1f1'));
    $liven_header_toolbar_icon_color = esc_html( get_theme_mod('liven_header_toolbar_icon_color', '#009cff'));
    $liven_header_toolbar_text_color = esc_html( get_theme_mod('liven_header_toolbar_text_color', '#777'));
    
    $custom_header_toolbar_css = "
        .header-top {
            background: ".esc_html($liven_header_toolbar_bg_color).";
            color: ".esc_html($liven_header_toolbar_text_color).";
        }
        .topinfo a {
            color: ".esc_html($liven_header_toolbar_text_color).";
        }
        .header-toolbar-icon-color {
            color: ".esc_html($liven_header_toolbar_icon_color).";
        }
    ";
    wp_add_inline_style( 'liven_custom_header_toolbar_style', $custom_header_toolbar_css );
}   
add_action( 'wp_enqueue_scripts', 'liven_custom_header_toolbar_style' ,150);
/***************************************** header toolbar style ends here  *****************************************/

/***************************************** header style starts here  *****************************************/
function liven_custom_header_style() {
    wp_enqueue_style( 
        'liven_custom_header_style', 
        get_template_directory_uri() . '/static/css/liven_custom_dynamic_styles.css'
    );
    $liven_header_bg_color              = esc_html( get_theme_mod('liven_header_bg_color', '#fff'));
    $liven_header_text_color            = esc_html( get_theme_mod('liven_header_text_color', '#666'));
    $liven_header_active_text_color     = esc_html( get_theme_mod('liven_header_active_text_color', '#009cff'));
    $liven_header_text_hover_color      = esc_html( get_theme_mod('liven_header_text_hover_color', '#666'));
    $liven_header_menu_background_color = esc_html( get_theme_mod('liven_header_menu_background_color', '#f1f1f1'));
    
    $custom_header_css = "
        .liven-header-bg {
            background: ".esc_html($liven_header_bg_color).";
        }
        .menu ul li > a {
            color: ".esc_html($liven_header_text_color).";
        }
        .menu ul li > a:hover {
            color: ".esc_html($liven_header_text_hover_color).";
        }
        .menu .current_page_item a {
            color: ".esc_html($liven_header_active_text_color).";
        }
        .header-nav-gray {
            background: ".esc_html($liven_header_menu_background_color).";
        }
        .top-bar-section ul li > a {
            color: ".esc_html($liven_header_text_color).";
        }
        .top-bar-section ul li > a:hover {
            color: ".esc_html($liven_header_text_hover_color).";
        }
    ";
    wp_add_inline_style( 'liven_custom_header_style', $custom_header_css );
}   
add_action( 'wp_enqueue_scripts', 'liven_custom_header_style' ,150);
/***************************************** header style ends here  *****************************************/