<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blackair
 */

if ( ! is_active_sidebar( 'liven_sidebar_1' ) ) {
	return;
}
?>

<div class="col-md-4" >
    <?php dynamic_sidebar( 'liven_sidebar_1' ); ?>
</div>