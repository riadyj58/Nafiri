<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

require_once RIVAX_THEME_DIR . '/admin/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'rivax_register_required_plugins' );

function rivax_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(


		// This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'               => esc_html__( 'Rivax Addon', 'kayleen' ),
            'slug'               => 'rivax-addon',
            'version'            => '1.1.1',
            'source'             => get_template_directory() . '/plugins/rivax-addon.zip',
            'required'           => true,
        ),
        array(
            'name'               => esc_html__( 'Envato Market', 'kayleen' ),
            'slug'               => 'envato-market',
            'version'            => '2.0.7',
            'source'             => get_template_directory() . '/plugins/envato-market.zip',
            'required'           => false,
        ),
		array(
			'name'      => esc_html__( 'Redux Framework', 'kayleen' ),
			'slug'      => 'redux-framework',
			'required'  => true,
		),
        array(
            'name'      => esc_html__( 'CMB2', 'kayleen' ),
            'slug'      => 'cmb2',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'Elementor', 'kayleen' ),
            'slug'      => 'elementor',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'One Click Demo Import', 'kayleen' ),
            'slug'      => 'one-click-demo-import',
            'required'  => false,
        ),
		array(
            'name'      => esc_html__( 'Contact Form 7', 'kayleen' ),
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
		array(
            'name'      => esc_html__( 'Mailchimp for WordPress', 'kayleen' ),
            'slug'      => 'mailchimp-for-wp',
            'required'  => false,
        ),
        array(
            'name'      => esc_html__( 'WooCommerce', 'kayleen' ),
            'slug'      => 'woocommerce',
            'required'  => false,
        ),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'kayleen',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.


		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'kayleen' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'kayleen' ),
			/* translators: %s: plugin name. */
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'kayleen' ),
			/* translators: %s: plugin name. */
			'updating'                        => esc_html__( 'Updating Plugin: %s', 'kayleen' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'kayleen' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). */
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'kayleen'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). */
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'kayleen'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). */
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'kayleen'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). */
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'kayleen'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). */
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'kayleen'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). */
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'kayleen'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'kayleen'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'kayleen'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'kayleen'
			),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'kayleen' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'kayleen' ),
			'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'kayleen' ),
			/* translators: 1: plugin name. */
			'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'kayleen' ),
			/* translators: 1: plugin name. */
			'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'kayleen' ),
			/* translators: 1: dashboard link. */
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'kayleen' ),
			'dismiss'                         => esc_html__( 'Dismiss this notice', 'kayleen' ),
			'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'kayleen' ),
			'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'kayleen' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),

	);

	tgmpa( $plugins, $config );
}
