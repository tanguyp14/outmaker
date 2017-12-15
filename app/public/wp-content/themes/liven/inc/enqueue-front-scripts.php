<?php
if (!function_exists('liven_enqueue_scripts')) {
	function liven_enqueue_scripts() {
	    $liven_minified_js = liven_htmldata( get_theme_mod('liven_minified_js'),"liven" );
	    
	    if($liven_minified_js == 1 &&  !empty($liven_minified_js)){
	        wp_enqueue_script( 'liven_function', esc_url( get_template_directory_uri()) . '/static/js/minified/function.min.js',false, '1.0', 'all' );
		    wp_enqueue_script( 'bootstrap', esc_url( get_template_directory_uri()) . '/static/js/minified/bootstrap.min.js',false, '1.0', 'all' );
		    wp_enqueue_script( 'modernizr', esc_url( get_template_directory_uri()) . '/static/js/minified/modernizr.min.js',false, '1.0', 'all' );
    		wp_enqueue_script( 'slick', esc_url( get_template_directory_uri()) . '/static/js/minified/slick.min.js',false, '1.0', 'all' );
	    	wp_enqueue_script( 'stickyheader', esc_url( get_template_directory_uri()) . '/static/js/minified/stickyheader.min.js',false, '1.0', 'all' );
		    wp_enqueue_script( 'backtotop', esc_url( get_template_directory_uri()) . '/static/js/minified/backtotop.min.js',false, '1.0', 'all' );
	    	wp_enqueue_script( 'parallax', esc_url( get_template_directory_uri()) . '/static/js/minified/parallax.min.js',false, '1.0', 'all' );
		    wp_enqueue_script( 'animation', esc_url( get_template_directory_uri()) . '/static/js/minified/animation.min.js',false, '0.1.8', 'all' );
    		wp_enqueue_script( 'counter', esc_url( get_template_directory_uri()) . '/static/js/minified/counter.min.js',false, '1.6.2', 'all' );
	    	wp_enqueue_script( 'portfolio', esc_url( get_template_directory_uri()) . '/static/js/minified/jquery.portfolio.min.js',false, '1.5.25', 'all' );
    		wp_enqueue_script( 'number-counter', esc_url( get_template_directory_uri()) . '/static/js/minified/number-counter.min.js',false, '1.0', 'all' );
	    	wp_enqueue_script( 'accordian', esc_url( get_template_directory_uri()) . '/static/js/minified/accordian.min.js',false, '1.0', 'all' );
    		wp_enqueue_script( 'easyResponsiveTabs', esc_url( get_template_directory_uri()) . '/static/js/minified/easyResponsiveTabs.min.js',false, '1.0', 'all' );
	    	wp_enqueue_script( 'bootstrapValidator', esc_url( get_template_directory_uri()) . '/static/js/minified/bootstrapValidator.min.js',false, '1.0', 'all' );
	    	wp_enqueue_script( 'tooltip-viewport', esc_url( get_template_directory_uri()) . '/static/js/minified/tooltip-viewport.min.js',false, '1.0', 'all' );
		    wp_enqueue_script( 'p-gallery', esc_url( get_template_directory_uri()) . '/static/js/minified/p-gallery.min.js',false, '1.0', 'all' );
		
    		/* Visual Composer element js*/
	    	wp_enqueue_script( 'liven_liven_vc_element', esc_url( get_template_directory_uri()) . '/static/js/minified/vc_custom_js/liven_vc_element.min.js',false, '1.0.0', 'all' );

		    if ( is_singular())	wp_enqueue_script( 'comment-reply' );
            wp_enqueue_script( 'liven_maps',  'https://maps.googleapis.com/maps/api/js?sensor=false',false, '1.0', 'all' );
            wp_enqueue_script( 'liven_gmaps',   esc_url( get_template_directory_uri()) . '/static/js/minified/gmaps.min.js',false, '1.0', 'all' );
	    }
	    else
	    {
	        wp_enqueue_script( 'liven_function', esc_url( get_template_directory_uri()) . '/static/js/function.js',false, '1.0', 'all' );
		    wp_enqueue_script( 'bootstrap', esc_url( get_template_directory_uri()) . '/static/js/bootstrap.js',false, '1.0', 'all' );
		    wp_enqueue_script( 'modernizr', esc_url( get_template_directory_uri()) . '/static/js/modernizr.js',false, '1.0', 'all' );
    		wp_enqueue_script( 'slick', esc_url( get_template_directory_uri()) . '/static/js/slick.js',false, '1.0', 'all' );
	    	wp_enqueue_script( 'stickyheader', esc_url( get_template_directory_uri()) . '/static/js/stickyheader.js',false, '1.0', 'all' );
		    wp_enqueue_script( 'backtotop', esc_url( get_template_directory_uri()) . '/static/js/backtotop.js',false, '1.0', 'all' );
	    	wp_enqueue_script( 'parallax', esc_url( get_template_directory_uri()) . '/static/js/parallax.js',false, '1.0', 'all' );
		    wp_enqueue_script( 'animation', esc_url( get_template_directory_uri()) . '/static/js/animation.js',false, '0.1.8', 'all' );
    		wp_enqueue_script( 'counter', esc_url( get_template_directory_uri()) . '/static/js/counter.js',false, '1.6.2', 'all' );
	    	wp_enqueue_script( 'portfolio', esc_url( get_template_directory_uri()) . '/static/js/jquery.portfolio.js',false, '1.5.25', 'all' );
    		wp_enqueue_script( 'number-counter', esc_url( get_template_directory_uri()) . '/static/js/number-counter.js',false, '1.0', 'all' );
	    	wp_enqueue_script( 'accordian', esc_url( get_template_directory_uri()) . '/static/js/accordian.js',false, '1.0', 'all' );
    		wp_enqueue_script( 'easyResponsiveTabs', esc_url( get_template_directory_uri()) . '/static/js/easyResponsiveTabs.js',false, '1.0', 'all' );
	    	wp_enqueue_script( 'bootstrapValidator', esc_url( get_template_directory_uri()) . '/static/js/bootstrapValidator.js',false, '1.0', 'all' );
	    	wp_enqueue_script( 'tooltip-viewport', esc_url( get_template_directory_uri()) . '/static/js/tooltip-viewport.js',false, '1.0', 'all' );
		    wp_enqueue_script( 'p-gallery', esc_url( get_template_directory_uri()) . '/static/js/p-gallery.js',false, '1.0', 'all' );
		
    		/* Visual Composer element js*/
	    	wp_enqueue_script( 'liven_liven_vc_element', esc_url( get_template_directory_uri()) . '/static/js/vc_custom_js/liven_vc_element.js',false, '1.0.0', 'all' );

		    if ( is_singular())	wp_enqueue_script( 'comment-reply' );
            wp_enqueue_script( 'maps',  'https://maps.googleapis.com/maps/api/js?sensor=false',false, '1.0', 'all' );
            wp_enqueue_script( 'gmaps',   esc_url( get_template_directory_uri()) . '/static/js/gmaps.js',false, '1.0', 'all' );
	    }
	}
}
add_action( 'wp_enqueue_scripts', 'liven_enqueue_scripts' );
?>