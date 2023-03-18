<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Sidebar Position for woocommerce
if( is_shop() ) {
	$sidebar_position = rivax_get_option('woocommerce-shop-sidebar-position');
}
elseif( is_product_category() || is_product_tag()) {
	$sidebar_position = rivax_get_option('woocommerce-archive-sidebar-position');
}
else {
	$sidebar_position = 'none';
}

switch ($sidebar_position) {
	case 'left':
	case 'right':
	case 'none':
		break;
	default:
		$sidebar_position = 'none';
}


// Check Sidebar For Content
if( in_array($sidebar_position, ['left', 'right']) ) {
	$sidebar_template_id = rivax_get_layout_template_id('sidebar');
	if(!$sidebar_template_id && !is_active_sidebar( 'rivax_sidebar_widgets' )) {
		$sidebar_position = 'none';
	}
}
?>
<main class="main-wrapper">
	<div class="content-wrapper">
		<div class="container">
			<div class="page-content-wrapper woocommerce-content-wrapper <?php echo 'sidebar-' . $sidebar_position; ?>">
				<div class="content-container">

