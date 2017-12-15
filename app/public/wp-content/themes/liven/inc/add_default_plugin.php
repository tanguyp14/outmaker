<?php
if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
    get_template_part( get_template_directory() . '/inc/class-tgm-plugin-activation' );
}
function liven_register_required_plugins() {
	$plugins = array();
    if (!empty($plugins))
    {
        // Do nothing
    }
    else 
    {
        // If remote request fails use theme delivered plugins
        $plugins = array(
            // PREMIUM Plugins
            // This is an example of how to include a plugin bundled with a theme.
            array(
                'name'                  => esc_html__('Visual Composer','liven'), // The plugin name
                'slug'                  => 'js_composer', // The plugin slug (typically the folder name)
                'source'                => esc_url('http://static.lithemes.com/plugins/js_composer.zip'),
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
                'version'               => esc_html__('4.12.1','liven'), // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            ),
            array(
                'name'                  => esc_html__('Liven Extenstion','liven'), // The plugin name
                'slug'                  => 'liven-extensions', // The plugin slug (typically the folder name)
                'source'                => esc_url('http://static.lithemes.com/plugins/liven-extensions.zip'),
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
                'version'               => esc_html__('1.0','liven'), // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            ),
            array(
                'name'                  => esc_html__('Revolution Slider','liven'), // The plugin name
                'slug'                  => 'revslider', // The plugin slug (typically the folder name)
                'source'                => esc_url('http://static.lithemes.com/plugins/revslider.zip'),
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
                'version'               => esc_html__('5.2.6','liven'), // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            ),
			array(
                'name'                  => esc_html__('Contact Form 7','liven'), // The plugin name
                'slug'                  => 'contact-form-7', // The plugin slug (typically the folder name)
                'required'              => false, // If false, the plugin is only 'recommended' instead of required
            ),
		);
    }
    $config = array(
		'id'           => 'liven',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'domain'       => 'liven',
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'message'      => '',                      // Message to output right before the plugins table.
    );
    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'liven_register_required_plugins' );
?>