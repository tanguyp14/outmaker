<?php
   get_header();
   get_template_part( 'templates/breadcrumb', get_post_format() );
?>
<div class="middlecontent">
    <div class="container">
    <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                echo the_content();
            endwhile;
            if ( comments_open() || get_comments_number() ) :
            ?>
            <div class="page-cmts">
            <?php
                comments_template();
            ?>
            </div>
            <?php
            endif;
        endif;
    ?>
    </div>
</div>
<?php get_footer(); ?>