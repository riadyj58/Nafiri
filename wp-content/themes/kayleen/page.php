<?php
/**
 * Template part for displaying single page
 */

get_header();

// Default Sidebar Position for the page
$sidebar_position = rivax_get_option('single-page-sidebar-position');
switch ($sidebar_position) {
    case 'left':
    case 'right':
    case 'none':
    case 'none-narrow':
        break;
    default:
        $sidebar_position = 'right';
}

// Custom Sidebar Position for the Page
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
        $sidebar_position = 'none-narrow';
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
                <div class="content-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <header class="single-page-title-wrapper">
                                    <h1 class="single-page-title"><?php the_title(); ?></h1>
                                </header>
                            </div>
                        </div>
                        <div class="page-content-wrapper <?php echo 'sidebar-' . $sidebar_position; ?>">
                            <div class="content-container">
                                <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-content' ); ?> >
                                    <?php the_content(); ?>
                                    <?php wp_link_pages(); ?>
                                </article>
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
                <?php
            }
        endwhile; // End of the loop.
        ?>
    </main>
<?php
get_footer();
