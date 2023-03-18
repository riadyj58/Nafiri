<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

// We can pass $args or get meta from option panel
$single_default_meta = rivax_get_option('single-default-post-meta');

if(!$single_default_meta) {
    $single_default_meta = array(
        'category'      => true,
        'author-avatar' => true,
        'author-name'   => true,
        'date'          => true,
        'reading-time'  => false,
        'views'         => false,
        'comments'      => true,
        'excerpt'       => false,
    );
}

$show_category = isset($args['category'])? $args['category'] : $single_default_meta['category'];
$show_author_avatar = isset($args['author-avatar'])? $args['author-avatar'] : $single_default_meta['author-avatar'];
$show_author_name = isset($args['author-name'])? $args['author-name'] : $single_default_meta['author-name'];
$show_date = isset($args['date'])? $args['date'] : $single_default_meta['date'];
$show_reading_time = isset($args['reading-time'])? $args['reading-time'] : $single_default_meta['reading-time'];
$show_views = isset($args['views'])? $args['views'] : $single_default_meta['views'];
$show_comments = isset($args['comments'])? $args['comments'] : $single_default_meta['comments'];
$show_excerpt = isset($args['excerpt'])? $args['excerpt'] : $single_default_meta['excerpt'];
$show_title = isset($args['title'])? $args['title'] : true;


?>
<div class="single-hero-title-2">
    <?php if( $show_category ): ?>
        <div class="category">
            <?php
            $categories = get_the_category();
            foreach ($categories as $category) {
                $bg = '';
                if(rivax_get_option('single-category-multi-bg')) {
                    $term_bg = get_term_meta($category->term_id, 'rivax_term_color', true);
                    if($term_bg) {
                        $bg = 'style="background-color: ' . esc_html($term_bg) . '"';
                    }
                }
                echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( $category->name ) . '" ' . $bg . '>' . esc_html( $category->name ) . '</a>';
            }
            ?>
        </div>
    <?php endif; ?>

    <?php if( $show_title ): ?>
        <?php if( is_singular() ): ?>
            <h1 class="title"><span class="title-span"><?php the_title(); ?></span></h1>
        <?php else: ?>
            <h2 class="title"><span class="title-span"><a class="title-animation-underline" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></h2>
        <?php endif; ?>
    <?php endif; ?>

    <?php if( $show_excerpt ): ?>
        <div class="excerpt">
            <?php the_excerpt(); ?>
        </div>
    <?php endif; ?>
    <div class="meta">
        <?php if( $show_author_avatar ): ?>
            <div class="author-avatar">
                <a target="_blank" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' ))); ?>">
                    <?php echo get_avatar( get_the_author_meta( 'user_email' ), 45 ); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="meta-details">
            <?php if( $show_author_name ): ?>
                <div class="author-name">
                    <a target="_blank" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' ))); ?>">
                        <?php echo esc_attr(get_the_author()); ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php if( $show_date ): ?>
                <div class="meta-item date">
                    <span><?php echo get_the_date(); ?></span>
                </div>
            <?php endif; ?>

            <?php if( $show_reading_time ): ?>
                <div class="meta-item reading-time">
                <span>
                <?php
                $mins = rivax_get_reading_time();
                printf( esc_html( _n( 'One Min Read', '%d  Mins Read', $mins, 'kayleen'  ) ), $mins );
                ?>
                </span>
                </div>
            <?php endif; ?>

            <?php if( $show_views ): ?>
                <div class="meta-item views">
                    <span><?php echo rivax_get_post_views(get_the_ID()) . ' ' . esc_html__('Views', 'kayleen'); ?></span>
                </div>
            <?php endif; ?>

            <?php if( $show_comments ): ?>
                <div class="meta-item comments">
                    <a href="#comments">
                        <?php $comments_count = get_comments_number(); ?>
                        <span><?php printf( esc_html( _n( '%d Comment', '%d Comments', $comments_count, 'kayleen'  ) ), $comments_count ); ?></span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
