<?php
/**
 * Template part for displaying header styles.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package liven
*/

$liven_header_style                     = get_theme_mod('liven_header_style');
$liven_header_toolbar_social_icon_color = get_theme_mod('liven_header_toolbar_social_icon_color');
$liven_header_social_icons              = get_theme_mod('liven_header_social_icons');

$liven_social_class = "";
if($liven_header_toolbar_social_icon_color == 'dark' || $liven_header_toolbar_social_icon_color == ''){
    $liven_social_class = "header_social_style1";
}
else{
    $liven_social_class = "header_dark_social";
}

if($liven_header_style == 'header_style_1' || $liven_header_style == ''){
    $header_style = get_theme_mod('liven_header_toolbar_required');
	if($header_style == 'on'){
	?>
	    <div class="header-top header-banner">
            <div class="container">
                <div class="topinfo pull-right">
                    <?php 
                        $header_tool_phone = get_theme_mod('liven_header_tool_Phone_number');
                        $header_tool_email = get_theme_mod('liven_header_tool_email');
                        ?>
                        <div class="topinfo-detail">
                        <?php
                            if(!empty($header_tool_phone)){
                            ?>
                                <i class="fa fa-phone fa-x header-toolbar-icon-color"></i><?php echo esc_html($header_tool_phone); ?>
                            <?php
                            }
                        ?>
                        </div>
                        <div class="topinfo-detail">
                        <?php
                            if(!empty($header_tool_email)){
                            ?>
                                <i class="fa fa-envelope fa-x header-toolbar-icon-color"></i><a href="<?php echo esc_url('mailto:'.$header_tool_email); ?>"><?php echo esc_html($header_tool_email); ?></a>
                            <?php
                            }
                        ?>
                        </div>
                        <div class="clr"></div>
                </div>
            </div>
        </div>
    <?php
	}
    ?>
    <div class="header-white liven-header-bg">
        <div class="container">
            <div class="header-data">
                <div class="logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                        $liven_site_logo = get_theme_mod('liven_site_logo');
                        if($liven_site_logo != "") {
                        ?>
                            <img src="<?php echo esc_url(get_theme_mod('liven_site_logo')); ?>"  alt="<?php esc_html(bloginfo( 'name' )); ?>" />
                        <?php
                        }
                        else{
                            esc_html(bloginfo( 'name' ));
                        }
                    ?>
                    </a>
                </div>
                <div class="menu liven-header-bg">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary',  'menu_id' => 'menu-main-menu-2', 'menu_class' => 'right' ) ); ?>
                </div> 
                <div class="clr"></div>
            </div>
        </div>
    </div>
    <!--fix header for mobile-->
    <div class="fix-header">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-xs-6 logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                        $liven_site_logo = get_theme_mod('liven_site_logo');
                        if($liven_site_logo != "") {
                        ?>
                            <img src="<?php echo esc_url(get_theme_mod('liven_site_logo')); ?>"  alt="<?php esc_html(bloginfo( 'name' )); ?>" />
                        <?php
                        }
                        else{
                            esc_html(bloginfo( 'name' ));
                        }
                    ?>
                    </a>
                </div>
                <div class="col-xs-2 pull-right res-bar">
                    <nav class="nav is-fixed">
                        <button class="nav-toggle">
                            <span class="icon-menu">
                                <span class="line line-1"></span>
                                <span class="line line-2"></span>
                                <span class="line line-3"></span>
                            </span>
                        </button>
                        <div class="nav-container">
                            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu menu' ) ); ?>
                        </div>
                    </nav>
                </div>
                <div class="clr"></div>
            </div>
        </div>
    </div>
<?php        
}
else if($liven_header_style == 'header_style_2'){
    $header_style = get_theme_mod('liven_header_toolbar_required');
	if($header_style == 'on'){
	?>
	    <div class="header-top header2-top">
            <div class="container">
                <div class="topinfo pull-left">
                    <?php 
                        $header_tool_phone = get_theme_mod('liven_header_tool_Phone_number');
                        $header_tool_email = get_theme_mod('liven_header_tool_email');
                    ?>
                    <div class="topinfo-detail">
                    <?php
                        if(!empty($header_tool_phone)){
                        ?>
                            <i class="fa fa-phone fa-x header-toolbar-icon-color"></i><?php echo esc_html($header_tool_phone); ?>
                        <?php
                        }
                    ?>
                    </div>
                    <div class="topinfo-detail">
                    <?php
                        if(!empty($header_tool_email)){
                        ?>
                            <i class="fa fa-envelope fa-x header-toolbar-icon-color"></i><a href="<?php echo esc_url('mailto:'.$header_tool_email); ?>"><?php echo esc_html($header_tool_email); ?></a>
                        <?php
                        }
                    ?>
                    </div>
                    <div class="clr"></div>
                </div>
                <?php
                    if(!empty($liven_header_social_icons) && $liven_header_social_icons == 'on'){
                    ?>
                        <div class="<?php echo esc_attr($liven_social_class); ?> pull-right">
                            <div class="col-lg-12">
                            <?php
                                $liven_header_tool_facebook = get_theme_mod('liven_header_tool_facebook');
                                $liven_header_tool_twitter  = get_theme_mod('liven_header_tool_twitter');
                                $liven_header_tool_gplus    = get_theme_mod('liven_header_tool_gplus');
                                $liven_header_tool_linkedin = get_theme_mod('liven_header_tool_linkedin');
                            
                                if(!empty($liven_header_tool_facebook)){
                                ?>
                                    <a href="<?php echo esc_url($liven_header_tool_facebook); ?>" class="facebook" target="_BLANK"></a>
                                <?php
                                }
                                if(!empty($liven_header_tool_twitter)){
                                ?>
                                    <a href="<?php echo esc_url($liven_header_tool_twitter); ?>" class="twitter" target="_BLANK"></a>
                                <?php
                                }
                                if(!empty($liven_header_tool_gplus)){
                                ?>
                                    <a href="<?php echo esc_url($liven_header_tool_gplus); ?>" class="gplus" target="_BLANK"></a>
                                <?php
                                }
                                if(!empty($liven_header_tool_linkedin)){
                                ?>
                                    <a href="<?php echo esc_url($liven_header_tool_linkedin); ?>" class="linkedin" target="_BLANK"></a>
                                <?php
                                }
                            ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    <?php
                    }
                ?>
            </div>
        </div>
        <div class="clear"></div>
	<?php
	}
    ?>
    <div class="header-white liven-header-bg">
        <div class="container">
            <div class="header-data">
                <div class="logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                        $liven_site_logo = get_theme_mod('liven_site_logo');
                        if($liven_site_logo != "") {
                        ?>
                            <img src="<?php echo esc_url(get_theme_mod('liven_site_logo')); ?>"  alt="<?php esc_html(bloginfo( 'name' )); ?>" />
                        <?php
                        }
                        else{
                            esc_html(bloginfo( 'name' ));
                        }
                    ?>
                    </a>
                </div>
                <div class="menu liven-header-bg">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary',  'menu_id' => 'menu-main-menu-2', 'menu_class' => 'right' ) ); ?>
                </div> 
                <div class="clr"></div>
            </div>
        </div>
    </div>
    <!--fix header for mobile-->
    <div class="fix-header">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-xs-6 logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                        $liven_site_logo = get_theme_mod('liven_site_logo');
                        if($liven_site_logo != "") {
                        ?>
                            <img src="<?php echo esc_url(get_theme_mod('liven_site_logo')); ?>"  alt="<?php esc_html(bloginfo( 'name' )); ?>" />
                        <?php
                        }
                        else{
                            esc_html(bloginfo( 'name' ));
                        }
                    ?>
                    </a>
                </div>
                <div class="col-xs-2 pull-right res-bar">
                    <nav class="nav is-fixed">
                        <button class="nav-toggle">
                            <span class="icon-menu">
                                <span class="line line-1"></span>
                                <span class="line line-2"></span>
                                <span class="line line-3"></span>
                            </span>
                        </button>
                        <div class="nav-container">
                            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu menu' ) ); ?>
                        </div>
                    </nav>
                </div>
                <div class="clr"></div>
            </div>
        </div>
    </div>
<?php        
}

