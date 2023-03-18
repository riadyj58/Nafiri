<?php
/**
 * Template part for displaying single post
 */

get_header();

// Default Sidebar Position for the post
$sidebar_position = rivax_get_option('single-post-sidebar-position');
switch ($sidebar_position) {
	case 'left':
	case 'right':
	case 'none':
	case 'none-narrow':
		break;
	default:
		$sidebar_position = 'right';
}

// Custom Sidebar Position for the post
switch ( get_post_meta(get_the_ID(), 'rivax_page_sidebar', true ) ) {
	case 'left':
		$sidebar_position = 'left';
		break;
	case 'right':
		$sidebar_position = 'right';
		break;
    case 'none':
        $sidebar_position = 'none';
        break;
    case 'none-narrow':
        $sidebar_position = 'none-narrow';
        break;
    case 'elementor':
        $sidebar_position = 'elementor';
        break;
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
		<?php
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();

            if($sidebar_position == 'elementor') {
                ?>
                <div class="content-wrapper">
                    <?php the_content(); ?>
                </div>
                <?php
            }
            else {
                ?>
                <?php get_template_part('template-parts/post/content-top'); ?>
                <?php get_template_part('template-parts/post/single-hero-outside'); ?>
                <div class="content-wrapper">
                    <div class="container">
                        <div class="page-content-wrapper <?php echo 'sidebar-' . $sidebar_position; ?>">
                            <div class="content-container">
                                <?php get_template_part('template-parts/post/single-hero-inside'); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-content' ); ?> >
                                    <?php the_content(); ?>
                                    <?php wp_link_pages(); ?>
                                    <?php
                                    if(get_the_tags($post->ID)) {
                                        echo '<div class="clear"></div>';
                                        echo '<div class="single-post-tags">';
                                        echo '<h4>' . esc_html__('Tags:', 'kayleen') . '</h4>';
                                        the_tags('', '', '');
                                        echo '</div>';
                                    }
                                    ?>
                                </article>
                                <?php get_template_part('template-parts/post/share'); ?>
                                <?php get_template_part('template-parts/post/author-box'); ?>
                                <?php get_template_part('template-parts/post/next-prev-posts'); ?>
                                <?php get_template_part('template-parts/post/next-prev-posts-fixed'); ?>
                                <?php comments_template(); ?>
                            </div>
                            <?php if($sidebar_position == 'left' || $sidebar_position == 'right'): ?>
                                <aside class="sidebar-container <?php if(rivax_get_option('sticky-sidebar')) echo 'sticky'; ?>">
                                    <?php get_sidebar(); ?>
                                </aside>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php get_template_part('template-parts/post/content-bottom'); ?>
                <?php
            }
		endwhile; // End of the loop.
		?>
        <?php if(rivax_get_option('post-reading-progress-indicator')) echo '<div class="post-reading-progress-indicator"><span></span></div>'; ?>
	</main>
<?php
get_footer();
