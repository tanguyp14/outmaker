<?php
/**
**  activation theme
**/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'custom', get_stylesheet_directory_uri() . '/css/style_perso.css' );
    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );

}

add_action('wp_enqueue_scripts', 'load_javascript_files');
function load_javascript_files() {
    wp_enqueue_script('custom');
    wp_enqueue_script("particles", get_template_directory_uri()."/js/particles.js",array('jquery'),false,true);
    wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/js/custom.js', array ( 'jquery' ), 1.1, true);
}

