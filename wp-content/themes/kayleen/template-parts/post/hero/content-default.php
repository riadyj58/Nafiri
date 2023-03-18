<?php
/**
 * Template part for displaying single post default hero content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly
?>
<div class="single-hero-layout-default">
    <?php if(has_post_thumbnail()): ?>
    <div class="image-container">
		<?php
		the_post_thumbnail('rivax-large', array( 'title' => get_the_title() ));
		?>
    </div>
    <?php endif; ?>
    <?php
    $meta_args = array(
        'category' => true,
        'author-avatar' => true,
        'author-name' => true,
        'date' => true,
        'reading-time' => true,
        'views' => false,
        'comments' => true,
        'excerpt' => false,
    );
    get_template_part('template-parts/post/hero/title-section-1', '', $meta_args);
    ?>
</div>

