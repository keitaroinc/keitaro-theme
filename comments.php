<?php

/* This is the default template for rendering comments.
* It reuses code from the WordPress twentyseventeen theme.
*/

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( esc_html( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'keitaro' ) ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					esc_html( _nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'keitaro'
                        )
                    ),
					number_format_i18n( $comments_number ),
					get_the_title()
                );
			}
			?>
		</h3>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => __( 'Reply', 'keitaro' ),
				) );
			?>
		</ol>

		<?php the_comments_pagination( array(
			'prev_text' => '<span class="screen-reader-text">' . __( 'Previous', 'keitaro' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'keitaro' ) . '</span>') );

	endif;
    
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
        printf( '<p class="no-comments">%s</p>', esc_html__( 'Comments are closed.', 'keitaro' ) );
    endif;

	comment_form();
	?>

</div><!-- #comments -->
