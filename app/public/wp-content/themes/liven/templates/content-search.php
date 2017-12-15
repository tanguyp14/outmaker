<?php
/**
 * Template part for displaying search results.
 *
 * @package liven
*/

$liven_general_global_breadcrumb = get_theme_mod('liven_general_global_breadcrumb'); 
$breadcrumb_opt                  = get_post_meta(get_the_ID(), 'breadcrumb_option_key', true);
$post_type                       = get_post_type();
	
if($liven_general_global_breadcrumb == 'off' || $breadcrumb_opt =="off"){
    $allsearch = new WP_Query("s=$s&showposts=-1");
    echo $allsearch->post_count;
    echo esc_html__(' Search Results For : ','liven');
    the_search_query();
}
?>
<div class="search-result">
    <div class="search-title">
        <?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" >', '</a></h2>' );  ?>
    </div>
    <div class="search-head">
        <?php echo esc_html__(' by ','liven' ) ; ?><span><?php echo ucwords(get_the_author()); ?></span> <?php echo esc_html__(' on ','liven' ) ; ?> <span><?php the_date(get_option( 'date_format' )); ?></span>
        <?php
            switch ($post_type) {
                case 'post':
                {
                    echo esc_html__(' in ','liven' ).' '.get_the_category_list( ', ' );
                }
                break;
            
                case 'portfolio':
                {
                    $terms = get_the_terms(  get_the_id() ,'portfolio_categories') ;
                    if($terms!=""){
                        $i = 0;
                        $liven_post_terms = "";
                        foreach ($terms  as $term ) {
                            if ( $i == 0){
                                $liven_post_terms .= esc_html($term->name);
                                $i++;
                            }
                            else {
                                $liven_post_terms .= " , ".esc_html($term->name);
                            }
                        }
                        echo esc_html__(' in ','liven' ).' '.esc_html($liven_post_terms);
                    }
                }
                break;
            } 
        ?>
    </div>
    <div class="search-content"> <?php echo '<p>'.liven_blog_excerpt($GLOBALS['content_width']).'</p>'; ?> </div>
</div>