else if($liven_header_style == 'header_style_3'){
    $header_style = get_theme_mod('liven_header_toolbar_required');
	if($header_style == 'on'){
	?>
	    <div class="header-top header3-top">
            <div class="container">
                    <div class="topinfo pull-left">
                        <?php 
                            $header_tool_phone = get_theme_mod('liven_header_tool_Phone_number');
                            $header_tool_email = get_theme_mod('liven_header_tool_email');
                        ?>
                        <div class="topinfo-detail">
                        <?php
                            if(!empty($header_tool_phone)){
                            ?>
                                <i class="fa fa-phone fa-x header-toolbar-icon-color"></i><?php echo esc_html($header_tool_phone); ?>
                            <?php
                            }
                        ?>
                        </div>
                        <div class="topinfo-detail">
                        <?php
                            if(!empty($header_tool_email)){
                            ?>
                                <i class="fa fa-envelope fa-x header-toolbar-icon-color"></i><a href="<?php echo esc_url('mailto:'.$header_tool_email); ?>"><?php echo esc_html($header_tool_email); ?></a>
                            <?php
                            }
                        ?>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div class="serchdiv pull-right">
                    <?php 
                        $liven_header_search_bar = get_theme_mod('liven_header_search_bar');
                        if($liven_header_search_bar == "on" || $liven_header_search_bar == ""){
                            add_filter( 'get_search_form', 'liven_custom_search_form' );
                            get_search_form();
                            remove_filter( 'get_search_form', 'liven_custom_search_form' );
                        }
                    ?>
                    </div>
            </div>
        </div>
        <div class="clear"></div>
	<?php
	}
    ?>
    <div class="header-white liven-header-bg">
        <div class="container">
            <div class="header-data">
                <div class="col-md-2 col-xs-2 logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                        $liven_site_logo = get_theme_mod('liven_site_logo');
                        if($liven_site_logo != "") {
                        ?>
                            <img src="<?php echo esc_url(get_theme_mod('liven_site_logo')); ?>"  alt="<?php esc_html(bloginfo( 'name' )); ?>" />
                        <?php
                        }
                        else{
                            esc_html(bloginfo( 'name' ));
                        }
                    ?>
                    </a>
                </div>
                <div class="menu liven-header-bg">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary',  'menu_id' => 'menu-main-menu-2', 'menu_class' => 'right' ) ); ?>
                </div>
                <div class="clr"></div>
            </div>
        </div>
    </div>
    <!--fix header for mobile-->
    <div class="fix-header">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-xs-6 logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                        $liven_site_logo = get_theme_mod('liven_site_logo');
                        if($liven_site_logo != "") {
                        ?>
                            <img src="<?php echo esc_url(get_theme_mod('liven_site_logo')); ?>"  alt="<?php esc_html(bloginfo( 'name' )); ?>" />
                        <?php
                        }
                        else{
                            esc_html(bloginfo( 'name' ));
                        }
                    ?>
                    </a>
                </div>
                <div class="col-xs-2 pull-right res-bar">
                    <nav class="nav is-fixed">
                        <button class="nav-toggle">
                            <span class="icon-menu">
                                <span class="line line-1"></span>
                                <span class="line line-2"></span>
                                <span class="line line-3"></span>
                            </span>
                        </button>
                        <div class="nav-container">
                            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu menu' ) ); ?>
                        </div>
                    </nav>
                </div>
                <div class="clr"></div>
            </div>
        </div>
    </div>
<?php        
}
else if($liven_header_style == 'header_style_4'){
    $header_style = get_theme_mod('liven_header_toolbar_required');
	if($header_style == 'on'){
	?>
	    <div class="header-top header-banner header4-top">
            <div class="container">
                <div class="topinfo pull-right">
                    <?php 
                        $header_tool_phone = get_theme_mod('liven_header_tool_Phone_number');
                        $header_tool_email = get_theme_mod('liven_header_tool_email');
                        ?>
                        <div class="topinfo-detail">
                        <?php
                            if(!empty($header_tool_phone)){
                            ?>
                                <i class="fa fa-phone fa-x header-toolbar-icon-color"></i><?php echo esc_html($header_tool_phone); ?>
                            <?php
                            }
                        ?>
                        </div>
                        <div class="topinfo-detail">
                        <?php
                            if(!empty($header_tool_email)){
                            ?>
                                <i class="fa fa-envelope fa-x header-toolbar-icon-color"></i><a href="<?php echo esc_url('mailto:'.$header_tool_email); ?>"><?php echo esc_html($header_tool_email); ?></a>
                            <?php
                            }
                        ?>
                        </div>
                        <div class="clr"></div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
	<?php
	}
    ?>
    <div class="header-white liven-header-bg liven-header4">
        <div class="container">
            <div class="header-data">
                <div class="col-md-2 col-xs-2 logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                        $liven_site_logo = get_theme_mod('liven_site_logo');
                        if($liven_site_logo != "") {
                        ?>
                            <img src="<?php echo esc_url(get_theme_mod('liven_site_logo')); ?>"  alt="<?php esc_html(bloginfo( 'name' )); ?>" />
                        <?php
                        }
                        else{
                            esc_html(bloginfo( 'name' ));
                        }
                    ?>
                    </a>
                </div>
                <dic class="search-menu-4">
                    <div class="menu liven-header-bg">
                        <?php wp_nav_menu( array( 'theme_location' => 'primary',  'menu_id' => 'menu-main-menu-2', 'menu_class' => 'right' ) ); ?>
                    </div>
                    <div class="serchdiv">
                        <?php 
                            $liven_header_search_bar = get_theme_mod('liven_header_search_bar');
                            if($liven_header_search_bar == "on" || $liven_header_search_bar == ""){
                                add_filter( 'get_search_form', 'liven_custom_search_form' );
                                get_search_form();
                                remove_filter( 'get_search_form', 'liven_custom_search_form' );
                            }
                        ?>
                    </div>
                    <div class="clr"></div>
                </div>
            </div>
        </div>
    </div>
    <!--fix header for mobile-->
    <div class="fix-header">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-xs-6 logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                        $liven_site_logo = get_theme_mod('liven_site_logo');
                        if($liven_site_logo != "") {
                        ?>
                            <img src="<?php echo esc_url(get_theme_mod('liven_site_logo')); ?>"  alt="<?php esc_html(bloginfo( 'name' )); ?>" />
                        <?php
                        }
                        else{
                            esc_html(bloginfo( 'name' ));
                        }
                    ?>
                    </a>
                </div>
                <div class="col-xs-2 pull-right res-bar">
                    <nav class="nav is-fixed">
                        <button class="nav-toggle">
                            <span class="icon-menu">
                                <span class="line line-1"></span>
                                <span class="line line-2"></span>
                                <span class="line line-3"></span>
                            </span>
                        </button>
                        <div class="nav-container">
                            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu menu' ) ); ?>
                        </div>
                    </nav>
                </div>
                <div class="clr"></div>
            </div>
        </div>
    </div>
<?php        
}
else if($liven_header_style == 'header_style_5'){
    $header_style = get_theme_mod('liven_header_toolbar_required');
	if($header_style == 'on'){
	?>
	    <div class="header-top header-banner">
            <div class="container">
                <div class="">
                    <div class="topinfo pull-right">
                    <?php 
                        $header_tool_phone = get_theme_mod('liven_header_tool_Phone_number');
                        $header_tool_email = get_theme_mod('liven_header_tool_email');
                        ?>
                        <div class="topinfo-detail">
                        <?php
                            if(!empty($header_tool_phone)){
                            ?>
                                <i class="fa fa-phone fa-x header-toolbar-icon-color"></i><?php echo esc_html($header_tool_phone); ?>
                            <?php
                            }
                        ?>
                        </div>
                        <div class="topinfo-detail">
                        <?php
                            if(!empty($header_tool_email)){
                            ?>
                                <i class="fa fa-envelope fa-x header-toolbar-icon-color"></i><a href="<?php echo esc_url('mailto:'.$header_tool_email); ?>"><?php echo esc_html($header_tool_email); ?></a>
                            <?php
                            }
                        ?>
                        </div>
                        <div class="clr"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
	<?php
	}
    ?>
    <div class="header-white liven-header-bg">
        <div class="container">
            <div class="header-data">
                <div class="col-md-2 col-xs-2 logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                        $liven_site_logo = get_theme_mod('liven_site_logo');
                        if($liven_site_logo != "") {
                        ?>
                            <img src="<?php echo esc_url(get_theme_mod('liven_site_logo')); ?>"  alt="<?php esc_html(bloginfo( 'name' )); ?>" />
                        <?php
                        }
                        else{
                            esc_html(bloginfo( 'name' ));
                        }
                    ?>
                    </a>
                </div>
                <div class="liven-header5">
                    <div class="serchdiv">
                    <?php 
                        
                        $liven_header_search_bar = get_theme_mod('liven_header_search_bar');
                        if($liven_header_search_bar == "on" || $liven_header_search_bar == ""){
                            add_filter( 'get_search_form', 'liven_custom_search_form' );
                            get_search_form();
                            remove_filter( 'get_search_form', 'liven_custom_search_form' );
                        }
                    ?>
                    </div>
                    <?php
                        if(!empty($liven_header_social_icons) && $liven_header_social_icons == 'on'){
                        ?>
                            <div class="<?php echo esc_attr($liven_social_class); ?>">
                                <div class="">
                                <?php
                                    $liven_header_tool_facebook = get_theme_mod('liven_header_tool_facebook');
                                    $liven_header_tool_twitter  = get_theme_mod('liven_header_tool_twitter');
                                    $liven_header_tool_gplus    = get_theme_mod('liven_header_tool_gplus');
                                    $liven_header_tool_linkedin = get_theme_mod('liven_header_tool_linkedin');
                            
                                    if(!empty($liven_header_tool_facebook)){
                                    ?>
                                        <a href="<?php echo esc_url($liven_header_tool_facebook); ?>" class="facebook" target="_BLANK"></a>
                                    <?php
                                    }
                                    if(!empty($liven_header_tool_twitter)){
                                    ?>
                                        <a href="<?php echo esc_url($liven_header_tool_twitter); ?>" class="twitter" target="_BLANK"></a>
                                    <?php
                                    }
                                    if(!empty($liven_header_tool_gplus)){
                                    ?>  
                                        <a href="<?php echo esc_url($liven_header_tool_gplus); ?>" class="gplus" target="_BLANK"></a>
                                    <?php
                                    }
                                    if(!empty($liven_header_tool_linkedin)){
                                    ?>
                                        <a href="<?php echo esc_url($liven_header_tool_linkedin); ?>" class="linkedin" target="_BLANK"></a>
                                    <?php
                                    }
                                ?>
                                </div>
                                <div class="clr"></div>
                            </div>
                        <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="header-nav-gray header5-menu">
            <div class="container">
                <div class="menu">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary',  'menu_id' => 'menu-main-menu-2' ) ); ?>
                </div>
            </div>
        </div>
    </div>
    
    <!--fix header for mobile-->
    <div class="fix-header">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-xs-6 logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php
                        $liven_site_logo = get_theme_mod('liven_site_logo');
                        if($liven_site_logo != "") {
                        ?>
                            <img src="<?php echo esc_url(get_theme_mod('liven_site_logo')); ?>"  alt="<?php esc_html(bloginfo( 'name' )); ?>" />
                        <?php
                        }
                        else{
                            esc_html(bloginfo( 'name' ));
                        }
                    ?>
                    </a>
                </div>
                <div class="col-xs-2 pull-right res-bar">
                    <nav class="nav is-fixed">
                        <button class="nav-toggle">
                            <span class="icon-menu">
                                <span class="line line-1"></span>
                                <span class="line line-2"></span>
                                <span class="line line-3"></span>
                            </span>
                        </button>
                        <div class="nav-container">
                            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu menu' ) ); ?>
                        </div>
                    </nav>
                </div>
                <div class="clr"></div>
            </div>
        </div>
    </div>
<?php        
}