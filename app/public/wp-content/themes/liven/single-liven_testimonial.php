<?php
/**
 * The template for displaying Tabs Detail page.
 *
 * @package liven
 */
?>
<?php
    get_header();
    get_template_part( 'templates/breadcrumb', get_post_format() ); 

    $liven_blog_sidebar              = get_theme_mod('liven_blog_sidebar') ;
    $liven_blog_sidebar_position     = get_theme_mod('liven_blog_sidebar_position') ;
?>
<!--middle content-->
<div class="middlecontent">
    <div class="container">
        <div class="col-md-12">
            <?php get_template_part( 'templates/single-testimonial', get_post_format() );?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
