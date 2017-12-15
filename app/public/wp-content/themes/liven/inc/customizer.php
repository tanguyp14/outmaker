<?php
/**
 * liven Theme Customizer.
 *
 * @package liven
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function liven_customize_register( $wp_customize ) {
/***********Following code adds main theme panel in customizer***********/
	$wp_customize->add_panel( 'liven_panel_id', array(
	    'priority'       => 10,
	    'capability'     => 'edit_theme_options',
	    'title'          => esc_html__( 'Liven Theme Option', 'liven' ),
	    'theme_supports' => '',
	    'description'    => esc_html__( 'The Customizer allows you to preview changes to your site before publishing them. You can also navigate to different pages on your site to preview them.', 'liven' ),
	) );

/***********Following code adds colors section***********/
	$wp_customize->add_section( 'liven_theme_global_color_section', array(
	    'priority'       => 10,
	  	'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => esc_html__( 'Global Colors', 'liven' ),
	    'panel'          => 'liven_panel_id',
	) );

/***********controls of colors starts from here***********/
	$wp_customize->add_setting( 'liven_global_page_bg_color' , array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_global_page_bg_color', array(
		'label'      => esc_html__( 'Page Background Color', 'liven' ),
		'section'    => 'liven_theme_global_color_section',
		'settings'   => 'liven_global_page_bg_color',
	) ) );
	
	$wp_customize->add_setting( 'liven_global_text_color' , array(
		'default'           => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_global_text_color', array(
		'label'      => esc_html__( 'Font Color', 'liven' ),
		'section'    => 'liven_theme_global_color_section',
		'settings'   => 'liven_global_text_color',
	) ) );
	
	$wp_customize->add_setting( 'liven_global_link_color' , array(
		'default'           => '#009cff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_global_link_color', array(
		'label'      => esc_html__( 'Link Color', 'liven' ),
		'section'    => 'liven_theme_global_color_section',
		'settings'   => 'liven_global_link_color',
	) ) );
	
	$wp_customize->add_setting( 'liven_global_link_hover_color' , array(
		'default'           => '#333',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_global_link_hover_color', array(
		'label'      => esc_html__( 'Link Hover Color', 'liven' ),
		'section'    => 'liven_theme_global_color_section',
		'settings'   => 'liven_global_link_hover_color',
	) ) );
	
	$wp_customize->add_setting( 'liven_global_button_color' , array(
		'default'           => '#009cff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_global_button_color', array(
		'label'      => esc_html__( 'Button Color', 'liven' ),
		'section'    => 'liven_theme_global_color_section',
		'settings'   => 'liven_global_button_color',
	) ) );
	
	$wp_customize->add_setting( 'liven_global_button_text_color' , array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_global_button_text_color', array(
		'label'      => esc_html__( 'Button Font Color', 'liven' ),
		'section'    => 'liven_theme_global_color_section',
		'settings'   => 'liven_global_button_text_color',
	) ) );
	
	$wp_customize->add_setting( 'liven_global_heading_color' , array(
		'default'           => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_global_heading_color', array(
		'label'      => esc_html__( 'Heading Color', 'liven' ),
		'section'    => 'liven_theme_global_color_section',
		'settings'   => 'liven_global_heading_color',
		'description' => esc_html__( 'Default Heading color for h1 to h6', 'liven' ),
	) ) );
	
/***********controls of colors ends here***********/



/***********Following code adds header toolbar section***********/
	$wp_customize->add_section( 'liven_theme_header_toolbar_section', array(
	    'priority'       => 10,
	  	'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => esc_html__( 'Header Toolbar', 'liven' ),
	    'panel'          => 'liven_panel_id',
	) );
	
