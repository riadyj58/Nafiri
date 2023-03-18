<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


// Replace author image
add_filter( 'pre_get_avatar', 'rivax_replace_author_avatar', 10, 3 );
function rivax_replace_author_avatar ($avatar, $id_or_email, $args) {

	if(isset($args["force_default"]) && $args["force_default"]) {
        return $avatar;
    }
	
    // Get user data.
    if ( is_numeric( $id_or_email ) ) {
        $user = get_user_by( 'id', (int) $id_or_email );
    }
    elseif ( is_object( $id_or_email ) ) {
        $comment = $id_or_email;
        if ( !empty( $comment->user_id ) ) {
            $user = get_user_by( 'id', $comment->user_id );
        } else {
            $user = get_user_by( 'email', $comment->comment_author_email );
        }
        if ( ! $user ) {
            return $avatar;
        }
    } elseif ( is_string( $id_or_email ) ) {
        $user = get_user_by( 'email', $id_or_email );
    } else {
        return $avatar;
    }

    if ( ! $user ) {
        return $avatar;
    }
    $user_id = $user->ID;


    $profile_image_id = intval(get_the_author_meta( 'rivax_author_profile_image_id', $user_id ));
    $profile_image_url = wp_get_attachment_image_url($profile_image_id);
    if($profile_image_url ) {
        return '<img class="avatar avatar-' . (int) $args['size'] . ' photo" src="' . esc_url($profile_image_url) . '" alt="' . esc_html($user->display_name) . '" loading="lazy" width="' . $args['width'] . '" height="' . $args['height'] . '">';
    }

    return $avatar;

}



// Add class to body
add_filter('body_class', 'rivax_body_class');
function rivax_body_class($classes) {

    if(rivax_get_option('smooth-scroll')) {
        $classes[] = 'rivax-smooth-scroll';
    }


    return $classes;
}



// Full Size for Gif image thumbnail
add_filter('wp_get_attachment_image_src', 'rivax_full_size_gif_images', 10, 4);
function rivax_full_size_gif_images($image, $attachment_id, $size, $icon) {
    if( rivax_get_option('full-size-gif') && ! empty( $image[0] ) ) {

        $format = wp_check_filetype( $image[0] );

        if ( ! empty( $format ) && 'gif' == $format['ext'] && 'full' != $size ) {
            return wp_get_attachment_image_src( $attachment_id, 'full', $icon );
        }

    }

    return $image;
}



// Limit search for custom post types
add_filter('pre_get_posts','rivax_limit_search_post_types',100);
function rivax_limit_search_post_types ($query) {

	$post_types = rivax_get_option('search-post-types');

	if ( is_array($post_types) && count($post_types) && $query->is_search && $query->is_main_query() && !is_admin() ) {
		$query->set('post_type',$post_types);
	}

	return $query;
}



// Performance Settings
add_action('wp', function () {

    if( rivax_get_option('disable-elementor-google-font') ) {
        add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );
    }

    if( rivax_get_option('disable-emojis') ) {
        // Prevent Emoji from loading on the front-end
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );

    }

}, 11);

add_action( 'wp_enqueue_scripts', function () {

    if( rivax_get_option('disable-extendify') ) {
        wp_dequeue_style( 'extendify-gutenberg-patterns-and-templates-utilities' );
    }

    if( rivax_get_option('disable-woocommerce-assets-out-of-shop') && function_exists( 'is_woocommerce' ) ){

        if(! is_woocommerce() && ! is_cart() && ! is_checkout() && !is_account_page()) {

            // Dequeue WooCommerce styles
            wp_dequeue_style('woocommerce-layout');
            wp_dequeue_style('woocommerce-general');
            wp_dequeue_style('woocommerce-smallscreen');
            wp_dequeue_style('wc-blocks-vendors-style');
            wp_dequeue_style('wc-blocks-style');
            wp_dequeue_style('woocommerce-inline');
            wp_dequeue_style('rivax-woocommerce');

            // Dequeue WooCommerce scripts
            wp_dequeue_script('wc-cart-fragments');
            wp_dequeue_script('woocommerce');
            wp_dequeue_script('wc-add-to-cart');
            wp_dequeue_script( 'js-cookie' );

        }
    }

    if( rivax_get_option('disable-gutenberg-assets') ) {
        if (is_home() || is_archive() || ( get_the_ID() && class_exists( '\Elementor\Plugin' ) && Elementor\Plugin::instance()->documents->get( get_the_ID() )->is_built_with_elementor() ) ) {

            wp_dequeue_style( 'wp-block-library' );
            wp_dequeue_style( 'wp-block-library-theme' );
            wp_dequeue_style( 'global-styles' );
            remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
        }
    }

}, 11 );

add_action( 'wp_default_scripts', function($scripts) {

	if ( !is_admin() && rivax_get_option('disable-jquery-migrate') && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}

} );



// Add Favicon for AMP
add_action( 'amp_post_template_head', 'wp_site_icon');