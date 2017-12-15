<?php 
    // Template Name: footer_template
    get_header();
?>

<div class="container">
<?php 
	$liven_footer_page = get_theme_mod('liven_footer_page');
	$footer_opt        = get_post_meta(get_the_ID(), 'footer_option_key', true);
	
    if(!empty($footer_opt)){
        $the_query = new WP_Query( 'page_id='. $footer_opt);
	}
	else {
	    $the_query = new WP_Query( 'page_id='. $liven_footer_page);
	}
	
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        the_content();
    }
    wp_reset_postdata();
?>
</div>