/***********controls of header toolbar starts from here***********/
	$wp_customize->add_setting('liven_header_toolbar_required', array(
		'default'           => 'off',
		'sanitize_callback' => 'liven_sanitize_header_toolbar'
    ) );
    $wp_customize->add_control('liven_header_toolbar_required', array(
		'type'    => 'radio',
        'label'   => esc_html__( 'Header Toolbar', 'liven' ),
        'section' => 'liven_theme_header_toolbar_section',
        'choices' => array(
        	'on'  => esc_html__('On','liven'),
            'off' => esc_html__('Off','liven'),
        ),
    ) );
    
  	$wp_customize->add_setting( 'liven_header_tool_Phone_number', array(
		'default'           => '',
		'sanitize_callback' => 'liven_sanitize_phone_number'
	) );
	$wp_customize->add_control( 'liven_header_tool_Phone_number', array(
		'type'            => 'text',
		'priority'        => 10,
		'section'         => 'liven_theme_header_toolbar_section',
		'label'           => esc_html__( 'Phone Number', 'liven' ),
		'active_callback' => 'liven_header_tool_callback',
		'description' => esc_html__( 'Enter phone number in standard format', 'liven' )
	) );
	
	$wp_customize->add_setting( 'liven_header_tool_email', array(
		'default'           => '',
		'sanitize_callback' => 'liven_sanitize_header_tool_email'
	) );
	$wp_customize->add_control( 'liven_header_tool_email', array(
		'type'            => 'text',
		'priority'        => 10,
		'section'         => 'liven_theme_header_toolbar_section',
		'label'           => esc_html__( 'Email', 'liven' ),
		'active_callback' => 'liven_header_tool_callback',
		'description' => esc_html__( 'Enter email address in standard format', 'liven' )
	) );
	    
    $wp_customize->add_setting( 'liven_header_toolbar_bg_color' , array(
		'default'           => '#f1f1f1',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_header_toolbar_bg_color', array(
		'label'      => esc_html__( 'Background Color', 'liven' ),
		'section'    => 'liven_theme_header_toolbar_section',
		'settings'   => 'liven_header_toolbar_bg_color',
		'active_callback' => 'liven_header_tool_callback'
	) ) );
	
	$wp_customize->add_setting( 'liven_header_toolbar_icon_color' , array(
		'default'           => '#009cff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_header_toolbar_icon_color', array(
		'label'      => esc_html__( 'Icon Color', 'liven' ),
		'section'    => 'liven_theme_header_toolbar_section',
		'settings'   => 'liven_header_toolbar_icon_color',
		'active_callback' => 'liven_header_tool_callback'
	) ) );
	
	$wp_customize->add_setting( 'liven_header_toolbar_text_color' , array(
		'default'           => '#777',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_header_toolbar_text_color', array(
		'label'      => esc_html__( 'Font Color', 'liven' ),
		'section'    => 'liven_theme_header_toolbar_section',
		'settings'   => 'liven_header_toolbar_text_color',
		'active_callback' => 'liven_header_tool_callback'
	) ) );
	
	function liven_header_tool_callback( $control ) {
		if ( $control->manager->get_setting('liven_header_toolbar_required')->value() == 'on' ) {
        	return true;
		} else {
 			return false;
		}
	}
/***********controls of header toolbar ends here***********/


/***********Following code adds header section***********/
	$wp_customize->add_section( 'liven_theme_header_section', array(
	    'priority'       => 10,
	  	'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => esc_html__( 'Header', 'liven' ),
	    'panel'          => 'liven_panel_id',
	) );
	
