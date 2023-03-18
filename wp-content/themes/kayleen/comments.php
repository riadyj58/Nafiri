<?php
/**
 * Template part for displaying comments list and form
 */

$comments_list_collapsable = rivax_get_option('comments-list-collapsable');
$comments_count = get_comments_number();



// If comments are not open and there is no comment, return
if ( !comments_open() &&  !$comments_count ) {
    return;
}


/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password,
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div class="comments-container">
    <?php if( $comments_list_collapsable ): ?>
        <div class="comments-list-collapse-btn-box">
            <button class="comments-list-collapse-btn" data-show="<?php esc_html_e('Show Comments', 'kayleen'); ?>" data-hide="<?php esc_html_e('Hide Comments', 'kayleen'); ?>">
                <?php esc_html_e('Show Comments', 'kayleen'); ?>
            </button>
        </div>
    <?php endif; ?>
    <div id="comments" class="comments-area <?php if($comments_list_collapsable) echo 'collapsed'; ?>">
        <h4 class="comments-title">
        <?php
        if( $comments_count == 0 ) {
            esc_html_e('No Comment! Be the first one.', 'kayleen');
        }
        elseif ( $comments_count == 1 ) {
            esc_html_e('One Comment', 'kayleen');
        }
        else {
            printf( esc_html__('%d Comments', 'kayleen'), $comments_count );
        }
        ?>
        </h4><!-- .comments-title -->

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'avatar_size' => 60,
                    'style'       => 'ol',
                )
            );
            ?>
        </ol><!-- .comment-list -->
        <?php
        the_comments_pagination(
            array(
                'prev_text'          => esc_html__( 'Older comments', 'kayleen' ),
                'next_text'          => esc_html__( 'Newer comments', 'kayleen' ),
            )
        );
        ?>

        <?php if ( ! comments_open() ) : ?>
            <p class="comments-closed"><?php esc_html_e( 'Comments are closed.', 'kayleen' ); ?></p>
        <?php endif; ?>


        <?php
        $commenter = wp_get_current_commenter();

        $req = get_option( 'require_name_email' );
        $aria_req = $req ? " required" : '';
        $req_sign = $req ? ' *' : '';
        $fields =  array(
            'author' => '<input class="form-author" id="author" name="author" type="text" size="30" maxlength="245" placeholder="' . esc_attr__('Name', 'kayleen') . $req_sign . '" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' >',
            'email' => '<input class="form-email" id="email" name="email" type="email" size="30" maxlength="200" placeholder="' . esc_attr__('Email',  'kayleen') . $req_sign . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' >',
            'url' => '<input class="form-website" id="url" name="url" type="url" size="30" maxlength="200" placeholder="' . esc_attr__('Website',  'kayleen'). '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" >',
        );

        $fields = apply_filters( 'comment_form_default_fields', $fields );

        $comments_args = array(
            'fields' => $fields,
            'comment_field' => '<textarea id="comment" name="comment" rows="8" class="form-textarea" placeholder="' . esc_attr__( 'Comment', 'kayleen') . '" required></textarea>',
            'format'               => 'html5',
            );

        comment_form($comments_args);
        ?>
    </div><!-- #comments -->
</div>
