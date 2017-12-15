<?php
/**
 * liven Theme Customizer.
 *
 * @package Liven
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
 
 
if ( ! function_exists( 'liven_sanitize_text' ) ) :
    function liven_sanitize_text( $string ) {
	    return  sanitize_text_field( $string  );
    }
endif;

if ( ! function_exists( 'sanitize_hex_color' ) ) :
    function sanitize_hex_color( $color ) {
        if ( '' === $color )
            return '';
	    // 3 or 6 hex digits, or the empty string.
        if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
            return $color;
        return null;
    }
endif;

if ( ! function_exists( 'liven_sanitize_image' ) ) :
    function liven_sanitize_image( $value) {
	    global $allowedtags;
    	return wp_kses( $value ,$allowedtags );
    }
endif;

if ( ! function_exists( 'liven_sanitize_header_style' ) ) :
    function liven_sanitize_header_style( $value) {
	    if ( isset(  $value )){
		    if( in_array( $value,array('header_style_1','header_style_2','header_style_3','header_style_4','header_style_5') )) {
    			return sanitize_text_field(  $value );
	    	}
		    else{
			    return "header_style_1";
		    }
	    }
	    else{
		    return "header_style_1";
		}
    }
endif;


if ( ! function_exists( 'liven_sanitize_header_style' ) ) :
    function liven_sanitize_header_style( $value) {
	    if ( isset(  $value )){
		    if( in_array( $value,array('header_style_1','header_style_2','header_style_3','header_style_4') )) {
			    return sanitize_text_field(  $value );
		    }
            else{
			    return "header_style_1";
            }
	    }
	    else{
			return "header_style_1";
		}
    }
endif;

if ( ! function_exists( 'liven_sanitize_breadcrumb_style' ) ) :
    function liven_sanitize_breadcrumb_style( $value) {
	    if ( isset(  $value )){
		    if( in_array( $value,array('liven_breadcrumb_style_1','liven_breadcrumb_style_2','liven_breadcrumb_style_3') )) {
			    return sanitize_text_field(  $value );
    		}
	    	else
		    {
			    return "liven_breadcrumb_style_1";
    		}
	    }
    	else{
		    return "liven_breadcrumb_style_1";
    	}
    }
endif;

if ( ! function_exists( 'liven_sanitize_breadcrumb_separator' ) ) :
    function liven_sanitize_breadcrumb_separator( $value) {
	    if ( isset(  $value )){
		    if( in_array( $value,array('/','|','>') )) {
			    return sanitize_text_field(  $value );
    		}
	    	else
		    {
			    return "/";
    		}
	    }
    	else{
		    return "/";
    	}
    }
endif;


if ( ! function_exists( 'liven_sanitize_blog_style' ) ) :
    function liven_sanitize_blog_style( $value) {
	    if ( isset(  $value )){
		    if( in_array( $value,array('liven_blog_style_1','liven_blog_style_2','liven_blog_style_3','liven_blog_style_4','liven_blog_style_5') )) {
			    return sanitize_text_field(  $value );
            }
	    	else{
			    return "liven_blog_style_1";
		    }
	}
	else{
	    return "liven_blog_style_1";
	}
}
endif;


if ( ! function_exists( 'liven_sanitize_blog_style' ) ) :
function liven_sanitize_blog_style( $value) {
	if ( isset(  $value )){
		if( in_array( $value,array('liven_blog_style_1','liven_blog_style_2','liven_blog_style_3','liven_blog_style_4','liven_blog_style_5') )) {
			return sanitize_text_field(  $value );
		}
		else{
			return "liven_blog_style_1";
		}
	
	}
	else{
	    return "liven_blog_style_1";
	}
}
endif;


if ( ! function_exists( 'liven_sanitize_header_toolbar' ) ) :
function liven_sanitize_header_toolbar( $value) {
	if ( isset(  $value )){
		if( in_array( $value,array('on','off') )) {
			return sanitize_text_field(  $value );
		}
		else{
			return "on";
		}
	}
	else{
		return "on";
	}
}
endif;



if ( ! function_exists( 'liven_sanitize_header_toolbar_social_icon_color' ) ) :
function liven_sanitize_header_toolbar_social_icon_color( $value) {
	if ( isset(  $value )){
		if( in_array( $value,array('dark','light') )) {
			return sanitize_text_field(  $value );
		}
		else{
			return "dark";
		}
	}
	else{
	    return "dark";
	}
}
endif;



if ( ! function_exists( 'liven_sanitize_header_search_bar' ) ) :
function liven_sanitize_header_search_bar( $value) {
	if ( isset(  $value )){
		if( in_array( $value,array('on','off') )) {
			return sanitize_text_field(  $value );
		}
		else{
			return "on";
		}
	
	}
	else{
		return "on";
	}
}
endif;


if ( ! function_exists( 'liven_sanitize_header_social_icons' ) ) :
function liven_sanitize_header_social_icons( $value) {
	if ( isset(  $value )){
		if( in_array( $value,array('on','off') )) {
			return sanitize_text_field(  $value );
		}
		else{
			return "on";
		}
	
	}
	else{
		return "on";
	}
}
endif;


if ( ! function_exists( 'liven_sanitize_general_global_page_title' ) ) :
function liven_sanitize_general_global_page_title( $value) {
	if ( isset(  $value )){
		if( in_array( $value,array('on','off') )) {
			return sanitize_text_field(  $value );
		}
		else{
			return "on";
		}
	}
	else{
		return "on";
	}
}
endif;


if ( ! function_exists( 'liven_sanitize_general_global_breadcrumb' ) ) :
function liven_sanitize_general_global_breadcrumb( $value) {
	if ( isset(  $value )){
		if( in_array( $value,array('on','off') )) {
			return sanitize_text_field(  $value );
		}
		else{
			return "on";
		}
	}
	else{
		return "on";
	}
}
endif;


if ( ! function_exists( 'liven_sanitize_breadcrumb_bg' ) ) :
function liven_sanitize_breadcrumb_bg( $value) {
	if ( isset(  $value )){
		if( in_array( $value,array('image','color') )) {
			return sanitize_text_field(  $value );
		}
		else{
			return "image";
		}
	}
	else{
		return "image";
	}
}
endif;


if ( ! function_exists( 'liven_sanitize_blog_sidebar' ) ) :
function liven_sanitize_blog_sidebar( $value) {
	if ( isset(  $value )){
		if( in_array( $value,array('on','off') )) {
			return sanitize_text_field(  $value );
		}
		else{
			return "on";
		}
	}
	else{
		return "on";
	}
}
endif;



if ( ! function_exists( 'liven_sanitize_blog_sidebar_position' ) ) :
function liven_sanitize_blog_sidebar_position( $value) {
	if ( isset(  $value )){
		if( in_array( $value,array('right','left') )) {
			return sanitize_text_field(  $value );
		}
		else{
			return "right";
		}
	}
	else{
		return "right";
	}
}
endif;




if ( ! function_exists( 'liven_sanitize_footer_toolbar_required' ) ) :
function liven_sanitize_footer_toolbar_required( $value) {
	if ( isset(  $value )){
		if( in_array( $value,array('on','off') )) {
			return sanitize_text_field(  $value );
		}
		else{
			return "on";
		}
	}
	else{
		return "on";
	}
}
endif;


if ( ! function_exists( 'liven_sanitize_footer_text_position' ) ) :
function liven_sanitize_footer_text_position( $value) {
	if ( isset(  $value )){
		if( in_array( $value,array('left','center','right') )) {
			return sanitize_text_field(  $value );
		}
		else{
			return "left";
		}
	}
	else{
		return "left";
	}
}
endif;


if ( ! function_exists( 'liven_sanitize_footer_back_to_top_button' ) ) :
function liven_sanitize_footer_back_to_top_button( $value) {
	if ( isset(  $value )){
		if( in_array( $value,array('on','off') )) {
			return sanitize_text_field(  $value );
		}
		else{
			return "on";
		}
	}
	else{
		return "on";
	}
}
endif;



if ( ! function_exists( 'liven_sanitize_header_tool_email' ) ) :
function  liven_sanitize_header_tool_email( $email ) {

	$output = '';
		$output =  sanitize_email($email);	
	return $output;
}
endif;


if ( ! function_exists( 'liven_sanitize_phone_number' ) ) :
function  liven_sanitize_phone_number( $phone_number ) {
	$output = '';
    $regex =   '/^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/';
		if(preg_match( $regex, $phone_number ))
		$output = $phone_number ;	
	return $output;
}
endif;

if ( ! function_exists( 'liven_sanitize_url' ) ) :
function  liven_sanitize_url( $url ) {
	$output = '';
    	$output = esc_url($url);
	return $output;
}
endif;

if ( ! function_exists( 'liven_sanitize_footer_page' ) ) :
function  liven_sanitize_footer_page( $value ) {
    $footer_page_list=array();
    $footer_page_listings =array();
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'footer_template.php'
    ));
    foreach($pages as $page){
        $footer_page_list[$page->ID] = $page->post_title;
        $footer_page_listings[] = $page->ID;
    }
    
    if ( isset(  $value )){
		if( in_array( $value, $footer_page_listings )) {
			return sanitize_text_field(  $value );
		}
		else{
			return "";
		}
	}
	else{
		return "";
	}
}
endif;

if ( ! function_exists( 'liven_sanitize_theme_opt_css' ) ) :
function liven_sanitize_theme_opt_css( $value) {
	if ( isset(  $value )){
		if( !empty($value)) {
			return $value;
		}
		else{
			return "";
		}
	}
	else{
		return "";
	}
}
endif;

if ( ! function_exists( 'liven_sanitize_theme_opt_js' ) ) :
function liven_sanitize_theme_opt_js( $value) {
	if ( isset(  $value )){
		if( !empty($value)) {
			return $value;
		}
		else{
			return "";
		}
	}
	else{
		return "";
	}
}
endif;