/***********controls of header starts from here***********/
	$wp_customize->add_setting( 'liven_site_logo' , array(
		'default'           => '',
		'sanitize_callback' => 'liven_sanitize_image'
	) );
 	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'liven_site_logo', array(	
		'label'    => esc_html__( 'Upload Your Logo', 'liven' ),
        'section'  => 'liven_theme_header_section',
        'settings' => 'liven_site_logo',
    ) ) );
    
    $wp_customize->add_setting('liven_header_style', array(
		'default'           => 'header_style_1',
		'sanitize_callback' => 'liven_sanitize_header_style'
    ) );
    $wp_customize->add_control('liven_header_style', array(
		'type'    => 'select',
        'label'   => esc_html__( 'Select Your Header Style', 'liven' ),
        'section' => 'liven_theme_header_section',
        'choices' => array(
        	'header_style_1'  => esc_html__( 'Style 1', 'liven' ),
            'header_style_2'  => esc_html__( 'Style 2', 'liven' ),
            'header_style_3'  => esc_html__( 'Style 3', 'liven' ),
            'header_style_4'  => esc_html__( 'Style 4', 'liven' ),
            'header_style_5'  => esc_html__( 'Style 5', 'liven' ),
        ),
    ) );
    
    
    
    $wp_customize->add_setting( 'liven_header_bg_color' , array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_header_bg_color', array(
		'label'      => esc_html__( 'Header Background Color', 'liven' ),
		'section'    => 'liven_theme_header_section',
		'settings'   => 'liven_header_bg_color',
	) ) );
	
	$wp_customize->add_setting( 'liven_header_text_color' , array(
		'default'           => '#666',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_header_text_color', array(
		'label'      => esc_html__( 'Menu Font Color', 'liven' ),
		'section'    => 'liven_theme_header_section',
		'settings'   => 'liven_header_text_color',
	) ) );
	
	$wp_customize->add_setting( 'liven_header_text_hover_color' , array(
		'default'           => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_header_text_hover_color', array(
		'label'      => esc_html__( 'Menu Font Hover Color', 'liven' ),
		'section'    => 'liven_theme_header_section',
		'settings'   => 'liven_header_text_hover_color',
	) ) );
	
	$wp_customize->add_setting( 'liven_header_active_text_color' , array(
		'default'           => '#009cff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_header_active_text_color', array(
		'label'      => esc_html__( 'Active Menu Font Color', 'liven' ),
		'section'    => 'liven_theme_header_section',
		'settings'   => 'liven_header_active_text_color',
	) ) );
	
	$wp_customize->add_setting( 'liven_header_menu_background_color' , array(
		'default'           => '#f1f1f1',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_header_menu_background_color', array(
		'label'           => esc_html__( 'Menu Background Color', 'liven' ),
		'section'         => 'liven_theme_header_section',
		'settings'        => 'liven_header_menu_background_color',
		'active_callback' => 'liven_header_color_callback'
	) ) );
	
	$wp_customize->add_setting('liven_header_search_bar', array(
		'default'           => 'on',
		'sanitize_callback' => 'liven_sanitize_header_search_bar'
    ) );
    $wp_customize->add_control('liven_header_search_bar', array(
		'type'    => 'radio',
        'label'   => esc_html__( 'Header Searchbar', 'liven' ),
        'section' => 'liven_theme_header_section',
        'choices' => array(
        	'on'  => esc_html__( 'On', 'liven' ),
            'off' => esc_html__( 'Off', 'liven' ),
        ),
        'active_callback' => 'liven_header_sarchbar_callback'
    ) );
    
    $wp_customize->add_setting('liven_header_social_icons', array(
		'default'           => 'off',
		'sanitize_callback' => 'liven_sanitize_header_social_icons'
    ) );
    $wp_customize->add_control('liven_header_social_icons', array(
		'type'    => 'radio',
        'label'   => esc_html__( 'Social Icons', 'liven' ),
        'section' => 'liven_theme_header_section',
        'choices' => array(
        	'on'  => esc_html__( 'On', 'liven' ),
            'off' => esc_html__( 'Off', 'liven' ),
        ),
        'active_callback' => 'liven_header_social_icon_callback'
    ) );
    
    
    
    $wp_customize->add_setting( 'liven_header_tool_facebook', array(
		'sanitize_callback' => 'liven_sanitize_url'
	) );
	$wp_customize->add_control( 'liven_header_tool_facebook', array(
		'type'            => 'text',
		'priority'        => 10,
		'section'         => 'liven_theme_header_section',
		'label'           => esc_html__( 'Facebook Link', 'liven' ),
		'active_callback' => 'liven_header_social_switch_callback',
		'description' => esc_html__( 'Enter your facebook link to show icon.', 'liven' )
	) );
	
	$wp_customize->add_setting( 'liven_header_tool_twitter', array(
		'sanitize_callback' => 'liven_sanitize_url'
	) );
	$wp_customize->add_control( 'liven_header_tool_twitter', array(
		'type'            => 'text',
		'priority'        => 10,
		'section'         => 'liven_theme_header_section',
		'label'           => esc_html__( 'Twitter Link', 'liven' ),
		'active_callback' => 'liven_header_social_switch_callback',
		'description' => esc_html__( 'Enter your twitter link to show icon.', 'liven' )
	) );
	
	$wp_customize->add_setting( 'liven_header_tool_gplus', array(
		'sanitize_callback' => 'liven_sanitize_url'
	) );
	$wp_customize->add_control( 'liven_header_tool_gplus', array(
		'type'            => 'text',
		'priority'        => 10,
		'section'         => 'liven_theme_header_section',
		'label'           => esc_html__( 'Google Plus Link', 'liven' ),
		'active_callback' => 'liven_header_social_switch_callback',
		'description' => esc_html__( 'Enter your google plus link to show icon.', 'liven' )
	) );
	
	$wp_customize->add_setting( 'liven_header_tool_linkedin', array(
		'sanitize_callback' => 'liven_sanitize_url'
	) );
	$wp_customize->add_control( 'liven_header_tool_linkedin', array(
		'type'            => 'text',
		'priority'        => 10,
		'section'         => 'liven_theme_header_section',
		'label'           => esc_html__( 'LinkedIn Link', 'liven' ),
		'active_callback' => 'liven_header_social_switch_callback',
		'description' => esc_html__( 'Enter your linkedin link to show icon.', 'liven' )
	) );
	
	$wp_customize->add_setting('liven_header_toolbar_social_icon_color', array(
		'default'           => 'dark',
		'sanitize_callback' => 'liven_sanitize_header_toolbar_social_icon_color'
    ) );
    $wp_customize->add_control('liven_header_toolbar_social_icon_color', array(
		'type'    => 'radio',
        'label'   => esc_html__( 'Social Icons Style', 'liven' ),
        'section' => 'liven_theme_header_section',
        'choices' => array(
        	'dark'  => esc_html__( 'Dark', 'liven' ),
            'light' => esc_html__( 'Light', 'liven' ),
        ),
        'active_callback' => 'liven_header_social_switch_callback'
    ) );
    
    
	
	function liven_header_color_callback( $control ) {
		if ( $control->manager->get_setting('liven_header_style')->value() == 'header_style_5' ) {
        	return true;
		} else {
 			return false;
		}
	}
	function liven_header_sarchbar_callback( $control ) {
		if ( $control->manager->get_setting('liven_header_style')->value() == 'header_style_3' || $control->manager->get_setting('liven_header_style')->value() == 'header_style_4' || $control->manager->get_setting('liven_header_style')->value() == 'header_style_5') {
        	return true;
		} else {
 			return false;
		}
	}
	function liven_header_social_icon_callback( $control ) {
		if ( $control->manager->get_setting('liven_header_style')->value() == 'header_style_2' || $control->manager->get_setting('liven_header_style')->value() == 'header_style_5') {
        	return true;
		} else {
 			return false;
		}
	}
	function liven_header_social_switch_callback( $control ) {
		if ( $control->manager->get_setting('liven_header_social_icons')->value() == 'on' ) {
        	if ( $control->manager->get_setting('liven_header_style')->value() == 'header_style_2' || $control->manager->get_setting('liven_header_style')->value() == 'header_style_5') {
        	    return true;
		    }
		} else {
 			return false;
		}
	}
