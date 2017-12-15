<?php
/*
Plugin Name: Liven Extenstion
Plugin URI: 
Description: Liven Extenstion.
Author: Nirav And Hardik | Litmus Branding
Version: 1.0
Author URI: https://lithemes.com/
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


if ( ! function_exists( 'liven_globle_css' ) ) :
function liven_globle_css() {
	$GLOBALS['pg_content'] = '';
}
endif;				
add_action( 'plugins_loaded', 'liven_globle_css', 0 );

/**
 * Load plugin textdomain.
 */
add_action( 'plugins_loaded', 'liven_load_textdomain' );
function liven_load_textdomain() {
  load_plugin_textdomain( 'liven', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

if ( ! function_exists( 'liven_get_cpt_data' ) ) :
    function liven_get_cpt_data( $post_type = 'post' ) {
	$posts = get_posts( array(
		'posts_per_page' 	=> -1,
		'post_type'			=> $post_type,
	));

	$result = array();
	foreach ( $posts as $post )	{
		$result[] = array(
			'value' => esc_html($post->ID),
			'label' => esc_html($post->post_title),
		);
	}
	return $result;
}
endif;


function  liven_vc_containtdata( $liven_containtdata) {
	global $allowedtags;
	return wp_kses( $liven_containtdata ,$allowedtags );
}


add_action( 'vc_before_init', 'liven_vc_disable_frontend' );
function liven_vc_disable_frontend() {
	vc_disable_frontend();
}

foreach ( glob( plugin_dir_path( __FILE__ ) . "custom-post-types/*.php" ) as $file ) {
    include_once $file;
}
foreach ( glob( plugin_dir_path( __FILE__ ) . "include-metabox/*.php" ) as $file ) {
    include_once $file;
}
foreach ( glob( plugin_dir_path( __FILE__ ) . "include-element/*.php" ) as $file ) {
    include_once $file;
}
foreach ( glob( plugin_dir_path( __FILE__ ) . "*.php" ) as $file ) {
    include_once $file;
}


add_action( 'vc_before_init', 'liven_vc_set_default_editor_post_types' );
function liven_vc_set_default_editor_post_types() {
	$list = array(
    	'page',
    	'custom_post_type'
	);
}	 


if ( ! function_exists( 'liven_get_type_tags_data' ) ) :
function liven_get_type_tags_data( $tags_type = 'tags' ) {
	$result = array();
	$tags = get_tags();
	
	foreach ($tags as $tag)
	{
		$result[] = array(
			'value' => esc_html($tag->term_id),
			'label' => esc_html($tag->name),			
		);
	}
	return $result;
}
endif;


if ( ! function_exists( 'liven_my_styles_method' ) ) :
function liven_my_styles_method() {
	wp_enqueue_style( 'custom-style', plugin_dir_url( __FILE__ ) . 'css/custom-css.css',false, '1.0', 'all' );
     if($GLOBALS['pg_content']!="")    wp_add_inline_style( 'custom-style',$GLOBALS['pg_content']);
}
endif;
add_action( 'wp_footer', 'liven_my_styles_method' );