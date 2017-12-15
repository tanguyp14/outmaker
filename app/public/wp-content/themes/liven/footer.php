<div class="footer">
<?php
    $liven_footer_page = get_theme_mod('liven_footer_page');

	if(!empty($liven_footer_page)){
	    get_template_part('footer_template');
	}
?>
</div>
<?php
    $liven_footer_back_to_top_button = get_theme_mod('liven_footer_back_to_top_button');
    if($liven_footer_back_to_top_button == 'on' || $liven_footer_back_to_top_button == '') {
        echo '<div class="backtotop"><a href="#0" class="cd-top"><i class="fa fa-angle-up fa-1x"></i></a></div>';
    }
?>
<?php wp_footer(); ?>
</body>
</html>