/***********controls of header ends here***********/



/***********Following code adds Breadcrumb section***********/
	$wp_customize->add_section( 'liven_theme_general_breadcrumb_section', array(
	    'priority'       => 10,
	  	'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => esc_html__( 'Page Title & Breadcrumb Settings', 'liven' ),
	    'panel'          => 'liven_panel_id',
	) );

/***********controls of breadcrumb starts from here***********/
    $wp_customize->add_setting('liven_breadcrumb_bg', array(
		'default'           => 'color',
		'sanitize_callback' => 'liven_sanitize_breadcrumb_bg'
    ) );
    $wp_customize->add_control('liven_breadcrumb_bg', array(
		'type'    => 'radio',
        'label'   => esc_html__( 'Page Title Background', 'liven' ),
        'section' => 'liven_theme_general_breadcrumb_section',
        'choices' => array(
        	'image' => esc_html__( 'Image', 'liven' ),
            'color' => esc_html__( 'Color', 'liven' ),
        ),
    ) );
    
    $wp_customize->add_setting( 'liven_breadcrumb_bg_image' , array(
		'default'           => '',
		'sanitize_callback' => 'liven_sanitize_image'
	) );
 	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'liven_breadcrumb_bg_image', array(	
		'label'           => esc_html__( 'Background Image', 'liven' ),
        'section'         => 'liven_theme_general_breadcrumb_section',
        'settings'        => 'liven_breadcrumb_bg_image',
        'active_callback' => 'liven_breadcrumb_bg_image_callback'
    ) ) );
    
    $wp_customize->add_setting( 'liven_breadcrumb_bg_color' , array(
		'default'           => '#02a2ff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_breadcrumb_bg_color', array(
		'label'           => esc_html__( 'Background Color', 'liven' ),
		'section'         => 'liven_theme_general_breadcrumb_section',
		'settings'        => 'liven_breadcrumb_bg_color',
		'active_callback' => 'liven_breadcrumb_bg_color_callback'
	) ) );

    $wp_customize->add_setting('liven_general_global_page_title', array(
		'default'           => 'on',
		'sanitize_callback' => 'liven_sanitize_general_global_page_title'
    ) );
    $wp_customize->add_control('liven_general_global_page_title', array(
		'type'    => 'radio',
        'label'   => esc_html__( 'Page Title', 'liven' ),
        'section' => 'liven_theme_general_breadcrumb_section',
        'choices' => array(
        	'on'  => esc_html__( 'On', 'liven' ),
            'off' => esc_html__( 'Off', 'liven' ),
        ),
        'description' => esc_html__( 'You can disable page title globally using this option, or you may need to disable it in a particular page.', 'liven' ),
    ) );
    
    $wp_customize->add_setting( 'liven_page_title_color' , array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_page_title_color', array(
		'label'           => esc_html__( 'Page Title Color', 'liven' ),
		'section'         => 'liven_theme_general_breadcrumb_section',
		'settings'        => 'liven_page_title_color',
		'active_callback' => 'liven_page_title_callback'
	) ) );
    
    $wp_customize->add_setting('liven_general_global_breadcrumb', array(
		'default'           => 'on',
		'sanitize_callback' => 'liven_sanitize_general_global_breadcrumb'
    ) );
    $wp_customize->add_control('liven_general_global_breadcrumb', array(
		'type'    => 'radio',
        'label'   => esc_html__( 'Breadcrumb', 'liven' ),
        'section' => 'liven_theme_general_breadcrumb_section',
        'choices' => array(
        	'on'  => esc_html__( 'On', 'liven' ),
            'off' => esc_html__( 'Off', 'liven' ),
        ),
        'description' => esc_html__( 'You can disable breadcrumb navigation globally using this option, or you may need to disable it in a particular page.', 'liven' ),
    ) );
    
    $wp_customize->add_setting('liven_breadcrumb_style', array(
		'default'           => 'liven_breadcrumb_style_1',
		'sanitize_callback' => 'liven_sanitize_breadcrumb_style'
    ) );
    $wp_customize->add_control('liven_breadcrumb_style', array(
		'type'    => 'select',
        'label'   => esc_html__( 'Select Your Breadcrumb Style', 'liven' ),
        'section' => 'liven_theme_general_breadcrumb_section',
        'choices' => array(
        	'liven_breadcrumb_style_1'  => esc_html__( 'Style 1', 'liven' ),
            'liven_breadcrumb_style_2'  => esc_html__( 'Style 2', 'liven' ),
            'liven_breadcrumb_style_3'  => esc_html__( 'Style 3', 'liven' ),
        ),
        'active_callback' => 'liven_breadcrumb_callback'
    ) );
    	
	$wp_customize->add_setting( 'liven_breadcrumb_pg_color' , array(
		'default'           => '#caecff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_breadcrumb_pg_color', array(
		'label'           => esc_html__( 'Breadcrumb Page Color', 'liven' ),
		'section'         => 'liven_theme_general_breadcrumb_section',
		'settings'        => 'liven_breadcrumb_pg_color',
		'active_callback' => 'liven_breadcrumb_callback'
	) ) );
	
	$wp_customize->add_setting( 'liven_breadcrumb_hover_pg_color' , array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_breadcrumb_hover_pg_color', array(
		'label'           => esc_html__( 'Breadcrumb Hover Color', 'liven' ),
		'section'         => 'liven_theme_general_breadcrumb_section',
		'settings'        => 'liven_breadcrumb_hover_pg_color',
		'active_callback' => 'liven_breadcrumb_callback'
	) ) );
	
	$wp_customize->add_setting( 'liven_breadcrumb_active_pg_color' , array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_breadcrumb_active_pg_color', array(
		'label'           => esc_html__( 'Breadcrumb Active Page Color', 'liven' ),
		'section'         => 'liven_theme_general_breadcrumb_section',
		'settings'        => 'liven_breadcrumb_active_pg_color',
		'active_callback' => 'liven_breadcrumb_callback'
	) ) );
	
	
	$wp_customize->add_setting('liven_breadcrumb_separator', array(
		'default'           => '/',
		'sanitize_callback' => 'liven_sanitize_breadcrumb_separator'
    ) );
    $wp_customize->add_control('liven_breadcrumb_separator', array(
		'type'    => 'select',
        'label'   => esc_html__( 'Select Breadcrumb Separator', 'liven' ),
        'section' => 'liven_theme_general_breadcrumb_section',
        'choices' => array(
        	'/'  => esc_html__('/','liven'),
            '|'  => esc_html__('|','liven'),
            '>'  => esc_html__('>','liven'),
        ),
        'active_callback' => 'liven_breadcrumb_callback'
    ) );
    
    $wp_customize->add_setting( 'liven_breadcrumb_homepage_text', array(
		'default'           => 'home',
		'sanitize_callback' => 'liven_sanitize_text'
	) );
	$wp_customize->add_control( 'liven_breadcrumb_homepage_text', array(
		'type'            => 'text',
		'priority'        => 10,
		'section'         => 'liven_theme_general_breadcrumb_section',
		'label'           => esc_html__( 'Label For Home', 'liven' ),
		'active_callback' => 'liven_breadcrumb_callback'
	) );
	
	function liven_page_title_callback( $control ) {
		if ( $control->manager->get_setting('liven_general_global_page_title')->value() == 'on' ) {
        	return true;
		} else {
 			return false;
		}
	}
	function liven_breadcrumb_callback( $control ) {
		if ( $control->manager->get_setting('liven_general_global_breadcrumb')->value() == 'on' ) {
        	return true;
		} else {
 			return false;
		}
	}
	function liven_breadcrumb_bg_image_callback( $control ) {
		if ( $control->manager->get_setting('liven_breadcrumb_bg')->value() == 'image') {
        	return true;
		} else {
 			return false;
		}
	}
	function liven_breadcrumb_bg_color_callback( $control ) {
		if ( $control->manager->get_setting('liven_breadcrumb_bg')->value() == 'color') {
        	return true;
		} else {
 			return false;
		}
	}
	
