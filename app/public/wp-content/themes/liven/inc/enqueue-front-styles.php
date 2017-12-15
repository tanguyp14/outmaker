<?php
if (!function_exists('liven_enqueue_styles')) {
	function liven_enqueue_styles() {
	    $liven_minified_css_1 = get_theme_mod('liven_minified_css_1');
	    if($liven_minified_css_1 == 1 &&  !empty($liven_minified_css_1)){
	        wp_enqueue_style( 'liven_master', get_template_directory_uri() . '/static/css/master.min.css',false , '1.0', 'all' );
	    }
	    else
	    {
	        wp_enqueue_style( 'liven_master', get_template_directory_uri() . '/static/css/master.css',false , '1.0', 'all' );
	    }
	    
	    //wp_enqueue_style( 'liven_custom_dynamic_style', get_template_directory_uri() . '/static/css/liven_custom_dynamic_styles.css',false , '1.0', 'all' );
		wp_enqueue_style( 'style', get_stylesheet_uri() );
	    wp_enqueue_style( 'liven_fonts', esc_url(liven_fonts_url()),true , '', 'all' );
	    wp_enqueue_style( 'liven_google_fonts', esc_url(liven_google_fonts_url()),true , '', 'all' );
		add_editor_style();
	}
}
add_action( 'wp_enqueue_scripts', 'liven_enqueue_styles',10  );

function liven_google_fonts_url() {
    $font_url = '';
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'liven' ) ) {
        $font_url = add_query_arg( 'family',  'Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' , "//fonts.googleapis.com/css" );
    }
    return $font_url;
}

function liven_fonts_url() {
    $font_url = '';
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'liven' ) ) {
        $font_url = add_query_arg( 'family',  'Arimo:400,700,700italic,400italic' , "//fonts.googleapis.com/css" );
    }
    return $font_url;
}