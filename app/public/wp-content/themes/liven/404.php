<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

<div class="err404">
    <div class="parallax-overlay-black">
        <div class="container wow fadeInDown errorpage text-center">
            <div class="font-lg margin-bottom-50"><span><?php echo esc_html__('404','liven'); ?></span></div>
            <h1><span><?php echo esc_html__('Oops! Page not found','liven'); ?></span></h1>
            <p><?php echo esc_html__("We're sorry, the page you requested cannot be found.",'liven'); ?></p>
            <p><?php echo esc_html__('You can go back to','liven'); ?></p>
            <button class="default-btn margin-top-50" onClick="window.location='<?php  echo esc_url( home_url("/") );?>'"><?php echo esc_html__('go to homepage ','liven'); ?><i class="fa fa-angle-right"></i></button>
        </div>
    </div>
</div>
<?php get_footer(); ?>