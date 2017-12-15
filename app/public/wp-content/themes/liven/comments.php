<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package liven
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="comnts">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'liven' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s thought on &ldquo;%2$s&rdquo;',
							'%1$s thoughts on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'liven'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h2>
        <ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => false,
					'avatar_size' => 48,
					'type' => 'comment',
					'callback' => 'liven_comment_format',
				) );
			?>
		</ul><!-- .comment-list -->
		<div class="clr"></div>
        <div class="cmt-pagi">
    	<?php 
	        paginate_comments_links(array('prev_text' => '&laquo;', 'next_text' => '&raquo;'));
    	?>
	    </div>
	    <div class="clr"></div>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html__( 'Comments are closed.', 'liven' ); ?></p>
	<?php endif; ?>

	<?php
		$comment_args = array(
        'fields' => apply_filters( 'comment_form_default_fields', array(
            'author' => '<p class="comment-form-author"> <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="'.esc_html__("Name *","liven").'" /></p>',
            'email'  => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="'.esc_html__("Email *","liven").'" /></p>',
            'url'    => '<p class="comment-form-url"><input id="url" name="url" type="url" value="" size="30" maxlength="200" placeholder="'.esc_html("Website","liven").'" /></p>' 
        )),
        'comment_field' => '<p> <textarea id="comment" name="comment" cols="45" rows="4" aria-required="true" placeholder="'.esc_html__("Comment...","liven").'" ></textarea> </p>',
        'comment_notes_after' => '',
    );
comment_form($comment_args);
	?>

</div><!-- .comments-area -->