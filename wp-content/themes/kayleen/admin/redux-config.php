<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


// Add custom style in theme settings
function rivax_theme_settings_style () {
    wp_enqueue_style('rivax_settings_style', RIVAX_THEME_URI . '/admin/assets/css/settings.css', array(), null);
}
add_action( 'redux/page/rivax_kayleen_options/enqueue', 'rivax_theme_settings_style' );




add_action('after_setup_theme', 'rivax_redux_config' );
function rivax_redux_config() {

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    $theme = wp_get_theme(); // For use with some settings. Not necessary.
    $theme = $theme->parent() ?: $theme;

    // This is your option name where all the Redux data is stored.
    $opt_name = "rivax_kayleen_options";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * */
    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__('Theme Settings', 'kayleen'),
        'page_title'           => esc_html__('Theme Settings', 'kayleen'),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-hammer',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => 72,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'rivax-dashboard',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'rivax-settings',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'output_location'                  => array( 'frontend', 'admin' ),
        // Admin area: Enqueue dynamic CSS and Google fonts.
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    );

// Add content after the form.
    $args['footer_text'] = '<p>' . esc_html__('Designed by: ', 'kayleen') . '<a href="https://themeforest.net/user/rivaxstudio/portfolio" target="_blank">Rivax Studio</a>.</p>';

    Redux::set_args( $opt_name, $args );

    /*
 * ---> END ARGUMENTS
 */

 /*
 *
 * ---> START SECTIONS
 *
 */

    Redux::set_section( $opt_name, array(
        'title'            =>  esc_html__('General', 'kayleen'),
        'id'               => 'general_section',
        'desc'             =>  esc_html__('General settings for site', 'kayleen'),
        'icon'             => 'el el-cog',
        'fields'           => array(
            array(
                'id'       => 'site-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__('Site Logo', 'kayleen'),
                'subtitle' => esc_html__('Select your logo for the header.', 'kayleen'),
                'desc'     => '',
                'default'  => '',
            ),
            array(
                'id'       => 'site-logo-width',
                'type'     => 'slider',
                'title'    => esc_html__('Logo Width', 'kayleen'),
                'subtitle' => esc_html__('Select the logo width.', 'kayleen'),
                'desc'     => esc_html__('Default value: 200', 'kayleen'),
                'default'  => 200,
                'min'       => 100,
                'step'      => 5,
                'max'       => 300,
            ),
            array(
                'id'       => 'sticky-sidebar',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Sticky Sidebar', 'kayleen'),
                'subtitle' => esc_html__('Make sidebar sticky.', 'kayleen'),
                'desc'     => '',
                'default'  => true,
            ),

            array(
                'id'       => 'site-preloader',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Preloader', 'kayleen'),
                'subtitle' => esc_html__('Show site preloader transition before site loaded.', 'kayleen'),
                'desc'     => '',
                'default'  => true,
            ),

            array(
                'id'       => 'smooth-scroll',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Smooth Scroll', 'kayleen'),
                'subtitle' => esc_html__('Smooth scroll in website.', 'kayleen'),
                'desc'     => '',
                'default'  => true,
            ),

            array(
                'id'       => 'full-size-gif',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Full Size Gif Images', 'kayleen'),
                'subtitle' => esc_html__('Use full image size for Gif. It is useful to show gif animation in thumbnail.', 'kayleen'),
                'desc'     => '',
                'default'  => true,
            ),

        )
    ) );

    Redux::set_section( $opt_name, array(
        'title'            =>  esc_html__('Header', 'kayleen'),
        'id'               => 'header_section',
        'desc'             =>  esc_html__('General settings for header', 'kayleen'),
        'icon'             => 'el el-website',
        'fields'           => array(

            array(
                'id'       => 'site-header',
                'type'     => 'select',
                'title'    => esc_html__('Site Header Template', 'kayleen'),
                'subtitle' => esc_html__('Select header template for your site.', 'kayleen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'kayleen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

            array(
                'id'       => 'single-post-header',
                'type'     => 'select',
                'title'    => esc_html__('Single Post Header Template', 'kayleen'),
                'subtitle' => esc_html__('Select header template for the single post.', 'kayleen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('Default inherit from site header template. You can create your custom template in %1$s Rivax Templates %2$s section.', 'kayleen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

            array(
                'id'       => 'single-post-float-header',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Single Post Float Header', 'kayleen'),
                'subtitle' => esc_html__('Make header float in single post.', 'kayleen'),
                'desc'     => '',
                'default'  => false,
            ),

            array(
                'id'       => 'float-header-glass-bg-blur',
                'type'     => 'slider',
                'title'    => esc_html__('Float Header Glassmorphism', 'kayleen'),
                'subtitle' => esc_html__('Make float header glassmorphism. Set background color opacity lower than 1 for header. Currently, this feature does not work in Firefox.', 'kayleen'),
                'desc'     => '',
                'default'  => '',
                'min'       => 0,
                'step'      => 1,
                'max'       => 30,
            ),

            array(
                'id'       => 'sticky-header-status',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Sticky Header', 'kayleen'),
                'subtitle' => esc_html__('Enable sticky header for your site.', 'kayleen'),
                'desc'     => '',
                'default'  => false,
            ),

            array(
                'id'       => 'site-sticky-header',
                'type'     => 'select',
                'required' => array( 'sticky-header-status', '=', '1' ),
                'title'    => esc_html__('Site Sticky Header', 'kayleen'),
                'subtitle' => esc_html__('Select sticky header for the site.', 'kayleen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'kayleen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

            array(
                'id'       => 'sticky-header-glass-bg-blur',
                'type'     => 'slider',
                'required' => array( 'sticky-header-status', '=', '1' ),
                'title'    => esc_html__('Sticky Header Glassmorphism', 'kayleen'),
                'subtitle' => esc_html__('Make sticky header glassmorphism. Set background color opacity lower than 1 for sticky header. Currently, this feature does not work in Firefox.', 'kayleen'),
                'desc'     => '',
                'default'  => '',
                'min'       => 0,
                'step'      => 1,
                'max'       => 30,
            ),

        )
    ) );

    Redux::set_section( $opt_name, array(
        'title'            =>  esc_html__('Footer', 'kayleen'),
        'id'               => 'footer_section',
        'desc'             =>  esc_html__('General settings for footer', 'kayleen'),
        'icon'             => 'el el-credit-card',
        'fields'           => array(
            array(
                'id'       => 'site-footer',
                'type'     => 'select',
                'title'    => esc_html__('Site Footer', 'kayleen'),
                'subtitle' => esc_html__('Select footer for the site.', 'kayleen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'kayleen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),
            array(
                'id'       => 'back-to-top',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Back to Top Button', 'kayleen'),
                'subtitle' => esc_html__('Enable or disable back to top button.', 'kayleen'),
                'desc'     => '',
                'default'  => false,
            ),

            array(
                'id'       => 'back-to-top-bg',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Back to Top Button Background', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),

            array(
                'id'       => 'footer-canvas-menu-bg',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Footer Canvas Menu Background', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'footer-canvas-menu-color',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Footer Canvas Menu Link Color', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'footer-canvas-menu-color-hover',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Footer Canvas Menu Link Hover Color', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
        )
    ) );


    Redux::set_section( $opt_name, array(
        'title'            =>  esc_html__('Sidebar', 'kayleen'),
        'id'               => 'sidebar_section',
        'desc'             =>  esc_html__('General settings for sidebar', 'kayleen'),
        'icon'             => 'el el-align-left',
        'fields'           => array(
            array(
                'id'       => 'subtitle-756694',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Single Page Sidebar', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-page-sidebar-position',
                'type'     => 'select',
                'title'    => esc_html__('Single Page Sidebar Position', 'kayleen'),
                'subtitle' => esc_html__('Select sidebar position for pages.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'left' => esc_html__('Left', 'kayleen'),
                    'right' => esc_html__('Right', 'kayleen'),
                    'none' => esc_html__('No Sidebar', 'kayleen'),
                    'none-narrow' => esc_html__('No Sidebar + Narrow Content', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'none',
            ),
            array(
                'id'       => 'single-page-sidebar-template',
                'type'     => 'select',
                'title'    => esc_html__('Single Page Sidebar Template', 'kayleen'),
                'subtitle' => esc_html__('Select template for this sidebar.', 'kayleen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'kayleen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

            array(
                'id'       => 'subtitle-355494',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Single Post Sidebar', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-post-sidebar-position',
                'type'     => 'select',
                'title'    => esc_html__('Single Post Sidebar Position', 'kayleen'),
                'subtitle' => esc_html__('Select sidebar position for single post.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'left' => esc_html__('Left', 'kayleen'),
                    'right' => esc_html__('Right', 'kayleen'),
                    'none' => esc_html__('No Sidebar', 'kayleen'),
                    'none-narrow' => esc_html__('No Sidebar + Narrow Content', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'none',
            ),
            array(
                'id'       => 'single-post-sidebar-template',
                'type'     => 'select',
                'title'    => esc_html__('Single Post Sidebar Template', 'kayleen'),
                'subtitle' => esc_html__('Select template for this sidebar.', 'kayleen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'kayleen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

            array(
                'id'       => 'subtitle-755494',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Blog Sidebar', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'blog-sidebar-position',
                'type'     => 'select',
                'title'    => esc_html__('Blog Sidebar Position', 'kayleen'),
                'subtitle' => esc_html__('Select sidebar position for blog archive.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'left' => esc_html__('Left', 'kayleen'),
                    'right' => esc_html__('Right', 'kayleen'),
                    'none' => esc_html__('No Sidebar', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'none',
            ),
            array(
                'id'       => 'blog-sidebar-template',
                'type'     => 'select',
                'title'    => esc_html__('Blog Sidebar Template', 'kayleen'),
                'subtitle' => esc_html__('Select template for this sidebar.', 'kayleen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'kayleen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

            array(
                'id'       => 'subtitle-756794',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Woocommerce Sidebar', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'woocommerce-shop-sidebar-position',
                'type'     => 'select',
                'title'    => esc_html__('Woocommerce Shop Sidebar Position', 'kayleen'),
                'subtitle' => esc_html__('Select sidebar position for woocommerce shop.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'left' => esc_html__('Left', 'kayleen'),
                    'right' => esc_html__('Right', 'kayleen'),
                    'none' => esc_html__('No Sidebar', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'none',
            ),
            array(
                'id'       => 'woocommerce-archive-sidebar-position',
                'type'     => 'select',
                'title'    => esc_html__('Woocommerce Archive Sidebar Position', 'kayleen'),
                'subtitle' => esc_html__('Select sidebar position for woocommerce archive.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'left' => esc_html__('Left', 'kayleen'),
                    'right' => esc_html__('Right', 'kayleen'),
                    'none' => esc_html__('No Sidebar', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'none',
            ),
            array(
                'id'       => 'woocommerce-sidebar-template',
                'type'     => 'select',
                'title'    => esc_html__('Woocommerce Sidebar Template', 'kayleen'),
                'subtitle' => esc_html__('Select template for this sidebar.', 'kayleen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'kayleen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

        )
    ) );



    Redux::set_section( $opt_name, array(
        'title'            =>  esc_html__('Styling', 'kayleen'),
        'id'               => 'styling_section',
        'desc'             =>  esc_html__('Styling settings', 'kayleen'),
        'icon'             => 'el el-brush',
        'fields'           => array(
            array(
                'id'       => 'accent-color',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Accent Color', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'accent-color-alt',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Accent Color Alternative', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'second-color',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Second Color', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'second-color-alt',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Second Color Alternative', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'body-bg',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Body Background Color', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'body-color',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Body Text Color', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'link-color',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Links Color', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'link-color-hover',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Links Hover Color', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'heading-color',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Headings Color', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'single-progress-bar-color',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Single Post Progress Bar Color', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),

            array(
                'id'       => 'single-category-bg',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Single Post Category Background', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),

            array(
                'id'       => 'single-category-bg-hover',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Single Post Category Background Hover', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),



        )
    ) );


    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Typography', 'kayleen'),
        'id'               => 'typography',
        'desc'             => esc_html__('Typography settings', 'kayleen'),
        'subsection'       => false,
        'icon'             => 'el el-fontsize',
        'fields'           => array(
            array(
                'id'       => 'typography-body',
                'type'     => 'typography',
                'google'      => true,
                'color'      => false,
                'text-align'      => false,
                'subsets'      => false,
                'line-height'      => false,
                'units'       =>'px',
                'title'    => esc_html__('Body Typography', 'kayleen'),
            ),
            array(
                'id'       => 'typography-heading',
                'type'     => 'typography',
                'google'      => true,
                'color'      => false,
                'text-align'      => false,
                'subsets'      => false,
                'line-height'      => false,
                'font-size'      => false,
                'units'       =>'px',
                'title'    => esc_html__('Headings Typography', 'kayleen'),
            ),
            array(
                'id'       => 'title-font-size-9856',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h2>' . esc_html__('Font Size', 'kayleen') . '</h2>',
            ),
            array(
                'id'       => 'h1-font-size',
                'type'     => 'text',
                'title'    => esc_html__('H1 Font Size', 'kayleen'),
                'subtitle' => esc_html__('Enter H1 font size. Example: 28px or 1.8rem', 'kayleen'),
            ),
            array(
                'id'       => 'h2-font-size',
                'type'     => 'text',
                'title'    => esc_html__('H2 Font Size', 'kayleen'),
                'subtitle' => esc_html__('Enter H2 font size. Example: 28px or 1.8rem', 'kayleen'),
            ),
            array(
                'id'       => 'h3-font-size',
                'type'     => 'text',
                'title'    => esc_html__('H3 Font Size', 'kayleen'),
                'subtitle' => esc_html__('Enter H3 font size. Example: 28px or 1.8rem', 'kayleen'),
            ),
            array(
                'id'       => 'h4-font-size',
                'type'     => 'text',
                'title'    => esc_html__('H4 Font Size', 'kayleen'),
                'subtitle' => esc_html__('Enter H4 font size. Example: 28px or 1.8rem', 'kayleen'),
            ),
            array(
                'id'       => 'h5-font-size',
                'type'     => 'text',
                'title'    => esc_html__('H5 Font Size', 'kayleen'),
                'subtitle' => esc_html__('Enter H5 font size. Example: 28px or 1.8rem', 'kayleen'),
            ),
            array(
                'id'       => 'h6-font-size',
                'type'     => 'text',
                'title'    => esc_html__('H6 Font Size', 'kayleen'),
                'subtitle' => esc_html__('Enter H6 font size. Example: 28px or 1.8rem', 'kayleen'),
            ),
            array(
                'id'       => 'single-post-title-font-size',
                'type'     => 'text',
                'title'    => esc_html__('Single Post Title Font Size', 'kayleen'),
                'subtitle' => esc_html__('Enter font size. Example: 28px or 1.8rem', 'kayleen'),
            ),

            array(
                'id'       => 'title-font-size-984556',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h2>' . esc_html__('Font Size In Responsive', 'kayleen') . '</h2>',
            ),
            array(
                'id'       => 'h1-font-size-responsive',
                'type'     => 'text',
                'title'    => esc_html__('H1 Font Size In Mobile And Tablet', 'kayleen'),
                'subtitle' => esc_html__('Enter H1 font size. Example: 28px or 1.8rem', 'kayleen'),
            ),
            array(
                'id'       => 'h2-font-size-responsive',
                'type'     => 'text',
                'title'    => esc_html__('H2 Font Size In Mobile And Tablet', 'kayleen'),
                'subtitle' => esc_html__('Enter H2 font size. Example: 28px or 1.8rem', 'kayleen'),
            ),
            array(
                'id'       => 'h3-font-size-responsive',
                'type'     => 'text',
                'title'    => esc_html__('H3 Font Size In Mobile And Tablet', 'kayleen'),
                'subtitle' => esc_html__('Enter H3 font size. Example: 28px or 1.8rem', 'kayleen'),
            ),
            array(
                'id'       => 'h4-font-size-responsive',
                'type'     => 'text',
                'title'    => esc_html__('H4 Font Size In Mobile And Tablet', 'kayleen'),
                'subtitle' => esc_html__('Enter H4 font size. Example: 28px or 1.8rem', 'kayleen'),
            ),
            array(
                'id'       => 'h5-font-size-responsive',
                'type'     => 'text',
                'title'    => esc_html__('H5 Font Size In Mobile And Tablet', 'kayleen'),
                'subtitle' => esc_html__('Enter H5 font size. Example: 28px or 1.8rem', 'kayleen'),
            ),
            array(
                'id'       => 'h6-font-size-responsive',
                'type'     => 'text',
                'title'    => esc_html__('H6 Font Size In Mobile And Tablet', 'kayleen'),
                'subtitle' => esc_html__('Enter H6 font size. Example: 28px or 1.8rem', 'kayleen'),
            ),
            array(
                'id'       => 'single-post-title-font-size-responsive',
                'type'     => 'text',
                'title'    => esc_html__('Single Post Title Font Size In Mobile And Tablet', 'kayleen'),
                'subtitle' => esc_html__('Enter font size. Example: 28px or 1.8rem', 'kayleen'),
            ),

        )
    ) );


    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Single Post', 'kayleen'),
        'id'               => 'single_post_section',
        'desc'             => esc_html__('Single Post settings', 'kayleen'),
        'subsection'       => false,
        'icon'             => 'el el-pencil',
    ) );


    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('General', 'kayleen'),
        'id'               => 'single_post_general',
        'desc'             => esc_html__('Single Post general settings', 'kayleen'),
        'subsection'       => true,
        'icon'             => 'el el-cog',
        'fields'           => array(

            array(
                'id'       => 'single-post-top-content-template',
                'type'     => 'select',
                'title'    => esc_html__('Top Content', 'kayleen'),
                'subtitle' => esc_html__('Select template to show in top of the post.', 'kayleen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'kayleen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),
            array(
                'id'       => 'single-post-bottom-content-template',
                'type'     => 'select',
                'title'    => esc_html__('Bottom Content', 'kayleen'),
                'subtitle' => esc_html__('Select template to show in bottom of the post.', 'kayleen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'kayleen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),
            array(
                'id'       => 'single-category-multi-bg',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Category Multi Background', 'kayleen'),
                'subtitle' => esc_html__('Edit category and set its color.', 'kayleen'),
                'desc'     => '',
                'default'  => true,
            ),
            array(
                'id'       => 'post-reading-progress-indicator',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Reading Progress Indicator', 'kayleen'),
                'subtitle' => esc_html__('Show reading progress indicator in post.', 'kayleen'),
                'desc'     => '',
                'default'  => true,
            ),
            array(
                'id'       => 'comments-list-collapsable',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Comments List Collapsable', 'kayleen'),
                'subtitle' => esc_html__('Makes comments list collapsable with show/hide button.', 'kayleen'),
                'desc'     => '',
                'default'  => true,
            ),
            array(
                'id'       => 'single-post-share-box',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Show Share Box', 'kayleen'),
                'subtitle' => esc_html__('Show share box in the single post.', 'kayleen'),
                'desc'     => '',
                'default'  => true,
            ),
            array(
                'id'       => 'single-post-share-box-options',
                'type'     => 'checkbox',
                'required' => array( 'single-post-share-box', '=', '1' ),
                'title'    => esc_html__('Share Box Options', 'kayleen'),
                'subtitle' => esc_html__('Select share box options.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'facebook' => esc_html__('Facebook', 'kayleen'),
                    'twitter' => esc_html__('Twitter', 'kayleen'),
                    'linkedin' => esc_html__('Linkedin', 'kayleen'),
                    'pinterest' => esc_html__('Pinterest', 'kayleen'),
                    'telegram' => esc_html__('Telegram', 'kayleen'),
                    'email' => esc_html__('Email', 'kayleen'),
                    'whatsapp' => esc_html__('WhatsApp', 'kayleen'),
                    'link' => esc_html__('Link Box', 'kayleen'),
                ),
                'default' => array(
                    'facebook' => '1',
                    'twitter' => '1',
                    'linkedin' => '0',
                    'pinterest' => '1',
                    'telegram' => '0',
                    'email' => '1',
                    'whatsapp' => '1',
                    'link' => '1',
                )
            ),
            array(
                'id'       => 'single-post-author-box',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Show Author Box', 'kayleen'),
                'subtitle' => esc_html__('Show author box in the single post.', 'kayleen'),
                'desc'     => '',
                'default'  => true,
            ),
            array(
                'id'       => 'single-post-next-prev-posts',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Show Next And Previews Posts', 'kayleen'),
                'subtitle' => esc_html__('Show next and previews posts in the single post.', 'kayleen'),
                'desc'     => '',
                'default'  => true,
            ),
            array(
                'id'       => 'single-next-prev-posts-title',
                'type'     => 'text',
                'required' => array( 'single-post-next-prev-posts', '=', '1' ),
                'title'    => esc_html__('Next And Previews Posts Title', 'kayleen'),
                'subtitle' => esc_html__('Enter your title for the next and previews posts.', 'kayleen'),
                'desc'     => esc_html__('Default value: Other Articles', 'kayleen'),
                'default'  => esc_html__('Other Articles', 'kayleen'),
            ),
            array(
                'id'       => 'single-post-fixed-next-prev-posts',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Show Fixed Next And Previews Posts', 'kayleen'),
                'subtitle' => esc_html__('Show fixed next and previews posts in the single post.', 'kayleen'),
                'desc'     => '',
                'default'  => true,
            ),
            array(
                'id'       => 'reading-time-words-per-minute',
                'type'     => 'slider',
                'title'    => esc_html__('Reading Time Words Per Minute', 'kayleen'),
                'subtitle' => esc_html__('How many words user can read per minute?', 'kayleen'),
                'desc'     => esc_html__('Default value: 255', 'kayleen'),
                'default'  => 255,
                'min'       => 100,
                'step'      => 10,
                'max'       => 500,
            ),


        )
    ) );


    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Hero Layout', 'kayleen'),
        'id'               => 'single_post_layout',
        'desc'             => esc_html__('Single post hero layout settings', 'kayleen'),
        'subsection'       => true,
        'icon'             => 'el el-picture',
        'fields'           => array(
            array(
                'id'       => 'single-default-post-meta',
                'type'     => 'checkbox',
                'title'    => esc_html__('Default Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select default meta for single post.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),

            array(
                'id'       => 'title-8145',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h2>' . esc_html__('Standard Post Format', 'kayleen') . '</h2>',
            ),
            array(
                'id'       => 'single-format-standard-layout',
                'type'     => 'select',
                'title'    => esc_html__('Standard Post Layout', 'kayleen'),
                'subtitle' => esc_html__('Select default layout for standard posts. You can customize settings for each layout below.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    '1' => esc_html__('Layout 1', 'kayleen'),
                    '2' => esc_html__('Layout 2', 'kayleen'),
                    '3' => esc_html__('Layout 3', 'kayleen'),
                    '4' => esc_html__('Layout 4', 'kayleen'),
                    '5' => esc_html__('Layout 5', 'kayleen'),
                    '6' => esc_html__('Layout 6', 'kayleen'),
                    '7' => esc_html__('Layout 7', 'kayleen'),
                    '8' => esc_html__('Layout 8', 'kayleen'),
                    '9' => esc_html__('Layout 9', 'kayleen'),
                    '10' => esc_html__('Layout 10', 'kayleen'),
                    '11' => esc_html__('Layout 11', 'kayleen'),
                    '12' => esc_html__('Layout 12', 'kayleen'),
                    '13' => esc_html__('Layout 13', 'kayleen'),
                    '14' => esc_html__('Layout 14', 'kayleen'),
                    '15' => esc_html__('Layout 15', 'kayleen'),
                    '16' => esc_html__('Layout 16', 'kayleen'),
                    '17' => esc_html__('Layout 17', 'kayleen'),
                    '18' => esc_html__('Layout 18', 'kayleen'),
                    '19' => esc_html__('Layout 19', 'kayleen'),
                    '20' => esc_html__('Layout 20', 'kayleen'),
                    '21' => esc_html__('Layout 21', 'kayleen'),
                    '22' => esc_html__('Layout 22', 'kayleen'),
                    '23' => esc_html__('Layout 23', 'kayleen'),
                    '24' => esc_html__('Layout 24', 'kayleen'),
                    '25' => esc_html__('Layout 25', 'kayleen'),
                    '26' => esc_html__('Layout 26', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => '1',
            ),
            array(
                'id'       => 'subtitle-56784',
                'required' => array( 'single-format-standard-layout', '=', '1' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 1 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-1-img-position',
                'type'     => 'select',
                'required' => array( 'single-format-standard-layout', '=', '1' ),
                'title'    => esc_html__('Image Position', 'kayleen'),
                'subtitle' => esc_html__('Select image position.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'before' => esc_html__('Before Meta', 'kayleen'),
                    'after' => esc_html__('After Meta', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'before',
            ),
            array(
                'id'       => 'single-format-standard-layout-1-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '1' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-1-full-img',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '1' ),
                'title'    => esc_html__('Full Image Size', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),
            array(
                'id'       => 'single-format-standard-layout-1-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '1' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-1-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '1' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),

            array(
                'id'       => 'subtitle-83494',
                'required' => array( 'single-format-standard-layout', '=', '2' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 2 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-2-img-position',
                'type'     => 'select',
                'required' => array( 'single-format-standard-layout', '=', '2' ),
                'title'    => esc_html__('Image Position', 'kayleen'),
                'subtitle' => esc_html__('Select image position.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'before' => esc_html__('Before Meta', 'kayleen'),
                    'after' => esc_html__('After Meta', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'before',
            ),
            array(
                'id'       => 'single-format-standard-layout-2-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '2' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-2-full-img',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '2' ),
                'title'    => esc_html__('Full Image Size', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),
            array(
                'id'       => 'single-format-standard-layout-2-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '2' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-2-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '2' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),


            array(
                'id'       => 'subtitle-55494',
                'required' => array( 'single-format-standard-layout', '=', '3' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 3 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-3-img-position',
                'type'     => 'select',
                'required' => array( 'single-format-standard-layout', '=', '3' ),
                'title'    => esc_html__('Image Position', 'kayleen'),
                'subtitle' => esc_html__('Select image position.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'before' => esc_html__('Before Meta', 'kayleen'),
                    'after' => esc_html__('After Meta', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'before',
            ),
            array(
                'id'       => 'single-format-standard-layout-3-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '3' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-3-full-img',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '3' ),
                'title'    => esc_html__('Full Image Size', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),
            array(
                'id'       => 'single-format-standard-layout-3-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '3' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-3-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '3' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),


            array(
                'id'       => 'subtitle-55474',
                'required' => array( 'single-format-standard-layout', '=', '4' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 4 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-4-img-position',
                'type'     => 'select',
                'required' => array( 'single-format-standard-layout', '=', '4' ),
                'title'    => esc_html__('Image Position', 'kayleen'),
                'subtitle' => esc_html__('Select image position.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'before' => esc_html__('Before Meta', 'kayleen'),
                    'after' => esc_html__('After Meta', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'before',
            ),
            array(
                'id'       => 'single-format-standard-layout-4-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '4' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-4-full-img',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '4' ),
                'title'    => esc_html__('Full Image Size', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),
            array(
                'id'       => 'single-format-standard-layout-4-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '4' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-4-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '4' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),


            array(
                'id'       => 'subtitle-11474',
                'required' => array( 'single-format-standard-layout', '=', '5' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 5 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-5-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '5' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-5-full-img',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '5' ),
                'title'    => esc_html__('Full Image Size', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),
            array(
                'id'       => 'single-format-standard-layout-5-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '5' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-5-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '5' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),


            array(
                'id'       => 'subtitle-74374',
                'required' => array( 'single-format-standard-layout', '=', '6' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 6 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-6-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '6' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-6-bg',
                'type'     => 'color',
                'required' => array( 'single-format-standard-layout', '=', '6' ),
                'transparent'     => false,
                'title'    => esc_html__('Background Color', 'kayleen'),
                'subtitle' => esc_html__('Choose background color.', 'kayleen'),
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'single-format-standard-layout-6-full-img',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '6' ),
                'title'    => esc_html__('Full Image Size', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),
            array(
                'id'       => 'single-format-standard-layout-6-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '6' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-6-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '6' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),


            array(
                'id'       => 'subtitle-99774',
                'required' => array( 'single-format-standard-layout', '=', '7' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 7 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-7-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '7' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-7-bg',
                'type'     => 'color',
                'required' => array( 'single-format-standard-layout', '=', '7' ),
                'transparent'     => false,
                'title'    => esc_html__('Background Color', 'kayleen'),
                'subtitle' => esc_html__('Choose background color.', 'kayleen'),
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'single-format-standard-layout-7-full-img',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '7' ),
                'title'    => esc_html__('Full Image Size', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),
            array(
                'id'       => 'single-format-standard-layout-7-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '7' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-7-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '7' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),


            array(
                'id'       => 'subtitle-69856',
                'required' => array( 'single-format-standard-layout', '=', '8' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 8 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-8-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '8' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-8-full-img',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '8' ),
                'title'    => esc_html__('Full Image Size', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),
            array(
                'id'       => 'single-format-standard-layout-8-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '8' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-8-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '8' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),


            array(
                'id'       => 'subtitle-65886',
                'required' => array( 'single-format-standard-layout', '=', '9' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 9 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-9-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '9' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-9-full-img',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '9' ),
                'title'    => esc_html__('Full Image Size', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),
            array(
                'id'       => 'single-format-standard-layout-9-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '9' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-9-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '9' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),


            array(
                'id'       => 'subtitle-61886',
                'required' => array( 'single-format-standard-layout', '=', '10' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 10 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-10-img-position',
                'type'     => 'select',
                'required' => array( 'single-format-standard-layout', '=', '10' ),
                'title'    => esc_html__('Image Position', 'kayleen'),
                'subtitle' => esc_html__('Select image position.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'before' => esc_html__('Before Meta', 'kayleen'),
                    'after' => esc_html__('After Meta', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'before',
            ),
            array(
                'id'       => 'single-format-standard-layout-10-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '10' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-10-full-img',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '10' ),
                'title'    => esc_html__('Full Image Size', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),


            array(
                'id'       => 'subtitle-61855',
                'required' => array( 'single-format-standard-layout', '=', '11' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 11 (No Image) Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-11-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '11' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),


            array(
                'id'       => 'subtitle-55655',
                'required' => array( 'single-format-standard-layout', '=', '12' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 12 (No Image) Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-12-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '12' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),


            array(
                'id'       => 'subtitle-67786',
                'required' => array( 'single-format-standard-layout', '=', '13' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 13 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-13-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '13' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-13-bg',
                'type'     => 'color',
                'required' => array( 'single-format-standard-layout', '=', '13' ),
                'transparent'     => false,
                'title'    => esc_html__('Background Color', 'kayleen'),
                'subtitle' => esc_html__('Choose background color.', 'kayleen'),
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'single-format-standard-layout-13-color',
                'type'     => 'color',
                'required' => array( 'single-format-standard-layout', '=', '13' ),
                'transparent'     => false,
                'title'    => esc_html__('Text Color', 'kayleen'),
                'subtitle' => esc_html__('Choose text color.', 'kayleen'),
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'single-format-standard-layout-13-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '13' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-13-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '13' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),


            array(
                'id'       => 'subtitle-60086',
                'required' => array( 'single-format-standard-layout', '=', '14' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 14 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-14-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '14' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),


            array(
                'id'       => 'subtitle-65586',
                'required' => array( 'single-format-standard-layout', '=', '15' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 15 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-15-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '15' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-15-bg',
                'type'     => 'color',
                'transparent'     => false,
                'required' => array( 'single-format-standard-layout', '=', '15' ),
                'title'    => esc_html__('Background Color', 'kayleen'),
                'subtitle' => esc_html__('Choose background color.', 'kayleen'),
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),


            array(
                'id'       => 'subtitle-65500',
                'required' => array( 'single-format-standard-layout', '=', '16' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 16 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-16-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '16' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-16-bg',
                'type'     => 'color',
                'transparent'     => false,
                'required' => array( 'single-format-standard-layout', '=', '16' ),
                'title'    => esc_html__('Background Color', 'kayleen'),
                'subtitle' => esc_html__('Choose background color.', 'kayleen'),
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'single-format-standard-layout-16-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '16' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-16-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '16' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),


            array(
                'id'       => 'subtitle-18500',
                'required' => array( 'single-format-standard-layout', '=', '17' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 17 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-17-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '17' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),


            array(
                'id'       => 'subtitle-66890',
                'required' => array( 'single-format-standard-layout', '=', '18' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 18 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-18-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '18' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-18-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '18' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-18-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '18' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),


            array(
                'id'       => 'subtitle-61210',
                'required' => array( 'single-format-standard-layout', '=', '19' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 19 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-19-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '19' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-19-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '19' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-19-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '19' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),


            array(
                'id'       => 'subtitle-62010',
                'required' => array( 'single-format-standard-layout', '=', '20' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 20 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-20-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '20' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-20-title-bg',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '20' ),
                'title'    => esc_html__('Title Background', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),


            array(
                'id'       => 'subtitle-62110',
                'required' => array( 'single-format-standard-layout', '=', '21' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 21 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-21-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '21' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-21-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '21' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-21-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '21' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-21-title-bg',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '21' ),
                'title'    => esc_html__('Title Background', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),


            array(
                'id'       => 'subtitle-62210',
                'required' => array( 'single-format-standard-layout', '=', '22' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 22 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-22-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '22' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-22-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '22' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-22-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '22' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-22-title-bg',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '22' ),
                'title'    => esc_html__('Title Background', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),


            array(
                'id'       => 'subtitle-25310',
                'required' => array( 'single-format-standard-layout', '=', '23' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 23 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-23-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '23' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-23-title-bg',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '23' ),
                'title'    => esc_html__('Title Background', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),
            array(
                'id'       => 'single-format-standard-layout-23-title-center',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '23' ),
                'title'    => esc_html__('Title Center', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),


            array(
                'id'       => 'subtitle-62419',
                'required' => array( 'single-format-standard-layout', '=', '24' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 24 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-24-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '24' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-24-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '24' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-24-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '24' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-24-title-bg',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '24' ),
                'title'    => esc_html__('Title Background', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),
            array(
                'id'       => 'single-format-standard-layout-24-title-center',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '24' ),
                'title'    => esc_html__('Title Center', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),


            array(
                'id'       => 'subtitle-62544',
                'required' => array( 'single-format-standard-layout', '=', '25' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 25 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-25-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '25' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-25-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '25' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-25-shadow',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '25' ),
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-standard-layout-25-title-bg',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '25' ),
                'title'    => esc_html__('Title Background', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),
            array(
                'id'       => 'single-format-standard-layout-25-title-center',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '25' ),
                'title'    => esc_html__('Title Center', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),


            array(
                'id'       => 'subtitle-26774',
                'required' => array( 'single-format-standard-layout', '=', '26' ),
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Layout 26 Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'single-format-standard-layout-26-meta',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '26' ),
                'title'    => esc_html__('Post Meta', 'kayleen'),
                'subtitle' => esc_html__('Select post meta for this layout.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'author-name' => esc_html__('Author Name', 'kayleen'),
                    'author-avatar' => esc_html__('Author Avatar', 'kayleen'),
                    'date' => esc_html__('Date', 'kayleen'),
                    'category' => esc_html__('Category', 'kayleen'),
                    'comments' => esc_html__('Comments', 'kayleen'),
                    'views' => esc_html__('Views', 'kayleen'),
                    'reading-time' => esc_html__('Reading Time', 'kayleen'),
                    'excerpt' => esc_html__('Excerpt', 'kayleen'),
                ),
                'default' => array(
                    'author-name' => '1',
                    'author-avatar' => '1',
                    'date' => '1',
                    'category' => '1',
                    'comments' => '1',
                    'views' => '1',
                    'reading-time' => '1',
                    'excerpt' => '0',
                )
            ),
            array(
                'id'       => 'single-format-standard-layout-26-bg',
                'type'     => 'color',
                'required' => array( 'single-format-standard-layout', '=', '26' ),
                'transparent'     => false,
                'title'    => esc_html__('Background Color', 'kayleen'),
                'subtitle' => esc_html__('Choose background color.', 'kayleen'),
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'single-format-standard-layout-26-radius',
                'type'     => 'checkbox',
                'required' => array( 'single-format-standard-layout', '=', '26' ),
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),





            array(
                'id'       => 'title-8545',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h2>' . esc_html__('Gallery Post Format', 'kayleen') . '</h2>',
            ),
            array(
                'id'       => 'single-format-gallery-position',
                'type'     => 'select',
                'title'    => esc_html__('Gallery Position', 'kayleen'),
                'subtitle' => esc_html__('Select gallery position.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'inside' => esc_html__('Inside content', 'kayleen'),
                    'outside' => esc_html__('Outside Content', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'inside',
            ),
            array(
                'id'       => 'single-format-gallery-position-to-meta',
                'type'     => 'select',
                'title'    => esc_html__('Gallery Position To Meta', 'kayleen'),
                'subtitle' => esc_html__('Select gallery position.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'before' => esc_html__('Before Meta', 'kayleen'),
                    'after' => esc_html__('After Meta', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'before',
            ),
            array(
                'id'       => 'single-format-gallery-radius',
                'type'     => 'checkbox',
                'title'    => esc_html__('Image Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),
            array(
                'id'       => 'single-format-gallery-shadow',
                'type'     => 'checkbox',
                'title'    => esc_html__('Image Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),

            array(
                'id'       => 'title-2475',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h2>' . esc_html__('Quote Post Format', 'kayleen') . '</h2>',
            ),
            array(
                'id'       => 'single-format-quote-position',
                'type'     => 'select',
                'title'    => esc_html__('Quote Position', 'kayleen'),
                'subtitle' => esc_html__('Select quote position.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'inside' => esc_html__('Inside content', 'kayleen'),
                    'outside' => esc_html__('Outside Content', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'inside',
            ),
            array(
                'id'       => 'single-format-quote-position-to-meta',
                'type'     => 'select',
                'title'    => esc_html__('Quote Position To Meta', 'kayleen'),
                'subtitle' => esc_html__('Select quote position.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'before' => esc_html__('Before Meta', 'kayleen'),
                    'after' => esc_html__('After Meta', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'before',
            ),
            array(
                'id'       => 'single-format-quote-style',
                'type'     => 'select',
                'title'    => esc_html__('Quote Style', 'kayleen'),
                'subtitle' => esc_html__('Select quote style.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    '1' => esc_html__('Style 1', 'kayleen'),
                    '2' => esc_html__('Style 2', 'kayleen'),
                    '3' => esc_html__('Style 3', 'kayleen'),
                    '4' => esc_html__('Style 4', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => '1',
            ),
            array(
                'id'       => 'single-format-quote-radius',
                'type'     => 'checkbox',
                'title'    => esc_html__('Quote Box Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-quote-shadow',
                'type'     => 'checkbox',
                'title'    => esc_html__('Quote Box Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-quote-bg',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Quote Box Background', 'kayleen'),
                'subtitle' => esc_html__('Choose background color.', 'kayleen'),
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'single-format-quote-color',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Quote Box Text Color', 'kayleen'),
                'subtitle' => esc_html__('Choose text color.', 'kayleen'),
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),

            array(
                'id'       => 'title-8569',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h2>' . esc_html__('Link Post Format', 'kayleen') . '</h2>',
            ),
            array(
                'id'       => 'single-format-link-position',
                'type'     => 'select',
                'title'    => esc_html__('Link Position', 'kayleen'),
                'subtitle' => esc_html__('Select link position.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'inside' => esc_html__('Inside content', 'kayleen'),
                    'outside' => esc_html__('Outside Content', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'inside',
            ),
            array(
                'id'       => 'single-format-link-position-to-meta',
                'type'     => 'select',
                'title'    => esc_html__('Link Position To Meta', 'kayleen'),
                'subtitle' => esc_html__('Select link position.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'before' => esc_html__('Before Meta', 'kayleen'),
                    'after' => esc_html__('After Meta', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'before',
            ),
            array(
                'id'       => 'single-format-link-radius',
                'type'     => 'checkbox',
                'title'    => esc_html__('Link Box Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-link-shadow',
                'type'     => 'checkbox',
                'title'    => esc_html__('Link Box Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'single-format-link-bg',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Link Box Background', 'kayleen'),
                'subtitle' => esc_html__('Choose background color.', 'kayleen'),
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'single-format-link-color',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Link Box Text Color', 'kayleen'),
                'subtitle' => esc_html__('Choose text color.', 'kayleen'),
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),

            array(
                'id'       => 'title-2275',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h2>' . esc_html__('Video Post Format', 'kayleen') . '</h2>',
            ),
            array(
                'id'       => 'single-format-video-position',
                'type'     => 'select',
                'title'    => esc_html__('Video Position', 'kayleen'),
                'subtitle' => esc_html__('Select video position.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'inside' => esc_html__('Inside content', 'kayleen'),
                    'outside' => esc_html__('Outside Content', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'inside',
            ),
            array(
                'id'       => 'single-format-video-position-to-meta',
                'type'     => 'select',
                'title'    => esc_html__('Video Position To Meta', 'kayleen'),
                'subtitle' => esc_html__('Select video position.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'before' => esc_html__('Before Meta', 'kayleen'),
                    'after' => esc_html__('After Meta', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'before',
            ),

            array(
                'id'       => 'title-8967',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h2>' . esc_html__('Audio Post Format', 'kayleen') . '</h2>',
            ),
            array(
                'id'       => 'single-format-audio-position',
                'type'     => 'select',
                'title'    => esc_html__('Audio Position', 'kayleen'),
                'subtitle' => esc_html__('Select audio position.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'inside' => esc_html__('Inside content', 'kayleen'),
                    'outside' => esc_html__('Outside Content', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'inside',
            ),
            array(
                'id'       => 'single-format-audio-position-to-meta',
                'type'     => 'select',
                'title'    => esc_html__('Audio Position To Meta', 'kayleen'),
                'subtitle' => esc_html__('Select audio position.', 'kayleen'),
                'desc'     => '',
                'options'  => array(
                    'before' => esc_html__('Before Meta', 'kayleen'),
                    'after' => esc_html__('After Meta', 'kayleen'),
                ),
                'select2'  => array( 'allowClear' => false ),
                'default'  => 'before',
            ),




        )
    ) );


    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Blog Archive', 'kayleen'),
        'id'               => 'blog_section',
        'desc'             => esc_html__('Blog settings', 'kayleen'),
        'subsection'       => false,
        'icon'             => 'el el-th-list',
        'fields'           => array(
            array(
                'id'       => 'archive-template',
                'type'     => 'select',
                'title'    => esc_html__('Blog Archive Template', 'kayleen'),
                'subtitle' => esc_html__('Select template for blog archive.', 'kayleen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'kayleen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),
			
			array(
		        'id'       => 'subtitle-6340587',
		        'type'     => 'raw',
		        'full_width'     => true,
		        'content'     => '<h4>' . esc_html__('Search Settings', 'kayleen') . '</h4>',
	        ),
	        array(
		        'id'       => 'search-post-types',
		        'type'     => 'select',
		        'multi'    => true,
		        'title'    => esc_html__('Search Post Types', 'kayleen'),
		        'subtitle' => esc_html__('Limit search for custom post types.', 'kayleen'),
		        'data'  => 'post_types',
		        'desc'     => esc_html__('WordPress search in all post types by default.', 'kayleen'),
				'args'  => array(
						'exclude_from_search'      => false,
					),
	        ),

            array(
                'id'       => 'subtitle-60587',
                'type'     => 'raw',
                'full_width'     => true,
                'content'     => '<h4>' . esc_html__('Archive Title Settings', 'kayleen') . '</h4>',
            ),
            array(
                'id'       => 'blog-archive-title-radius',
                'type'     => 'checkbox',
                'title'    => esc_html__('Archive Title Section Radius', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '1'
            ),
            array(
                'id'       => 'blog-archive-title-shadow',
                'type'     => 'checkbox',
                'title'    => esc_html__('Archive Title Section Shadow', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default' => '0'
            ),
            array(
                'id'       => 'blog-archive-title-bg',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Archive Title Section Background', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'blog-archive-title-color',
                'type'     => 'color',
                'transparent'     => false,
                'title'    => esc_html__('Archive Title Section Color', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => '',
                'validate' => 'color',
            ),
            array(
                'id'       => 'blog-archive-title-padding',
                'type'     => 'spacing',
                'mode'     => 'padding',
                'units'    => 'px',
                'display_units' => false,
                'title'    => esc_html__('Archive Title Section Padding (px)', 'kayleen'),
                'subtitle' => '',
                'desc'     => '',
                'default'  => ''
            ),

        )
    ) );


  

    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Page 404', 'kayleen'),
        'id'               => 'page404_section',
        'desc'             => esc_html__('Page 404 settings', 'kayleen'),
        'subsection'       => false,
        'icon'             => 'el el-ban-circle',
        'fields'           => array(
            array(
                'id'       => 'page-404-template',
                'type'     => 'select',
                'title'    => esc_html__('Page 404 Template', 'kayleen'),
                'subtitle' => esc_html__('Select template for page 404.', 'kayleen'),
                'data'  => 'callback',
                'args' => 'rivax_get_templates_list',
                'desc'     => sprintf(esc_html__('You can create your custom template in %1$s Rivax Templates %2$s section.', 'kayleen'), '<a target="_blank" href="' . admin_url("edit.php?post_type=rivax-template") . '"><b>', '</b></a>'),
                'default' => '0',
                'select2'  => array( 'allowClear' => false ),
            ),

        )
    ) );



    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('AMP', 'kayleen'),
        'id'               => 'amp_section',
        'desc'     => sprintf(esc_html__('If you interested to have an AMP version for your site, please install the %1$s AMP Plugin %2$s. Select Reader Mode for template and Legacy theme and select Posts for Supported Templates.', 'kayleen'), '<a target="_blank" href="https://wordpress.org/plugins/amp/"><b>', '</b></a>'),
        'subsection'       => false,
        'icon'             => 'el el-compass',
        'fields'           => array(
            array(
                'id'       => 'amp-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__('AMP Logo', 'kayleen'),
                'subtitle' => esc_html__('Select your logo for the header.', 'kayleen'),
                'desc'     => '',
                'default'  => '',
            ),
            array(
                'id'       => 'amp-logo-width',
                'type'     => 'slider',
                'title'    => esc_html__('AMP Logo Width', 'kayleen'),
                'subtitle' => esc_html__('Select the logo width.', 'kayleen'),
                'desc'     => esc_html__('Default value: 100', 'kayleen'),
                'default'  => 100,
                'min'       => 60,
                'step'      => 5,
                'max'       => 300,
            ),
            array(
                'id'       => 'amp-sidebar-search',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Sidebar Search', 'kayleen'),
                'desc'     => '',
                'default'  => true,
            ),
            array(
                'id'       => 'amp-back-top',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Footer Back to Top', 'kayleen'),
                'desc'     => '',
                'default'  => true,
            ),
            array(
                'id'       => 'amp-copyright',
                'type'     => 'text',
                'title'    => esc_html__('Footer Copyright', 'kayleen'),
                'default'  => esc_html__('Designed by Rivax Studio. All Rights Reserved.', 'kayleen'),
            ),

        )
    ) );



    Redux::set_section( $opt_name, array(
        'title'            => esc_html__('Performance', 'kayleen'),
        'id'               => 'performance_section',
        'desc'             => esc_html__('Performance settings', 'kayleen'),
        'subsection'       => false,
        'icon'             => 'el el-broom',
        'fields'           => array(
            array(
                'id'       => 'disable-elementor-google-font',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Disable Load Elementor Google Font', 'kayleen'),
                'desc'    => esc_html__('If you don\'t use google fonts from the elementor, enable this option to prevent loading unused google fonts.', 'kayleen'),
            ),
            array(
                'id'       => 'disable-emojis',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Disable Emojis', 'kayleen'),
                'desc'    => esc_html__('If you don\'t use emojis, enable this option to disable emojis.', 'kayleen'),
            ),
            array(
                'id'       => 'disable-extendify',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Disable Extendify Gutenberg Assets', 'kayleen'),
                'desc'    => esc_html__('If you don\'t use Extendify templates in gutenberg (from Redux Framework), enable this option to disable it\s assets.', 'kayleen'),
            ),
            array(
                'id'       => 'disable-woocommerce-assets-out-of-shop',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Disable Woocommerce Assets out Of Shop', 'kayleen'),
                'desc'    => esc_html__('By default woocommerce css/js load on all pages. Enable this option to load them just on woocommerce pages.', 'kayleen'),
            ),
            array(
                'id'       => 'disable-gutenberg-assets',
                'type'     => 'switch',
                'on'     => esc_html__('Enable', 'kayleen'),
                'off'     => esc_html__('Disable', 'kayleen'),
                'title'    => esc_html__('Disable Gutenberg Assets From Archives & Elementor Pages', 'kayleen'),
                'desc'    => esc_html__('By default gutenberg css load on all pages. Enable this option to disable load them from homepage, category & tag archives and pages build with Elementor.', 'kayleen'),
            ),
			array(
				'id'       => 'disable-jquery-migrate',
				'type'     => 'switch',
				'on'     => esc_html__('Enable', 'kayleen'),
				'off'     => esc_html__('Disable', 'kayleen'),
				'title'    => esc_html__('Disable Jquery Migrate', 'kayleen'),
				'desc'    => esc_html__('By default Wordpress load Jquery Migrate. Enable this option to disable load it.', 'kayleen'),
			),

        )
    ) );
 


}