/***********controls of breadcrumb ends here***********/



/***********Following code adds blog section***********/
	$wp_customize->add_section( 'liven_theme_blog_section', array(
	    'priority'       => 10,
	  	'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => esc_html__( 'Blog', 'liven' ),
	    'panel'          => 'liven_panel_id',
	) );
	
/***********controls of blog starts from here***********/
    $wp_customize->add_setting('liven_blog_style', array(
		'default'           => 'liven_blog_style_1',
		'sanitize_callback' => 'liven_sanitize_blog_style'
    ) );
    $wp_customize->add_control('liven_blog_style', array(
		'type'    => 'select',
        'label'   => esc_html__( 'Select Your Blog Style', 'liven' ),
        'section' => 'liven_theme_blog_section',
        'choices' => array(
        	'liven_blog_style_1'  => esc_html__( 'Style 1', 'liven' ),
            'liven_blog_style_2'  => esc_html__( 'Style 2', 'liven' ),
            'liven_blog_style_3'  => esc_html__( 'Style 3', 'liven' ),
            'liven_blog_style_4'  => esc_html__( 'Style 4', 'liven' ),
            'liven_blog_style_5'  => esc_html__( 'Style 5', 'liven' ),
        ),
    ) );
    
    $wp_customize->add_setting( 'liven_blog_title_color' , array(
		'default'           => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_blog_title_color', array(
		'label'      => esc_html__( 'Blog Title Color', 'liven' ),
		'section'    => 'liven_theme_blog_section',
		'settings'   => 'liven_blog_title_color',
	) ) );
	
	$wp_customize->add_setting( 'liven_blog_title_hover_color' , array(
		'default'           => '#009cff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_blog_title_hover_color', array(
		'label'      => esc_html__( 'Blog Title Hover Color', 'liven' ),
		'section'    => 'liven_theme_blog_section',
		'settings'   => 'liven_blog_title_hover_color',
		'active_callback' => 'liven_blog_title_Hover_callback'
	) ) );
	
	$wp_customize->add_setting( 'liven_bloginfo_color' , array(
		'default'           => '#bbb',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_bloginfo_color', array(
		'label'      => esc_html__( 'Blog Info Color', 'liven' ),
		'section'    => 'liven_theme_blog_section',
		'settings'   => 'liven_bloginfo_color',
	) ) );
	
	$wp_customize->add_setting( 'liven_blog_date_color' , array(
		'default'           => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'liven_blog_date_color', array(
		'label'      => esc_html__( 'Date Color', 'liven' ),
		'section'    => 'liven_theme_blog_section',
		'settings'   => 'liven_blog_date_color',
		'active_callback' => 'liven_blog5_date_callback'
	) ) );
    
    $wp_customize->add_setting('liven_blog_sidebar', array(
		'default'           => 'off',
		'sanitize_callback' => 'liven_sanitize_blog_sidebar'
    ) );
    $wp_customize->add_control('liven_blog_sidebar', array(
		'type'    => 'radio',
        'label'   => esc_html__( 'Blog Sidebar', 'liven' ),
        'section' => 'liven_theme_blog_section',
        'choices' => array(
        	'on'  => esc_html__( 'On', 'liven' ),
            'off' => esc_html__( 'Off', 'liven' ),
        ),
    ) );
    
    $wp_customize->add_setting('liven_blog_sidebar_position', array(
		'default'           => 'right',
		'sanitize_callback' => 'liven_sanitize_blog_sidebar_position'
    ) );
    $wp_customize->add_control('liven_blog_sidebar_position', array(
		'type'    => 'radio',
        'label'   => esc_html__( 'Blog Sidebar Position', 'liven' ),
        'section' => 'liven_theme_blog_section',
        'choices' => array(
        	'left'  => esc_html__( 'Left', 'liven' ),
            'right' => esc_html__( 'Right', 'liven' ),
        ),
        'active_callback' => 'liven_blog_callback'
    ) );
    
	function liven_blog_callback( $control ) {
		if ( $control->manager->get_setting('liven_blog_sidebar')->value() == 'on' ) {
        	return true;
		} else {
 			return false;
		}
	}
	
	function liven_blog5_date_callback( $control ) {
		if ( $control->manager->get_setting('liven_blog_style')->value() == 'liven_blog_style_5' ) {
        	return true;
		} else {
 			return false;
		}
	}
	
	function liven_blog_title_Hover_callback( $control ) {
		if ( $control->manager->get_setting('liven_blog_style')->value() == 'liven_blog_style_2' ) {
        	return false;
		} else {
 			return true;
		}
	}
