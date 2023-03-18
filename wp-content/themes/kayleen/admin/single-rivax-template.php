<?php
/**
 * Template for rivax template preview
 */
 if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="wrapper">

<?php
while ( have_posts() ) :
    the_post();
    the_content();
endwhile;
?>

</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>