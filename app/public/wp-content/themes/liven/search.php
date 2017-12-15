<?php
/**
 * The template for displaying search results pages
 *
 * @package liven
 */
get_header(); 
get_template_part( 'templates/breadcrumb', get_post_format() ); 
?>
<div class="middlecontent">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="blog">
                    <div class="main-search-form">
                        <?php get_search_form(); ?>
                    </div>
                    <div class="search-result-wrap">
                    <?php
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post();
                                get_template_part( 'templates/content-search', get_post_format() );
                            endwhile;
                        the_posts_pagination( array( 'mid_size' => 2 ) );				  
                        else :
                            get_template_part( 'templates/content', 'none' );
                        endif;
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>