/***********controls of blog ends here***********/


/***********Following code adds footer toolbar section***********/
	$wp_customize->add_section( 'liven_theme_footer_toolbar_section', array(
	    'priority'       => 10,
	  	'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => esc_html__( 'Footer', 'liven' ),
	    'panel'          => 'liven_panel_id',
	) );
	
/***********controls of footer toolbar starts from here***********/
    $footer_page_list=array();
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'footer_template.php'
    ));
    foreach($pages as $page){
        $footer_page_list[$page->ID] = $page->post_title;
    }
    if(!empty($pages)){
        $default_footer_page = $pages[0]->ID;
    }
    else{
        $default_footer_page = '';
    }
                
    $wp_customize->add_setting('liven_footer_page', array(
        'default'             => $default_footer_page,
        'sanitize_callback' => 'liven_sanitize_footer_page'
    ) );
    $wp_customize->add_control('liven_footer_page', array(
        'type'    => 'select',
        'label'   => esc_html__( 'Footer Page', 'liven' ),
        'section' => 'liven_theme_footer_toolbar_section',
        'choices' => $footer_page_list,
    ) );
   
    $wp_customize->add_setting('liven_footer_back_to_top_button', array(
		'default'           => 'on',
		'sanitize_callback' => 'liven_sanitize_footer_back_to_top_button'
    ) );
    $wp_customize->add_control('liven_footer_back_to_top_button', array(
		'type'    => 'radio',
        'label'   => esc_html__( 'Back To Top', 'liven' ),
        'section' => 'liven_theme_footer_toolbar_section',
        'choices' => array(
        	'on'  => esc_html__( 'On', 'liven' ),
            'off' => esc_html__( 'Off', 'liven' ),
        ),
        'description'     => esc_html__( 'Using this option you can enable or disable back to top button.', 'liven' ),
        
    ) );

	
