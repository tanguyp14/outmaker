<?php
/**
 * Main Search Form Template
 * 
 * @package liven
 */
?>

<form id="main-search-form" role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <label> <span class="screen-reader-text"><?php echo esc_html__( 'Search for:', 'liven' ) ?></span>
    <input type="search" class="search-field"
            placeholder="<?php echo esc_html__( 'Search...', 'liven' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_html__( 'Search for:', 'liven' ) ?>" />
    </label>
    <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>
<div class="clr"></div>
