<?php
/**
 * The template for displaying Portfolio.
 *
 * @package liven
 */

get_header(); 
get_template_part( 'templates/breadcrumb', get_post_format() );

//<!--middle content-->
get_template_part( 'templates/portfolio', get_post_format() );

get_footer(); 
?>