/***********controls of footer toolbar ends here***********/



/***********Following code adds theme optimization section***********/
	$wp_customize->add_section( 'liven_theme_optimization_section', array(
	    'priority'       => 10,
	  	'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => esc_html__( 'Theme Optimization', 'liven' ),
	    'panel'          => 'liven_panel_id',
	) );
	
/***********controls of theme optimization starts from here***********/
    
    $wp_customize->add_setting('liven_minified_css_1', array(
        'default'    => '',
        'sanitize_callback' => 'liven_sanitize_theme_opt_css'
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'liven_minified_css_1', array(
        'label'     => esc_html__('Minified CSS', 'liven'),
        'section'   => 'liven_theme_optimization_section',
        'settings'  => 'liven_minified_css_1',
        'type'      => 'checkbox',
        'description'     => esc_html__( 'Check this option to load minified CSS', 'liven' ),
    )));
    
    $wp_customize->add_setting('liven_minified_js', array(
        'default'    => '',
        'sanitize_callback' => 'liven_sanitize_theme_opt_js'
    ));

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'liven_minified_js', array(
        'label'     => esc_html__('Minified Javascript', 'liven'),
        'section'   => 'liven_theme_optimization_section',
        'settings'  => 'liven_minified_js',
        'type'      => 'checkbox',
        'description'     => esc_html__( 'Check this option to load minified Javascript', 'liven' ),
    )));
/***********controls of theme optimization ends here***********/
		
}
add_action( 'customize_register', 'liven_customize_register' );