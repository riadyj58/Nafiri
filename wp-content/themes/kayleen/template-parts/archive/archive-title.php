<?php
/**
 * Template part for displaying archive title section
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

global $wp_query;
$post_count = $wp_query->found_posts;

$cls = (rivax_get_option('blog-archive-title-radius'))? ' radius' : '';
$cls .= (rivax_get_option('blog-archive-title-shadow'))? ' shadow' : '';
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="blog-archive-title<?php echo esc_attr($cls); ?>">
		        <?php
		        if( is_category() ) {
			        $title = esc_attr(single_cat_title('', false));
			        $sub_title =  esc_html__('Browse Category', 'kayleen');
		        }
                elseif( is_tag() ) {
			        $title = esc_attr(single_tag_title('', false));
			        $sub_title =  esc_html__('Browse Tag', 'kayleen');
		        }
                elseif( is_tax() ) {
			        $title = esc_attr(single_term_title('', false));
			        $sub_title =  esc_html__('Browse', 'kayleen');
		        }
                elseif (is_post_type_archive()) {
			        $title = esc_attr(post_type_archive_title( '', false ));
			        $sub_title =  esc_html__('Browse', 'kayleen');
		        }
                elseif( is_search() ) {
			        $title = esc_attr(get_search_query());
			        $sub_title =  esc_html__('Search Result for', 'kayleen');
		        }
                elseif( is_author() ) {

		        }
		        else {
			        $title = get_the_archive_title();
			        $sub_title =  esc_html__('Browse', 'kayleen');
		        }


		        if(is_author()) {
			        ?>
                    <div class="blog-archive-author-box">
                        <div class="avatar">
					        <?php echo get_avatar( get_the_author_meta( 'user_email' ), 120 ); ?>
                        </div>
                        <div class="desc">
                            <span class="sub-title"><?php esc_html_e('Author', 'kayleen'); ?></span>
                            <h1 class="title"><?php echo esc_attr(get_the_author()); ?></h1>
                            <div class="description"><p><?php the_author_meta( 'description' ); ?></p></div>
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="author-social-links">
								        <?php
								        if(function_exists('rivax_author_social')) {
									        rivax_author_social(get_the_author_meta( 'ID' ));
								        }
								        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="post-count"><span><?php printf( _n( '%s Article', '%s Articles', $post_count, 'kayleen' ), $post_count ); ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
			        <?php
		        }
                elseif(is_search()) {
			        ?>
                    <div class="blog-archive-search">
                        <span class="sub-title"><?php echo esc_attr($sub_title); ?></span>
                        <h1 class="title"><?php echo esc_attr($title); ?></h1>
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <form action="<?php echo home_url('/'); ?>" method="get" class="blog-archive-search-form">
                                    <input type="text" name="s" value="<?php echo esc_html(get_search_query()); ?>" class="search-field" placeholder="<?php esc_html_e('Search ...', 'kayleen'); ?>" aria-label="Search" required>
                                    <button type="submit" class="submit" aria-label="Submit">
                                        <i class="ri-search-2-line"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <div class="post-count"><span><?php printf( _n( '%s Article', '%s Articles', $post_count, 'kayleen' ), $post_count ); ?></span></div>
                            </div>
                        </div>
                    </div>
			        <?php
		        }
		        else {
			        ?>
                    <span class="sub-title"><?php echo esc_attr($sub_title); ?></span>
                    <h1 class="title"><?php echo wp_kses_post($title); ?></h1>
			        <?php the_archive_description('<div class="description">', '</div>'); ?>
                    <div class="post-count"><span><?php printf( _n( '%s Article', '%s Articles', $post_count, 'kayleen' ), $post_count ); ?></span></div>
			        <?php
		        }

		        ?>
            </div>
        </div>
    </div>
</div>
